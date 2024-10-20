@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="sell__content">
    <h1 class="sell-form__heading">
        商品の出品
    </h1>
    <form class="form" action="/sell" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form__group">
            <div class="form__group-item">
                <div class="form__group-title">
                    <span class="form__label--item">商品画像</span>
                </div>
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
        </div>

        <div class="form__group">
            <h2 class="form__group-heading">商品の詳細</h2>
            <div class="form__group-item">
                <div class="form__group-title">
                    <span class="form__label--item">カテゴリー</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="name" value="{{ old('name') }}">
                    </div>
                    <!-- <div class="form__error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div> -->
                </div>
            </div>
            <div class="form__group-item">
                <div class="form__group-title">
                    <span class="form__label--item">商品の状態</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="condition" value="{{ old('condition') }}">
                    </div>
                    <!-- <div class="form__error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div> -->
                </div>
            </div>
        </div>

        <div class="form__group">
            <h2 class="form__group-heading">商品名と説明</h2>
            <div class="form__group-item">
                <div class="form__group-title">
                    <span class="form__label--item">商品名</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="name" value="{{ old('name') }}">
                    </div>
                    <!-- <div class="form__error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div> -->
                </div>
            </div>
            <div class="form__group-item">
                <div class="form__group-title">
                    <span class="form__label--item">商品の説明</span>
                </div>
                <div class="form__group-content">
                    <div class="form__textarea">
                        <textarea name="explanation">
                            {{ old('explanation') }}
                        </textarea>
                    </div>
                    <!-- <div class="form__error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div> -->
                </div>
            </div>
        </div>

        <div class="form__group">
            <h2 class="form__group-heading">販売価格</h2>
            <div class="form__group-item">
                <div class="form__group-title">
                    <span class="form__label--item">販売価格</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="price" value="¥{{ old('price') }}">
                    </div>
                    <!-- <div class="form__error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div> -->
                </div>
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">出品する</button>
        </div>
    </form>
</div>
@endsection
