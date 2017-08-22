@extends('layouts.evaluatorlayout')

@section('content')

<div class="container">
	<div class="row">
		<div class="accordion">
		@foreach($evaluationlogs as $evaluationlog)
		<h3>Principle: {{ $evaluationlog->heuristicrule }}</h3>
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
					<td><img src="{!! '../uploads/' . $evaluationlog->screenshot !!}" alt="Screenshot" class="myImg min-img-size" title="Screen shot"
					></td>
					
				</tr>
				<tr>
					<th>ReferenceScreenshot:</th>
					<td><img src="{!! '../uploads/' . $evaluationlog->referencescreenshot  !!}" alt="refScreenshot" class="myImg min-img-size" title="Reference Image"></td>
				</tr>
			</table>
		@endforeach	
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
<script type="text/javascript" src="assets/scripts/showlogs.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets/scripts/webhep.js') }}"></script>

@stop