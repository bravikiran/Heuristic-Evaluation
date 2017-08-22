<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\validaterequiredparameters;

use App\User;
use App\contactAdmin;
use Validator;
use Input;
use App\Middleware\Authenticate;
use Auth;
use DB;
use Hash;
use Redirect;
use Session;
use Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function login(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|AlphaNum|min:6',
        ]);
    
        if ($validator->fails()) {
           return Redirect::to('/')->withErrors($validator);
        }

        $userdata = array(
            'email' =>  Input::get('email'),
            'password' =>  Input::get('password')
        );

        $checkUserEmail = User::where('email','=', $request->email)->first();
        if(empty($checkUserEmail))
        {
            $validator = "Sorry we did not find your email. please contact admin or register";
            return Redirect::to('/')->withErrors($validator);      
        }

        if (Auth::attempt($userdata))
        {
            //$user = Auth::getLastAttempted();
            if ($checkUserEmail->activated == 1)
            {
                
                if ($checkUserEmail->role == 'Manager')
                {
                    return redirect()->route('manager');  
                }
                elseif($checkUserEmail->role == "Evaluator")
                {
                    return redirect::to('evaluator');
                }
                elseif($checkUserEmail->role == "Developer")
                {
                    return redirect::to('developer');
                } 
            }
            else
            {   
                $validator = "Your email is not activated";
                return Redirect::to('/')->withErrors($validator);               
            }        
        }
        else
        {
            $validator = "Sorry your email and password did not match, please try again";
            return Redirect::to('/')->withErrors($validator);      
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {         
        $validator = Validator::make($request->all(), 
        [
            'name' => 'required|max:50|Alpha',
            'email' => 'required|email:unique|Email',
            'password' => 'required|min:6|AlphaNum',
            'password_confirmation' => 'required|same:password',
            'role' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return redirect::to('signup')->withErrors($validator);
        }
        $chekcEmail = User::where('email',$request->email)->first();
        if (!empty($chekcEmail)) 
        {
            $message = "Already registered with this E-mail address";
            return redirect::to('signup')->withErrors($message); 
        }

        
        $confirmation_code = str_random(60);
        
        $user = new User;
        $user->name = Input::get('name');  
        $user->email = Input::get('email');
        $user->password = Hash::make(Input::get('password'));
        $user->role = Input::get('role'); 
        $user->confirmation_code = $confirmation_code;
        $user->save();

        $data = array('confirmation_code' => $confirmation_code);
        Mail::send('emails.emailverification', $data, function($message) use ($user)
        {
            $message->from('ravi.byg@gmail.com', 'U-HE');
            $message->to($user->email, $user->name)
                ->subject('Verify your email address');
        });

        Session::flash('success','Successfully registered. Confirm E-mail');
        return redirect::to('/');
    }

    

    public function logout()
    {        
        Auth::logout();
        //Session::flash('success','Successfully logout');
        return Redirect::to('/');
    }

}