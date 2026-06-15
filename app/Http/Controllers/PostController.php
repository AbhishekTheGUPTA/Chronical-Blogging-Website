<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Services\PostService;
use App\Providers\ActionsServiceProvider;
use App\Repositories\PostRepository;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function __construct(protected PostService $postService){}

    public function create()
    {
        return view('posts.create', ['post' => new \App\Models\Post()]);
    }

    public function store(StorePostRequest $request){
        //dd($request);   
        //dd($request['table_of_contents'], $request['show_share_buttons'], $request['is_featured']);     
        $action = $request->input('action');
        $post = $this->postService->createPost($request, $action);
        // Add image after creating post
        
        $message = $action === 'draft' ? 'Post saved as draft!' : 'Post published successfully!';
        return redirect()->route('Dashboard')->with('success', $message);
    }

    public function browse(){
        $posts = \App\Models\Post::with('categories', 'tags')->latest()->get();
        return view('posts.index', compact('posts'));
    }
    

}
