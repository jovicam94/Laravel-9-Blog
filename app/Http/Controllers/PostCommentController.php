<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Jobs\NotifyUsersPostWasCommented;
use App\Jobs\ThrottledMail;
use App\Mail\CommentPosted;
use App\Mail\CommentPostedMarkdown;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }


    public function store(BlogPost $post, StoreComment $request)
    {
        $comment = $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);

        // send mail regularly

//        Mail::to($post->user)->send(
//            new CommentPostedMarkdown($comment)
//        );

//        $when = now()->addMinutes(1);

        // send mail with queue when start queue:work
//        Mail::to($post->user)->queue(
//            new CommentPostedMarkdown($comment)
//        );

        // send mail after 1 minute

//        Mail::to($post->user)->queue(
//            new CommentPostedMarkdown($comment)
//        );

        ThrottledMail::dispatch(new CommentPostedMarkdown($comment), $post->user)
        ->onQueue('high');

        NotifyUsersPostWasCommented::dispatch($comment)
        ->onQueue('low');

        $request->session()->flash('create', 'Comment was created.');

        return redirect()->back();
    }
}
