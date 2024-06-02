<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

</head>

<body>
    @if(session('success'))
    <div class="">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="">
        {{ session('error') }}
    </div>
    @endif
    <form method="post" enctype="multipart/form-data" action="{{route('image.save')}}">
        @csrf
        <div class="form-group">
            <label>Upload</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">UPLOAD</button>
    </form>

    <img src="{{asset('storage/images/bXu9dhMA2Mm0GHNSucakVgr7EQD1u82DQ6YtuSnf.jpg')}}">
</body>

</html>