@extends('layouts.managerlayout')

@section('content')      
<div class="container">
  <div class="col-md-12">
      <div class="col-md-6">
        <h3>Project details</h3>              
        <form method="POST" action="{{ route('createproject') }} " class="form-horizontal">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
   			      <label for="Projectname">Project Name</label>
   			      <input type="text" name="projectname" class="form-control" placeholder="example project" required="">
 		        </div>

 						<div class="form-group">
   	    			<label for="projectlink">Project Link</label>              
              <input type="url" name="projectlink" class="form-control" placeholder="Input your application url eg. http://www.example.com" value="" required="">
 						</div>
                    
            <div class="form-group" style="color:initial;">
               <label for="description">Description</label>
               <textarea class="form-control" name="description" rows="3" required=""></textarea>
            </div>   					
    				
    				<div class="form-group">
              <label for="HEA">Heuristic Principle</label>
                <div>
                  <button class="form-control btn btn-default btn-block" id="someh">Select Heuristic Principle</button>
                </div>
                <div id="showh" class="hideevaluators setheightwidth">
                  @foreach($rulename as $name)
                    <div class="checkbox">               
                      <label><input type="checkbox" value="{{ $name->name }}"  name="hrules[]">{{ $name->name }}</input></label>
                    </div>
                    @endforeach                              
                </div>                
            </div>
                   

    				<div class="form-group">
    					<label>End Date</label>
              <input class="form-control" id="myInput" type="date" oninput="get_date()" name="date"></input>
    				</div>        
      </div>

      <div class="col-md-6">
        <h3>Project member selection</h3>
        <label style="color:initial;">Evaluators</label>
        <div>
          <button class="form-control btn btn-default btn-block" id="some">Select Evaluators</button>
          <div id="show" class="hideevaluators setheightwidth">
          @foreach($evaluators as $evaluator)
            <div class="checkbox">
              <label><input type="checkbox" value="{{ $evaluator->user_email }}" name="evaemail[]">{{ $evaluator->user_email , $evaluator->id }}</input>
            </div>
          @endforeach
          </div>                                        
        </div>
        <div class="form-group gap"> 
          <label style="color:initial;">Developers</label>
          <div>
            <button class="form-control btn btn-default btn-block" id="somed">Select Developers</button>
            <div id="showd" class="hideevaluators setheightwidth">
            @foreach($developers as $developer)
              <div class="checkbox">
                <label><input type="checkbox" value="{{ $developer->user_email }}" name="devemail[]">{{ $developer->user_email , $developer->id }}</input></label>
              </div>
              @endforeach
            </div>                      
          </div>            
        </div>
      </div>    
      <div class="form-group">
        <button id="myBtn" class="btn btn-lg btn-success btn-block" name="submit" value="Click for Registration" onclick="check_fields()">Send Project Evaluation Request</button>
      </div>  
    </form>
  </div>
</div>
@stop