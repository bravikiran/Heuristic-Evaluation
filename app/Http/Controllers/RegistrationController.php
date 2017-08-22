<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Redirect;
use Session;

class RegistrationController extends Controller
{
    public function confirm($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            $message = "Oops something went wrong. Please check the code.";
            return View("errors",['message' => $message]);
        }

        $user = User::whereConfirmationCode($confirmation_code)->first();

        if ( ! $user)
        {
            $message = "Oops something went wrong. Please check the code.";
            return View("errors",['message' => $message]);
        }

        $user->activated = 1;
        $user->confirmation_code = null;
        $user->save();

        Session::flash('success','Email confirmed. Thanks.');
        return Redirect::to('/');
    }
}