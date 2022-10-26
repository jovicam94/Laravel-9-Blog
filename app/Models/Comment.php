<?php

namespace App\Models;

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
}
