<?php

namespace App\Models;

use App\Scopes\LatestScope;
use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{


    use SoftDeletes, Taggable;

    protected $fillable = ['user_id', 'content'];


    // blog_post_id
    public function commentable() : MorphTo
    {
        return $this->morphTo(BlogPost::class, 'commentable_type', 'commentable_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    use HasFactory;

}
