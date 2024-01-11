<?php
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

$page = Request::input("page", 1);
$pageSize = Request::input("pageSize", 10);

$API_Key = env("NEWS_API_KEY", "");
$url = "https://newsapi.org/v2/top-headlines?language=en&page={$page}&pageSize={$pageSize}&apiKey={$API_Key}";
$data = http::get($url)->json();
$news = $data["articles"];

$totalResults = $data["totalResults"];
$pageSizes = [10, 20, 50, 100];
?>

<head>
    <link
        rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />
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

    .carousel-text:hover {
        text-decoration: underline;
        cursor: pointer;
    }

    .carousel-btn-div {
        display: flex;
        align-items: center;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        {{ __("Dashboard") }}
    </x-slot>

    @if ($page == 1)
        <x-slot name="carousel">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li
                        data-target="#myCarousel"
                        data-slide-to="0"
                        class="active"
                    ></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                    <li data-target="#myCarousel" data-slide-to="4"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        @if ($news[0]["urlToImage"])
                            <img
                                src="{{ $news[0]["urlToImage"] }}"
                                class="carousel-img"
                            />
                        @else
                            <img
                                src="https://s.france24.com/media/display/d1676b6c-0770-11e9-8595-005056a964fe/w:1280/p:16x9/news_1920x1080.png"
                                class="carousel-img"
                            />
                        @endif
                        <div class="carousel-caption carousel-right">
                            <span
                                class="carousel-text article-title"
                                onclick="openArticle(`{{ $news[0]["url"] }}`)"
                            >
                                {{ $news[0]["title"] }}
                            </span>
                            @if (isset($news[0]["description"]))
                                <br />
                                <br />
                                <span
                                    class="carousel-text article-description"
                                    onclick="openArticle(`{{ $news[0]["url"] }}`)"
                                >
                                    {{ $news[0]["description"] }}
                                </span>
                            @endif

                            @if (isset($news[0]["source"]["name"]))
                                <br />
                                <br />
                                <span
                                    class="carousel-text article-notes"
                                    onclick="openArticle(`{{ $news[0]["url"] }}`)"
                                >
                                    {{ $news[0]["source"]["name"] }}
                                </span>
                            @endif

                            @if (isset($news[0]["source"]["name"]) && isset($news[0]["author"]))
                                <span class="article-notes">-</span>
                            @endif

                            @if (isset($news[0]["author"]))
                                <span
                                    class="carousel-text article-notes"
                                    onclick="openArticle(`{{ $news[0]["url"] }}`)"
                                >
                                    {{ $news[0]["author"] }}
                                </span>
                            @endif

                            @if (isset($news[0]["publishedAt"]))
                                <br />
                                <br />
                                <span
                                    class="carousel-text article-notes"
                                    onclick="openArticle(`{{ $news[0]["url"] }}`)"
                                >
                                    {{ date("d / M / Y - h:i", strtotime($news[0]["publishedAt"])) }}
                                    UTC
                                </span>
                            @endif

                            <br />
                            <br />
                            <div class="carousel-btn-div">
                                <button
                                    onclick="openArticle(`{{ $news[0]["url"] }}`)"
                                >
                                    Go to our page
                                </button>
                                <button
                                    class="ml-4"
                                    onclick="openOriginalArticle(`{{ $news[0]["url"] }}`)"
                                >
                                    Go to original page
                                </button>
                            </div>
                            <div class="carousel-btn-div mt-8">
                                <x-vaadin-link
                                    class="article-icons link-icon"
                                    onclick="openOriginalArticle(`{{ $news[0]['url'] }}`)"
                                />
                                <x-bxs-like
                                    class="article-icons like-icon ml-4"
                                    onclick="likeArticle(`{{ $news[0]['url'] }}`)"
                                />
                                <x-bxs-dislike
                                    class="article-icons dislike-icon ml-4"
                                    onclick="dislikeArticle(`{{ $news[0]['url'] }}`)"
                                />
                                <x-bxs-comment
                                    class="article-icons comment-icon ml-4"
                                    onclick="openArticle(`{{ $news[0]['url'] }}`)"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        @if ($news[1]["urlToImage"])
                            <img
                                src="{{ $news[1]["urlToImage"] }}"
                                class="carousel-img"
                            />
                        @else
                            <img
                                src="https://s.france24.com/media/display/d1676b6c-0770-11e9-8595-005056a964fe/w:1280/p:16x9/news_1920x1080.png"
                                class="carousel-img"
                            />
                        @endif
                        <div class="carousel-caption carousel-right">
                            <span
                                class="carousel-text article-title"
                                onclick="openArticle(`{{ $news[1]["url"] }}`)"
                            >
                                {{ $news[1]["title"] }}
                            </span>
                            @if (isset($news[1]["description"]))
                                <br />
                                <br />
                                <span
                                    class="carousel-text article-description"
                                    onclick="openArticle(`{{ $news[1]["url"] }}`)"
                                >
                                    {{ $news[1]["description"] }}
                                </span>
                            @endif

                            @if (isset($news[1]["source"]["name"]))
                                <br />
                                <br />
                                <span
                                    class="carousel-text article-notes"
                                    onclick="openArticle(`{{ $news[1]["url"] }}`)"
                                >
                                    {{ $news[1]["source"]["name"] }}
                                </span>
                            @endif

                            @if (isset($news[1]["source"]["name"]) && isset($news[1]["author"]))
                                <span class="article-notes">-</span>
                            @endif

                            @if (isset($news[1]["author"]))
                                <span
                                    class="carousel-text article-notes"
                                    onclick="openArticle(`{{ $news[1]["url"] }}`)"
                                >
                                    {{ $news[1]["author"] }}
                                </span>
                            @endif

                            @if (isset($news[1]["publishedAt"]))
                                <br />
                                <br />
                                <span
                                    class="carousel-text article-notes"
                                    onclick="openArticle(`{{ $news[1]["url"] }}`)"
                                >
                                    {{ date("d / M / Y - h:i", strtotime($news[1]["publishedAt"])) }}
                                    UTC
                                </span>
                            @endif

                            <br />
                            <br />
                            <div class="carousel-btn-div">
                                <button
                                    onclick="openArticle(`{{ $news[1]["url"] }}`)"
                                >
                                    Go to our page
                                </button>
                                <button
                                    class="ml-4"
                                    onclick="openOriginalArticle(`{{ $news[1]["url"] }}`)"
                                >
                                    Go to original page
                                </button>
                            </div>
                            <div class="carousel-btn-div mt-8">
                                <x-vaadin-link
                                    class="article-icons link-icon"
                                    onclick="openOriginalArticle(`{{ $news[1]['url'] }}`)"
                                />
                                <x-bxs-like
                                    class="article-icons like-icon ml-4"
                                    onclick="likeArticle(`{{ $news[1]['url'] }}`)"
                                />
                                <x-bxs-dislike
                                    class="article-icons dislike-icon ml-4"
                                    onclick="dislikeArticle(`{{ $news[1]['url'] }}`)"
                                />
                                <x-bxs-comment
                                    class="article-icons comment-icon ml-4"
                                    onclick="openArticle(`{{ $news[1]['url'] }}`)"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        @if ($news[2]["urlToImage"])
                            <img
                                src="{{ $news[2]["urlToImage"] }}"
                                class="carousel-img"
                            />
                        @else
                            <img
                                src="https://s.france24.com/media/display/d1676b6c-0770-11e9-8595-005056a964fe/w:1280/p:16x9/news_1920x1080.png"
                                class="carousel-img"
                            />
                        @endif
                        <div class="carousel-caption carousel-right">
                            <span
                                class="carousel-text article-title"
                                onclick="openArticle(`{{ $news[2]["url"] }}`)"
                            >
                                {{ $news[2]["title"] }}
                            </span>
                            @if (isset($news[2]["description"]))
                                <br />
                                <br />
                                <span
                                    class="carousel-text article-description"
                                    onclick="openArticle(`{{ $news[2]["url"] }}`)"
                                >
                                    {{ $news[2]["description"] }}
                                </span>
                            @endif

                            @if (isset($news[2]["source"]["name"]))
                                <br />
                                <br />
                                <span
                                    class="carousel-text article-notes"
                                    onclick="openArticle(`{{ $news[2]["url"] }}`)"
                                >
                                    {{ $news[2]["source"]["name"] }}
                                </span>
                            @endif

                            @if (isset($news[2]["source"]["name"]) && isset($news[2]["author"]))
                                <span class="article-notes">-</span>
                            @endif

                            @if (isset($news[2]["author"]))
                                <span
                                    class="carousel-text article-notes"
                                    onclick="openArticle(`{{ $news[2]["url"] }}`)"
                                >
                                    {{ $news[2]["author"] }}
                                </span>
                            @endif

                            @if (isset($news[2]["publishedAt"]))
                                <br />
                                <br />
                                <span
                                    class="carousel-text article-notes"
                                    onclick="openArticle(`{{ $news[2]["url"] }}`)"
                                >
                                    {{ date("d / M / Y - h:i", strtotime($news[2]["publishedAt"])) }}
                                    UTC
                                </span>
                            @endif

                            <br />
                            <br />
                            <div class="carousel-btn-div">
                                <button
                                    onclick="openArticle(`{{ $news[2]["url"] }}`)"
                                >
                                    Go to our page
                                </button>
                                <button
                                    class="ml-4"
                                    onclick="openOriginalArticle(`{{ $news[2]["url"] }}`)"
                                >
                                    Go to original page
                                </button>
                            </div>
                            <div class="carousel-btn-div mt-8">
                                <x-vaadin-link
                                    class="article-icons link-icon"
                                    onclick="openOriginalArticle(`{{ $news[2]['url'] }}`)"
                                />
                                <x-bxs-like
                                    class="article-icons like-icon ml-4"
                                    onclick="likeArticle(`{{ $news[2]['url'] }}`)"
                                />
                                <x-bxs-dislike
                                    class="article-icons dislike-icon ml-4"
                                    onclick="dislikeArticle(`{{ $news[2]['url'] }}`)"
                                />
                                <x-bxs-comment
                                    class="article-icons comment-icon ml-4"
                                    onclick="openArticle(`{{ $news[2]['url'] }}`)"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        @if ($news[3]["urlToImage"])
                            <img
                                src="{{ $news[3]["urlToImage"] }}"
                                class="carousel-img"
                            />
                        @else
                            <img
                                src="https://s.france24.com/media/display/d1676b6c-0770-11e9-8595-005056a964fe/w:1280/p:16x9/news_1920x1080.png"
                                class="carousel-img"
                            />
                        @endif
                        <div class="carousel-caption carousel-right">
                            <span
                                class="carousel-text article-title"
                                onclick="openArticle(`{{ $news[3]["url"] }}`)"
                            >
                                {{ $news[3]["title"] }}
                            </span>
                            @if (isset($news[3]["description"]))
                                <br />
                                <br />
                                <span
                                    class="carousel-text article-description"
                                    onclick="openArticle(`{{ $news[3]["url"] }}`)"
                                >
                                    {{ $news[3]["description"] }}
                                </span>
                            @endif

                            @if (isset($news[3]["source"]["name"]))
                                <br />
                                <br />
                                <span
                                    class="carousel-text article-notes"
                                    onclick="openArticle(`{{ $news[3]["url"] }}`)"
                                >
                                    {{ $news[3]["source"]["name"] }}
                                </span>
                            @endif

                            @if (isset($news[3]["source"]["name"]) && isset($news[3]["author"]))
                                <span class="article-notes">-</span>
                            @endif

                            @if (isset($news[3]["author"]))
                                <span
                                    class="carousel-text article-notes"
                                    onclick="openArticle(`{{ $news[3]["url"] }}`)"
                                >
                                    {{ $news[3]["author"] }}
                                </span>
                            @endif

                            @if (isset($news[3]["publishedAt"]))
                                <br />
                                <br />
                                <span
                                    class="carousel-text article-notes"
                                    onclick="openArticle(`{{ $news[3]["url"] }}`)"
                                >
                                    {{ date("d / M / Y - h:i", strtotime($news[3]["publishedAt"])) }}
                                    UTC
                                </span>
                            @endif

                            <br />
                            <br />
                            <div class="carousel-btn-div">
                                <button
                                    onclick="openArticle(`{{ $news[3]["url"] }}`)"
                                >
                                    Go to our page
                                </button>
                                <button
                                    class="ml-4"
                                    onclick="openOriginalArticle(`{{ $news[3]["url"] }}`)"
                                >
                                    Go to original page
                                </button>
                            </div>
                            <div class="carousel-btn-div mt-8">
                                <x-vaadin-link
                                    class="article-icons link-icon"
                                    onclick="openOriginalArticle(`{{ $news[3]['url'] }}`)"
                                />
                                <x-bxs-like
                                    class="article-icons like-icon ml-4"
                                    onclick="likeArticle(`{{ $news[3]['url'] }}`)"
                                />
                                <x-bxs-dislike
                                    class="article-icons dislike-icon ml-4"
                                    onclick="dislikeArticle(`{{ $news[3]['url'] }}`)"
                                />
                                <x-bxs-comment
                                    class="article-icons comment-icon ml-4"
                                    onclick="openArticle(`{{ $news[3]['url'] }}`)"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        @if ($news[4]["urlToImage"])
                            <img
                                src="{{ $news[4]["urlToImage"] }}"
                                class="carousel-img"
                            />
                        @else
                            <img
                                src="https://s.france24.com/media/display/d1676b6c-0770-11e9-8595-005056a964fe/w:1280/p:16x9/news_1920x1080.png"
                                class="carousel-img"
                            />
                        @endif
                        <div class="carousel-caption carousel-right">
                            <span
                                class="carousel-text article-title"
                                onclick="openArticle(`{{ $news[4]["url"] }}`)"
                            >
                                {{ $news[4]["title"] }}
                            </span>
                            @if (isset($news[4]["description"]))
                                <br />
                                <br />
                                <span
                                    class="carousel-text article-description"
                                    onclick="openArticle(`{{ $news[4]["url"] }}`)"
                                >
                                    {{ $news[4]["description"] }}
                                </span>
                            @endif

                            @if (isset($news[4]["source"]["name"]))
                                <br />
                                <br />
                                <span
                                    class="carousel-text article-notes"
                                    onclick="openArticle(`{{ $news[4]["url"] }}`)"
                                >
                                    {{ $news[4]["source"]["name"] }}
                                </span>
                            @endif

                            @if (isset($news[4]["source"]["name"]) && isset($news[4]["author"]))
                                <span class="article-notes">-</span>
                            @endif

                            @if (isset($news[4]["author"]))
                                <span
                                    class="carousel-text article-notes"
                                    onclick="openArticle(`{{ $news[4]["url"] }}`)"
                                >
                                    {{ $news[4]["author"] }}
                                </span>
                            @endif

                            @if (isset($news[4]["publishedAt"]))
                                <br />
                                <br />
                                <span
                                    class="carousel-text article-notes"
                                    onclick="openArticle(`{{ $news[4]["url"] }}`)"
                                >
                                    {{ date("d / M / Y - h:i", strtotime($news[4]["publishedAt"])) }}
                                    UTC
                                </span>
                            @endif

                            <br />
                            <br />
                            <div class="carousel-btn-div">
                                <button
                                    onclick="openArticle(`{{ $news[4]["url"] }}`)"
                                >
                                    Go to our page
                                </button>
                                <button
                                    class="ml-4"
                                    onclick="openOriginalArticle(`{{ $news[4]["url"] }}`)"
                                >
                                    Go to original page
                                </button>
                            </div>
                            <div class="carousel-btn-div mt-8">
                                <x-vaadin-link
                                    class="article-icons link-icon"
                                    onclick="openOriginalArticle(`{{ $news[4]['url'] }}`)"
                                />
                                <x-bxs-like
                                    class="article-icons like-icon ml-4"
                                    onclick="likeArticle(`{{ $news[4]['url'] }}`)"
                                />
                                <x-bxs-dislike
                                    class="article-icons dislike-icon ml-4"
                                    onclick="dislikeArticle(`{{ $news[4]['url'] }}`)"
                                />
                                <x-bxs-comment
                                    class="article-icons comment-icon ml-4"
                                    onclick="openArticle(`{{ $news[4]['url'] }}`)"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Left and right controls -->
                <a
                    class="left carousel-control"
                    href="#myCarousel"
                    data-slide="prev"
                >
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a
                    class="right carousel-control"
                    href="#myCarousel"
                    data-slide="next"
                >
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </x-slot>
    @endif

    <div class="article-container">
        @foreach ($news as $index => $item)
            <div class="article">
                <div
                    @class([
                        "article-item",
                        "even-articles" => $index % 2 == 0,
                        "odd-articles" => $index % 2 != 0,
                    ])
                    @if (isset($item["urlToImage"]))
                        style="background-image: url({{ $item["urlToImage"] }});"
                    @else
                        style="background-image: url('https://s.france24.com/media/display/d1676b6c-0770-11e9-8595-005056a964fe/w:1280/p:16x9/news_1920x1080.png');"
                    @endif
                >
                    <div class="article-sub-item">
                        <div class="article-text-div">
                            <div
                                class="article-top"
                                onclick="openArticle(`{{ $item["url"] }}`)"
                            >
                                <span class="article-title">
                                    {{ $item["title"] }}
                                </span>
                                @if (isset($item["title"]))
                                    <br />
                                    <br />
                                    <span class="article-description">
                                        {{ $item["description"] }}
                                    </span>
                                @endif

                                @if (isset($item["source"]["name"]))
                                    <br />
                                    <br />
                                    <span class="article-notes">
                                        {{ $item["source"]["name"] }}
                                    </span>
                                @endif

                                @if (isset($item["source"]["name"]) && isset($item["author"]))
                                    <span class="article-notes">-</span>
                                @endif

                                @if (isset($item["author"]))
                                    <span class="article-notes">
                                        {{ $item["author"] }}
                                    </span>
                                @endif
                            </div>

                            <div class="article-bottom">
                                @if (isset($item["publishedAt"]))
                                    <span class="article-notes">
                                        {{ date("d / M / Y - h:i", strtotime($item["publishedAt"])) }}
                                        UTC
                                    </span>
                                @endif

                                <x-vaadin-link
                                    class="article-icons article-link-icon link-icon ml-4"
                                    onclick="openOriginalArticle(`{{ $item['url'] }}`)"
                                />
                                <x-bxs-like
                                    class="article-icons article-like-icon like-icon"
                                    onclick="likeArticle(`{{ $item['url'] }}`)"
                                />
                                <x-bxs-dislike
                                    class="article-icons article-dislike-icon dislike-icon ml-4"
                                    onclick="dislikeArticle(`{{ $item['url'] }}`)"
                                />
                                <x-bxs-comment
                                    class="article-icons article-comment-icon comment-icon ml-4"
                                    onclick="openArticle(`{{ $item['url'] }}`)"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <x-slot name="pagination">
        @if ($totalResults > $pageSize)
            <div class="page-size">
                @if ($page > 1)
                    <a
                        href="javascript:void(0);"
                        class="pagination-link without-decoration"
                        onclick="changePage({{ $page - 1 }}, {{ $page }})"
                    >
                        <span class="pagination-arrow-fix"><</span>
                    </a>
                @endif

                @for ($i = 1; $i <= ceil($totalResults / $pageSize); $i++)
                    <a
                        href="javascript:void(0);"
                        class="pagination-link @if ($i == $page) active @endif without-decoration"
                        onclick="changePage({{ $i }}, {{ $page }})"
                    >
                        {{ $i }}
                    </a>
                @endfor

                @if (ceil($totalResults / $pageSize) != $page)
                    <a
                        href="javascript:void(0);"
                        class="pagination-link without-decoration"
                        onclick="changePage({{ $page + 1 }}, {{ $page }})"
                    >
                        <span class="pagination-arrow-fix">></span>
                    </a>
                @endif
            </div>
        @endif

        <div class="page-size mt-8">
            <span class="mr-2">News per page:</span>
            @foreach ($pageSizes as $option)
                <a
                    href="javascript:void(0);"
                    class="pagination-link @if($option == $pageSize) active @endif without-decoration"
                    onclick="changePageSize({{ $option }}, {{ $pageSize }})"
                >
                    {{ $option }}
                </a>
            @endforeach
        </div>
    </x-slot>
</x-app-layout>

<script>
    function openArticle(url) {
        console.log('Open article on our page: ', url);
    }

    function openOriginalArticle(path) {
        window.open(path, '_blank');
    }

    function likeArticle(url) {
        console.log('Like article: ', url);
    }

    function dislikeArticle(url) {
        console.log('Dislike article: ', url);
    }

    function changePage(page, currentPage) {
        if (page !== currentPage) {
            var url = window.location.href;
            url = url.replace(/([?&])page=\d+/g, '');

            var separator = url.includes('?') ? '&' : '?';
            url += (url.includes('?') ? '&' : '?') + 'page=' + page;

            window.location.href = url;
        }
    }

    function changePageSize(size, currentSize) {
        if (size !== currentSize) {
            var url = window.location.href;
            url = url
                .replace(/([?&])pageSize=\d+/g, '')
                .replace(/([?&])page=\d+/g, '');

            var separator = url.includes('?') ? '&' : '?';
            url +=
                (url.includes('?') ? '&' : '?') +
                'pageSize=' +
                size +
                '&page=1';

            window.location.href = url;
        }
    }
</script>
