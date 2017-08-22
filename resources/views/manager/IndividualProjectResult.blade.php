@extends('layouts.managerlayout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-3 col-md-3">
			<!-- <div class="dropdown">
  				<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example<span class="caret"></span></button>
  				<ul class="dropdown-menu">
				    <li></li> // Dropdown list of selected heuristic rules for this project
				</ul>
			</div> -->
		</div>
		<div class="col-md-3">
			<form action="IndividualProjectResult" method="POST">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			@if(!empty($results))
			@foreach($results as $result)
			<input type="hidden" name="projectid" value="{{ $result->project_id }}">@endforeach
			@endif
				<div class="btn-group" role="group" aria-label="Basic example">
	  				<input type="submit" class="btn btn-lg btn-secondary" name="ratinghigh" value="High">
	  				<button type="button" class="btn btn-primary">Severity Rating</button>
	  				<input type="submit" class="btn btn-lg btn-secondary" name="ratinghigh" value="Low">
				</div>
			
			</form>
		</div>
		<div class="col-md-3">
			<form action="{!! url('individualprojectresultgraph') !!}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			@if(!empty($result))
			<input type="hidden" name="generateprojectid" value="{{ $result->project_id }}">
			@endif
				<input type="submit" name="generate" value="Generate Graph" class="btn btn-lg btn-default">
			</form>
		</div>
	</div>	
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<label>Project Name:</label>
			<strong>{{ $projectlist->projectname }}</strong>
			
			<div class="accordion">
			@foreach($results as $result)						
  				<h4>Principle: {{ $result->heuristicrule }}</h4>				
  				<div>
  					<table class="table table-reflow table-striped">
						<tr>
							<th>Note:</th>
							<td>{{ $result->note }}</td>
						</tr>
						<tr>
							<th>Recommendation:</th>
							<td>{{ $result->recommendation }}</td>
						</tr>
						<tr>
							<th>Rating:</th>
							<td>{{ $result->severity }}</td>
						</tr>
						<tr>
							<th>Screenshot:</th>
							<td>
								@foreach( $result->screen as $screen)
								<img class="myImg min-img-size" src="{!! './uploads/' .   $screen !!}" alt="Screenshot">
								@endforeach								
							</td>
						</tr>
						<tr>
							<th>ReferrenceScreenshot:</th>
							<td>
							@foreach( $result->refscreen as $refscreen)
							<img class="myImg min-img-size" src="{!! './uploads/' . $refscreen !!}" alt="refScreenshot">
							@endforeach
							</td>
						</tr>

						<tr>
							<th>Comments</th>							
							<td>
							@foreach( $comments as $comment)
							@if( $result->id == $comment->log_id)
							<textarea rows="5" class="form-control">{{ $comment->user_email ." :: ". $comment->comment ." \n" }}
							</textarea>
							@endif
							@endforeach
							</td>
						</tr>
						<form action="{{ URL::to('tracking') }}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<tr>
							<th>Track Old Logs</th>
							<td>
								<button type="submit" class="btn btn-lg btn-primary" name = "trackid" value="{!! $result->id !!}"><span class="badge">Click</span></button>								
							</td>
						</tr>
						</form>
					</table>
    			</div>
    		@endforeach
		</div>
		<!-- The Modal -->
		<div id="" class="myModal modal">
	  		<!-- The Close Button -->
	  		<span class="close" onclick="document.getElementsByClassName('myModal').style.display='none'">&times;</span>
			<!-- Modal Content (The Image) -->
	  		<img class="modal-content">
  		</div>
	</div>
</div>
<div class="text-center gap">
    <a href="{{ url('projectsreport') }}"><button class="btn btn-lg btn-default">Back</button>
</div>
@stop

@section('script')
<script type="text/javascript" src="assets/scripts/showlogs.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets/scripts/webhep.js') }}"></script>
@endsection
