<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Auth;

class ItemController extends Controller
{
    public function index()
    {
        $recommend_items = Item::all();

        // ログイン後
        if (Auth::check()) {
            $user = Auth::user();
            // ユーザーがお気に入りにした商品の一覧を取得
            $like_items = $user->likeItems()->get();
        // ログイン前
        } else {
            $like_items = [];
        }

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
        $categories = Category::all();

        return view('sell', compact('categories'));
    }

    public function store(Request $request)
    {
        // アップロードされたファイル名を取得
        $file_name = $request->file('image')->getClientOriginalName();

        // 取得したファイル名で保存
        $request->file('image')->storeAs('public/images' , $file_name);

        // Itemモデルのインスタンスを作成して保存
        $item = Item::create([
            'user_id' => Auth::id(),
            'image' => 'storage/images/' . $file_name,
            'condition' => $request->condition,
            'name' => $request->name,
            'explanation' => $request->explanation,
            'price' => $request->price
        ]);

        // 中間テーブルへの登録
        $item->categories()->attach($request->categories);

        return view('my_page');
    }
}
