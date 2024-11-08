@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/admin_admin.css') }}">
@endsection

@section('content')
<div class="admin__content">
    <div class="admin-header">
        <h1 class="admin-heading">
            ユーザー一覧
        </h1>
        <form action="/admin/mail" method="get">
            @csrf
            <button class="mail__form--button" type="submit">メール送信</button>
        </form>
        <form class="logout__form" action="/admin/logout" method="post">
            @csrf
            <button class="logout__button">管理者ログアウト</button>
        </form>
    </div>

    <div class="user-table">
        <table class="user-table__inner">
            <tr class="user-table__row">
                <th class="user-table__header">名前</th>
                <th class="user-table__header">メールアドレス</th>
                <th class="user-table__header"></th>
                <th class="user-table__header"></th>
            </tr>
            @foreach ($users as $user)
            <tr class="user-table__row">
                <td class="user-table__text">
                    <!-- プロフィールの名前が設定されている場合のみ名前を表示 -->
                    {{ isset($user->profile->name) ? $user->profile->name : 'ユーザー名' }}
                </td>
                <td class="user-table__text">
                    {{ $user->email }}
                </td>
                <td class="user-table__text">
                    <form class="delete-form" action="/admin/user/delete" method="post">
                        @csrf
                        <div class="delete-form__item">
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <button class="delete-form__button-submit" type="submit">削除</button>
                        </div>
                    </form>
                </td>
                <td class="user-table__text">
                    <form class="comment-form" action="/admin/comment/{{ $user->id }}" method="get">
                        @csrf
                        <div class="comment-form__button">
                            <button class="comment-form__button-submit" type="submit">コメント</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
