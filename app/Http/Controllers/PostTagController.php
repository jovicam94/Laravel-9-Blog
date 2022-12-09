<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Models\Tag;

class PostTagController extends Controller
{
    public function index($tag_id)
    {
        $tag = Tag::findOrFail($tag_id);

        return view('posts.index',
            ['posts' => $tag->blogPosts]);
    }
}
