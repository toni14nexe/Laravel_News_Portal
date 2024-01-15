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
        border-radius: 5px;
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

    .add-comment-main {
        width: 100%;
        height: fit-content;
    }

    .textarea {
        width: 100%;
        color: black;
        border-radius: 5px;
        padding: 0 0.5rem;
    }

    .post-comment-btn-layout {
        display: flex;
        justify-content: end;
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
                class="w-250 ml-4"
                onclick="openOriginalArticle(`{{ $url }}`)"
            >
                Open
            </button>
        </div>
    <br>

    <x-slot name="comments">
        <form method="POST" action="{{ route("comments.store") }}" class="mt-4">
            @csrf

            <div class="add-comment-main">
                <textarea class="textarea" id="comment" name="comment" rows="4" placeholder="Comment..."></textarea>    
            </div>

            <textarea id="url" name="url" class="hidden">{{ $url }}</textarea>
            <textarea id="title" name="title" class="hidden">{{ $title }}</textarea>
            <textarea id="imageUrl" name="imageUrl" class="hidden">{{ $imgUrl }}</textarea>
            <textarea id="publisher" name="publisher" class="hidden">{{ $publisher }}</textarea>
            <textarea id="author" name="author" class="hidden">{{ $author }}</textarea>

            @if ($errors->get("comment"))
                <div class="error-message flex justify-center">
                    <x-input-error :messages="$errors->get('comment')" />
                </div>
            @endif

            <div class="post-comment-btn-layout">
                <button class="mt-4 btn-green w-250">
                    Post
                </button>
            </div>
        </form>
    </x-slot>
</x-app-layout>

<script>
    function openOriginalArticle(path) {
        window.open(path, '_blank');
    }
</script>