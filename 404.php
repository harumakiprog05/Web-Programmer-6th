<!-- ▼ ヘッダー : 開始-->
<?php get_header('subpage'); ?>
<!-- ▲ ヘッダー : 終了-->

<main>
    <div class="container">

        <h2 class="c-post__title">
            404 Not found.
        </h2>
        <p>
            大変申し訳ございません。<br>
            お探しのページは削除されたか、URLが間違っている可能性があります。<br>
            URLをご確認いただき、トップページまたは上部ナビゲーションメニューからお探しのページへアクセスしてください。
        </p>
        <p>
            <a href="<?php echo home_url('/'); ?>">トップページへ戻る</a>
        </p>

    </div>
</main>

<!-- ▲ フッター : 開始-->
<?php get_footer(); ?>
<!-- ▲ フッター : 終了-->
