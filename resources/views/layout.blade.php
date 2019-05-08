<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News Parser</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>

    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="{{asset('css/blog.css')}}" rel="stylesheet">
</head>
<body>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
            <a class="navbar-brand" href="/">News parser</a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item-active">
                        <a class="nav-link" href="/articles">all news</a>
                    </li>
                    <li class="nav-item-active">
                        <a class="nav-link" href="/recent">recent articles</a>
                    </li>
                    @yield('filter')
                </ul>
            </div>

        </nav>



    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                @yield('content')
            </div>
        </div>
    </main>





</body>
</html>
