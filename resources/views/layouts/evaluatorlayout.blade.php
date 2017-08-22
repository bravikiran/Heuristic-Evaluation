@extends('layouts.master')

@section('title','Hello Evaluator')

@section('header')
<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{!! route('evaluator') !!}" style="height:75px;">
      <span><img class="logo" alt="U-HE Logo" src="{{ URL::asset('./assets/Logos/Logotwo.png') }}"></span></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding-top:10px;">
      <ul class="nav navbar-nav">
        <li><a href="{!! route('evaluator') !!}"><span class="glyphicon glyphicon-home">Home</span><span class="sr-only"></span></a></li>

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Projects<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{!! route('projectlist') !!}">Accepted Projects</a></li>
            <li><a href="{!! route('rejectedprojects') !!}">Rejected Projects</a></li>
          </ul>
        </li>
        <li role="presentation"><a href="{!! route('evaluator/reports') !!}">
          Reports</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ URL::to('logout') }}"><span class="glyphicon glyphicon-log-out"> Logout</span></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
@stop