<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Auth;

class ItemController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ユーザーがお気に入りにした商品の一覧を取得
        $like_items = $user->likeItems()->get();

        return view('item_all', compact('recommend_items', 'like_items'));
    }

    public function search(Request $request)
    {
        $items = Item::with(['area', 'genre'])->KeywordSearch($request->keyword)->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('item_all', compact('items', 'areas', 'genres'));
    }

    public function detail($item_id)
    {
        $item = Item::find($item_id);

        return view('item_detail', compact('item', 'item_categories'));
    }

    public function add()
    {
        // $areas = Area::all();
        // $genres = Genre::all();

        // return view('sell', compact('areas', 'genres'));
        return view('sell');
    }

    public function store(Request $request)
    {
        // アップロードされたファイル名を取得
        $file_name = $request->file('image')->getClientOriginalName();

        // 取得したファイル名で保存
        $request->file('image')->storeAs('public/images' , $file_name);

        $item = [
            'user_id' => Auth::id(),
            'image' => 'storage/images/' . $file_name,
            'condition' => $request->condition,
            'name' => $request->name,
            'explanation' => $request->explanation,
            'price' => $request->price
        ];
        Item::create($item);

        return view('my_page');
    }
}
