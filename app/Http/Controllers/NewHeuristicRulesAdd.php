<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\heuristicrules;
use App\titledescription;
use Input;
use DB;
use Redirect;
use Validator;
use App\User;
use Auth;
use Session;

class NewHeuristicRulesAdd extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user = Auth::User();   
        $heuristicrules = DB::select('select id, name from heuristicrules where user_id = '. $user->id . ' OR user_id = 0');
        return view('manager.heuristicrules')->with('heuristicrules',$heuristicrules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.addheuristic');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validate($request,['name'=> 'required']);
        $user_id = Auth::User();
        $newrule = new heuristicrules;
        $newrule->name = Input::get('name');
        $newrule->user_id = $user_id->id;
        $newrule->save(); 
    
        $countOfTitle = sizeof(Input::get('mytext'));
        for ($i=0; $i < $countOfTitle ; $i++){ 
            $titledescription = new titledescription;
            $titledescription->title = Input::get('mytext')[$i];
            $titledescription->description = Input::get('description')[$i];
            $titledescription->rules_id = $newrule->id;
            $titledescription->save(); 
        }      
        
        Session::flash('success','Successfully added.');
        return redirect()->route('heuristicrules');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $titledescriptions = heuristicrules::find($id)->titledescription;      
      return view('manager.showheuristic')->with(array('titledescriptions'=> $titledescriptions));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
       $validator = "You Can't edit Default Heuristic Principles";
       if ($id == 4) {
           return redirect()->back()->withErrors($validator);  
       }
       else
       {    
            $heuristicrulesname = heuristicrules::find($id);
            $heuristicrules = titledescription::where('rules_id','=', $id)->get();
            return view("manager.editheuristicrules")->with(array('heuristicrulesname' => $heuristicrulesname, 'heuristicrules' => $heuristicrules));
       }
    }

    public function update($id)
    {
        $user_id = Auth::User();

        $update = heuristicrules::find($id);
        $update->name = Input::get('name');
        $update->save();
       
        $countOfTitle = sizeof(Input::get('mytext'));
        for ($i=0; $i < $countOfTitle ; $i++){ 
           $titledescription = titledescription::where('rules_id','=',$id)->first();
            $titledescription->title = Input::get('mytext')[$i];
            $titledescription->description = Input::get('description')[$i];
            $titledescription->rules_id = $update->id;
            $titledescription->save(); 
        }
        Session::flash('success','Successfully updated');
        return redirect()->route('heuristicrules');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $validator = "You Can't delete Default Heuristic Principles";
       if ($id == 4) {
           return redirect()->back()->withErrors($validator);  
       }
       else
       {
        DB::table('titledescription')->where('rules_id', '=', $id)->delete();
        DB::table('heuristicrules')->where('id', '=', $id)->delete();
        }
        
        Session::flash('success','Successfully deleted');
        return redirect()->route('heuristicrules');

    }
}
