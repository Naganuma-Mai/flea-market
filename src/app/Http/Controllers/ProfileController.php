<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Item;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ユーザーのプロフィールを取得
        $profile = $user->profile;

        return view('profile', compact('profile'));
    }

    public function store(Request $request)
    {
        // アップロードされたファイル名を取得
        $file_name = $request->file('image')->getClientOriginalName();

        // 取得したファイル名で保存
        $request->file('image')->storeAs('public/images' , $file_name);

        $profile = [
            'user_id' => Auth::id(),
            'image' => 'storage/images/' . $file_name,
            'name' => $request->name,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building
        ];

        // profile_idキーが存在し、かつ値が入力されている場合
        if ($request->filled('profile_id')) {
            Profile::find($request->profile_id)->update($profile);
        // profile_idキーが存在しない、もしくはNULLの場合
        } else {
            Profile::create($profile);
        }

        return redirect('/mypage');
    }

    public function editAddress($item_id)
    {
        $user = Auth::user();

        // ユーザーのプロフィールを取得
        $profile = $user->profile;

        $item = Item::find($item_id);

        return view('address', compact('profile', 'item'));
    }

    public function storeAddress(Request $request, $item_id)
    {
        // profile_idキーが存在し、かつ値が入力されている場合
        if ($request->filled('profile_id')) {
            $address = $request->only(['postal_code', 'address', 'building']);
            Profile::find($request->profile_id)->update($address);
        // profile_idキーが存在しない、もしくはNULLの場合
        } else {
            $request['user_id'] = Auth::id();
            $address = $request->only(['user_id', 'postal_code', 'address', 'building']);
            Profile::create($address);
        }

        $item = Item::find($item_id);

        return view('purchase', compact('item'));
        // return redirect('/purchase/$item_id')->with('item', $item);
    }
}
