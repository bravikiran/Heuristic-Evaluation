@extends('layouts.master')

@section('title' , "About" )

@section('header')

@include('includes.header')

@stop

@section('content')
<style type="text/css">
	li{
		list-style: none;
		list-style-type: square;
	}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-6 jumbotron" id="section1">
				<p>Manager</p>
			</div>
			<div class="col-md-5 col-md-offset-1 jumbotron" id="section2">
				<ul>
					<li>Project creation</li>
					<li>Management of usability problems</li>
					<li>Collection of usability problems</li>
					<li>Editing and Saving the collected usability problems</li>
				</ul>
			</div>
		</div>

		<div class="col-md-12">
			<div class="col-md-5 jumbotron" id="section2">				
				<ul>
					<li>Unbiased heuristic evaluaion</li>
					<li>Accepting and rejecting the project evaluation request</li>
					<li>Creation of usability problem logs</li>
				</ul>
			</div>
			<div class="col-md-offset-1 col-md-6  jumbotron" id="section1">
				<p>Evaluator</p>
			</div>
		</div>

		<div class="col-md-12">
			<div class="col-md-6 jumbotron" id="section1">
				<p>Developer</p>
			</div>
			<div class="col-md-5 col-md-offset-1 jumbotron" id="section2">
				<ul>
					<li>Adding comments to usability problem logs</li>
				</ul>
			</div>
		</div>
	</div>
</div>
@stop