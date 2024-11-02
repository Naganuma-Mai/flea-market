$(function () {
    //「toggle_like」というクラスを持つタグがクリックされたときに以下の処理が走る
    $('.toggle_like').on('click', function ()
    {
        //表示しているプロダクトのIDと状態、押下し他ボタンの情報を取得
        var item_id = $(this).attr("item_id");
        var like_val = $(this).attr("like_val");
        click_button = $(this);
        var button = $(this);

        // 既にお気に入りにしている商品→お気に入りから削除
        if(like_val == '1'){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                url: '/unlike',
                type: 'POST',
                data: { //サーバーに送信するデータ
                    'item_id': item_id //お気に入りにした商品のidを送る
                },
            })
            //通信成功した時の処理
            .done(function (data, status, xhr) {
                button.attr('like_val', '0');
                button.children().attr('src', 'images/star_gray.png');
                // ページをリロードする
                location.reload(true);
            })
            //通信失敗した時の処理
            .fail(function (xhr, status, error) {
                console.log('fail');
            });

        // お気に入りにしていない商品→お気に入りに追加
        } else {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                url: '/like',
                type: 'POST',
                data: { //サーバーに送信するデータ
                    'item_id': item_id //お気に入りにした商品のidを送る
                },
            })
            //通信成功した時の処理
            .done(function (data, status, xhr) {
                button.attr('like_val', '1');
                button.children().attr('src', 'images/star_red.png');
                // ページをリロードする
                location.reload(true);
            })
            //通信失敗した時の処理
            .fail(function (xhr, status, error) {
                console.log('fail');
            });
        }
    });
});