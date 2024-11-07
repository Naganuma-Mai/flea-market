<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('my_page');
    }

    public function showComments($user_id)
    {
        $user = User::find($user_id);

        return view('user_comment', compact('user'));
    }

    public function destroy(Request $request)
    {
        User::find($request->user_id)->delete();

        return redirect('/admin/admin');
    }
}
