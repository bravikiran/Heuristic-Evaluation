@extends('layouts.managerlayout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-12">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Heuristic Rule</th>
							<th>Description</th>
						</tr>
					</thead>
					@foreach($titledescriptions as $titledescription)
					<tr>
						<td>{{ $titledescription->title }}</td>
						<td>{{ $titledescription->description }}</td>
					</tr>
					@endforeach					
				</table>

				<div class="row">
					<div class="col-md-12">
						<h4><a href="{!! route('heuristicrules') !!}"><button class="btn btn-default">Back to Heuristic Rules</button></a></h4>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop