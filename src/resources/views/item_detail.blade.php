@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/item_detail.css') }}">
@endsection

@section('content')
<div class="item-detail__content">
    <div class="item-detail__inner">
        <div class="item-detail__section">
            <div class="item__img">
                <img src="{{ asset($item->image) }}">
            </div>

            <div class="item__content">
                <div class="item__header">
                    <h1 class="item__ttl">
                        {{ $item->name }}
                    </h1>
                    <p>
                        ブランド名？？
                    </p>
                </div>
                <div class="item__price">
                    <p class="item__price--content">
                        ¥{{ number_format( $item->price ) }}(値段)
                    </p>
                </div>
                <div class="item__icon">
                    <img src="{{ asset('images/star.png') }}" class="item__icon--img" alt="">
                    <img src="{{ asset('images/comment.png') }}" class="item__icon--img" alt="">
                </div>
                <form class="item-purchase__form" action="/purchase/{{ $item->id }}" method="get">
                    @csrf
                    <button class="item-purchase__button">購入する</button>
                </form>
                <div class="item__explanation">
                    <h2 class="item__explanation--header">
                        商品説明
                    </h2>
                    <p class="item__explanation--content">
                        {{ $item->explanation }}
                    </p>
                </div>
                <div class="item__information">
                    <h2 class="item__information--header">
                        商品の情報
                    </h2>
                    <div class="item__category">
                        <h3 class="item__category--header">
                            カテゴリー
                        </h3>
                        @foreach ($item_categories as $category)
                        <p class="item__category--content">
                            {{ $category->name }}
                        </p>
                        @endforeach
                    </div>
                    <div class="item__condition">
                        <h3 class="item__condition--header">
                            商品の状態
                        </h3>
                        <p class="item__condition--content">
                            {{ $item->condition }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
