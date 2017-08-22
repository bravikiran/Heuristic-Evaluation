@extends('layouts.developerlayout')

@section('content')      
<div class="container">
	<div class="row">
		<div class="col-md-12" id="print">
			<div class="accordion" id="changecolor">
      @foreach($evaluationlogs as $evaluationlog)
        <h4 class="changecolor">Principle: {{ $evaluationlog->heuristicrule }}</h4>         
        <div class="table-responsive">
          <table class="table table-reflow table-striped">
            <tr>
              <th>Note:</th>
              <td>{{ $evaluationlog->note }}</td>
            </tr>

            <tr>
              <th>Recommendation:</th>
              <td>{{ $evaluationlog->recommendation }}</td>
            </tr>

            <tr>
              <th>Rating:</th>
              <td>{{ $evaluationlog->severity }}</td>
            </tr>

            <tr>
              <th>Screenshot:</th>
              <td>
                @for($i = 0; $i < sizeof($evaluationlog->screen); $i++)
                <img src="{!! '../uploads/' .   $evaluationlog->screen[$i] !!}" alt="Screenshot" class="myImg min-img-size">                
                @endfor
              </td>
            </tr>

            <tr>
              <th>ReferrenceScreenshot:</th>
              <td>
              @for($i = 0; $i < sizeof($evaluationlog->refscreen); $i++)
              <img src="{!! '../uploads/' . $evaluationlog->refscreen[$i] !!}" alt="refScreenshot" class="myImg min-img-size">
              @endfor
              </td>
            </tr>

            <form action="{{ URL('savelogcomment') }}" method="post" accept-charset="utf-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="project_id" value="{{ $evaluationlog->project_id }}">
                <input type="hidden" name="log_id" value="{{ $evaluationlog->id }}">

            <tr>
              <th><label for="description">Comment:</label></th>
              <td>
                  <textarea class="form-control" rows="5" name="comment" minlength="10"></textarea>                  
              </td>
            </tr>

          </table>

          <input type="submit" class="btn btn-lg btn-block btn-success"  value="Save Comment">
                </form>
          </div>
        @endforeach     
      </div>
      <!-- The Modal -->
      <div id="" class="myModal modal">
        <!-- The Close Button -->
        <span class="close" onclick="document.getElementsByClassName('myModal').style.display='none'">&times;</span>
        <!-- Modal Content (The Image) -->
        <img class="modal-content">
      </div>
		</div>
	</div>
</div>
@stop