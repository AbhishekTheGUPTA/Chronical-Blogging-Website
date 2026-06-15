<?php 

namespace App\Repositories; 
use App\Models\Post;


class PostRepository{
    public function create(array $data) : Post{
        return Post::create($data);
    }
}