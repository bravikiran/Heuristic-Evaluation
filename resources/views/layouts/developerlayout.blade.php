@extends('layouts.master')

@section('title','Hello Developer')

@section('header')
<!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('developer') }}" style="height:75px;">
            <span><img class="logo" src="{{ URL::asset('./assets/Logos/Logotwo.png') }}" alt="U-HE Logo"></span></a>
          </div>
          <div aria-expanded="true" id="navbar" class="navbar-collapse collapse in" style="padding-top:10px;">
            <ul class="nav navbar-nav">
              <li><a href="{{ route('developer') }}"><span class="glyphicon glyphicon-home">Home</span></a></li>
             </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="{{ URL::to('logout') }}"><span class="glyphicon glyphicon-log-out"> Logout</span></a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav> 
@stop