<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostViewAnalytics extends Model
{
    protected $table = 'posts_views_analytics';
    protected $fillable = ['Fk_postId', 'ip_address', 'viewed_at'];
}
