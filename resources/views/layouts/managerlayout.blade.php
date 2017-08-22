@extends('layouts.master')

@section('title','Hello Manager')

@section('header')
      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{!! route('manager') !!}" style="height:70px;"><span><img class="logo" alt="U-HE Logo" src="{{ URL::asset('./assets/Logos/Logotwo.png') }}"></span></a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding-top:10px;">
            <ul class="nav navbar-nav">
              <li><a href="{!! route('manager') !!}"><span class="glyphicon glyphicon-home"> Home</span></a></li>
              <li><a href="{!! route('projectform') !!}">New Project</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Invite <span class="glyphicon glyphicon-chevron-down"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{!! route('sendInvitationForm') !!}">Invite Users</a></li>
                  <li><a href="{!! route('usersstatus') !!}">View User Status</a></li>
                </ul>
              </li>
              <li><a href="{!! route('heuristicrules') !!}">Heuristic Principles</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Projects <span class="glyphicon glyphicon-chevron-down"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{!! route('managerprojects') !!}">Project List</a></li>
                  <li><a href="{!! route('managerprojectsstatus') !!}">Project Status</a></li>
                </ul>
              </li>
              </li>
              <li><a href="{!! route('results') !!}">Reports</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">              
              <li><a class="btn btn-lg" href="{{ URL::to('logout') }}"><span class="glyphicon glyphicon-log-out"> Logout</span></a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav> 
@stop
