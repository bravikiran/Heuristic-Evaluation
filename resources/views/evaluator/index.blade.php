@extends('layouts.evaluatorlayout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">		
				<h2>Requested for Evaluation</h2>
				@if($project != NULL)
				@foreach($project as $proj)
				<div class="table-responsive">
  					<table class="table table-bordered table-hover">
   					    <tr>  
   					    	<th>From</th>
   					    	<td>{{ $proj->manager_email}}</td>
   					    </tr>
   					    <tr>
        					<th>Project Name</th>
        					<td>{{ $proj->projectname }}</td>
        				</tr>
        				<tr>
        					<th>Project Link</th>
        					<td><a href="{{ $proj->projectlink}}" target="_blank">{{ $proj->projectlink}}</a></td>
        				</tr>
        				<tr>
        					<th>Description</th>
        					<td><textarea class="form-control" rows="5" title="description of project" readonly="">{{ $proj->Description }}</textarea></td>
        				</tr>
        				<tr>
        					<th>End Date</th>
        					<td>{{ $proj->date }}</td>
        				</tr>
        				<tr>
        					<th rowspan="2">Choice</th>
        					<td class="success">
        						<form method="get" action="{{ route('evaluator/accept', $proj->id) }}">
								      <button id="btnid" type="submit" class="btn btn-success">Accept</button>
								    </form>
							   </td>
						    </tr>
						    <tr>
        					<td class="warning">
        						<form action="{!! route('evaluator/reject',$proj->id) !!}" method="get">
        						  <button id="infoid" type="submit" class="btn btn-danger">Reject</button>
								    </form>
							    </td>
        				</tr>
  					</table>
  				</div> 
				@endforeach
				@endif
		</div>
	</div>
</div>
@stop

@section('script')
<script>
$(function(){
    $("#formid").hide();
    $("#btnid").on("click", function(){
        $("#formid").show();
    });
});
</script>
<script>
	$("#infoid").on('click', function() {
    		$("#projectlist").hide();	
    	});        
</script>
@stop