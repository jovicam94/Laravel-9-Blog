<?php

namespace App\Http\ViewComposers;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ActivityComposer
{
    public function compose(View $view)
    {
        $most_commented = Cache::tags(['blog-post'])->remember('blog-post-commented', 60, function () {
            return BlogPost::mostCommented()->take(5)->get();
        });

        $most_active = Cache::tags(['blog-post'])->remember('users-most-active', 60, function () {
            return User::withMostBlogPosts()->take(5)->get();
        });

        $most_active_last_month = Cache::tags(['blog-post'])->remember('users-most-active-last-month', 60, function () {
            return User::withMostBlogPostsLastMonth()->take(5)->get();
        });

        $view->with('most_commented', $most_commented);
        $view->with('most_active', $most_active);
        $view->with('most_active_last_month', $most_active_last_month);
    }
}
