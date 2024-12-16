@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/item_detail.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
@endsection

@section('content')
<div class="item-detail__content">
    <div class="item-detail__inner">
        <div class="item-detail__section">
            <div class="item__img--section">
                <img class="item__img" src="{{ asset($item->image) }}">
            </div>

            <div class="item__content">
                <div class="item__header">
                    <h1 class="item__ttl">{{ $item->name }}</h1>
                    <p class="item__brand">coachtech</p>
                </div>
                <div class="item__price">
                    <p class="item__price--content">¥{{ number_format( $item->price ) }}(値段)</p>
                </div>
                <div class="item__icon">
                    <div class="item__icon--like">
                        <!-- ログイン後 -->
                        @if (Auth::check())
                            <!-- お気に入りにしていない商品 -->
                            @if (!Auth::user()->isLike($item->id))
                                <a class="toggle_like" item_id="{{ $item->id }}" like_val="0">
                                    <img src="{{ asset('images/star_gray.png') }}" class="item__icon--img" alt="">
                                </a>
                            <!-- 既にお気に入りにしている商品 -->
                            @else
                                <a class="toggle_like" item_id="{{ $item->id }}" like_val="1">
                                    <img src="{{ asset('images/star_red.png') }}" class="item__icon--img" alt="">
                                </a>
                            @endif
                        <!-- ログイン前 -->
                        @else
                            <a class="likes">
                                <img src="{{ asset('images/star_gray.png') }}" class="item__icon--img" alt="">
                            </a>
                        @endif
                        <p class="item__likes--count">{{ $item->likes->count() }}</p>
                    </div>
                    <div class="item__icon--comment">
                        <form class="item-comment__form" action="/comment/{{ $item->id }}" method="get">
                            @csrf
                            <button class="item-comment__button">
                                <img src="{{ asset('images/comment.png') }}" class="item__icon--img" alt="">
                            </button>
                        </form>
                        <p class="item__comments--count">{{ $item->comments->count() }}</p>
                    </div>
                </div>
                <form class="item-purchase__form" action="/purchase/{{ $item->id }}" method="get">
                    @csrf
                    <button class="item-purchase__button">購入する</button>
                </form>
                <div class="item__explanation">
                    <h2 class="item__explanation--header">商品説明</h2>
                    <p class="item__explanation--content">{{ $item->explanation }}</p>
                </div>
                <div class="item__information">
                    <h2 class="item__information--header">商品の情報</h2>
                    <div class="item__category">
                        <h3 class="item__category--header">カテゴリー</h3>
                        <div class="item__category--content">
                            @foreach ($item->categories as $category)
                                <p class="item__category--item">{{ $category->name }}</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="item__condition">
                        <h3 class="item__condition--header">商品の状態</h3>
                        <p class="item__condition--content">{{ $item->condition }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/like.js') }}"></script>
@endsection
