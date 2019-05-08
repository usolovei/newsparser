@extends('layout')

@section('filter')
    @foreach ($websitePageURLs as $website)
        <li class="nav-item-active">
            <a class="nav-link" href="{{$website[0]}}">{{$website[1]}}</a>
        </li>
    @endforeach
@endsection


@section('content')
    @foreach ($parserData as $data)
        <div class="blog-post">
            <h2 class="blog-post-title"><a href="/articles/{{$data->slug}}">{{$data->title}}</a></h2>
            <p class="blog-post-meta">
                {{$data->tag}}
                 |
                {{$data->date}}
                 |
                {{$data->websiteName}}
            </p>
        </div>
    @endforeach

    {{$parserData->links()}}
@endsection
