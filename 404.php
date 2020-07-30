<!-- ▼ ヘッダー : 開始-->
<?php get_header('subpage'); ?>
<!-- ▲ ヘッダー : 終了-->

<main>
    <div class="container not_found_wrap">

        <h2 class="c-post__title not_found_title">
            404 Not found.
        </h2>
        <p class="not_found_content">
            大変申し訳ございません。<br>
            お探しのページは削除されたか、URLが間違っている可能性があります。<br>
            URLをご確認いただき、トップページまたは上部ナビゲーションメニューからお探しのページへアクセスしてください。
        </p>
        <p class="not_found_backbutton">
            <a href="<?php echo home_url('/'); ?>">トップページへ戻る</a>
        </p>

    </div>
</main>

<!-- ▲ フッター : 開始-->
<?php get_footer(); ?>
<!-- ▲ フッター : 終了-->
