@extends('layouts.managerlayout')

@section('content')  

<div class="row">
	<div class="col-md-7 col-md-offset-2">
		<h1 style="text-align:center">Adding New Heuristic Evaluation Principles</h1> 
		<form method="POST" action="{{ URL::to('newhsetsrules') }}" class="form-horizontal">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
			
			<label>Title</label>
			<input type="text" name="title" class="form-control">

			<label>Description</label>
			<textarea type="text" name="description" class="form-control"></textarea>
	
			
			<div style="padding-top:50px;">
				<span id="responce"></span>
				<input type="button" onclick="addInput()" value="click to me add" class="btn btn-lg" />
				
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="submit" value="New_Rules" onsubmit="return validateForm()" class="btn btn-lg">
			</div>
		</form>
	</div>				
</div>
@stop



@section('script')
<script>	
function addInput()
{
	var twofields =  '<label>Title </label><br/> <input class="form-control" type="text"  /><br/>'
				  + ' <label>Description</label><br/><textarea class="form-control" cols="3"> </textarea> <br/>';
    
	document.getElementById('responce').innerHTML += twofields;	
}
</script>

@stop