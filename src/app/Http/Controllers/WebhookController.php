<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Purchase;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use UnexpectedValueException;

class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Webhookのシークレットキー
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        // リクエストからペイロードを取得（デコードしない）
        $payload = $request->getContent();

        // Stripe-Signature ヘッダーを取得
        $sig_header = $request->header('Stripe-Signature');

        try {
            // Stripe Webhook署名の検証
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (UnexpectedValueException $e) {
            // ペイロードが無効な場合
            Log::error('Invalid payload', ['error' => $e->getMessage(), 'payload' => $payload]);
            return response('Invalid payload', 400);
        } catch (SignatureVerificationException $e) {
            // 署名の検証に失敗した場合
            Log::error('Invalid signature', ['error' => $e->getMessage(), 'signature' => $sig_header, 'payload' => $payload]);
            return response('Invalid signature', 400);
        }

        // イベントタイプごとに処理
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $this->handlePaymentIntentSucceeded($event->data->object);
                break;

            case 'payment_intent.payment_failed':
                $this->handlePaymentIntentFailed($event->data->object);
                break;

            default:
                Log::info('Unhandled event type: ' . $event->type);
        }

        return response('Webhook handled', 200);
    }

    private function handlePaymentIntentSucceeded($payment_intent)
    {
        Log::info('PaymentIntent succeeded: ', ['id' => $payment_intent->id]);

        // 必要なデータを取得
        $metadata = $payment_intent->metadata;

        $purchase = [
            'user_id' => $metadata->user_id,
            'item_id' => $metadata->item_id,
            'payment_id' => $metadata->payment_id,
        ];

        Purchase::create($purchase);

        Log::info('Purchase saved successfully', $purchase);
    }

    private function handlePaymentIntentFailed($payment_intent)
    {
        Log::info('PaymentIntent failed: ', ['id' => $payment_intent->id]);
    }
}
