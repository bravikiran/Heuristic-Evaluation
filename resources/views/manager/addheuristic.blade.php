@extends('layouts.managerlayout')

@section('content')  

<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<h1 style="text-align:center">Adding New Heuristic Evaluation Principles</h1> 
			<form method="POST" action="{{ route('saveheuristic') }}" class="form-horizontal">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				
				<label>Name of Heuristic:</label>
				<input type="text" name="name" class="form-control" required="">
							
				<div class="input_fields_wrap">
					<label>Title</label>
					<input type="text" name="mytext[]" class="form-control" required="">
					<label>Description</label>
					<textarea name="description[]" class="form-control" required=""></textarea>
				</div>
				
				<div style="padding-top: 20px;">
    				<button class="btn btn-lg add_field_button">Add More Fields</button>   				
    				<input type="submit" value="Save New Heuristics" class="btn btn-lg btn-primary">
    			</div>				
			</form>
		</div>
	</div>
</div>
@stop

@section('script')
<script>
	$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><label>Title</label><input type="text" name="mytext[]" class="form-control"/><label>Description</label><textarea name="description[]" class="form-control"></textarea><a href="#" class="remove_field"><h6>Remove</h6></a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>
@stop