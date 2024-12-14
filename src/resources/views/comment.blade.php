@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/comment.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
@endsection

@section('content')
<div class="comment__content">
    <div class="comment__inner">
        <div class="comment__section">
            <div class="item__img--section">
                <img class="item__img" src="{{ asset( $item->image ) }}">
            </div>

            <div class="item-comment__content">
                <div class="item__header">
                    <h1 class="item__ttl">
                        {{ $item->name }}
                    </h1>
                    <p class="item__brand">coachtech</p>
                </div>
                <div class="item__price">
                    <p class="item__price--content">
                        ¥{{ number_format( $item->price ) }}(値段)
                    </p>
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
                        <img src="{{ asset('images/comment.png') }}" class="item__icon--img" alt="">
                        <p class="item__comments--count">{{ $item->comments->count() }}</p>
                    </div>
                </div>

                <div class="comment__group">
                    @foreach ($item->comments as $comment)
                    <div class="comment__group-item">
                        <div class="comment__user">
                            <div class="comment__user-image">
                                <img class="comment__user-image" src="{{ asset( $comment->user->profile->image ) }}">
                            </div>
                            <span class="comment__user-name">
                                {{ $comment->user->profile->name }}
                            </span>
                        </div>
                        <div class="comment__text">{{ $comment->content }}</div>
                    </div>
                    @endforeach
                </div>

                <div class="comment__form">
                    <form class="form" action="/comment/{{ $item->id }}" method="post">
                        @csrf
                        <div class="form__title">
                            <span class="form__label">商品へのコメント</span>
                        </div>
                        <div class="form__content">
                            <div class="form__textarea">
                                <textarea name="content">{{ old('content') }}</textarea>
                            </div>
                        </div>
                        <button class="form__button-submit" type="submit">コメントを送信する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/like.js') }}"></script>
@endsection
