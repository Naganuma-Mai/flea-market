@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/user_comment.css') }}">
@endsection

@section('content')
<div class="user-comment__content">
    <div class="user-comment__header">
        <h1 class="user-comment__heading">
            <!-- プロフィールの名前が設定されている場合のみ名前を表示 -->
            {{ isset($user->profile->name) ? $user->profile->name : 'ユーザー名' }}<br class="sp_br">コメント一覧
        </h1>
    </div>

    <div class="comment-content">
        <div class="comment-content__row">
            <p class="comment-content__header">商品名</p>
            <p class="comment-content__header--comment">コメント内容</p>
        </div>
        @foreach ($user->comments as $comment)
        <div class="comment-content__row">
            <p class="comment-content__text">{{ $comment->item->name }}</p>
            <p class="comment-content__text--comment">{{ $comment->content }}</p>
            <div class="comment-content__form">
                <form class="delete-form" action="/admin/comments/delete/{{ $comment->id }}" method="post">
                    @csrf
                    <div class="delete-form__item">
                        <button class="delete-form__button-submit" type="submit">削除</button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
