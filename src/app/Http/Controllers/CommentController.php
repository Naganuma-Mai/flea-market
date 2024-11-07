<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Comment;
use Illuminate\Http\Request;
use Auth;

class CommentController extends Controller
{
    public function index($item_id)
    {
        // $comments = Comment::with(['user'])->ItemSearch($item_id)->get();
        $item = Item::find($item_id);

        return view('comment', compact('item'));
    }

    public function store(Request $request, $item_id)
    {
        $comment = [
            'user_id' => Auth::id(),
            'item_id' => $item_id,
            'content' => $request->content,
        ];
        Comment::create($comment);

        return redirect("/comment/$item_id");
    }

    public function destroy($comment_id)
    {
        Comment::find($comment_id)->delete();

        return redirect()->back();
    }
}
