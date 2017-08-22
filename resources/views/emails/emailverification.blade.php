<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <style type="text/css">
            .buttonstyle{
                color: blue;
                height: 25px;
                width: 30px;
                padding: 20px;
                margin: 20px;
            }
        </style>
    </head>
    <body>
        <h2>Thanks for creating an account. Verify your Email.</h2>
        <div style="text-align:center;">
            <a class="buttonstyle" href="{{ URL::to('register/verify/' . $confirmation_code ) }}" title="Confirmation Link" target="_blank">Click Me</a>
        </div>
    </body>
</html>