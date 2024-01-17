<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LikeController extends Controller
{   
    /** @throws \Illuminate\Validation\ValidationException */
    public function createLike(Request $request)
    {
        $request->validate(['url' => ['required', 'string']]);

        if (Auth::check()) {
            $user = Auth::user();

            Like::updateOrCreate(
                [
                    'userId' => $user->id,
                    'url' => $request->input('url'),
                ],
                [
                    'type' => 'like',
                    'url' => $request->input('url'),
                    'title' => $request->input('title'),
                    'imageUrl' => $request->input('imageUrl'),
                    'publisher' => $request->input('publisher'),
                    'author' => $request->input('author'),
                ]
            );
        }

        return Redirect::back();
    }

    public function createDislike(Request $request)
    {
        $request->validate(['url' => ['required', 'string']]);

        if (Auth::check()) {
            $user = Auth::user();

            Like::updateOrCreate(
                [
                    'userId' => $user->id,
                    'url' => $request->input('url'),
                ],
                [
                    'type' => 'dislike',
                    'url' => $request->input('url'),
                    'title' => $request->input('title'),
                    'imageUrl' => $request->input('imageUrl'),
                    'publisher' => $request->input('publisher'),
                    'author' => $request->input('author'),
                ]
            );
        }

        return Redirect::back();
    }
}