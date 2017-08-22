@extends('layouts.managerlayout')

@section('content')
<div class="container">
  <div class="row">
		<div class="col-md-12">
      <div class="table-responsive">
			<table class="table table-bordered table-hover">
          <tr>
  				  <th>Project Name</th>
            <td>{{ $projects->projectname}}</td>
          </tr>

          <tr>
            <th>Description</th>
            <td><textarea class="form-control" rows="5" title="description of project" readonly="">>{{ $projects->Description }}</textarea></td>
          </tr>

          <tr>
            <th>Rules</th>
            <td>
              @for($i=0; $i < count($pass); $i++)
                <li>{{ $pass[$i] }}</li>
              @endfor
            </td>
          </tr>
          
          <tr>
            <th>Evaluators</th>
            <td>
            @foreach($evaluators as $evaluator)
            @if( $evaluator->evaemail == Null)            
                {{ "no Evaluators"}}
            @else
               <li>{{ $evaluator->evaemail }}</li>           
            @endif
            @endforeach
            </td>
          </tr>

          <tr>
            <th>Developers</th>
            <td>
            @foreach($developers as $developer)
            @if( $developer->devemail == Null)            
                {{ "no Developers"}}
            @else
               <li>{{ $developer->devemail }}</li>           
            @endif
            @endforeach
            </td>
          </tr>

          <tr>
            <th>Operation</th>              
            <td>
              <!--<a href="{{ route('delete', $projects->id) }}"><button class="btn btn-danger">Delete</button></a> -->
              <a href="{{ route('projectreports', $projects->id) }}"><button class="btn btn-danger">Evaluation Logs</button></td>
          </tr>
        </tbody>
			</table>
      </div>
      <div>
        <a href="{{ redirect()->back()->getTargetUrl() }}"><button class="btn btn-lg btn-default">Back</button>
      </div>
		</div>	
	</div>
</div>
@stop