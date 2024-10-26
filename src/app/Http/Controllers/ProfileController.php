<?php

namespace App\Http\Controllers;

use App\Models\Profile;
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
}
