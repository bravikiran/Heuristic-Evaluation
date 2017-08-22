@extends('layouts.managerlayout')

@section('content')
  
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-7">
          <strong>Recently added projects</strong>
          <div class="table-responsive">
            <table class="table table-bordered">              
              <tr>
                <th>Project Name</th>
                <th>End date</th>
              </tr>
              <tr>
                @foreach($lastfiveprojects as $lastfiveproject)
                <td>{{ $lastfiveproject->projectname}}</td>
                <td>{{ $lastfiveproject->date}}</td>
              </tr>
              @endforeach
              <tr>
                <td colspan="">
                  <a href="{{ URL::to('managerprojectsstatus') }}" title="details"><button class="btn btn-default">Project Status</button></a> 
                  <span class="verticalline"></span>
                  <a href="{{ URL::to('projects') }}" title="details"><button class="btn btn-default">Project List</button></a>
                </td>
              </tr>
            </table>
          </div>            
      </div>

      <div class="col-md-5">
          <strong>Invited Users Notification</strong>
          <div class="table-responsive">
            <table class="table table-bordered">
              @if(!empty($notification))
              @foreach($notification as $notify)
              <tr>
                <th>{{ $notify->user_email }}</th>
                <th>{{ $notify->user_role }}</th>
                <th><form action="read/{{ $notify->id }}" method="get" accept-charset="utf-8">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <button type="submit" class="btn btn-success" title="read notification">Read</button>
                    </form>
                </th>
              </tr>
              @endforeach
                @else
                {{ "No Notification" }}
                @endif
            </table>
          </div>
      </div>          
    </div>
  </div>
</div>
@stop
