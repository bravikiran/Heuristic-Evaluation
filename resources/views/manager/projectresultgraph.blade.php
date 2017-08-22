@extends('layouts.managerlayout')

@section('content') 
<div id="pop_div" style="height:350px;"></div>
{!! Lava::render('DonutChart', 'IMDB', 'pop_div') !!}


<div class="text-center gap">
	<form action="{!! url('IndividualProjectResult') !!}" method="post">
	<input type="hidden" name="_token" value="{{  csrf_token() }}">
	@if(!empty($results))
	<input type="hidden" name="projectid" value="{{ $results[0]->project_id }} ">
	@endif
	<button type="submit" class="btn btn-lg btn-default">Back</button>
</form>   

@stop