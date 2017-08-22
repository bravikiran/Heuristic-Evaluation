@extends('layouts.developerlayout')

@section('content')      

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <table class="table table-striped">
      <caption><strong>List of Projects</strong></caption>
        <tr>
          <th>Project Name</th>
          <th>Link</th>           
          <th>Due Date</th>
          <th>Click</th>
        </tr>
        @if(!empty($projects))
        @foreach($projects as $project)
        <tr>
          <td>{{ $project->projectname}}</td>
          <td>{{ $project->projectlink}}</td>
          <td>{{ $project->date}}</td>
              <td>
              <a class="btn btn-default" href="{{ URL('commentonlogs', $project->id) }}">Click to Comment</a>
              </td>
        </tr>
        @endforeach
        @endif
      </table>
      <div class="text-center">
        {!! $projects->render(); !!}
      </div>
    </div>
  </div>
</div>

@endsection('content')