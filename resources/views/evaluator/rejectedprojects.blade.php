@extends('layouts.evaluatorlayout')

@section('content')	

<div class="container">
	<div class="row">
		<div class="table-responsive">
		<table class="table table-bordered" id="mytable">
			<thead>
				<tr>
					<th>Project Name</th>
					<th>Description</th>
					<th>Expire Date</th>
					<th>Rejected</th>
					<th>Request</th>
				</tr>
			</thead>
			@if( !empty($projectlists))
			@foreach($projectlists as $projectlist)
			<tbody>
				<tr>
					<td>{{ $projectlist->projectname}}</td>
					<td><textarea class="form-control" rows="5" readonly="">{{ $projectlist->Description}}</textarea></td>
					<td>{{ $projectlist->date}}</td>
					@if(!empty($project))
					@if($project->acceptreject==2 AND $project->request == 1)
					<td>
						<span id="reject" class="label label-info" value="{{ $project->request }}">Rejected</span>
					</td>
					@elseif($project->acceptreject==3)
						<td>
						<span id="reject" class="label label-info" value="{{ $project->request }}">Request Rejected</span>
					</td>
					@else
					<td><span id="reject" class="label label-warning" value="{{ $project->acceptreject }}">Rejected</span></td>
					@endif

					@if($project->request==1)
					<td>
						<button type="buton" class="btn btn-info btn-block">Request Sent</button>
					</td>
					@elseif($project->request==2)
					<td>
						<button type="buton" class="btn btn-info btn-block">Request Decline</button>
					</td>
					@else
					<td>	
						<a href="{!! route('requestprojectevaluation', $projectlist->id) !!}" class="btn btn-block btn-info">Request For Evaluation</a>
					</td>
					@endif
					@endif
				</tr>
			</tbody>
			@endforeach
			@else
				{{ "No Rejected Projects :(" }}
			@endif
		</table>
		</div>
	</div>
</div>
@endsection