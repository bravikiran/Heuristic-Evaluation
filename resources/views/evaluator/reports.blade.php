@extends('layouts.evaluatorlayout')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Project Name</th>
						<th>Project Link</th>
						<th>Show</th>
					</tr>
				</thead>
				<tbody>
					@foreach($projects as $project)
					<tr>
						<td><strong>{{ $project->projectname }}</strong></td>
						<td><a href="{{ $project->projectlink }}" title="Project link" target="_blank">{{ $project->projectlink }}</a></td>
						<td><a href="{{ route('evaluatorevaluationlogs',$project->id) }}" class="btn btn-default btn-block"  title="Show evaluation logs">Evaluation Logs</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>	
</div>

@stop