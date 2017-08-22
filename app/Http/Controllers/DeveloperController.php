<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\developer;
use App\developercomments;
use App\developerprojectlist;
use App\evaluationresults;
use App\projectlist;
use Input;
use Redirect;
use Auth;
use Validator;
use Session;

class DeveloperController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $projectsAssignedToDeveloper = developerprojectlist::where('devemail',Auth::User()->email)->get();
        if ($projectsAssignedToDeveloper != NULL) 
        {  

            $getproject = array();           
            foreach ($projectsAssignedToDeveloper as $projectAssigned)
            {
                array_push($getproject, $projectAssigned->project_id);
            }
            $projects = projectlist::whereIn('id', $getproject)->orderby('id','desc')->paginate(8);  
        } 
        return View('developer.index')->with(array('projects' => $projects));
    }

    public function commentonlogs($id)
    {   
        $user = Auth::User();
        $evaluationlogs = evaluationresults::where('project_id', $id)->get();

            $evaluationlog_id = array();
            foreach ($evaluationlogs as $evaluationlog) 
            {
               array_push($evaluationlog_id, $evaluationlog->id);
            }

            $comments = developercomments::where('project_id', $id)
                                          ->where('user_email',$user->email)
                                          ->whereIn('log_id', $evaluationlog_id)
                                          ->get();
            $comments_id = array();
            foreach ($comments as $comment)
            {   
                array_push($comments_id, $comment->log_id);
            }

            foreach ($evaluationlogs as $evaluationlog )
            {
                $evaluationlog->screen = explode(',', $evaluationlog->screenshot);
            }


            foreach ($evaluationlogs as $evaluationlog )
            {
                $evaluationlog->refscreen = explode(',', $evaluationlog->referencescreenshot);
            }

            if (empty($comment))
            {
                return View('developer.evaluationlogs')->with(['evaluationlogs'=> $evaluationlogs, 'user' => $user]);
            }
            else
            {
                    
                $evaluationlogs = evaluationresults::where('project_id', $id)
                                                    ->whereNotIn('id', $comments_id)
                                                    ->get();
                foreach ($evaluationlogs as $evaluationlog )
                {
                    $evaluationlog->screen = explode(',', $evaluationlog->screenshot);
                }
            

                foreach ($evaluationlogs as $evaluationlog )
                {
                    $evaluationlog->refscreen = explode(',', $evaluationlog->referencescreenshot);
                }
                    return View('developer.evaluationlogs')->with(['evaluationlogs'=> $evaluationlogs, 'user' => $user]);
            }
    }

     public function savelogcomment(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'comment' => 'required',
        ]);
    
        if ($validator->fails()) {
           return redirect()->back()->withErrors($validator);
        }

        $comment = new developercomments;
        $comment->project_id = Input::get('project_id');
        $comment->log_id = Input::get('log_id');
        $comment->user_email = Auth::User()->email;
        $comment->comment = Input::get('comment');
        $comment->save();
        Session::flash('success','Comment saved');
        return redirect()->back();
    }    
}