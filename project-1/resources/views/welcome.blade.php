<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

        <!-- Styles -->
        <style>
            .form-control:focus{
                box-shadow: none;
            }
            input[type="text"]{
                padding: 1.5rem;
            }
            </style>
        
    </head>
    <body class="container">
        <form action="" method="post" class="mt-5">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="todo_text" placeholder="Todo Title">
                <div class="input-group-append">
                <button class="btn btn-secondary" type="button">ADD</button>
                </div>
            </div>
        </form>
    </body>
</html>
