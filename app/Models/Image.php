<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    public $fillable = ['path', 'blog_post_id'];

    public function blog_post()
    {
        return $this->belongsTo(BlogPost::class);
    }

    public function url()
    {
//        return asset("storage/{$this->path}");
        return Storage::url($this->path);
    }


}
