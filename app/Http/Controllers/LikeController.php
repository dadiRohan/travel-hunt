<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Toggle like on a travel.
     */
    public function toggle(Travel $travel)
    {
        $like = Like::where('user_id', auth()->id())
                   ->where('travel_id', $travel->id)
                   ->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'travel_id' => $travel->id,
            ]);
            $liked = true;
        }

        if (request()->expectsJson()) {
            return response()->json([
                'liked' => $liked,
                'likes_count' => $travel->likes()->count(),
            ]);
        }

        return back();
    }

    /**
     * Get likes count for a travel.
     */
    public function count(Travel $travel)
    {
        return response()->json([
            'count' => $travel->likes()->count(),
            'userLiked' => auth()->check() && auth()->user()->hasLiked($travel->id),
        ]);
    }
}
