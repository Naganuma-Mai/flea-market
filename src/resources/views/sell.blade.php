@extends('layouts.app')

@section('head')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="sell__content">
    <h1 class="sell-form__heading">商品の出品</h1>
    <form class="form" action="/sell" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form__group--img">
            <div class="form__group-item">
                <div class="form__group-title">
                    <span class="form__label--item">商品画像</span>
                </div>
                <div class="form__group-content--img">
                    <!-- 商品画像プレビュー表示 -->
                    <div class="form__img">
                        <img id="preview" class="form__img--prv">
                    </div>
                    <!-- 商品画像 -->
                    <div class="form__input">
                        <label class="form__input--label">
                            画像を選択する
                            <input id="image" class="form__input--file" type="file" name="image" accept="image/*">
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form__group">
            <h2 class="form__group-heading">商品の詳細</h2>
            <div class="form__group-item--category">
                <div class="form__group-title">
                    <span class="form__label--item">カテゴリー</span>
                </div>
                <div class="form__group-content--category">
                    <select name="categories[]" multiple="multiple">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
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
                </div>
            </div>
            <div class="form__group-item">
                <div class="form__group-title">
                    <span class="form__label--item">商品の説明</span>
                </div>
                <div class="form__group-content">
                    <div class="form__textarea">
                        <textarea name="explanation">{{ old('explanation') }}</textarea>
                    </div>
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
                        <input id="price" type="text" name="price" value="{{ old('price') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">出品する</button>
        </div>
    </form>
</div>

<script>
    $('#image').on('change', function (ev) {
        const reader = new FileReader();
        const preview = $('#preview');
        const imageContainer = $('.form__img');

        // 画像が読み込まれた時の処理
        reader.onload = function (ev) {
            preview.attr('src', ev.target.result);
            imageContainer.show(); // 画像が選択されたら表示
        };

        // ファイルが選択されている場合のみ読み込み
        if (this.files && this.files[0]) {
            reader.readAsDataURL(this.files[0]);
        } else {
            preview.attr('src', ''); // 画像がリセットされた場合は非表示
            imageContainer.hide();  // プレビュー部分を非表示
        }
    });

    $(function () {
        $('select').multipleSelect({
            width: 200,
            selectAll: false, // 「すべて」を非表示にする
        });
    });

    // 価格入力フォームの自動フォーマット
    $('#price').on('input', function () {
        let value = $(this).val().replace(/[^\d]/g, ''); // 数字以外を削除
        if (value.length > 0) {
            $(this).val(`¥${Number(value).toLocaleString()}`);
        } else {
            $(this).val('¥'); // 入力が空の場合は¥のみ表示
        }
    });

    // ページ読み込み時に¥を表示
    $(document).ready(function() {
        let initialValue = $('#price').val();
        if (!initialValue) {
            $('#price').val('¥');
        }
    });

    // フォーム送信時に「¥」を除去
    $('form').on('submit', function() {
        let priceInput = $('#price');
        let rawValue = priceInput.val().replace(/[^0-9]/g, ''); // 数字のみ取得
        priceInput.val(rawValue); // 「¥」を取り除いた値をセット
    });
</script>
@endsection
