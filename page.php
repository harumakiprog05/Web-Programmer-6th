<!-- ▼ ヘッダー : 開始-->
<?php get_header('subpage'); ?>
<!-- ▲ ヘッダー : 終了-->

<!-- ▼ コンテンツ : 開始-->
<main>
    <section <?php post_class(); ?>>
        <?php
        $class_name = '';
        if (is_page('about')) {
            $class_name = 'site_about_wrap';
        } elseif (is_page('privacy-policy')) {
            $class_name = 'pp_container';
        } elseif (is_page('contact')) {
            $class_name = 'foam_wrap';
        }
        ?>
        <div class="container <?php echo $class_name; ?>">

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
