<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pizzeria:Login</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
    </head>
    <body>
    @if (!empty($errors->first()))
        <div class="alert alert-danger">
          {{ $errors->first() }}
        </div>
   @endif
        <div  id="app" class="content">
            <div class="row">
                <div class="col-md-4  offset-md-4">
                     <form class="form-signin" method="POST">
                             @csrf
                         <form-login/>
                     </form>
                </div>
            </div>
        </div>
        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
