<!-- ▼ ヘッダー : 開始-->
<?php get_header('subpage'); ?>
<!-- ▲ ヘッダー : 終了-->

<!-- ▼ コンテンツ : 開始-->
<main>
    <section <?php post_class(); ?>>
        <div class="container pp_wrap">

            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : ?>
                    <?php the_post(); ?>

                    <!-- ▼ 投稿 : 開始-->
                    <?php the_title('<h2 class="centering">', '</h2>'); ?>
                    <?php the_content(); ?>
                    <!-- ▲ 投稿 : 終了-->
                <?php endwhile; ?>

            <?php else : ?>
                <p>あてはまる情報はまだありません。</p>
            <?php endif; ?>

        </div>
    </section>
</main>
<!-- ▲ コンテンツ : 終了-->

<!-- ▲ フッター : 開始-->
<?php get_footer(); ?>
<!-- ▲ フッター : 終了-->
