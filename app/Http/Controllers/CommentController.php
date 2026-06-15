<?php

namespace App\Http\Controllers;
use App\Models\Comments;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string|max:1000', 
            'post_id' => 'required|exists:posts,id'
        ]);

        Comments::create([
            'Fk_postId' => $request->post_id,
            'Fk_userId' => auth()->id(),
            'body' => $request->body,
        ]);

        return back()->with('success', 'Comment posted.');
    }

    public function reply(Request $request, Comments $comment)
    {
        $request->validate(['body' => 'required|string|max:1000']);

        Comments::create([
            'Fk_postId' => $comment->Fk_postId,
            'Fk_userId' => auth()->id(),
            'parent_id' => $comment->id,
            'body' => $request->body,
        ]);

        return back()->with('success', 'Reply posted.');
    }

    public function destroy(Comments $comment)
    {
        abort_if(auth()->id() !== $comment->Fk_userId, 403);
        $comment->delete();

        return back()->with('success', 'Deleted.');
    }
}
