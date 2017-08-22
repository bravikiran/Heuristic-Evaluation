@extends('layouts.managerlayout')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<h3>Heuristic Principles</h3>		
			<div>
				<table class="table table-bordered table-hover">
					@foreach($heuristicrules as $rule)
					<tr>
						<td>{{ $rule->name }}</td>
						<td><a href="{{ route('ruleedit',$rule->id )}}"><button type="button" class="btn btn-info btn-block"> Edit</button></a></td>
						<td><a href="{{ route('deleterule', $rule->id) }}"><button type="button" class="btn btn-danger btn-block">Delete</button></a></td>
						<td><a href="{!! route('showtitledescription', $rule->id) !!}"><button type="button" class="btn btn-info btn-block">Show details</button></a></td>
					</tr>
					@endforeach				
				</table>
			</div>
			
			<div >
				<a class="btn btn-default" type="button" href="{!! route('addheuristic') !!}">Add Custom Heuristic Principle</a>
			</div>				
		</div>
	</div>
</div>	
@stop

@section('script')

<script>
$(function() {
    setTimeout(function() {
        $("#errormessage").hide('blind', {}, 300)
    }, 5000);
});
</script>
@stop