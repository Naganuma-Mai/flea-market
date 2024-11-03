<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Item;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function edit(Request $request, $item_id)
    {
        $payment = Payment::find($request->payment_id);
        $payments = Payment::all();
        $item = Item::find($item_id);

        return view('payment', compact('payment', 'payments', 'item'));
    }

    public function update(Request $request, $item_id)
    {
        $item = Item::find($item_id);

        $payment = Payment::find($request->payment_id);

        return view('purchase', compact('item', 'payment'));
    }
}
