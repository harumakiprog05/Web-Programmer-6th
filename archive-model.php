<?php get_header('subpage'); ?>
<main>
    <div class="model_head_img"></div>
    <article>
        <section class="model_archive_container">
            <div class="model_head">
                <div class="model_description">

                    <p>
                        次のお休みは何して過ごす？<br />
                        おすすめのスポットを巡るモデルコースをご紹介します。<br />
                        気分に合わせてコースを選んでみてはいかがでしょう？
                    </p>
                </div>
                <div class="archive_model_pc_img_top left_top">
                    <img src="<?php echo esc_url(get_theme_file_uri('image/model_img.png')); ?>" alt="おにぎりとリュックサック" />
                </div>
                <div class="archive_model_pc_img_top right_top">
                    <img src="<?php echo esc_url(get_theme_file_uri('image/bird_flower.png')); ?>" alt="鳥と花" />
                </div>
            </div>
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
                                    <img src="<?php echo $row['model_spot_img']; ?>" alt="モデルコーススポット画像">
                                <?php endforeach; ?>
                            </div>
                            <div class="archive_model_text">
                                <h2 class="">
                                    <?php the_title(); ?>

                                </h2>


                                <p class="model_card_description">
                                    <?php echo CFS()->get('model_info'); ?>
                                </p>
                                <a href="<?php the_permalink(); ?>">
                                    <div class="spot_more theme_color_dark">
                                        モデルコース詳細へ
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>
                            </div>
                        </article>

                    <?php endwhile; ?>

                <?php endif; ?>
            </div>
            <!-- SPイラスト -->
            <div class="model_sp_img">
                <img src="<?php echo esc_url(get_theme_file_uri('image/model_bottom_img.png')); ?>" alt="木" />
            </div>

            <!-- PCイラスト -->
            <div class="model_pc_img">
                <img src="<?php echo esc_url(get_theme_file_uri('image/model_pc_bottom_img.png')); ?>" alt="水彩画" />
            </div>
        </section>
    </article>

</main>

<!-- ▼ フッター : 開始-->
<?php get_footer(); ?>
<!-- ▲ フッター : 終了-->
