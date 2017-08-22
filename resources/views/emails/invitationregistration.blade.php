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
        <h2>Invitation</h2>
        <p>{{ $description }}</p>
        <div>
            <a class="buttonstyle" href="{{ URL::to('inviteuserregistration/verify/' . $confirmation_code ) }}" title="Invited By Manager" target="_black">Click Me</a>
        </div>
    </body>
</html>