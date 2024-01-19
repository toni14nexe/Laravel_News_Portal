<?php
use Illuminate\Support\Facades\Request;

$page = Request::input("page", 1);
$pageSizes = [10, 20, 50, 100];
$pageSize = Request::input("pageSize", 10);
?>

<style>
    .activity-nav-btn {
        transition: ease-in-out 0.3s;
        color: white;
        font-weight: 700;
        cursor: pointer;
    }

    .activity-nav-btn-margin {
        margin-left: 2.5rem;
    }

    .activity-nav-btn:hover,
    .active {
        text-decoration: underline;
        text-underline-offset: 5px;
    }

    .row {
        width: 100%;
        display: grid;
        grid-template-rows: 100%;
    }

    .col {
        grid-column: 3;
        border: 1px solid rgb(55, 65, 81);
        border-radius: 10px;
        padding: 0.5rem;
        margin: 0.5rem;
    }

    .col:hover {
        transition: 0.3s ease-in-out;
        border-color: white;
    }

    .article {
        height: 250px !important;
    }

    .article:hover {
        cursor: pointer;
    }

    .article-item {
        height: calc(250px - 2rem) !important;
    }

    .article-item:hover {
        height: calc(250px - 1.6rem) !important;
    }

    .article-sub-item {
        background-color: rgba(0, 0, 0, 0.7) !important;
    }

    .article-sub-item:hover {
        background-color: rgba(0, 0, 0, 0.9) !important;
    }

    .text-div {
        padding: 0.5rem;
    }

    .text-div-bottom {
        margin: 0 0.5rem 0.5rem 0.5rem;

    }
</style>

<x-app-layout>
    <x-slot name="activityNavigation">
        <span class="activity-nav-btn @if($title == 'Comments') active @endif" onclick="goToActivity('comments')">
            Comments
        </span>
        <span class="activity-nav-btn activity-nav-btn-margin @if($title == 'Likes') active @endif" onclick="goToActivity('likes')">
            Likes
        </span>
        <span class="activity-nav-btn activity-nav-btn-margin @if($title == 'Dislikes') active @endif" onclick="goToActivity('dislikes')">
            Dislikes
        </span>
    </x-slot>

    <div class="article-container">
        @foreach ($items as $index => $item)
            <div class="article" onclick="goToArticle({{ json_encode($item) }})">
                <div
                    @class([
                        "article-item",
                        "even-articles" => $index % 2 == 0,
                        "odd-articles" => $index % 2 != 0,
                    ])
                    @if (isset($item["imageUrl"]))
                        style="background-image: url({{ $item["imageUrl"] }});"
                    @else
                        style="background-image: url('https://s.france24.com/media/display/d1676b6c-0770-11e9-8595-005056a964fe/w:1280/p:16x9/news_1920x1080.png');"
                    @endif
                >
                    <div class="article-sub-item">
                        <div class="text-div">
                            {{ $item['title'] }}
                        </div>
                        <br>
                        <div class="text-div">
                            {{ date("d / M / Y - h:i", strtotime($item->created_at)) }}
                        </div>
                        <div class="text-div">
                            {{ $item['comment'] }}
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

        <div class="page-size @if($totalResults > $pageSize) mt-4 @endif">
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
    function goToArticle(news) {
        news?.imageUrl ? undefined : news.imageUrl = 'https://s.france24.com/media/display/d1676b6c-0770-11e9-8595-005056a964fe/w:1280/p:16x9/news_1920x1080.png';

        window.location.href = 'news-profile?title=' + news.title
            + '&publisher=' + news.publisher
            + '&author=' + news.author
            + '&url=' + news.url
            + '&imgUrl=' + news.imageUrl
            + '&goTo=comments'
    }

    function goToActivity(link) {
        window.location.href = link
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
