<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CommentController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('news-profile');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'comment' => ['required', 'string'],
            'url' => ['required', 'string'],
        ]);

        Comment::create([
            'comment' => $request->input('comment'),
            'url' => $request->input('url'),
            'title' => $request->input('title'),
            'imageUrl' => $request->input('imageUrl'),
            'publisher' => $request->input('publisher'),
            'author' => $request->input('author'),
        ]);

        return redirect(RouteServiceProvider::HOME);
    }
}
