@extends('layouts.managerlayout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12 col-md-offset-0.5">
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						@foreach( $projects as $project)					
						<th colspan="4" class="text-center">Project Name: {{ $project->projectname }}</th>
					
					<tr>
						<th>Users</th>
						<th>Accept/Reject</th>
						<th>Pending/Finished</th>
						<th>Request</th>
					</tr>

					@foreach( $projectusers as $projectuser)
					<tr>
						@if( $projectuser->project_id == $project->id)						
						<td>{{ $projectuser->evaemail }}</td>

						@if($projectuser->acceptreject == 1)
						<td><span class="label label-success">Accepted</span></td>
						@elseif($projectuser->acceptreject == 2)
						<td><span class="label label-danger">Rejected</span></td>
						@elseif($projectuser->acceptreject == 3)
						<td><span class="label label-info">Request Rejected</span></td>
						@else
						<td><span class="label label-info">Waiting</span></td>
						@endif

						@if($projectuser->pendingfinished == 1)
						<td><span class="label label-success">Finished</span></td>
						@elseif($projectuser->pendingfinished == 2)
						<td><span class="label label-info">Request Rejected</span></td>
						@else
						<td><span class="label label-info">Pending</span></td>
						@endif
						
						@if($projectuser->request == 1)
						<td><a href="{{ route('requestAccept', $projectuser->id) }}"><button class="btn btn-success">Request Accept</button></a>
						<br /><hr />
						<a href="{{ route('requestDecline', $projectuser->id)}}"><button class="btn btn-danger">Request Decline</button></a></td>
						@elseif($projectuser->request == 2)
						<td><span class="label label-info">Request Decline</span></td>
						@else
						<td>None</td>
						@endif						
						@endif
 					</tr>
					@endforeach
					</tr>
					@endforeach
				</table>
				<div class="text-center">
					{!! $projects->render(); !!}
				</div>				
				<div>
        			<a href="{{ URL::to('managerprojectsstatus') }}"><button class="btn btn-lg btn-default" title="back to status page">Back</button>
      			</div>
			</div>
		</div>
	</div>	
</div>
@stop