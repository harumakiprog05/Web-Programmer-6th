<!-- ▼ ヘッダー : 開始-->
<?php get_header('subpage'); ?>
<!-- ▲ ヘッダー : 終了-->
<?php
// 変数の定義と背景画像の配列
$post_type = 'spot';
$tax_name = 'spot_cat';
$course_loopcount = 0;
$background_img = ['awaiyashi_gyogun', 'awaiyashi_sudachi_flower3', 'awaiyashi_sudatiburi', 'awaiyashi_car'];
?>
<div class="model_head_img"></div>
<main>
    <section class="container model_container_wrap">
        <div class="model_pc_img_top">
            <img src="<?php echo esc_url(get_theme_file_uri('image/model_pc_img.png')); ?>" alt="" />
        </div>

        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : ?>
                <?php the_post(); ?>

                <div class="model_description">
                    <?php // <!-- モデルコースタイトル -->
                    the_title('<h2>', '</h2>'); ?>
                    <p><?php // <!-- モデルコース説明文 -->
                        echo CFS()->get('model_info'); ?></p>
                </div>

                <!-- スタート -->
                <div class="model_start_img">
                    <img src="<?php echo esc_url(get_theme_file_uri('image/start_station.png')); ?>" alt="" />
                </div>

                <span class="calm_color_dark model_circle_set model_big_circle">
                    スタート！
                </span>

                <?php
                // <!-- ▼ コースループ : 開始-->
                $loop = CFS()->get('course_loop');
                foreach ($loop as $row) :
                ?>
                    <!-- 道路 -->
                    <span class="calm_color_dark road">
                        <?php if ($course_loopcount < 2) :
                            echo '<img class="model_sp_img', $course_loopcount + 2, '" src="', esc_url(get_theme_file_uri('image/' . $background_img[2 * $course_loopcount] . '.png')), '" alt="" />';
                        endif; ?>
                    </span>

                    <?php $spot_slug = $row['spot_slug']; ?>
                    <?php $args = array(
                        'post_type' => $post_type,
                        'name'      => $spot_slug
                    );
                    $customPosts = get_posts($args);
                    // <!-- ▼ spotループ : 開始-->
                    if ($customPosts) :
                        foreach ($customPosts as $post) :
                            setup_postdata($post);
                            $spot_cat = get_category_parent($post, $tax_name);
                            $spot_cat_slug = $spot_cat->slug;
                    ?>
                            <!-- スポットカード-->
                            <div class="pc_spot_more">
                                <button class="spot_more <?php echo $spot_cat_slug; ?>_color_dark pc_spot_name1 <?php echo $spot_cat_slug; ?>_color_dark">
                                    <?php the_title(); ?> <i class="fas fa-chevron-<?php echo $course_loopcount == 1 ? 'left' : 'right' ?>"></i>
                                </button>
                            </div>

                            <div class="model_spot_wrap spot_fade_in<?php echo $course_loopcount + 1; ?>" id="modelSpotCard<?php echo $course_loopcount + 1; ?>">
                                <div class="model_spot_card <?php echo $spot_cat_slug; ?>_bdcolor_dark">
                                    <div>
                                        <?php // <!-- サムネイル -->
                                        the_post_thumbnail(); ?>
                                    </div>
                                    <div class="model_text">
                                        <?php // <!-- タイトル -->
                                        the_title('<h3>', '</h3>'); ?>
                                        <p class="model_card_description">
                                            <?php // <!-- 癒しポイントテキスト -->
                                            echo CFS()->get('iyashi_point'); ?>
                                        </p>
                                        <a href="<?php echo the_permalink(); // <!-- spot詳細へのリンク -->
                                                    ?>">
                                            <button class="spot_more <?php echo $spot_cat_slug; ?>_color_dark">
                                                詳細はこちら <i class="fas fa-chevron-right"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>該当スポットがありません。</p>
                    <?php endif;
                    wp_reset_postdata(); //クエリのリセット
                    // <!-- ▲ spotループ : 終了-->
                    ?>

                    <!-- 道路 -->
                    <span class="calm_color_dark road">
                        <?php if ($course_loopcount < 2) :
                            echo '<img class="model_sp_img', $course_loopcount + 4, '" src="', esc_url(get_theme_file_uri('image/' . $background_img[2 * $course_loopcount + 1] . '.png')), '" alt="" />';
                        endif; ?>
                    </span>

                    <!-- 所要時間 -->
                    <?php
                    if (!empty($row['travel_time'])) {
                        echo '<span class="calm_color_dark model_circle_set">';
                        echo $row['travel_time'];
                        echo '</span>';
                    }
                    ?>

                    <?php $course_loopcount++; ?>
                <?php endforeach;
                // <!-- ▲ コースループ : 終了-->
                ?>
            <?php endwhile; ?>
        <?php endif; ?>

        <!-- ゴール -->
        <span class="calm_color_dark model_circle_set model_big_circle">ゴール！</span>
        <div>
            <img class="model_sp_img6" src="<?php echo esc_url(get_theme_file_uri('image/model_bottom_img.png')); ?>" alt="" />
        </div>

        <div class="model_iframe_outline">
            <?php echo CFS()->get('map_if'); ?>
        </div>

        <a href="<?php echo esc_url(get_post_type_archive_link('model')); ?>">
            <button class="back_model_archive calm_color_dark">
                モデルコース一覧へ
            </button>
        </a>
    </section>
</main>
<!-- ▼ フッター : 開始-->
<?php get_footer(); ?>
<!-- ▲ フッター : 終了-->
