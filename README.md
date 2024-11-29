# coachtechフリマ

coachtechフリマはある企業が開発した独自のフリマアプリです

<img width="1424" alt="item_all" src="https://github.com/user-attachments/assets/b3e20ae6-2273-4f43-a29e-d0dcad436e86">

## 作成した目的

coachtechブランドのアイテムを出品する

## アプリケーションURL

- 開発環境：http://localhost/
- phpMyAdmin：http://localhost:8080/
- MailHog：http://localhost:8025/

## 他のリポジトリ

なし

## 機能一覧

- 会員登録機能
- ログイン機能
- ログアウト機能
- 商品一覧取得機能
- 商品詳細取得機能
- 商品お気に入り一覧取得機能
- ユーザー情報取得機能
- ユーザー購入商品一覧取得機能
- ユーザー出品商品一覧取得機能
- プロフィール変更機能
- 商品お気に入り追加機能
- 商品お気に入り削除機能
- 商品コメント追加機能
- 商品コメント削除機能
- 出品機能
- 配送先変更機能
- 商品購入機能
- 支払い方法変更機能
- 管理者登録機能
- 管理者ログイン機能
- 管理者ログアウト機能
- ユーザー一覧取得機能
- ユーザー削除機能
- ユーザーコメント取得機能
- ユーザーコメント削除機能
- 管理者メール送信機能

## 使用技術(実行環境)

- PHP8.3.2
- Laravel8.83.8
- MySQL8.0.26

## テーブル設計

<img width="491" alt="table1" src="https://github.com/user-attachments/assets/cc1b8171-53b7-4e2f-b182-c5a84faa6132">
<img width="492" alt="table2" src="https://github.com/user-attachments/assets/1100cb5f-8d8f-430d-a18a-504e059751b1">

## ER図

<img width="620" alt="er" src="https://github.com/user-attachments/assets/f0e70b62-29d4-474b-916b-6af0c992f893">

## 環境構築

**Dockerビルド**

1. `git clone git@github.com:Naganuma-Mai/flea-market.git`
2. DockerDesktop アプリを立ち上げる
3. `docker-compose up -d --build`

> MySQL等は、OSによって起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。

**Laravel環境構築**

1. `docker-compose exec php bash`
2. `composer install`
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
4. .envに以下の環境変数を追加

```text
APP_NAME=coachtechフリマ
```

```text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

```text
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=test
MAIL_PASSWORD=pass
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=test@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

> 以下のSTRIPE_KEY・STRIPE_SECRETはご自身のものを入力してください。

```text
STRIPE_KEY=****
STRIPE_SECRET=****
```

5. アプリケーションキーの作成

```bash
php artisan key:generate
```

6. マイグレーションの実行

```bash
php artisan migrate
```

7. シーディングの実行

```bash
php artisan db:seed
```

8. シンボリックリンクの作成

```bash
php artisan storage:link
```
