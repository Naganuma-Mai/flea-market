<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Comment;
use Illuminate\Http\Request;
use Auth;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $comments = Comment::with(['user'])->ItemSearch($request->item_id)->get();
        $item = Item::find($request->item_id);

        return view('comment', compact('comments', 'item'));
    }

    public function store(Request $request)
    {
        $request['user_id'] = Auth::id();
        Comment::create(
            $request->only([
                'user_id',
                'item_id',
                'content'
            ])
        );

        return redirect('/comment');
    }
}
