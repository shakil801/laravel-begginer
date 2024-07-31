<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->

    </head>
    <body>

        @if(session('success'))
           {{session('success')}}
        @endif
        <form class="" method="post" enctype="multipart/form-data" action="{{route('upload')}}">
            @csrf
            <div>
                <label>Upload</label>
                <input type="file" class="" name="pdf_file">
            </div>

            <input type="submit" value="Upload">
        </form>
    </body>
</html>
