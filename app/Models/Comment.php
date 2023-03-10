<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function blogPosts()
    {
        return $this->belongsTo('App\Models\Profile', 'blog_post_id');
    }
}