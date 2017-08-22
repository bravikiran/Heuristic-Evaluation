<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Exceptions;

use App\managerreferenceusers;
use App\User;
use Redirect;
use Validator;
use Input;
use Hash;
use Session;

class InvitationRegistrationController extends Controller
{
    public function referencesignupview()
    {
        return View('referencesignup');
    }

    public function confirm($confirmation_code)
    {
       
        if( ! $confirmation_code)
        {
            $message = "Oops something went wrong. Please check the code.";
            return View("errors",['message' => $message]);
        }

        $invitation = managerreferenceusers::whereConfirmationCode($confirmation_code)->first();

        if ( ! $invitation)
        {
            $message = "Oops something went wrong. Please check the code.";
            return View("errors",['message' => $message]);
        }

        if ($invitation->confirmed == 1) 
        {   
            $message = "This email is already confirmed";
            return Redirect::to('message')->withErrors($message);
        }
        
        return View('referencesignup', array('invitation' => $invitation));
    }

    public function referencesignup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50|Alpha',
            'user_email' => 'required|Email',
            'password' => 'required|min:6|AlphaNum',
            'password_confirmation' => 'required|same:password',
            'user_role' => 'required',
        ]);

        if ($validator->fails()) 
        {            
            return back()->withErrors($validator);
        }

        $invitation = managerreferenceusers::whereConfirmationCode($request->ref_code)->first();
        if (!($invitation->user_email == $request->user_email AND $invitation->user_role== $request->user_role)) 
        {               
            $message = "Please don't change your email address and role";
            return back()->withErrors($message);
        }
        else
        {

            $user = new User;
            $user->name = $request->name;  
            $user->email = $request->user_email;
            $user->password = Hash::make(Input::get('password'));
            $user->role = $request->user_role;
            $user->activated = 1;
            $user->save();            
            
            managerreferenceusers::where('user_email','=', $request->user_email)->update(['confirmed' => 1]);
            
            Session::flash('success','Successfully register.Thanks');
            return redirect::to('/');
        }
    }
}
