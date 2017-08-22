@extends('layouts.evaluatorlayout')

@section('content')	

<div class="container">
	<div class="row">
		<table class="table table-bordered" id="mytable">
			<thead>
				<tr>
					<th>Project Name</th>
					<th>Description</th>
					<th>Expire Date</th>
					<th>Accepted</th>
					<th>Status</th>
				</tr>
			</thead>
			@if( !empty($projects))
			@foreach($projects as $project)
			<tbody>
				<tr>
					<td>{{ $project->projectname}}</td>
					<td>{{ $project->Description}}</td>
					<td>{{ $project->date}}</td>
					<td><p id="accept"><span class="label label-info" value="{{ $project->acceptreject }}">Accepted</span></p></td>
					<td>
					@if($project->pendingfinished == 1 )
						<a href="#"><button type="button" class="btn btn-primary disabled btn-block " id="pending" value="{{ $project->pendingfinished }}">Evaluation Finished</button></a>
					@elseif($project->date >= date("Y-m-d"))
						<a href="{{ route('evaluationlogs', $project->project_id ) }}"><button type="button" class="btn btn-primary active btn-block" id="pending" value="{{ $project->pendingfinished }}">Evaluation Logs</button></a>
					@else
						<a href="#"><button type="button" class="btn btn-primary active btn-block" id="pending" value="{{ $project->pendingfinished }}" disabled="">Evaluation Expired</button></a>
					@endif
					</td>
				</tr>
			</tbody>
			@endforeach
			@endif
		</table>
	</div>
</div>
@stop