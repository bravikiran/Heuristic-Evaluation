@extends('layouts.managerlayout')

@section('content')
<div class="container">
<div class="row">
		<div class="col-md-12">
      <div class="table-responsive"></div>
			<table class="table table-striped table-bordered table-hover">
  			<tr>
  				<th>Project Name</th>
  				<th>Link</th>						
  				<th>Due Date</th>
  				<th>Project Details</th>
          <th>Evaluation Logs</th>
  			</tr>

  			@if(!empty($projects))
  			@foreach($projects as $project)
  			<tr>
  				<td>{{ $project->projectname}}</td>
  				<td><a href="{{ $project->projectlink}}" title="project link">{{ $project->projectlink}}</a></td>
  				<td>{{ $project->date}}</td>
  				<td>
            <form action="showprojectdetails" method="get">
              <input type="hidden" name="projectid" value="{{ $project->id }}">
              <button type="submit" class="btn btn-default btn-block">View</button>
            </form>
          </td>
          <td><a href="{{ route('projectreports',$project->id) }}"><button class="btn btn-primary btn-block">View Logs</button></a></td>
  			</tr>
  			@endforeach
  			@endif
			</table>
      </div>
      <div class="text-center">
        {!! $projects->render(); !!}
      </div>      
		</div>
	</div>
</div>
</div>  
@stop