@extends('layouts.managerlayout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
  						<th>Project Name</th>
  						<th>Show</th>
  					</tr>
				</thead>
	
				<tbody>
				<form action="IndividualProjectResult" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				@foreach( $projectlist as $project)
					<tr>					
						<td>{{ $project->projectname }}</td>			
						<td>							
							<button type="submit" class="btn btn-default" name="projectid" value="{!! $project->id !!}" >Evaluation Logs</button>
						</td>
					</tr>
				@endforeach
				</form>
				</tbody>
			</table>
			<div class="text-center">
				{!! $projectlist->render(); !!}
			</div>
		</div>
	</div>
</div>
@stop  			