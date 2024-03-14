<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Chirp;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'chirp_id' => 'required|exists:chirps,id',
            'comment' => 'required|string',
        
        ]);
    
        $comment = Comment::create([
            'chirp_id' => $request->chirp_id,
            'comment' => $request->comment,
            'user_id' => auth()->id(), 
        ]);
    
        if (request()->wantsJson()){
            return response()->json(['comment' => $comment]);
        } else {
            return redirect()->back()->with('success', 'Comment successfully added');
        }
            
    }

    public function update()
    {
        //
    }

    public function destroy(Comment $comment)
    {
        if (auth()->user() && auth()->user()->id === $comment->user_id) {
            
            $comment->delete();
    
            if (request()->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Comment deleted successfully']);
            } else {
                return redirect()->back()->with('success', 'Comment deleted successfully');
            } 
        } else {
            // User is not authorized to delete this comment
            if (request()->wantsJson()) {
                return response()->json(['error' => 'Unauthorized to delete this comment'], 403);
            } else {
                return redirect()->back()->with('error', 'Unauthorized to delete this comment');
        } 
    }}

    public function index(Chirp $chirp)
    {
        return $chirp->comments;
    }
}
