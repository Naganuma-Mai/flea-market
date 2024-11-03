@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/item_search.css') }}">
@endsection

@section('content')
<div class="item-search__content">
    <div class="item-search__inner">
        @foreach ($items as $item)
        <div class="item__img">
            <a href="/item/{{ $item->id }}">
                <img src="{{ asset( $item->image ) }}">
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
