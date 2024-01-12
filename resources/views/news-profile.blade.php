<?php
use Illuminate\Support\Facades\Request;

$title = Request::input("title", "");
$description = Request::input("description", "");
$publisher = Request::input("publisher", "");
$author = Request::input("author", "");
$url = Request::input("url", "");
$imgUrl = Request::input("imgUrl", "");
$published = Request::input("published", "");
?>

<style>
    .news-profile-title {
        font-size: xx-large;
        text-align: center;
        width: 100%;
    }

    .news-profile-img {
        width: 100%;
        height: auto;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    .news-profile-x-large {
        font-size: x-large;
    }

    .news-profile-large {
        font-size: large;
    }

    .btn-div {
        display: flex;
        justify-content: center;
    }

    .open-btn {
        width: 250px;
        height: 60px;
    }
</style>

<x-app-layout>
    <div class="news-profile-title">
        {{ $title }}
    </div>

    <div class="mt-4">
        @if (isset($imgUrl))
            <img
                src="{{ $imgUrl }}"
                class="news-profile-img"
            />
        @else
            <img
                src="https://s.france24.com/media/display/d1676b6c-0770-11e9-8595-005056a964fe/w:1280/p:16x9/news_1920x1080.png"
                class="news-profile-img"
            />
        @endif
    </div>
    <br>

    @if (isset($description))
        <span class="news-profile-x-large">
            {{ $description }}
        </span>
        <br><br>
    @endif

    @if (isset($publisher))
        <span class="news-profile-large">
            Publisher: {{ $publisher }}
        </span>
        <br>
    @endif

    @if (isset($author))
        <span class="news-profile-large">
            Author: {{ $author }}
        </span>
        <br>
    @endif

    @if (isset($published))
        <span class="news-profile-large">
            Published: {{ date("d / M / Y - h:i", strtotime($published)) }}
        </span>
    @endif

    <br><br>
        <div class="btn-div">
            <button
                class="open-btn ml-4"
                onclick="openOriginalArticle(`{{ $url }}`)"
            >
                Open
            </button>
        </div>
    <br>
</x-app-layout>

<script>
    function openOriginalArticle(path) {
        window.open(path, '_blank');
    }
</script>