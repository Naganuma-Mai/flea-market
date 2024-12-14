<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Payment;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Customer;

class PurchaseController extends Controller
{
    public function index($item_id)
    {
        $item = Item::find($item_id);

        // デフォルトはコンビニ払い
        $payment = Payment::find(2);

        return view('purchase', compact('item', 'payment'));
    }

    public function store(Request $request, $item_id)
    {
        $item = Item::find($item_id);

        // StripeのAPIキーを設定
        Stripe::setApiKey(env('STRIPE_SECRET'));

        switch ($request->payment_id) {
            case 1:
                // クレジットカード処理
                return $this->handleCreditCardPayment($item);

            case 2:
                // コンビニ払い処理
                $session = $this->createKonbiniSession($item);
                break;

            case 3:
                // 銀行振込処理
                $session = $this->createBankTransferSession($item);
                break;

            default:
                abort(400, 'Invalid payment method.');
        }

        return redirect($session->url);
    }

    private function handleCreditCardPayment($item)
    {
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => ['name' => $item->name],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/purchase/success/' . $item->id), // 成功URL
            'cancel_url' => url('/purchase/cancel/' . $item->id),   // キャンセルURL
            'payment_intent_data' => [
                'metadata' => [
                    'user_id' => Auth::id(),
                    'item_id' => $item->id,
                    'payment_id' => 1
                ],
            ],
        ]);

        return redirect($session->url);
    }

    private function createKonbiniSession($item)
    {
        return Session::create([
            'payment_method_types' => ['konbini'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => ['name' => $item->name],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'payment_method_options' => [
                'konbini' => ['expires_after_days' => 3],
            ],
            'success_url' => url('/purchase/success/' . $item->id), // 成功URL
            'cancel_url' => url('/purchase/cancel/' . $item->id),   // キャンセルURL
            'payment_intent_data' => [
                'metadata' => [
                    'user_id' => Auth::id(),
                    'item_id' => $item->id,
                    'payment_id' => 2
                ],
            ],
        ]);
    }

    private function createBankTransferSession($item)
    {
        $customer = Auth::user()->stripe_customer_id
            ? Customer::retrieve(Auth::user()->stripe_customer_id)
            : Customer::create([
                'email' => Auth::user()->email,
                'name' => Auth::user()->profile->name,
            ]);

        if (!Auth::user()->stripe_customer_id) {
            Auth::user()->update(['stripe_customer_id' => $customer->id]);
        }

        return Session::create([
            'payment_method_types' => ['customer_balance'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => ['name' => $item->name],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'customer' => $customer->id,
            'payment_method_options' => [
                'customer_balance' => [
                    'funding_type' => 'bank_transfer',
                    'bank_transfer' => ['type' => 'jp_bank_transfer'],
                ],
            ],
            'success_url' => url('/purchase/success/' . $item->id), // 成功URL
            'cancel_url' => url('/purchase/cancel/' . $item->id),   // キャンセルURL
            'payment_intent_data' => [
                'metadata' => [
                    'user_id' => Auth::id(),
                    'item_id' => $item->id,
                    'payment_id' => 3
                ],
            ],
        ]);
    }

    public function success($item_id)
    {
        return redirect('/mypage');
    }

    public function cancel($item_id)
    {
        // Stripe決済がキャンセルされた場合の処理
        return redirect("/purchase/$item_id");
    }
}
