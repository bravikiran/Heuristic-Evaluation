@extends('layouts.master')

@section('title' , "HomePage" )

@section('header')

@include('includes.header')

@stop

@section('content')      
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">                
                <div class="jumbotron" id="section1">
                    <h2>Welcome to Usability Heuristic Evaluation</h2>
                    <p>An administrative platform for the heuristic evaluation of applications and a management tool to log usability problems in the user interface (UI) design.</p>
                    <a href="{{ URL('learn') }}" title="" class="btn btn-default">Learn more...</a>
                </div>

                <div class="jumbotron" id="section41">
                    @include('includes.nielsens10')                        
                </div>
            </div>                
        
            <div class="col-md-6" id="signupbox">
                <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">
                            Sign Up
                        </div>
                    </div> 
                </div>
                
                <form method="POST" action="inviteregister" class="form-signin">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="name">Name*</label>
                    <input class="form-control" type="text" name="name" value="{{ $invitation->user_name }}" required="" placeholder="Only letters" pattern="[A-Za-z]+" title="Name should only contain letters. e.g. John">
                </div>
                        
                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" name="user_email" value="{{ $invitation->user_email }}" placeholder="Your address" readonly="" class="form-control">
                </div>    
                        
                <div class="form-group">
                    <label for="psw">Password*</label>
                    <input class="form-control" type="password" name="password"  minlength="6" placeholder="Password" pattern="[a-zA-Z0-9-]+" title="password should contain only letters and number e.g. John123 minimum 6">
                </div>
                    
                <div class="form-group">
                    <label for="conpsw">Confirm Password*</label>
                    <input class="form-control" type="password" name="  password_confirmation"  minlength="6" placeholder="Repeat password" pattern="[a-zA-Z0-9-]+" title="password should contain only letters and number e.g. John123 minimum 6">
                </div>
                    
                <div class="form-group">
                    <label>Role:</label>
                    <input type="text" name="user_role" value="{{ $invitation->user_role }}" placeholder="" readonly="" class="form-control">
                </div>

                <input type="hidden" name="ref_code" value="{{ $invitation->confirmation_code }}">
                <input type="submit" class="btn btn-lg btn-primary btn-block" name="submit" value="Registration">
            </form>
        </div>
    </div>
</div>
@endsection('content')

@section('script')
<script>
   $(function(){
        $('#loginbox').hide();
    });
</script>

<script>
$(function() {
    setTimeout(function() {
        $("#errormessage").hide('blind', {}, 300)
    }, 5000);
});
</script>
@stop