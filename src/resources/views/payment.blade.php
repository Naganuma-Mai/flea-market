@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection

@section('content')
<div class="payment__content">
    <h1 class="payment-form__heading">
        支払い方法の変更
    </h1>
    <form class="form" action="/purchase/payment/{{ $item->id }}" method="post">
        @csrf
        <select class="form__item--select" name="payment_id">
            @foreach ($payments as $select_payment)
                <option value="{{ $select_payment->id }}" @if( $payment->id==$select_payment->id ) selected @endif>
                    {{ $select_payment->name }}
                </option>
            @endforeach
        </select>
        <div class="form__button">
            <button class="form__button-submit" type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection
