<?php
    use Illuminate\Support\Facades\Http;

    $url = "https://newsapi.org/v2/top-headlines?country=us&page=1&pageSize=10&apiKey=28fd4e028d8746b09625625701e3b512";
    $data = http::get($url);
    $news = $data['articles'];
?>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<style>
    .carousel-img {
        width: 60%;
        min-height: 60vh;
        max-height: 60vh;
    }

    .carousel-right {
        margin-left: 41%;
        text-align: left;
        width: 38%;
        height: 100%;
    }

    .carousel-title {
        font-weight: 700;
        font-size: x-large;
    }

    .carousel-title:hover {
        text-decoration: underline;
        cursor: pointer;
    }

    .carousel-description:hover {
        text-decoration: underline;
        cursor: pointer;
    }
</style>

@vite(["resources/css/app.css"])

<x-app-layout>
    <x-slot name="header">
        {{ __("Dashboard") }}
    </x-slot>

    <x-slot name="carousel">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
                <li data-target="#myCarousel" data-slide-to="4"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    @if ($news[0]['description'])
                        <img src="{{ $news[0]['urlToImage'] }}" class="carousel-img">
                    @else
                        <img src="https://s.france24.com/media/display/d1676b6c-0770-11e9-8595-005056a964fe/w:1280/p:16x9/news_1920x1080.png" class="carousel-img">
                    @endif
                    <div class="carousel-caption carousel-right">
                        <span class="carousel-title" onclick="openArticle(`{{ $news[0]['url'] }}`)">{{ $news[0]['title'] }}</span>
                        <br><br>
                        @if ($news[0]['description'])
                            <span class="carousel-description" onclick="openArticle(`{{ $news[0]['url'] }}`)">{{ $news[0]['description'] }}</span>
                            <br><br>
                        @endif
                        <button onclick="openArticle(`{{ $news[0]['url'] }}`)">Open</button>
                    </div>
                </div>

                <div class="item ">
                    @if ($news[1]['description'])
                        <img src="{{ $news[1]['urlToImage'] }}" class="carousel-img">
                    @else
                        <img src="https://s.france24.com/media/display/d1676b6c-0770-11e9-8595-005056a964fe/w:1280/p:16x9/news_1920x1080.png" class="carousel-img">
                    @endif
                    <div class="carousel-caption carousel-right">
                        <span class="carousel-title" onclick="openArticle(`{{ $news[1]['url'] }}`)">{{ $news[1]['title'] }}</span>
                        <br><br>
                        @if ($news[1]['description'])
                            <span class="carousel-description" onclick="openArticle(`{{ $news[1]['url'] }}`)">{{ $news[1]['description'] }}</span>
                            <br><br>
                        @endif
                        <button onclick="openArticle(`{{ $news[1]['url'] }}`)">Open</button>
                    </div>
                </div>

                <div class="item">
                    @if ($news[2]['description'])
                        <img src="{{ $news[2]['urlToImage'] }}" class="carousel-img">
                    @else
                        <img src="https://s.france24.com/media/display/d1676b6c-0770-11e9-8595-005056a964fe/w:1280/p:16x9/news_1920x1080.png" class="carousel-img">
                    @endif
                    <div class="carousel-caption carousel-right">
                        <span class="carousel-title" onclick="openArticle(`{{ $news[2]['url'] }}`)">{{ $news[2]['title'] }}</span>
                        <br><br>
                        @if ($news[1]['description'])
                            <span class="carousel-description" onclick="openArticle(`{{ $news[2]['url'] }}`)">{{ $news[2]['description'] }}</span>
                            <br><br>
                        @endif
                        <button onclick="openArticle(`{{ $news[2]['url'] }}`)">Open</button>
                    </div>
                </div>

                <div class="item">
                    @if ($news[3]['description'])
                        <img src="{{ $news[3]['urlToImage'] }}" class="carousel-img">
                    @else
                        <img src="https://s.france24.com/media/display/d1676b6c-0770-11e9-8595-005056a964fe/w:1280/p:16x9/news_1920x1080.png" class="carousel-img">
                    @endif
                    <div class="carousel-caption carousel-right">
                        <span class="carousel-title" onclick="openArticle(`{{ $news[3]['url'] }}`)">{{ $news[3]['title'] }}</span>
                        <br><br>
                        @if ($news[1]['description'])
                            <span class="carousel-description" onclick="openArticle(`{{ $news[3]['url'] }}`)">{{ $news[3]['description'] }}</span>
                            <br><br>
                        @endif
                        <button onclick="openArticle(`{{ $news[3]['url'] }}`)">Open</button>
                    </div>
                </div>

                <div class="item">
                    @if ($news[4]['description'])
                        <img src="{{ $news[4]['urlToImage'] }}" class="carousel-img">
                    @else
                        <img src="https://s.france24.com/media/display/d1676b6c-0770-11e9-8595-005056a964fe/w:1280/p:16x9/news_1920x1080.png" class="carousel-img">
                    @endif
                    <div class="carousel-caption carousel-right">
                        <span class="carousel-title" onclick="openArticle(`$news[4]['url']`)">{{ $news[4]['title'] }}</span>
                        <br><br>
                        @if ($news[1]['description'])
                            <span class="carousel-description" onclick="openArticle(`{{ $news[4]['url'] }}`)">{{ $news[4]['description'] }}</span>
                            <br><br>
                        @endif
                        <button onclick="openArticle(`{{ $news[4]['url'] }}`)">Open</button>
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </x-slot>

    <!-- @foreach ($news as $item)
        <img src="{{ $item['urlToImage'] }}" alt="New York">
        <div class="carousel-caption">
            <h3>{{$item['title']}}</h3>
            <p>We love the Big Apple!</p>
        </div>
    @endforeach  -->
</x-app-layout>

<script>
    function openArticle(path) {
        window.open(path, '_blank');
    }
</script>
