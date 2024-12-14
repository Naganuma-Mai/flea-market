@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/mail_send.css') }}">
@endsection

@section('content')
<div class="mail__content">
    <h1 class="mail-form__heading">メール送信</h1>
    <form class="form" action="/admin/mail" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">件名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="subject">
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">本文</span>
            </div>
            <div class="form__group-content">
                <div class="form__textarea">
                    <textarea name="content"></textarea>
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">送信する</button>
        </div>
    </form>
</div>
@endsection
