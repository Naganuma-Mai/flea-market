@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
@endsection

@section('content')
<div class="my-page__content">
    <div class="my-page__inner">
        <div class="my-page__header">
            <div class="my-page__user">
                <div class="my-page__user-image--section">
                    <!-- プロフィールの画像が設定されている場合のみ画像を表示 -->
                    <img class="my-page__user-image" src="{{ isset(Auth::user()->profile->image) ? asset(Auth::user()->profile->image) : '' }}">
                </div>
                <span class="my-page__user-name">
                    <!-- プロフィールの名前が設定されている場合のみ名前を表示 -->
                    {{ isset(Auth::user()->profile->name) ? Auth::user()->profile->name : 'ユーザー名' }}
                </span>
            </div>
            <div class="my-page__form">
                <form class="form" action="/mypage/profile" method="get">
                    @csrf
                    <button class="my-page__form__button">プロフィールを編集</button>
                </form>
            </div>
        </div>

        <div class="my-page__main">
            <input class="my-page__tab--input" type="radio" name="tab_name" id="tab_sell" checked>
            <label class="my-page__tab--label" for="tab_sell">出品した商品</label>
            <div class="my-page__tab--content">
                @foreach (Auth::user()->items as $sell_item)
                <div class="my-page__item">
                    <a href="/item/{{ $sell_item->id }}">
                        <img class="my-page__img" src="{{ asset( $sell_item->image ) }}">
                    </a>
                </div>
                @endforeach
            </div>

            <input class="my-page__tab--input" type="radio" name="tab_name" id="tab_purchase">
            <label class="my-page__tab--label" for="tab_purchase">購入した商品</label>
            <div class="my-page__tab--content">
                @foreach (Auth::user()->purchases as $purchase)
                <div class="my-page__item">
                    <a href="/item/{{ $purchase->item->id }}">
                        <img class="my-page__img" src="{{ asset( $purchase->item->image ) }}">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
