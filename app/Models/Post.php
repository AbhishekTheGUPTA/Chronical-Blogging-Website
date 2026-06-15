<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\User;
use App\Models\Categories;
use Spatie\MediaLibrary\HasMedia;
use App\Models\PostViewAnalytics;

class Post extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasSlug;
    protected $fillable = [
        'Fk_userId',
        'title',
        'body',
        'excerpt',
        'slug',
        'visibility',
        'status',
        'publish_date',
        'seo_title',
        'description',
        'social_title',
        'social_description',
        'useCanonical',
        'noIndex',
        'author',
        'reading_time',
        'table_of_contents',
        'show_share_buttons',
        'enable_comments',
        'is_featured',
        'custom_css_class',
    ];

    public function getSlugOptions(): SlugOptions{
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function user(){
        return $this->belongsTo(User::class, 'Fk_userId');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'Fk_postId')
                    ->whereNull('parent_id') // only top-level
                    ->with('replies.user') // eager load replies
                    ->latest();
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'post_tag', 'Fk_postId', 'Fk_tagId');
    }

    public function categories(){
        return $this->belongsToMany(Categories::class, 'category_post', 'Fk_postId', 'Fk_categoryId');
    }

    // public function likes() {
    //     return $this->hasMany(Like::class);
    // }

    public function registerMediaCollections(): void {
        $this->addMediaCollection('featured_image');
    }

    

    public function postViews() {
        return $this->hasMany(PostViewAnalytics::class, 'Fk_postId');
    }
}

