@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/user_comment.css') }}">
@endsection

@section('content')
<div class="user-comment__content">
    <div class="user-comment__header">
        <h1 class="user-comment__heading">
            <!-- プロフィールの名前が設定されている場合のみ名前を表示 -->
            {{ isset($user->profile->name) ? $user->profile->name : 'ユーザー名' }}コメント一覧
        </h1>
        <div class="back-form">
            <form action="/admin/admin" method="get">
                @csrf
                <button class="back-form__button" type="submit">戻る</button>
            </form>
        </div>
    </div>

    <div class="comment-table">
        <table class="comment-table__inner">
            <tr class="comment-table__row">
                <th class="comment-table__header">商品名</th>
                <th class="comment-table__header">コメント内容</th>
                <th class="comment-table__header"></th>
            </tr>
            @foreach ($user->comments as $comment)
            <tr class="comment-table__row">
                <td class="comment-table__text">
                    {{ $comment->item->name }}
                </td>
                <td class="comment-table__text">
                    {{ $comment->content }}
                </td>
                <td class="comment-table__text">
                    <form class="delete-form" action="/admin/comments/delete/{{ $comment->id }}" method="post">
                        @csrf
                        <div class="delete-form__item">
                            <button class="delete-form__button-submit" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
