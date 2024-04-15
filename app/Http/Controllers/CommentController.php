<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Chirp;
use App\Notifications\NewComment;
use App\Notifications\NewReply;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        
        $request->validate([
            'chirp_id' => 'required|exists:chirps,id',
            'comment' => 'required|string', 
        ]);
        
        $commentData = [
            'chirp_id' => $request->chirp_id,
            'comment' => $request->comment,
            'user_id' => auth()->id(),
        ];

        if ($request->has('parent_id')) {
            $commentData['parent_id'] = $request->parent_id;
        }

        $comment = Comment::create($commentData);

        // notify chirp owner that someone commented based on comment or reply
        if ($request->has('parent_id')) {
            $reply = Comment::find($request->parent_id);
            $reply->user->notify(new NewReply($comment));
        } else {
            $chirp = Chirp::find($request->chirp_id);
            $chirp->user->notify(new NewComment($comment));
        }
        
        return response()->json(['comment' => $comment]);
        
    }

    public function update()
    {
        //
    }

    public function destroy(Comment $comment)
    {   

        if (auth()->user() && auth()->user()->id === $comment->user_id) {

            $comment->childComments()->delete();
            $comment->delete();
    
            return response()->json(['success' => true, 'message' => 'Comment deleted successfully']); 
        } else {
            // User is not authorized to delete this comment
            return response()->json(['error' => 'Unauthorized to delete this comment'], 403);
            }  
    }

    public function index(Chirp $chirp)
    {
        $comments = $chirp->comments()->get();
        return $comments;
    }
}
