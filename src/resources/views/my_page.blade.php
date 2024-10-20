@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
@endsection

@section('content')
<div class="my-page__content">
    <div class="my-page__inner">
        <div class="my-page__header">
            <div class="my-page__user">
                <div class="my-page__user-image">
                    <img src="{{ asset( Auth::user()->profile->image ) }}">
                </div>
                <span class="my-page__user-name">
                    {{ Auth::user()->profile->name }}
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
            <input type="radio" name="tab_name" id="tab1" checked>
            <label class="tab_class" for="tab1">出品した商品</label>
            <div class="content_class">
                @foreach (Auth::user()->items as $sell_item)
                <div class="item__img">
                    <a href="/item/{{ $sell_item->id }}">
                        <img src="{{ asset( $sell_item->image ) }}">
                    </a>
                </div>
                @endforeach
            </div>

            <input type="radio" name="tab_name" id="tab2">
            <label class="tab_class" for="tab2">購入した商品</label>
            <div class="content_class">
                @foreach (Auth::user()->purchases as $purchase_item)
                <div class="item__img">
                    <a href="/item/{{ $purchase_item->id }}">
                        <img src="{{ asset( $purchase_item->image ) }}">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
