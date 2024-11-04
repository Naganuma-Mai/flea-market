@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase__content">
    <div class="purchase__inner">
        <div class="purchase__section">
            <div class="purchase__information">
                <div class="item__img">
                    <img src="{{ asset( $item->image ) }}">
                </div>
                <div class="item__header">
                    <h1 class="item__ttl">
                        {{ $item->name }}
                    </h1>
                </div>
                <div class="item__price">
                    <p class="item__price--content">
                        ¥{{ number_format( $item->price ) }}
                    </p>
                </div>
                <div class="purchase-payment__form">
                    <h2 class="purchase-form__ttl">支払い方法</h2>
                    <form class="form" action="/purchase/payment/{{ $item->id }}" method="get">
                        @csrf
                        <div class="form__item">
                            <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                            <button class="form__item-button" type="submit">変更する</button>
                        </div>
                    </form>
                </div>
                <div class="purchase-address__form">
                    <h2 class="purchase-form__ttl">配送先</h2>
                    <form class="form" action="/purchase/address/{{ $item->id }}" method="get">
                        @csrf
                        <div class="form__item">
                            <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                            <button class="form__item-button" type="submit">変更する</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="purchase__form">
                <form class="form" action="/purchase/{{ $item->id }}" method="post">
                    @csrf
                    <div class="purchase-table">
                        <table class="purchase-table__inner">
                            <tr class="purchase-table__row">
                                <th class="purchase-table__header">商品代金</th>
                                <td class="purchase-table__text">
                                    ¥{{ number_format( $item->price ) }}
                                </td>
                            </tr>
                            <tr class="purchase-table__row">
                                <th class="purchase-table__header">支払い金額</th>
                                <td class="purchase-table__text">
                                    ¥{{ number_format( $item->price ) }}
                                </td>
                            </tr>
                            <tr class="purchase-table__row">
                                <th class="purchase-table__header">支払い方法</th>
                                <td class="purchase-table__text">
                                    <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                                    {{ $payment->name }}払い
                                </td>
                            </tr>
                        </table>
                    </div>
                    <button class="form__button-submit" type="submit">購入する</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
