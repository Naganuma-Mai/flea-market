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

    public function destroy(Request $request)
    {
        User::find($request->user_id)->delete();

        return redirect('/admin/admin');
    }
}
