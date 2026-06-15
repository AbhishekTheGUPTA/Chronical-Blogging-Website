<?php

namespace App\Services;

use App\Http\Requests\StorePostRequest;
use App\Models\Categories;
use App\Models\Post;
use App\Models\Tag;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Str as LaravelStr;

class PostService
{
    public function __construct(protected PostRepository $postRepository) {}

    public function createPost(StorePostRequest $request, string $action)
    {
        // $body = $request->input('body', '');
        // $text = strip_tags($body);
        // $wordCount = str_word_count($text);
        // \Log::info("Body length: " . strlen($body) . " | Text: " . substr($text, 0, 100) . " | Words: " . $wordCount);

        $post = $this->postRepository->create([
            'Fk_userId'         => Auth::id(),
            'title'             => $request->input('title'),
            'body'              => $request->input('body'),
            'excerpt'           => $request->input('excerpt'),
            'slug'              => $request->filled('urlSlug') ? $request->input('urlSlug') : $this->generateSlug($request->input('title')),
            'visibility'        => $request->input('visibility'),
            'publish_date'      => $request->input('publishDate'),
            'is_featured'       => $request->boolean('is_featured'),
            'social_description'=> $request->input('socialDescription'),
            'author'            => $request->input('author'),
            'seo_title'         => $request->input('seoTitle'),
            'description'       => $request->input('Description'),
            'social_title'      => $request->input('socialTitle'),
            'status'            => $action === 'draft' ? 'draft' : 'published',
            'published_at'      => $action === 'draft' ? null : now(), 
            'useCanonical'      => $request->boolean('useCanonical'),
            'noIndex'           => $request->boolean('noIndex'),
            'reading_time'      => $this->calculateReadingTime($request->input('body', '')),
            'table_of_contents' => $request->boolean('table_of_contents'),
            'show_share_buttons'=> $request->boolean('show_share_buttons'),
            'enable_comments'   => $request->boolean('enable_comments'),
        ]);

        $post = $post->fresh();

        // 2. Attach relationships — after post exists
        // Attach category
        $categorySlug = $request->input('category');
        $category = Categories::where('slug', $categorySlug)->first();
        if ($category) {
            $post->categories()->attach($category->id);
        }

        // Attach tags
        $tagNames = $request->input('tags', []);
        foreach ($tagNames as $tagName) {
            $tag = Tag::firstOrCreate(
                ['name' => $tagName],
                ['slug' => Str::slug($tagName)]
            );
            $post->tags()->attach($tag->id);
        }

        // 3. Handle media — after post exists
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $post->addMedia($file)
                ->toMediaCollection('featured_image');

            //dd('done', $post->getMedia('featured_image'));
        }
        //dd('no file found');

        if ($request->hasFile('additionalImages')) {
            foreach ($request->file('additionalImages') as $image) {
                $post->addMedia($image)
                    ->toMediaCollection('additional_images');
            }
        }

        if ($request->hasFile('socialImage')) {
            $post->addMedia($request->file('socialImage'))
                ->toMediaCollection('social_image');
        }

        return $post;
    }

    private function generateSlug(string $title): string
    {
        $slug = LaravelStr::slug($title);
        $original = $slug;
        $count = 1;

        while (Post::where('slug', $slug)->exists()) {
            $slug = $original.'-'.$count++;
        }

        return $slug;
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    private function calculateReadingTime(string $html): int
    {
        $text      = strip_tags($html);
        $wordCount = str_word_count($text);
        $minutes   = (int) ceil($wordCount / 220);

        return max(1, $minutes); // minimum 1 minute
    }
}
