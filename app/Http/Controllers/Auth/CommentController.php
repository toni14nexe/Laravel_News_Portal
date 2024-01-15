<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
}
