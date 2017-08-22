@extends('layouts.managerlayout')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-offset-1 col-md-10 col-md-offset-1">
				<form method="POST" action="{{ route('saveresults',$project_id )}}" class="droppable" class="ui-widget-header" role="form">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group">
						<label>Heuristic Principle</label>						
						<input type="text" name="heuristicrules" value="<?php foreach($gotUniqueheuristic as $Uniqueheuristic)  echo $Uniqueheuristic .','; ?>" class="form-control">	
					</div>

					<div class="form-group">
						<label for="">Note:</label>
						<textarea name="note" class="form-control" rows="3"><?php foreach($logs as $log)  echo $log[0]->note  ." \n" ; ?> </textarea>
					</div>

					<div class="form-group">
						<label for="">Description:</label>
						<textarea name="recommendation" class="form-control" rows="3"><?php foreach($logs as $log)  echo $log[0]->recommendation  ." \n" ; ?></textarea>
					</div>

					<div class="form-group">
						<label>Rating:</label>
						<input type="text" name="severity" value="<?php foreach($logs as $log) $avg = array($log[0]->severity); echo array_sum($avg); ?>" max="5" class="form-control">
					</div>

					<div class="form-group" style="display: inline-block;">
						<label>ScreenShot(s):</label>
						<div>
							@foreach($logs as $log)
							<input type="text" name="screenshot[]" value="{{ $log[0]->screenshot }}" style="display:none;" />		
							<img src="{!! './uploads/' . $log[0]->screenshot !!}" class="img-thumbnail removeimg " alt="screenshot no image"  style="float: left; width: 30%; margin-right: 1%; margin-bottom: 0.5em; height="150px !important;" />
							@endforeach
							<h4><label class="label label-default">Double Click On Image to Delete</label></h4>
						</div>										
					</div>

					<div class="form-group">
						<label>Reference Screenshot</label>
						<div>
							@foreach($logs as $log)
							<input type="text" name="referencescreenshot[]" value="{{ $log[0]->referencescreenshot }}" style="display:none;" />		
							<img src="{!! './uploads/' . $log[0]->referencescreenshot !!}" class="img-thumbnail removeimg"  alt="refscreenshot no image" style="float: left; width: 30%; margin-right: 1%; margin-bottom: 0.5em;" />	
							@endforeach
							<h4><label class="label label-default">Double Click On Image to Delete</label></h4>
						</div>
					</div>
					
					<div class="form-group">
						<button type="submit" class="btn btn-primary form-control">Save Results</button>
					</div>
				</form>
			</div>
		</div>
		<div>
        	<a href="{{ redirect()->back()->getTargetUrl() }}"><button class="btn btn-lg btn-default">Back</button>
      	</div>		
	</div>	
</div>

@endsection

@section('script')
<script>
  $(function() {
    $( ".draggable" ).draggable();
    $( ".droppable" ).droppable({
      drop: function( event, ui ) {
        $( this )
          .addClass( "ui-state-highlight" )
          .find( "p" )
            .html( "Dropped!" );
      }
    });
  });
</script>

<script>	
$( ".removeimg" ).dblclick(function() {
  $(this).remove();
});
</script>
@endsection