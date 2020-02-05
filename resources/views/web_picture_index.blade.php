<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>web照片墙</title>

</head>
<body>
    <div class="image">
    @foreach ($href as $qq)
    <img src="{{ $qq->href }}">
    @endforeach
    </div>
</body>
</html>
