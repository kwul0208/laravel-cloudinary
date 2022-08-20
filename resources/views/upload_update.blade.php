<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Halaman update Upload Image</h2>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <form action="{{ route('images.test', $image) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="old_img" value="{{ $image->image }}">
        <input type="file" name="image">
        <p>
            <button type="submit">Upload {{ $image }}</button>
        </p>
    </form>
</body>
</html>