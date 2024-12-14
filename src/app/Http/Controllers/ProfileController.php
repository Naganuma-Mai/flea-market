<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Item;
use App\Models\Payment;
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
        $profile = [
            'user_id' => Auth::id(),
            'name' => $request->name,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building
        ];

        // ファイルがアップロードされている場合
        if ($request->hasFile('image')) {
            // アップロードされたファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();
            // 取得したファイル名で保存
            $request->file('image')->storeAs('public/images' , $file_name);

            $profile['image'] = 'storage/images/' . $file_name;
        }

        // profile_idキーが存在し、かつ値が入力されている場合
        if ($request->filled('profile_id')) {
            Profile::find($request->profile_id)->update($profile);
        // profile_idキーが存在しない、もしくはNULLの場合
        } else {
            Profile::create($profile);
        }

        return redirect('/mypage');
    }

    public function editAddress(Request $request, $item_id)
    {
        $user = Auth::user();

        // ユーザーのプロフィールを取得
        $profile = $user->profile;

        $item = Item::find($item_id);

        $payment = Payment::find($request->payment_id);

        return view('address', compact('profile', 'item', 'payment'));
    }

    public function updateAddress(Request $request, $item_id)
    {
        $address = $request->only(['postal_code', 'address', 'building']);
        Profile::find($request->profile_id)->update($address);

        $item = Item::find($item_id);

        $payment = Payment::find($request->payment_id);

        return view('purchase', compact('item', 'payment'));
    }
}
