@extends('layouts.managerlayout')

@section('content') 

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="accordion">
			@foreach( $trackedlogids as $trackedlogid )
			<h4>Principle:{{ $trackedlogid->heuristicrule }}</h4>				
  				<div>
				<table class="table table-reflow table-striped">
					<tr>
						<th>Note:</th>
						<td>{{ $trackedlogid->note }}</td>
					</tr>
					<tr>
						<th>Recommendation:</th>
						<td>{{ $trackedlogid->recommendation }}</td>
					</tr>
					<tr>
						<th>Rating:</th>
						<td>{{ $trackedlogid->severity }}</td>
					</tr>
					<tr>
						<th>Screenshot:</th>
						<td><img src="{!! './uploads/' . $trackedlogid->screenshot !!}" alt="Screenshot" class="myImg min-img-size"><td>
					</tr>
					<tr>
						<th>ReferrenceScreenshot:</th>
						<td><img src="{!! './uploads/' . $trackedlogid->referencescreenshot  !!}" alt="refScreenshot" class="myImg min-img-size"></td>
					</tr>
				</table>
				</div>
				@endforeach	
			</div>		
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

<div class="col-md-12 gap">
	<div class="col-md-offset-3 col-md-6 col-md-offset-3">
		<form action="{{ URL::to('IndividualProjectResult') }}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<button type="submit" name="projectid" value="{{ $trackedlogid->project_id}}"class="btn btn-lg btn-default btn-block"> Back</button>
		</form>
	</div>
</div>

@stop