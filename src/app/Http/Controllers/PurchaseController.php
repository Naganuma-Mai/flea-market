<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Payment;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;

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

        // クレジットカード払いの場合
        if ($request->payment_id == 1) {
            // Stripeの決済セッションを作成
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => [
                            'name' => $item->name,
                        ],
                        'unit_amount' => $item->price,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => url('/purchase/success/' . $item_id), // 成功URL
                'cancel_url' => url('/purchase/cancel/' . $item_id),   // キャンセルURL
            ]);

            // Stripe決済ページへリダイレクト
            return redirect($session->url);

        // コンビニ払いの処理
        } elseif ($request->payment_id == 2) {
            // コンビニ決済用のStripeセッションを作成
            $session = Session::create([
                'payment_method_types' => ['konbini'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => [
                            'name' => $item->name,
                        ],
                        'unit_amount' => $item->price,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'payment_method_options' => [
                    'konbini' => [
                        'expires_after_days' => 3, // 支払い有効期限（3日間など）
                    ]
                ],
                'success_url' => url('/purchase/success/' . $item_id), // 成功URL
                'cancel_url' => url('/purchase/cancel/' . $item_id),   // キャンセルURL
            ]);

            // Stripe決済ページへリダイレクト
            return redirect($session->url);
        }

        // それ以外の支払い方法の場合、直接購入を保存
        $purchase = [
            'user_id' => Auth::id(),
            'item_id' => $item_id,
            'payment_id' => $request->payment_id,
        ];
        Purchase::create($purchase);

        return redirect('/mypage');
    }

    public function success($item_id)
    {
        // Stripe決済が成功した場合に購入情報を保存
        $purchase = [
            'user_id' => Auth::id(),
            'item_id' => $item_id,
            'payment_id' => 1,
        ];
        Purchase::create($purchase);

        return redirect('/mypage');
    }

    public function cancel($item_id)
    {
        // Stripe決済がキャンセルされた場合の処理
        return redirect("/purchase/$item_id");
    }
}
