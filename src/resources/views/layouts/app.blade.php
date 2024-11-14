<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtechフリマ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('head')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <div class="header__logo">
                    <img src="{{ asset('images/logo.svg') }}" class="header__logo--img" alt="">
                </div>
                <div class="search-form">
                    <form class="search-form__inner" action="/items/search" method="get">
                        @csrf
                        <div class="search-form__item">
                            <input class="search-form__item-input" type="text" name="keyword" placeholder="なにをお探しですか？" value="{{request('keyword')}}">
                        </div>
                    </form>
                </div>
                <nav class="header-nav">
                    <ul id="menu" class="header-nav__list">
                        <!-- 管理者ログイン後のナビゲーション -->
                        @if (Auth::guard('admin')->check())
                            <li class="header-nav__item">
                                <form class="header-nav__form" action="/admin/logout" method="post">
                                    @csrf
                                    <button class="header-nav__button">管理者ログアウト</button>
                                </form>
                            </li>
                            <li class="header-nav__item">
                                <form class="header-nav__form" action="/admin/admin" method="get">
                                    @csrf
                                    <button class="header-nav__button" type="submit">管理画面</button>
                                </form>
                            </li>
                            <li class="header-nav__item">
                                <form class="header-nav__form" action="/admin/mail" method="get">
                                    @csrf
                                    <button class="header-nav__button--frame" type="submit">メール送信</button>
                                </form>
                            </li>

                        <!-- ユーザーとしてログイン後のナビゲーション -->
                        @elseif (Auth::check())
                            <li class="header-nav__item">
                                <form class="header-nav__form" action="/logout" method="post">
                                    @csrf
                                    <button class="header-nav__button">ログアウト</button>
                                </form>
                            </li>
                            <li class="header-nav__item">
                                <form class="header-nav__form" action="/mypage" method="get">
                                    @csrf
                                    <button class="header-nav__button">マイページ</button>
                                </form>
                            </li>
                            <li class="header-nav__item">
                                <form class="header-nav__form" action="/sell" method="get">
                                    @csrf
                                    <button class="header-nav__button--frame">出品</button>
                                </form>
                            </li>

                        <!-- ログイン前のナビゲーション -->
                        @else
                            <li class="header-nav__item">
                                <form class="header-nav__form" action="/login" method="get">
                                    @csrf
                                    <button class="header-nav__button">ログイン</button>
                                </form>
                            </li>
                            <li class="header-nav__item">
                                <form class="header-nav__form" action="/register" method="get">
                                    @csrf
                                    <button class="header-nav__button">会員登録</button>
                                </form>
                            </li>
                            <li class="header-nav__item">
                                <form class="header-nav__form" action="/sell" method="get">
                                    @csrf
                                    <button class="header-nav__button--frame">出品</button>
                                </form>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>
