@extends('layout')

@section('filter')
    @foreach ($websitePageURLs as $website)
        <a href="{{$website[0]}}">{{$website[1]}}</a>
        <span> | </span>
    @endforeach
@endsection


@section('content')
    @foreach ($parserData as $data)
        <a href="#"><h5>{{$data->title}}</h5></a>
        <span>{{$data->tag}}</span>
        <span> | </span>
        <span>{{$data->date}}</span>
        <span> | </span>
        <span>{{$data->websiteName}}</span>
    @endforeach
@endsection
