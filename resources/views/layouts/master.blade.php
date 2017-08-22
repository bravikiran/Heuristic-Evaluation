<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- CSS And JavaScript -->
         @include('layouts.css')   
    </head>

    <body>
        @yield('header')

        @include('partials._messages')

        @yield('content')    	

     	@yield('script')

        @include('includes.footer')
    </body>
</html>