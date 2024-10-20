<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Auth;

class LikeController extends Controller
{
    public function store(Request $request) {
        $user = Auth::user();
        $item_id = $request->item_id;
        // まだお気に入りにしていなければお気に入りにする
        if (!$user->isLike($item_id)) {
            $user->likeItems()->attach($item_id);
        }
        return back();
    }

    public function destroy(Request $request) {
        $user = Auth::user();
        $item_id = $request->item_id;
        // すでにお気に入りにしていればお気に入りから外す
        if ($user->isLike($item_id)) {
            $user->likeItems()->detach($item_id);
        }
        return back();
    }
}
