@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/admin_admin.css') }}">
@endsection

@section('content')
<div class="admin__content">
    <div class="admin-header">
        <h1 class="admin-heading">ユーザー一覧</h1>
    </div>

    <div class="user-content">
        <div class="user-content__row">
            <p class="user-content__header">名前</p>
            <!-- <p class="user-content__header--mail">メールアドレス</p> -->
        </div>
        @foreach ($users as $user)
        <div class="user-content__row">
            <p class="user-content__text">
                <!-- プロフィールの名前が設定されている場合のみ名前を表示 -->
                {{ isset($user->profile->name) ? $user->profile->name : 'ユーザー名' }}
            </p>
            <!-- <p class="user-content__text--mail">
                {{ $user->email }}
            </p> -->
            <div class="user-content__form">
                <form class="delete-form" action="/admin/user/delete" method="post">
                    @csrf
                    <div class="delete-form__item">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button class="delete-form__button-submit" type="submit">削除</button>
                    </div>
                </form>
                <form class="comment-form" action="/admin/comment/{{ $user->id }}" method="get">
                    @csrf
                    <div class="comment-form__button">
                        <button class="comment-form__button-submit" type="submit">コメント</button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
