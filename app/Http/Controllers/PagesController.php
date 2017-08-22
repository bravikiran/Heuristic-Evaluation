<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use App\contactAdmin;
use DB;
use Input;
use Redirect;
use Validator;
use Mail;
use Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
   	public function index()
    {         
        return View('index');  
    }
    
    public function aboutpage()
   	{
   		return View('about');
   	}

   	public function contactpage()
   	{
   		return View('contact');
   	}
   	
   	public function learnpage()
   	{
   		return View('learn');
   	}

    public function signup()
    {
      return View('signup');  
    }

    public function message()
    {
      return View('message');
    }
    
   	public function contactAdmin(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
        'user_name' => 'required|min:4',
        'email' => 'required|email',
        'message' => 'required|min:25',
        ]);

        if ($validator->fails())
        {
            return Redirect::to('contact')->withErrors($validator);;
        }

        $contact_user = new contactAdmin;

        $contact_user->user_name = Input::get('user_name');
        $contact_user->email = Input::get('email');
        $contact_user->message = Input::get('message');
       	$contact_user->save();

        $data = array('name' => Input::get('user_name') , 'email' => Input::get('email'), 'messages' => Input::get('message'));

        Mail::send('emails.contactAdmin', $data, function($message) use($contact_user)
        {
            $message->from($contact_user->email);
            $message->to('ravi.byg@gmail.com', 'Admin')->subject('Feedback');
    	});

        Session::flash('success','Thanks. We will get back to you soon.');
        return Redirect::to('contact');
    }
}
