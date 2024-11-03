<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Payment;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Auth;

class PurchaseController extends Controller
{
    public function index($item_id)
    {
        $item = Item::find($item_id);

        // デフォルトはコンビニ払い
        $payment = Payment::find(2);

        return view('purchase', compact('item', 'payment'));
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
