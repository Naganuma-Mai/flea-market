@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/comment.css') }}">
@endsection

@section('content')
<div class="comment__content">
    <div class="comment__inner">
        <div class="comment__section">
            <div class="item__img">
                <img src="{{ asset( $item->image ) }}">
            </div>

            <div class="item-comment__content">
                <div class="item__header">
                    <h1 class="item__ttl">
                        {{ $item->name }}
                    </h1>
                    <p>coachtech</p>
                </div>
                <div class="item__price">
                    <p class="item__price--content">
                        ¥{{ number_format( $item->price ) }}(値段)
                    </p>
                </div>
                <div class="item__icon">
                    <img src="{{ asset('images/star.png') }}" class="item__icon--img" alt="">
                    <img src="{{ asset('images/comment.png') }}" class="item__icon--img" alt="">
                    <p class="item__comment--count">{{ count($comments) }}</p>
                </div>

                <div class="comment__group">
                    @foreach ($comments as $comment)
                    <div class="comment__group-item">
                        <div class="comment__user">
                            <div class="comment__user-image">
                                <img src="{{ asset( $comment->user->profile->image ) }}">
                            </div>
                            <span class="comment__user-name">
                                {{ $comment->user->profile->name }}
                            </span>
                        </div>
                        <div class="comment__content">
                            {{ $comment->content }}
                        </div>
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
                            <!-- <div class="form__error">
                                @error('email')
                                {{ $message }}
                                @enderror
                            </div> -->
                        </div>
                        <button class="form__button-submit" type="submit">コメントを送信する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
