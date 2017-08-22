<!-- resources/views/auth/login.blade.php -->
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
                <div class="col-md-12">
                    <div class="jumbotron" id="section1">
                        <h2>Welcome to Usability Heuristic Evaluation</h2>
                        <p>An administrative platform for the heuristic evaluation of applications and a management tool to log usability problems in the user interface (UI) design.</p>
                        <a href="{{ URL('learn') }}" title="" class="btn btn-default">Learn more...</a>
                    </div>
                </div>            

                <div class="col-md-12">
                    <div class="jumbotron" id="section41">
                        @include('includes.nielsens10')                        
                    </div>
                </div> 
            </div>

            <div class="col-md-6">
                <div class="col-md-12">
                    <div class="col-md-12" id="loginbox"> 
                        <div class="panel panel-info" >
                            <div class="panel-heading">
                            <div class="panel-title"><span class="glyphicon glyphicon-log-in"> Log-in</span></div>                    
                        </div> 
                    </div>
                    <form method="POST" action="./login">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">                
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" autofocus=""  autocomplete="" required="" title="input your email address">
                    </div>
                            
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" id="password" class="form-control" id="exampleInputPassword1" placeholder="Password" autofocus="" required="" title="password should contain only letters and number e.g. John123" pattern="[a-zA-Z0-9-]+">
                    </div>                        
                
                    <div class="form-group">
                        <input class="btn btn-lg btn-primary" type="submit" name="Signin" value="Log-in">
                    </div>
                    <div>
                        <h6><a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()"><b>Sign Up to create a new account</b></a></h6>
                    </div>
                    <hr />
                    </form>
                </div>

                <div class="col-md-12"> 
                    <div class="hideregisterdiv" id="signupbox">
                        <div class="panel panel-info" >
                            <div class="panel-heading">
                                 <div class="panel-title">
                                    Sign Up
                                    <a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()" style="float:right;"><span class="glyphicon glyphicon-log-in"> Log-in</span></a>
                                </div>
                            </div> 
                        </div>            
    
                        <form method="POST" action="{{ route('register') }}" class="form-signin">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">        
                        
                        <div class="form-group">
                            <label>Name*</label>
                            <input class="form-control" type="text" name="name" value="" required="" placeholder="Only letters" pattern="[A-Za-z]+" title="Name should only contain letters. e.g. John no space">
                        </div>
                        
                        <div class="form-group">
                            <label>Email*</label>
                            <input class="form-control" type="email" name="email" value="" required="" placeholder="Email address" title="your email address">
                        </div>
                        
                        <div class="form-group">
                            <label>Password*</label>
                            <input class="form-control" type="password" name="password" required="" minlength="6" placeholder="Password" pattern="[a-zA-Z0-9-]+" title="password should contain only letters and number e.g. John123 minimum 6">
                        </div>
                    
                        <div class="form-group">
                            <label>Confirm Password*</label>
                            <input class="form-control" type="password" name="  password_confirmation" required="" minlength="6" placeholder="Repeat password" pattern="[a-zA-Z0-9-]+" title="password should contain only letters and number e.g. John123 minimum 6">
                        </div>
                    
                        <div class="form-group">
                            <label>Role:</label>
                            <input type="text" name="role" class="form-control" value="Manager" readonly="">
                        </div>                    
                        
                        <input type="submit" class="btn btn-lg btn-primary btn-block" name="submit" value="Registration">
                        </form>
                    </div>
                </div>            
            </div>            
        </div>
    </div>
</div>
@endsection('content')

@section('script')
<script>
   $(function(){
        $('#signupbox').hide();
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