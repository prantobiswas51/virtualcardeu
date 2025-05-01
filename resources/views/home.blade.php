<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <a href="{{ route('dashboard') }}">Dashboard</a>

    <div class="py-4">
        How are you doing {{ Auth::user()->name ?? "" }}?
    </div>
</body>
</html>