@extends('layouts.managerlayout')

@section('content')
<div class="container">
    <div class="row">         
        <div class="col-md-8 col-md-offset-1">
            <h3  class="text-uppercase">Invitation </h3>

            <form method="POST" action="{{ route('sendInvitation') }}" class="form-signin">
            {!! csrf_field() !!}
                        
            <div>
                <label>Name</label>
                <input class="form-control" type="text" name="name" value="{{ old('name') }}">
            </div>
                        
            <div>
                <label>Email</label>
                <input class="form-control" type="email" name="email" value="{{ old('email') }}" required="">
            </div>

            <div>
                <label>Description</label>
                <textarea class="form-control" rows="5" name="description"></textarea>
            </div>
                        
            <div class="form-group">
                <label>select</label>
                <select name="role" class="form-control" required='' >
                    <option value="Evaluator">Evaluator</option>
                    <option value="Developer">Developer</option>
                </select>
            </div>                    
            
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block" name="submit" id="submit" value="Send" type="submit">Send</button>
            </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('script')
<script>
$(function() {
    setTimeout(function() {
        $("#errormessage").hide(300)
    }, 5000);
});
</script>
@stop