<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{   
    public function newsProfile(): View
    {
        return view('news-profile');
    }

    public function create(): View
    {
        return view('news-profile');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment' => ['required', 'string'],
            'url' => ['required', 'string'],
        ]);

        if (Auth::check()) {
            $user = Auth::user();

            Comment::create([
                'comment' => $request->input('comment'),
                'url' => $request->input('url'),
                'username' => $user->name,
                'title' => $request->input('title'),
                'imageUrl' => $request->input('imageUrl'),
                'publisher' => $request->input('publisher'),
                'author' => $request->input('author'),
            ]);
        }

        Session::put('url', $request->input('url'));
        Session::put('title', $request->input('title'));
        Session::put('imageUrl', $request->input('imageUrl'));
        Session::put('publisher', $request->input('publisher'));
        Session::put('author', $request->input('author'));
        Session::put('description', $request->input('description'));
        Session::put('published', $request->input('published'));

        return redirect()->route('news-profile');
    }

    public function edit(Request $request)
    {
        DB::table('comments')->where('id', $request->input('id'))->update(['comment' => $request->input('comment')]);
        $comment = DB::table('comments')->where('id', $request->input('id'))->first();

        Session::put('url', $comment->url);
        Session::put('title', $comment->title);
        Session::put('imageUrl', $comment->imageUrl);
        Session::put('publisher', $comment->publisher);
        Session::put('author', $comment->author);
        Session::put('description', $request->input('newsDescription'));
        Session::put('published', $request->input('newsPublished'));

        return redirect()->route('news-profile');
    }

    public function delete(Request $request)
    {
        $comment = DB::table('comments')->where('id', $request->input('id'))->first();
        DB::table('comments')->where('id', $request->input('id'))->delete();

        Session::put('url', $comment->url);
        Session::put('title', $comment->title);
        Session::put('imageUrl', $comment->imageUrl);
        Session::put('publisher', $comment->publisher);
        Session::put('author', $comment->author);
        Session::put('description', $request->input('newsDescription'));
        Session::put('published', $request->input('newsPublished'));

        return redirect()->route('news-profile');
    }

    public function activity(Request $request)
    {
        $userName = Auth::user()->name;
        $comments = Comment::where('username', $userName)->get()->sortBy('created_at');

        return view('activity', ['title' => 'Comments','items' => $comments]);
    }
}
