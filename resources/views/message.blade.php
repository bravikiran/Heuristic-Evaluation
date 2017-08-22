@extends('layouts.master')

@section('title' , "Error Page" )

@section('header')

@include('includes.header')

@stop

@section('content')      
<div class="container">
    <div class="row">
        <div class="jumbotron">
            <a href="{{ URL('/') }}" title="" class="btn btn-default">Return to Home Page</a>
        </div>
    </div>
</div>
@stop