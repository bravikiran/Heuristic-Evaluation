<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\evaluationlogs;
use App\projectusers;
use App\projectlist;
use App\heuristicRules;
use App\titledescription;
use DB;
use Input;
use Redirect;
use Auth;
use File;
use Session;
use Validator;

class EvaluatorController extends Controller
{   
    public function __construct()
    {
      $this->middleware('auth');
    }
    public function index()
    {
       $user = Auth::User();
       $project = $this->checkProjects();
       return view('evaluator.index')->with(array('project' => $project));
    }

    public function checkProjects(){
        $user = Auth::User();
        $date = date("Y-m-d");
        $projectsAssignedToUser = projectusers::where('evaemail',$user->email)
                                                ->where('created_at', '>=', $date)
                                                ->where('acceptreject', 0)
                                                ->get();

        if ($projectsAssignedToUser != NULL)
        {             
            $getproject_id = array();
            foreach ($projectsAssignedToUser as $projectAssigned)
            {
                array_push($getproject_id, $projectAssigned->project_id);
            }

            $projectlists = projectlist::whereIn('id', $getproject_id)
                                        ->get();
            return $projectlists; 
        }
        else
        {
            return "No Projects";
        } 
               
    }

    public function checkRules($id){
        $project =  projectlist::where('id', $id)->get();
        $queryone = DB::select('select id, name from heuristicrules');
        $titledescriptions = array();
        foreach ($project as $rule) {
           $rule = json_decode($rule->requiredrules);
             for ($i=0; $i < sizeof($rule); $i++) { 
                if ($rule[$i] == $queryone[$i]->name) {
                   array_push($titledescriptions, $queryone[$i]->id);
                }
             }
        }
        $titledes = DB::table('titledescription')->whereIn('rules_id', $titledescriptions)->get();
        return $titledes;
    }

    public function accept($id){
        $user = Auth::User();
        $project = projectusers::where('project_id', $id)
                               ->where('evaemail', $user->email)
                               ->update(['acceptreject' => 1]); 
        Session::flash('success','Successfully accepted');
        return redirect()->route('projectlist');
    }

    public function evaluationlogs($id){
        $hrule = $this->checkRules($id);
        return view('evaluator.evaluationlogs')->with(array('hrule' => $hrule, 'project_id'=> $id));
    }

