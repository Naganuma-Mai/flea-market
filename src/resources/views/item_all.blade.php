@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/item_all.css') }}">
@endsection

@section('content')
<div class="item-all__content">
    <div class="item-all_inner">
        <input type="radio" name="tab_name" id="tab1" checked>
        <label class="tab_class" for="tab1">おすすめ</label>
        <div class="content_class">
            @foreach ($recommend_items as $recommend_item)
            <div class="item__img">
                <a href="/item/{{ $recommend_item->id }}">
                    <img src="{{ asset( $recommend_item->image ) }}">
                </a>
            </div>
            @endforeach
        </div>

        <input type="radio" name="tab_name" id="tab2">
        <label class="tab_class" for="tab2">マイリスト</label>
        <div class="content_class">
            @foreach ($like_items as $like_item)
            <div class="item__img">
                <a href="/item/{{ $like_item->id }}">
                    <img src="{{ asset( $like_item->image ) }}">
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
