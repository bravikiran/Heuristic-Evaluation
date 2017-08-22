<!-- resources/views/auth/login.blade.php -->
@extends('layouts.master')

@section('title' , "HomePage" )

@section('header')

@include('includes.header')

@stop

@section('content') 
<div class="text-center">
	{{ $message }}
</div>
@stop