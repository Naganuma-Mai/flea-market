@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/item_all.css') }}">
@endsection

@section('content')
<div class="item-all__content">
    <div class="item-all__inner">
        <input class="item-all__tab--input" type="radio" name="tab_name" id="tab_recommend" checked>
        <label class="item-all__tab--label" for="tab_recommend">おすすめ</label>
        <div class="item-all__tab--content">
            @foreach ($recommend_items as $recommend_item)
            <div class="item-all__item">
                <a href="/item/{{ $recommend_item->id }}">
                    <img class="item-all__img" src="{{ asset( $recommend_item->image ) }}">
                </a>
            </div>
            @endforeach
        </div>

        <!-- ログイン後 -->
        @if (Auth::check())
        <input class="item-all__tab--input" type="radio" name="tab_name" id="tab_like">
        <label class="item-all__tab--label" for="tab_like">マイリスト</label>
        <div class="item-all__tab--content">
            @foreach ($like_items as $like_item)
            <div class="item-all__item">
                <a href="/item/{{ $like_item->id }}">
                    <img class="item-all__img" src="{{ asset( $like_item->image ) }}">
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
