<?php

namespace App\Http\Controllers;

use App\Contracts\CounterContract;
use App\Events\BlogPostPosted;
use App\Facades\CounterFacade;
use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
        $this->middleware('locale');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index',
            [
                'posts' => BlogPost::latestWithRelations()->get()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // authorization of function for creating blog post with Policy method
        $this->authorize('posts.create');
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;

        $post = BlogPost::create($validated);

        if ($request->hasFile('thumbnail'))
        {
            $path = $request->file('thumbnail')->store('thumbnails');
            $post->image()->save(
                Image::make(['path' => $path])
            );
        }

        event(new BlogPostPosted($post));

        $request->session()->flash('create', __('Blog post created'));

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        abort_if(!isset($this->posts[$id]), 404);

//        return view('posts.show', ['post' => BlogPost::findOrFail($id)]);

        $blog_posts = Cache::tags(['blog-post'])->remember("blog-post-{$id}", 60, function () use($id) {
            return BlogPost::with('comments', 'tags', 'user')
                ->findOrFail($id);
        });

        return view('posts.show', [
            'post' => $blog_posts,
            'counter' => CounterFacade::increment("blog-post-{$id}", ['blog-post']),
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        $this->authorize('update', $post);

//        if (Gate::denies('posts.update', $post))
//        {
//            abort(403, "You can't edit this blog post!");
//        }

        return view('posts.edit', ['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        $this->authorize('update', $post);

//        if (Gate::denies('posts.update', $post))
//        {
//            abort(403, "You can't edit this blog post!");
//        }

        $validated = $request->validated();
        $post->fill($validated);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails');

            if ($post->image)
            {
                Storage::delete($post->image->path);
                $post->image->path = $path;
                $post->image->save();

            } else {
                $post->image()->save(
                    Image::make(['path' => $path])
                );
            }


        }
            $post->save();

        $request->session()->flash('update', __('Blog post updated'));

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);
        $this->authorize('delete', $post);
        $post->delete();

        session()->flash('delete', __('Blog post deleted'));

        return redirect()->route('posts.index');
    }
}
