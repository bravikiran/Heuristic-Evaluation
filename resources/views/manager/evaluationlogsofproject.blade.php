@extends('layouts.managerlayout')

@section('content') 

<!-- <div class="container">
	<div class="row">
		<div class="col-md-offset-9 col-md-12">
			<form action="{{ url('evaluationlogsofproject') }}" method="get">
			 <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
			<!-- @if(!empty($results))
			@foreach($results as $result)
			<input type="hidden" name="projectid" value="{{ $result->project_id }}">@endforeach
			@endif
			 -->	<!-- <div class="btn-group" role="group" aria-label="Basic example">
	  				<input type="submit" class="btn btn-lg btn-secondary" name="ratinghigh" value="High">
	  				<button type="button" class="btn btn-primary">Rating</button>
	  				<input type="submit" class="btn btn-lg btn-secondary" name="ratinghigh" value="Low"> -->
				<!-- </div>			
			</form>
		</div>
	</div>
</div> -->

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<form action="{!! url('selectedlogs') !!}" method="POST">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="projectid" value="{{  $project->id }}">
				@if(!empty($evaluators))		
				@foreach( $evaluators as $evaluator)			
				@if( $count == 1)
				<div class="col-md-10 col-lg-10">
				@elseif( $count == 2)
				<div class="col-md-6 col-lg-6">
				@else
				<div class="col-md-4 col-lg-4">
				@endif
				<b>{{ $evaluator->evaemail }}</b>								
					<div class="accordion" id="changecolor">	
						@foreach($evaluationlogs as $evaluationlog)					
						@if( $evaluator->evaemail === $evaluationlog->evaluator_email)
		  				<h3>Principle: {{ $evaluationlog->heuristicrule }}</h3>			
		  				<div class="table-responsive">
		  					<table class="table table-reflow table-striped">
								<tr>
									<th>Note:</th>
									<td>{{ $evaluationlog->note }}</td>
								</tr>
								<tr>
									<th>Recommendation:</th>
									<td>{{ $evaluationlog->recommendation }}</td>
								</tr>
								<tr>
									<th>Rating:</th>
									<td>{{ $evaluationlog->severity }}</td>
								</tr>
								<tr>
									<th>Screenshot:</th>
									<td><img class="myImg min-img-size" src="{!! '../uploads/' . $evaluationlog->screenshot !!}" alt="Screen shot"></td>
								</tr>
								<tr>
									<th>ReferrenceScreenshot:</th>
									<td><img class="myImg min-img-size" src="{!! '../uploads/' . $evaluationlog->referencescreenshot  !!}" alt="Referencescreen"></td>
								</tr>
							</table>
							
							<div class="checkbox btn btn-primary pull-right" >
		  						<label><input type="checkbox" name="logids[]" value="{{ $evaluationlog->id }}">Edit</label>
							</div>

							<div class="pull-left" style="margin-top:10px;">
								<a type="button" class="btn btn-danger" href="{{ route('deleteevaluationlogs', array($evaluationlog->id)) }}">Delete</a>
							</div>
		    			</div>
		    			@endif
		    			@endforeach  
		    		</div> 			  				
				</div>
				@endforeach

				<div class="row">
		  			<div class="col-md-6 col-md-offset-3 gap">
		  				<input type="submit" value="Edit Logs" class="btn btn-primary btn-lg btn-block">
		  			</div>
		  		</div>
		  		@else
				<div class="text-center">
					<strong>{{ "No Evaluation Logs" }}</strong>
				</div>
				@endif
			</form>
			<div class="gap">
				<a href="{{ URL::to('projects') }}" title="Back to projects"><button class="btn btn-default btn-lg">Back</button></a>
			</div>
		</div>
	</div>
</div>
<!-- The Modal -->
<div id="" class="myModal modal">
	<!-- The Close Button -->
	<span class="close" onclick="document.getElementsByClassName('myModal').style.display='none'">&times;</span>
	<!-- Modal Content (The Image) -->
	<img class="modal-content">
</div> 
@stop

@section('script')
<script>
$(function() 
{
    setTimeout(function() {
        $("#errormessage").hide('blind', {}, 300)
    }, 5000);
});
</script>
<script type="text/javascript" src="{{ URL::asset('assets/scripts/webhep.js') }}"></script>
@endsection