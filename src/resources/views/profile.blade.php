@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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
            <div class="form__group-content--img">
                <!-- アイコン画像プレビュー表示 -->
                <div class="form__img">
                    <img id="preview" class="form__img--prv" src="{{ isset($profile) && $profile->image ? asset($profile->image) : '' }}">
                </div>
                <!-- アイコン画像 -->
                <div class="form__input">
                    <label class="form__input--label">
                        画像を選択する
                        <input id="icon" class="form__input--file" type="file" name="image" accept="image/*">
                    </label>
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

<script>
    // アイコン画像プレビュー処理
    // 画像が選択される度に、この中の処理が走る
    $('#icon').on('change', function (ev) {
        // このFileReaderが画像を読み込む上で大切
        const reader = new FileReader();
        // ファイル名を取得
        const fileName = ev.target.files[0].name;
        // 画像が読み込まれた時の動作を記述
        reader.onload = function (ev) {
            $('#preview').attr('src', ev.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    })
</script>
@endsection
