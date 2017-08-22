@extends('layouts.master')

@section('title' , "Contact" )

@section('header')

@include('includes.header')

@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-1">
			<form action="contactAdmin" method="post" accept-charset="utf-8">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<h1>Contact Us</h1>
				<hr />
				<div class="form-group">
					<label for="user_name">Name</label>
					<input type="text" name="user_name" class="form-control" id="username" placeholder="your name" required="">	
				</div>				

				<div class="form-group">
    				<label for="exampleInputEmail1">Email address</label>
    				<input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="E-mail" required="">
  				</div>

  				<div class="form-group">
  					<label for="message">Message:</label>
  					<textarea name="message" class="form-control" rows="7" required=""></textarea>
  				</div>

  				<input type="submit" name="submit" value="Submit" class="col-md-3 col-md-offset-4 btn btn-lg btn-primary">
			</form>
		</div>
	</div>
</div>
@stop