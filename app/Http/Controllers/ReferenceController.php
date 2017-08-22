<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\managerreferenceusers;
use App\User;
use Auth;
use Validator;
use Input;
use Mail;
use Session;
use Redirect;

class ReferenceController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    
    public function userstatus()
    {
      $user = Auth::User();
      $userstatus = managerreferenceusers::where('manager_id', $user->id)
                                           ->orderBy('id', 'desc')
                                           ->paginate(10);
      if (empty($userstatus))
      {
          return view('manager.inviteusersstatus')->with(['userstatus' => ""]);
      }
      else
      {
        return view('manager.inviteusersstatus')->with(['userstatus' => $userstatus]);
      }
    }

    public function sendInvitationForm()
    {
       return view('manager.sendInvitationForm');
    }

    public function sendInvitation(Request $request)
    {
        
      $validator = Validator::make($request->all(),
         [            
          'email' => 'required|email',
          'role'  => 'required',
          ]
      );

      if($validator->fails())
      {
        return view('manager.sendInvitationForm')->withErrors($validator);
      }

      $CheckEmailInUserTable = User::where('email','=',$request->email)->first();
      if (!empty($CheckEmailInUserTable))
      {
        if ($CheckEmailInUserTable->role == $request->role)
        {           
          $checkInManagerReferenceTable = managerreferenceusers::where('manager_email','=', Auth::user()->email)->where('user_email','=', $request->email)->where('user_role','=', $request->role)->first();

          if (!empty($checkInManagerReferenceTable))
          {
            $message = "Invited user is in your profile";
            return Redirect::to('sendInvitationForm')->withErrors($message);
          }
          else
          {

          $invite_user = new managerreferenceusers;

          $invite_user->manager_id=Auth::id();
          $invite_user->manager_email=Auth::User()->email;
          $invite_user->user_name = Input::get("name");
          $invite_user->description = Input::get('description');
          $invite_user->user_email= Input::get("email");
          $invite_user->user_role = Input::get("role");
          $invite_user->confirmed = 1;
              
          $invite_user->save();

          Session::flash('success','This user is already in the system with same user role. we added this user to your profile. Now you assign project. Thanks');
          return Redirect::to('sendInvitationForm');
         }
        }
       else
        {
          $message = "Sorry to inform, invited user is already registered in the system with different role.";
          return Redirect::to('sendInvitationForm')->withErrors($message);
        }
      }
      else
      {
        $checkEmailInManagerReferenceTable = managerreferenceusers::where('user_email', $request->email)->first();
        
        if(!empty($checkEmailInManagerReferenceTable))
        {
          if(($checkEmailInManagerReferenceTable->user_role == $request->role) AND ($checkEmailInManagerReferenceTable->manager_email == Auth::user()->email))
          {
            $message = "already sent invitation to this email";
            return view('manager.sendInvitationForm')->withErrors($message);
          }
          else
          {
            $invite_user = new managerreferenceusers;

          $invite_user->manager_id=Auth::id();
          $invite_user->manager_email=Auth::User()->email;
          $invite_user->user_name = Input::get("name");
          $invite_user->description = Input::get('description');
          $invite_user->user_email= Input::get("email");
          $invite_user->user_role = Input::get("role");
          $invite_user->invitation_code = MD5(Input::get("email"));
          $invite_user->confirmation_code = MD5(Auth::User()->email).'&uid='.MD5(Input::get("email"));            

          $invite_user->save();

          $data = array( 'confirmation_code' => $invite_user->confirmation_code , 'description' => $invite_user->description);

          Mail::send('emails.invitationregistration', $data, function($message) use($invite_user)
          {
            $message->from('ravi.byg@gmail.com', 'Application');
            $message->to($invite_user->user_email, $invite_user->user_name)
                        ->subject('Verify your email address');
          });

          Session::flash('success','successfully sent.');
          return Redirect::to('sendInvitationForm');
          }
        }
        else
        {
          $invite_user = new managerreferenceusers;

          $invite_user->manager_id=Auth::id();
          $invite_user->manager_email=Auth::User()->email;
          $invite_user->user_name = Input::get("name");
          $invite_user->description = Input::get('description');
          $invite_user->user_email= Input::get("email");
          $invite_user->user_role = Input::get("role");
          $invite_user->invitation_code = MD5(Input::get("email"));
          $invite_user->confirmation_code = MD5(Auth::User()->email).'&uid='.MD5(Input::get("email"));            

          $invite_user->save();

          $data = array( 'confirmation_code' => $invite_user->confirmation_code);

          Mail::send('emails.invitationregistration', $data, function($message) use($invite_user)
          {
            $message->from('ravi.byg@gmail.com', 'Application');
            $message->to($invite_user->user_email, $invite_user->user_name)
                        ->subject('Verify your email address');
          });

          Session::flash('success','successfully sent.');
          return Redirect::to('sendInvitationForm');
          }
        }
      }
}