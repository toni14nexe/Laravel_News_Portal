<?php
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;

$title = Request::input("title", session('title'));
$description = Request::input("description", session('description'));
$publisher = Request::input("publisher", session('publisher'));
$author = Request::input("author", session('author'));
$url = Request::input("url", session('url'));
$imgUrl = Request::input("imgUrl", session('imgUrl'));
$published = Request::input("published", session('published'));
$goTO = Request::input("goTo", session('goTo'));

$comments = DB::table('comments')->where('url', $url)->get()->sortBy('created_at');
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

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        margin-top: 5%;
        left: 25%;
        top: 0;
        width: 50%;
        height: fit-content;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.85);
    }

    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        transition: 0.3s ease-in-out;
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        margin-right: 1rem;
    }

    .close:hover,
    .close:focus {
        transition: 0.3s ease-in-out;
        color: #ef4444;
        text-decoration: none;
        cursor: pointer;
    }

    .edit-modal-div {
        padding: 1rem;
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
                class="w-250 ml-4 btn-green"
                onclick="openOriginalArticle(`{{ $url }}`)"
            >
                Open
            </button>
        </div>
    <br>

    <div id="comments">
        <x-slot name="comments">
            @if (count($comments))
                @foreach ($comments as $comment)
                    <div class="comment">
                        <div class="comment-top-row">
                            <div class="comment-avatar"></div>
                            <span class="ml-2 comment-username">{{ $comment->username }}</span>
                            @if ($comment->username == auth()->user()->name)
                                <x-bxs-edit class="edit-comment" onclick="editComment({{ json_encode($comment) }})" />
                                <x-eos-delete class="delete-comment" />
                            @endif
                        </div>
                        <div class="mt-2 mb-2">
                            <span class="comment-comment">{{ $comment->comment }}</span>
                        </div>
                        <div class="mt-2">
                            Posted: {{ date("d / M / Y - h:i", strtotime($comment->created_at)) }}
                        </div>
                        @if ($comment->created_at != $comment->updated_at)
                            <div>
                                Updated: {{ date("d / M / Y - h:i", strtotime($comment->updated_at)) }}
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <span>This news does not have comments yet...</span>
            @endif

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
                <textarea id="description" name="description" class="hidden">{{ $description }}</textarea>
                <textarea id="published" name="published" class="hidden">{{ $published }}</textarea>

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
    </div>

    <div id="editModal" class="modal">
        <!-- Edit modal content -->
        <div class="edit-modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <div class="edit-modal-div">
                <form method="POST" action="{{ route("comments.edit") }}">
                    @csrf
                    <span id="commentCreatedAt"></span>
                    <textarea id="editCommentId" name="id" class="hidden"></textarea>
                    <textarea class="textarea mt-2" name="comment" rows="4" placeholder="Comment..." id="commentTextarea"></textarea>
                    <div class="post-comment-btn-layout">
                        <button class="mt-4 btn-green w-250" onclick="updateComment()">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let modal = document.getElementById("editModal");
        let commentTextarea = document.getElementById("commentTextarea");
        let commentCreatedAt = document.getElementById("commentCreatedAt");
        let editCommentId = document.getElementById("editCommentId");
        
        function editComment(comment) {
            localStorage.setItem('editComment', JSON.stringify(comment));
            commentTextarea.value = comment.comment;
            editCommentId.value = comment.id;
            commentCreatedAt.innerText = "Created: " + new Date(comment.created_at).toLocaleString();
            modal.style.display = "block";
        }

        function closeEditModal() {
            modal.style.display = "none";
            localStorage.removeItem('editComment');
        }

        function updateComment() {
            closeEditModal();
        }
    </script>
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (window.location.search.includes('goTo=comments')) {
            let commentsElement = document.getElementById('comments');

            if (commentsElement)
                commentsElement.scrollIntoView({ behavior: 'smooth' });
        }
    });

    function openOriginalArticle(path) {
        window.open(path, '_blank');
    }

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal)
            modal.style.display = "none";
    }

    document.addEventListener("DOMContentLoaded", function() {
    if (localStorage.getItem('editComment')) {
        let storedValue = localStorage.getItem('editComment');
        document.getElementById('commentTextarea').value = storedValue;
    }
});
</script>