    public function reject($id){
        $user = Auth::User();
        $project = DB::table('projectusers')
                            ->where('project_id', $id)
                            ->where('evaemail', $user->email)
                            ->update(['acceptreject' => 2]); 
        Session::flash('success','Project Rejected');
        return Redirect::to('rejectedprojects');
    }
    
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'heuristicrule' => 'required',
            'note'          => 'required',
            'severity'      => 'required',
        ]);
        
        if ($validator->fails()) {
           return redirect()->back()->withErrors($validator);
        }

        $id = $request->get('projectid');
        $user = Auth::User();
        $valid_extensions = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/bmp'); // valid extensions
        $target_dir = 'uploads'; // upload directory

        $logs = new evaluationlogs;
        $principles = implode(",", Input::get('heuristicrule'));
        $logs->heuristicrule = $principles;
        $logs->note = Input::get('note');
        $logs->recommendation = Input::get('recommendation');
        $logs->positive = Input::get('positive',false);
        $logs->severity = Input::get('severity');
            
        
        $image = Input::file('screenshot')[0];
        if(isset($image))
        {
            $img = Input::file('screenshot')[0];
            
            // get uploaded file's extension
            $ext = Input::file('screenshot')[0]->getMimeType();
                      
            // can upload same image using project id
            $final_image =  uniqid(). $id .'_screenshot_'. $img->getClientOriginalName();

            //check in Database the file name exits or not
            $check_name = DB::table('evaluationlogs')
                                    ->where('project_id', '=', $id)
                                    ->where('screenshot','=',$final_image)->first();

            if (is_null($check_name)) 
            {
                 // check's valid format
                if(in_array($ext, $valid_extensions)) 
                {   
                    Input::file('screenshot')[0]->move($target_dir, $final_image );
                    $logs->screenshot = $final_image;  

                }
            }
            else
            {   
                $change = $this->changeScreenshotName($img, $id);
                if(in_array($ext, $valid_extensions)) 
                {   
                    Input::file('screenshot')[0]->move($target_dir, $final_image );
                    $logs->screenshot = $final_image; 
                }
            }  
            
        }
       
        $image1 = Input::file('referencescreenshot')[0];
        if(isset($image1))
        {
            $img = Input::file('referencescreenshot')[0];            
            // get uploaded file's extension
            $ext = Input::file('referencescreenshot')[0]->getMimeType();          
            // can upload same image using project id
            $final_image = uniqid(). $id  . '_referencescreenshot_'. $img->getClientOriginalName();

            $check_name = DB::table('evaluationlogs')
                                    ->where('project_id', '=', $id)
                                    ->where('screenshot','=',$final_image)->first();
           
            if (is_null($check_name)) 
            {
                // check's valid format
                 if(in_array($ext, $valid_extensions)) 
                {   
                    Input::file('referencescreenshot')[0]->move($target_dir, $final_image );
                    $logs->referencescreenshot = $final_image;
                }
            }
            else
            {                   
                $change = $this->changeRefScreenshotName($img, $id);
                if(in_array($ext, $valid_extensions)) 
                { 
                    Input::file('referencescreenshot')[0]->move($target_dir, $final_image );
                    $logs->referencescreenshot = $final_image;
                } 
            }
        }    
        
        $logs->project_id = $id;
        $logs->evaluator_email = $user->email;
        $logs->save();  
        return $this->evaluationlogs($id);
    }

    public function changeScreenshotName($img, $id)
    {
        $final_image = uniqid() . $id .'_screenshot_'. $img->getClientOriginalName();
        return $final_image;         
    }

    public function changeRefScreenshotName($img, $id)
    {
        $final_image = uniqid() . $id .'_referencescreenshot_'. $img->getClientOriginalName();
        return $final_image;         
    }


    public function storeLastLog(Request $request)
    {   	
        $validator = Validator::make($request->all(), [
            'heuristicrule' => 'required',
            'note'          => 'required',
            'severity'      => 'required',
        ]);
        
        if ($validator->fails()) {
           return redirect()->back()->withErrors($validator);
        }
        $id = $request->get('projectid');
        $user = Auth::User();
        $valid_extensions = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/bmp'); // valid extensions
        $target_dir = 'uploads'; // upload directory

        $logs = new evaluationlogs;
        $principles = implode(",", Input::get('heuristicrule'));
        $logs->heuristicrule = $principles;
        $logs->note = Input::get('note');
        $logs->recommendation = Input::get('recommendation');
        $logs->positive = Input::get('positive',false);
        $logs->severity = Input::get('severity');
        

        $image = Input::file('screenshot')[0];
        if(isset($image))
        {
            $img = Input::file('screenshot')[0];
            $ext = Input::file('screenshot')[0]->getMimeType();
            $final_image = $id .'_screenshot_'. $img->getClientOriginalName();
            if(in_array($ext, $valid_extensions)) 
            {   
                Input::file('screenshot')[0]->move($target_dir, $final_image );
                $logs->screenshot = $final_image;  
            }
            else
            {   
                $logs->screenshot = "No Image";
            }
        }

        $image1 = Input::file('referencescreenshot')[0];
        if(isset($image1))
        {
            $img = Input::file('referencescreenshot')[0];           
            $ext = Input::file('referencescreenshot')[0]->getMimeType();          
            $final_image = $id  .'_referencescreenshot_'. $img->getClientOriginalName();            
            if(in_array($ext, $valid_extensions)) 
            {   
                Input::file('referencescreenshot')[0]->move($target_dir, $final_image );
                $logs->referencescreenshot = $final_image;
            }
            else
            {
                $logs->referencescreenshot = "No Image"; 
            }
        } 
        $logs->project_id = $id;
        $logs->evaluator_email = $user->email;
        $logs->save();  
        $this->evaluationfinished($id);
        
        Session::flash('seccess','Evaluation Done. Thanks');
        return Redirect::to('evaluator');         	
	}

    public function projects()
    {
        $user = Auth::User();
        $projects = DB::table('projectusers')
            ->where('projectusers.evaemail','=', $user->email)
            ->where('acceptreject','=', 1)
            ->join('projectlist', 'projectusers.project_id', '=', 'projectlist.id')
            ->select('projectusers.*', 'projectlist.*')
            ->orderby('projectusers.id','desc')
            ->get();
    
        if ($projects !=NULL) {
            return view('evaluator.projectlist')->with(array('projects' => $projects));
        }
        else
        {
            return view('evaluator.projectlist')->with(array('projects' => NULL));
        }
    } 

    public function rejectlist()
    {
        $user = Auth::User();
        $rejectedprojects = projectusers::where('evaemail','=', $user->email)
                                        ->whereIn('acceptreject', [0,2, 3])
                                        ->whereIn('request', [0, 1, 2])
                                        ->orderby('id','desc')
                                        ->get();

        if ($rejectedprojects != NULL )
        {    
            $project_id = array();
            foreach ($rejectedprojects as $rejected )
            {
               array_push($project_id, $rejected->project_id);
               $project = $rejected;
            }
            if (empty($project))
            {
                $projectlists = projectlist::whereIn('id', $project_id)->get();
                return view('evaluator.rejectedprojects')->with(array('projectlists' => $projectlists, 'project' => ''));            
            }
            else
            {
                $projectlists = projectlist::whereIn('id', $project_id)->get();
                return view('evaluator.rejectedprojects')->with(array('projectlists' => $projectlists, 'project' => $project));            
            }            
        }    
    }

    public function reports()
    {
        $user = Auth::User();
        $projectlists = projectusers::where('evaemail', $user->email)
                                    ->where('acceptreject', 1)
                                    ->where('pendingfinished', 1)
                                    ->get();
        
        if (is_null($projectlists))
        {   
            return view('evaluator.reports')->with(['projects' => ""]);   
        }
        else
        {
            $projectlist_id = array();
            foreach ($projectlists as $projectlist)
            {
                array_push($projectlist_id, $projectlist->project_id);
            }

            $projects = projectlist::whereIn('id', $projectlist_id)->get();
            return view('evaluator.reports')->with(['projects' => $projects]);
        }
        
    }

    public function evaluatorevaluationlogs($id)
    {
        $user = Auth::User();
       
        $evaluationlogs = DB::table('evaluationlogs')
                                            ->where('project_id', $id)
                                            ->where('evaluator_email', $user->email)
                                            ->get();
                                        
        return view('evaluator.reportlogs')->with(['evaluationlogs' => $evaluationlogs]);
    }

    public function evaluationfinished($id){
        $user = Auth::User();
        $project = DB::table('projectusers')
                            ->where('project_id', $id)
                            ->where('evaemail', $user->email)
                            ->update(['pendingfinished' => 1]);
        return redirect()->route('projectlist');
    }

    public function requestproject($id){
        $user = Auth::User();
        $project = DB::table('projectusers')
                            ->where('project_id', $id)
                            ->where('evaemail', $user->email)
                            ->update(['request' => 1]);
         Session::flash('success','request sent.Thanks');
        return redirect()->route('rejectedprojects');
    }
}