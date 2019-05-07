<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    @foreach ($parserData as $data)
        <h5>{{$data->title}}</h5>
        <span>{{$data->tag}}</span>
        <span>{{$data->date}}</span>
        <span>{{$data->slug}}</span>
        <p> {{$data->content}}</p>
    @endforeach

</body>
</html>
