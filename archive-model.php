<?php get_header('subpage'); ?>
<main>

    <article>
        <div class="archive_model_spot_wrap">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : ?>
                    <?php the_post(); ?>

                    <article <?php post_class(); ?>>

                        <div class="model_course_card model_fade">
                            <?php
                            $loop = CFS()->get('course_loop');
                            foreach ($loop as $row) :
                            ?>
                                <!-- 画像： -->
                                <img src="<?php echo $row['model_spot_img']; ?>">
                            <?php endforeach; ?>
                        </div>
                        <div class="model_text">
                            <h3 class="">
                                <?php the_title(); ?>

                            </h3>


                            <p class="model_card_description">
                                <?php echo CFS()->get('model_info'); ?>
                            </p>
                            <a href="<?php the_permalink(); ?>">
                                <button class="spot_more theme_color_dark">
                                    モデルコース詳細へ
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </a>
                        </div>
                    </article>

                <?php endwhile; ?>

            <?php endif; ?>
        </div>
    </article>

</main>

<!-- ▼ フッター : 開始-->
<?php get_footer(); ?>
<!-- ▲ フッター : 終了-->