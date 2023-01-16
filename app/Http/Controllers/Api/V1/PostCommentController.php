<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\CommentPosted;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComment;
use App\Http\Resources\Comment as CommentResource;
use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->only(['index', 'store', 'update', 'destroy']);
    }

    public function index(BlogPost $post, Request $request)
    {
        $per_page = $request->input('per_page') ?? 5;

        return CommentResource::collection(
            $post->comments()->with('user')->paginate($per_page)->appends(
                [
                    'per_page' => $per_page
                ]
            )
        );
    }

    public function store(BlogPost $post, StoreComment $request)
    {
        $comment = $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);

        event(new CommentPosted($comment));

        $request->session()->flash('create', __('Comment created'));

        return new CommentResource($comment);
    }

    public function show(BlogPost $post, Comment $comment)
    {
        return new CommentResource($comment);
    }

    public function update(BlogPost $post, Comment $comment, StoreComment $request)
    {
        $this->authorize($comment);
        $comment->content = $request->input('content');
        $comment->save();

        return new CommentResource($comment);
    }

    public function destroy(BlogPost $post, Comment $comment)
    {
        $this->authorize($comment);
        $comment->delete();

        return response()->noContent();
    }
}
