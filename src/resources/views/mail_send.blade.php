@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/mail_send.css') }}">
@endsection

@section('content')
<div class="mail__content">
    <div class="mail__inner">
        <div class="mail__form">
            <h2 class="mail__ttl">メール送信</h2>
            <form class="form" action="/admin/mail" method="post">
                @csrf
                <div class="mail__form-content">
                    <div class="mail-table">
                        <table class="mail-table__inner">
                            <tr class="mail-table__row">
                                <th class="mail-table__header">件名</th>
                                <td class="mail-table__text">
                                    <input class="form__item--input" type="text" name="subject">
                                </td>
                            </tr>
                            <tr class="mail-table__row">
                                <th class="mail-table__header">本文</th>
                                <td class="mail-table__text">
                                    <textarea class="form__item--textarea" name="content"></textarea>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <button class="form__button-submit" type="submit">送信する</button>
            </form>
        </div>
    <div>
</div>
@endsection
