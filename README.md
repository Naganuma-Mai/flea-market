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
> Stripe決済が完了した際にWebhookで通知され、購入データがデータベースに保存されます。<br>Stripeでの決済完了の仕方は以下になります。<br>コンビニ払い：3分経過すると決済完了となります。<br>銀行振込：Stripeのダッシュボードで購入する顧客のページに行き、「支払い方法>JPYの現金残高」から資金を追加することで決済完了となります。
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

<img width="656" alt="table1" src="https://github.com/user-attachments/assets/3ec90a10-e1f5-4149-8b6b-d69005226a67">
<img width="658" alt="table2" src="https://github.com/user-attachments/assets/e1483561-f755-4cac-a8cc-5af69e2f7073">
<img width="658" alt="table3" src="https://github.com/user-attachments/assets/6e5bac07-ffdf-44ce-88a0-9b371898029c">

## ER図

<img width="620" alt="er" src="https://github.com/user-attachments/assets/dc4c22a8-2a1b-4cb6-9d82-efa2d5d2f2ec">

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

**PHPUnit環境構築**

1. テスト用データベースの準備

- `docker-compose exec mysql bash`
- `mysql -u root -p`
> パスワードはrootと入力してください。
- `CREATE DATABASE demo_test;`
- `SHOW DATABASES;`
> SHOW DATABASES;入力後、demo_testが作成されていれば成功です。

2. 「.env」ファイルをコピーして 「.env.testing」ファイルを作成

- `docker-compose exec php bash`
- `cp .env .env.testing`

3. .env.testingの編集

```text
APP_ENV=test
APP_KEY=
```

```text
DB_DATABASE=demo_test
DB_USERNAME=root
DB_PASSWORD=root
```

4. APP_KEYに新たなテスト用のアプリケーションキーを追加

- `php artisan key:generate --env=testing`
- `php artisan config:clear`

5. テスト用のテーブルを作成

`php artisan migrate --env=testing`

6. テストの実行

- `php artisan config:clear`
- `vendor/bin/phpunit tests/Feature/CommentTest.php`

**ngrokのセットアップとStripe Webhookの設定**

1. ngrokのインストール

```bash
brew install ngrok/ngrok/ngrok
```

> macOSでHomebrewがインストールされている場合、上記コマンドでngrokをインストールできます。<br>他のOSの場合は、ngrok公式サイトからダウンロードしてインストールしてください。

2. ngrokのセットアップ
- 公式サイトから無料アカウントを作成し、ログインします。
- ダッシュボードから「Authtoken」をコピーします。
- 次に、ターミナルを開いて以下のコマンドでngrokにAuthtokenを設定します。<br>（「YOUR_AUTH_TOKEN」はコピーしたAuthtokenに置き換えてください。）

```bash
ngrok config add-authtoken YOUR_AUTH_TOKEN
```

3. ngrokの起動

```bash
ngrok http 80
```

> これにより、ngrokがhttp\://localhost:80に対して一時的な公開URLを作成します。<br>出力されたForwardingの→の左側部分が、外部からアクセス可能なURLです。<br>例：`https://1a44-240b-13-2140-a200-cdb5-5969-eee3-cd99.ngrok-free.app`

4. StripeダッシュボードでWebhookエンドポイントを設定
- Stripeダッシュボードにログインします。
- 左側のメニューから「開発者」→「Webhooks」を選択します。
- 「イベントの送信先」の「送信先を追加する」をクリックします。
- イベントとして、「payment_intent.succeeded」・「payment_intent.payment_failed」を選択し、「続行」をクリックします。
- 送信先のタイプとして、「Webhookエンドポイント」を選択し、「続行」をクリックします。
- エンドポイントURLとして、ngrokで生成されたURLに「/webhook」を追加したものを入力し、「送信先を作成する」をクリックします。<br>例: `https://1a44-240b-13-2140-a200-cdb5-5969-eee3-cd99.ngrok-free.app/webhook`

5. StripeのWebhookシークレットキーの設定
> .envファイルに以下のように追加してください。
```text
STRIPE_WEBHOOK_SECRET=****
```