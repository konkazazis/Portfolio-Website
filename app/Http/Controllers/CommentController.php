<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Public: submit a comment (saved as unapproved)
    public function store(Request $request)
    {
        $data = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'content' => 'required|string|max:2000',
        ]);

        $post = Post::published()->findOrFail($data['post_id']);

        $comment = $post->comments()->create($data);

        return response()->json([
            'message' => 'Comment submitted and awaiting approval.',
            'comment' => $comment,
        ], 201);
    }

    // Admin: list all comments (optionally filter by post or approval status)
    public function index(Request $request)
    {
        $query = Comment::with('post:id,title,slug')->latest();

        if ($request->has('post_id')) {
            $query->where('post_id', $request->post_id);
        }

        if ($request->has('approved')) {
            $query->where('is_approved', filter_var($request->approved, FILTER_VALIDATE_BOOLEAN));
        }

        return response()->json($query->paginate(20));
    }

    // Admin: approve a comment
    public function approve(int $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update(['is_approved' => true]);

        return response()->json(['message' => 'Comment approved.', 'comment' => $comment]);
    }

    // Admin: delete a comment
    public function destroy(int $id)
    {
        Comment::findOrFail($id)->delete();

        return response()->json(['message' => 'Comment deleted.']);
    }
}
