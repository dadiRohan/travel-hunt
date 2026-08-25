<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created comment.
     */
    public function store(Request $request, Travel $travel)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000|min:1',
        ]);

        $travel->comments()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

    /**
     * Delete a comment.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        
        $travel = $comment->travel;
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully!');
    }

    /**
     * Update a comment.
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validated = $request->validate([
            'content' => 'required|string|max:1000|min:1',
        ]);

        $comment->update(['content' => $validated['content']]);

        return back()->with('success', 'Comment updated successfully!');
    }
}
