@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile__content">
    <h1 class="profile-form__heading">
        プロフィール設定
    </h1>
    <form class="form" action="/mypage/profile" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="profile_id" value="{{ $profile->id ?? '' }}">
        <div class="form__group">
            <div class="form__group-content">
                <div class="form__img--prv">
                    <img id="preview">
                </div>
                <div class="form__input--file">
                    <input type="file" name="image">
                </div>
                <!-- <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div> -->
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">ユーザー名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="name" value="{{ old('name', $profile->name ?? '') }}">
                </div>
                <!-- <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div> -->
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">郵便番号</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="postal_code" value="{{ old('postal_code', $profile->postal_code ?? '') }}">
                </div>
                <!-- <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div> -->
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" value="{{ old('address', $profile->address ?? '') }}">
                </div>
                <!-- <div class="form__error">
                    @error('address')
                    {{ $message }}
                    @enderror
                </div> -->
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" value="{{ old('building', $profile->building ?? '') }}">
                </div>
                <!-- <div class="form__error">
                    @error('building')
                    {{ $message }}
                    @enderror
                </div> -->
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection
