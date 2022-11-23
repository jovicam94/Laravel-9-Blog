<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{


    use SoftDeletes;
    // blog_post_id
    public function blog_post()
    {
        return $this->belongsTo('App\Models\BlogPost');
    }

    use HasFactory;

    public static function boot()
    {
        parent::boot();

//        static::addGlobalScope(new LatestScope);

    }
}
