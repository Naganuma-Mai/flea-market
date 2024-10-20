<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Auth;

class PurchaseController extends Controller
{
    public function index($item_id)
    {
        $item = Item::find($item_id);

        return view('purchase', compact('item'));
    }

    public function store(Request $request)
    {
        $request['user_id'] = Auth::id();
        Purchase::create(
            $request->only([
                'user_id',
                'item_id',
                'payment_id'
            ])
        );

        return view('my_page');
    }
}
