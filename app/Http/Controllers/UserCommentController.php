<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\User;

class UserCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }


    public function store(User $user, StoreComment $request)
    {
        $user->comments_on()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);

        $request->session()->flash('create', 'Comment was created.');

        return redirect()->back();
    }
}
