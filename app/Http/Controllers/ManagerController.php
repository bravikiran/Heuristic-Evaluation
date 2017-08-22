<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Khill\Lavacharts\Lavacharts;
use DB;
use App\User;
use App\projectlist;
use App\projectusers;
use App\developerprojectlist;
use App\evaluationresults;
use App\evaluationlogs;
use App\developercomments;
use App\heuristicrules;
use App\managerreferenceusers;
use Input;
use Auth;
use Redirect;
use Session;
use Schema;
use Validator;

class ManagerController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    public function index()
    {
      $notification = $this->notifications();
      $lastfiveprojects = $this->lastfivecreatedproject();

      return view('manager.index')->with(array('notification' => $notification, 'lastfiveprojects' => $lastfiveprojects));
    }

    public function notifications()
    {
      $checkNotification = array('read' => 0 , 'confirmed' => 1);
      $userRead = managerreferenceusers::where('manager_email','=',Auth::user()->email)->where($checkNotification)->orderby('id','desc')->get();      
        return $userRead;
    }

    public function lastfivecreatedproject()
    {
      $user = Auth::User();
      $projects = projectlist::where('manager_email', $user->email)
                              ->orderby('id','desc')
                              ->take(5)
                              ->get();                             
      return $projects;
    }

    public function notificationread($id)
    {
      managerreferenceusers::where('id','=', $id)->update(['read' => 1]);
      Session::flash('success','Read notification');
      return Redirect::to('index');
    }

    public function show()
    {
    	return View('manager.evadev');
    }

    public function createForm()
    {
      $user = Auth::User();
      $rulename  = heuristicrules::whereIn('user_id', [$user->id, 0])->get();

      $evaluators = managerreferenceusers::where('manager_id','=', $user->id )->where('user_role','=', 'Evaluator')->where('confirmed','=', 1)->get();
      
      $developers = managerreferenceusers::where('manager_id','=', $user->id )->where('user_role','=', 'Developer')->where('confirmed','=', 1)->get();
     
      return View('manager.projectForm')->with(array('rulename' => $rulename, 'evaluators' => $evaluators, 'developers' => $developers));    
    }

    public function createProject(Request $request)
    {
      
      $validator = Validator::make($request->all(), [
            'projectname' => 'required',
            'projectlink' => 'required',
            'hrules'      => 'required',
            'date'        => 'required',
            'evaemail'    => 'required',
        ]);
    
        if ($validator->fails()) {
           return redirect()->back()->withInput()->withErrors($validator);
        }

      $users = Auth::User();
      $project = new projectList;
      $project->projectname = Input::get('projectname');
      $project->projectlink = Input::get('projectlink');
      $project->description = Input::get('description');      
      $project->requiredrules = json_encode(Input::get('hrules'));     
      $project->date = Input::get('date');
      $project->manager_email = $users->email;
      $project->save();

      $size = sizeof(Input::get('evaemail'));
      for ($i=0; $i < $size ; $i++) {
          $projectusers = new projectusers;
          $projectusers->evaemail = Input::get('evaemail')[$i];
          $projectusers->project_id = $project->id;
          $projectusers->save();
      }

      $developersize = sizeof(Input::get('devemail'));
      for ($i=0; $i < $developersize ; $i++) { 
            $projectdevelopers = new developerprojectlist;            
            $projectdevelopers->devemail = Input::get('devemail')[$i];
            $projectdevelopers->project_id = $project->id;
            $projectdevelopers->save();

          }
          Session::flash('success','Successfully Sent.');
          return redirect::to('projectForm');          
    }

    Public function projects()
    { 
      $user = Auth::User();
      $projects = projectlist::where('manager_email', $user->email)
                              ->orderby('id','desc')
                              ->paginate(8);
      return View('manager.projects')->with('projects', $projects);
    }

     Public function showproject()
    {
      $id = Input::get('projectid');
      $projects = projectlist::find($id);
      $pass = json_decode($projects->requiredrules);
      $evaluators = DB::table('projectusers')->where('project_id','=', $id)->get();
      $developers = DB::table('developerprojectlist')->where('project_id','=', $id)->get();
      return View('manager.detailsofproject')->with(array('projects'=> $projects , 'pass' => $pass, 'evaluators' => $evaluators, 'developers'=> $developers ));
    }

    public function ProjectReports($id)
    {
      $project = projectlist::find($id);      
      $evaluators = DB::table('projectusers')
                                        ->where('project_id','=', $id)
                                        ->where('acceptreject','=', 1)
                                        ->where('pendingfinished','=', 1)
                                        ->get();
      $finished = projectusers::where('project_id', $id)->where('pendingfinished', 1)->get();
      $count = 0;
      foreach ($finished as $getCount) {
        $count += $getCount->pendingfinished;
      }
      
     $evaluationlogs = evaluationlogs::where('project_id','=', $id)
                                        ->whereNull('deleted_at')
                                        ->orderby('id','asc')
                                        ->get();
    
      return view('manager.evaluationlogsofproject')->with(array('evaluationlogs' => $evaluationlogs, 'project'=> $project,'evaluators' => $evaluators, 'count' => $count));
    }

    public function selectiongevaluationlogs(Request $request)
    {  
      
      if (is_null($request->get('logids'))) {
        $validator = "please select atleast one Log";
        return redirect()->back()->withErrors($validator);
      }
      
      $logs = array();
  
      for($i=0;$i<sizeof($request->get('logids'));$i++)
      {
        $evaluationlogs = DB::table('evaluationlogs')
                                            ->where('project_id','=', $request->get('projectid'))
                                            ->where('id','=', $request->get('logids')[$i])
                                            ->get();  
        array_push($logs, $evaluationlogs);
      }
        Session::put("logids",$request->get('logids'));

        $heuristicruleUnique = array();     
         foreach ($logs as $key ) {
          $getOnlyheuristics = $key[0]->heuristicrule;          
          $removieLastCommna = rtrim($getOnlyheuristics,',');
          $makeArray = explode(',', $removieLastCommna);
          foreach ($makeArray as $heuristickey => $heuristicrule) {
            $heuristicruleUnique[] = $heuristicrule;
          }
         }
         $gotUniqueheuristic = array_unique($heuristicruleUnique);

        return view('manager.editevaluationlogs')->with(array('logs' => $logs, 'project_id' => $request->get('projectid'), 'gotUniqueheuristic' => $gotUniqueheuristic));
    }

    public function storeEvaluationResults(Request $request, $id)
    {
       $user = Auth::User();
       $results = new evaluationresults;

       $results->heuristicrule = Input::get('heuristicrules');
       $results->note = Input::get('note');
       $results->recommendation = Input::get('recommendation');
       $results->severity = Input::get('severity');

       $getCount = sizeof(Input::get('screenshot'));
       for ($i=0; $i < $getCount; $i++) { 
         $screenshot = implode(",", Input::get('screenshot'));
       }
       $results->screenshot = $screenshot;    
       
       $getCount = sizeof(Input::get('referencescreenshot'));
       for ($i=0; $i < $getCount; $i++) {
        $referencescreenshot = implode(",", Input::get('referencescreenshot'));
       }
       $results->referencescreenshot = $referencescreenshot ;

       $results->project_id = $id;
       $results->tracking = implode(",", Session::get("logids"));
       $results->save();

       $this->softdeleteselectedlogs();

       return $this->ProjectReports($id);
    }

    public function projectresults()
    {
      $user = Auth::User();
      $projectlist = DB::table('projectlist')
                          ->where('manager_email','=', $user->email)
                          ->orderby('id','desc')
                          ->paginate(8);
      if (is_null($projectlist))
      {
        return view('manager.projectsreport')->with(array('projectlist' => ''));
      }
      else
      {
        return view('manager.projectsreport')->with(array('projectlist' => $projectlist));
      }      
    }

    public function IndividualProjectResult(Request $request)
    {
      
      if ($request->get('ratinghigh') == "High") {
        $results = evaluationresults::where('project_id',$request->get('projectid'))
                                  ->orderby('severity','desc')
                                  ->orderby('id','asc')
                                  ->get();
      }elseif ($request->get('ratinghigh') == "Low") {
        $results = evaluationresults::where('project_id',$request->get('projectid'))
                                  ->orderby('severity','asc')
                                  ->orderby('id','asc')
                                  ->get();
      }else{
        $results = evaluationresults::where('project_id',$request->get('projectid'))
                                  ->orderby('id','asc')
                                  ->get();  
      }

      $projectlist = projectlist::where('id', $request->get('projectid'))->first();
      $comments    = developercomments::where('project_id', $request->get('projectid'))->get();
      
      if (!empty($results))
      {
      foreach ($results as $result )
      {
          $result->screen = explode(',', $result->screenshot);
      }

      foreach ($results as $result )
      {
          $result->refscreen = explode(',', $result->referencescreenshot);
      }

      return view('manager.IndividualProjectResult')->with(array('results' => $results, 'projectlist' => $projectlist, 'comments' => $comments));
      }

      return view('manager.IndividualProjectResult')->with(array('results'=>"", 'projectlist' => "", 'comments' => ""));
      
    }

    public function lavashow(Request $request)
    { 
      $results = evaluationresults::where('project_id', $request->get('generateprojectid'))->get();
       
       $count = [];
       foreach ($results as $result)
       {
         $heuristicrules = (explode(',', $result->heuristicrule));
         $removieLastCommna = rtrim(implode(',', $heuristicrules),',');
         $makearraywithoutcomma = explode(',', $removieLastCommna);
         foreach ($heuristicrules as $rest => $value) 
         {
          array_push($count, $value);
        }
      }

      $passTocharts = array_filter($count);
      $hrules = array_count_values($count);
      $lava = new Lavacharts; 
      $heuristic = \Lava::DataTable();

      $heuristic->addStringColumn('Reasons')
                ->addNumberColumn('Percent')
                ;
      foreach ($hrules as $key => $value) {
        $heuristic->addRow([
          $key, $value ]);
      }

      \Lava::DonutChart('IMDB', $heuristic, [
          'title' => 'Display Project Name'
      ]);
      
    return View('manager.projectresultgraph',['results' => $results]);  
  }

    public function tracking()
    {
      
      $trackinglogs = evaluationresults::where('id', Input::get('trackid'))->get();
      foreach ($trackinglogs as $trackinglog) {
          $tracking = explode(',',  $trackinglog->tracking);
      }

      $trackedlogids = DB::table('evaluationlogs')->whereIn('id' , $tracking)->get();
      
      return View('manager.trackinglogs')->with(['trackedlogids' => $trackedlogids, 'tracking' => $tracking]);
      
    }
    
    public function managerprojectsstatus()
    { 
      $user = Auth::User();
      $trythis = array();
      $projects = projectlist::where('manager_email', $user->email)
                              ->orderby('id','desc')
                              ->paginate(2);
      
      $project_id = array();
      foreach ($projects as $project ) 
      { 
        array_push($project_id, $project->id);
      }
      
      $projectusers = projectusers::whereIn('project_id', $project_id)->get();
      return View('manager.managerprojectsstatus')->with(['projects' => $projects, 'projectusers' => $projectusers]);
    }

    public function softdeleteselectedlogs()
    {
      for($i=0;$i<sizeof(Session::get('logids'));$i++)
      {
        $softdelete = evaluationlogs::where('id', Session::get('logids')[$i])->delete();
      }
    }

    public function destroy($id)
    {
      $projectlist = projectlist::find($id);
      $projectlist->delete();
      return Redirect::to('projects');
    }

    public function deleteevaluationlogs($id)
    {      
      
      $validator = "Please select atleast one log to delete";
      if (is_null($id))
      {
        return redirect()->back()->withErrors($validator);  
      }
      else
      {
        $getCount = sizeof($id);
        for ($i=0; $i < $getCount; $i++) { 
          evaluationlogs::find($id)->delete();  
        }        
        return redirect()->back();
      }
    }

    public function requestAccept($id)
    {
      projectusers::where('id', $id)
                      ->update(['acceptreject' => 0, 'request' => 0]);
      Session::flash('success','Request Accepted');
       return redirect()->back();
    }

    public function requestDecline($id)
    {
         projectusers::where('id', $id)
                      ->update(['acceptreject' => 3,'pendingfinished' => 2, 'request' => 2]);
      Session::flash('success','Request Declined');
       return redirect()->back();
    }
}