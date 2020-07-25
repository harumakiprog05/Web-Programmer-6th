<!-- ▼ ヘッダー : 開始-->
<?php get_header('subpage'); ?>
<!-- ▲ ヘッダー : 終了-->

<main>

    <article>
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : ?>
                <?php the_post(); ?>

                <section class="container model_container_wrap">
                    <article <?php post_class(); ?>>
                        <div class="model_description">
                            <!-- モデルコースタイトル -->
                            <h2><?php the_title(); ?></h2>
                            <!-- モデルコース説明文 -->
                            <p><?php echo CFS()->get('model_info'); ?></p>
                        </div>

                        <div>
                            <?php echo CFS()->get('map_if');; ?>
                        </div>

                        <!-- スタート -->
                        <!-- <div class="model_start_img">
                        <img src="<?php echo esc_url(get_theme_file_uri('image/model_course_sample.jpg')); ?>" alt="" />
                    </div> -->
                        <span class=" calm_color_dark model_circle_set model_big_circle">スタート！</span>
                        <!-- 道路 -->
                        <span class="calm_color_dark road"> <img class="model_sp_img2" src="<?php echo esc_url(get_theme_file_uri('image/awaiyashi_gyogun.png')); ?>" alt="" /></span>

                        <!-- スポットカード-1-->
                        <div class="pc_spot_more">
                            <button class="spot_more fun_color_dark pc_spot_name1 fun_color_dark"><?php the_title(); ?><i class="fas fa-chevron-right"></i></button>
                        </div>

                        <ul>
                            <?php
                            $loop = CFS()->get('course_loop');
                            foreach ($loop as $row) :
                            ?>

                                <?php $spot_slug = $row['spot_slug']; ?>

                                <?php $args = array(
                                    'post_type' => 'spot', //投稿タイプ名
                                    'name' => $spot_slug
                                );
                                $customPosts = get_posts($args);
                                if ($customPosts) :
                                    foreach ($customPosts as $post) :
                                        setup_postdata($post);
                                ?>

                                        <!-- ▼ サムネイル -->
                                        <div class="model_spot_wrap spot_fade_in1" id="modelSpotCard1">
                                            <div class="model_spot_card fun_bdcolor_dark">
                                                <div>
                                                    <?php the_post_thumbnail(); ?>
                                                </div>
                                                <!-- タイトル -->
                                                <div class="model_text">
                                                    <h3><?php the_title(); ?></h3>


                                                    <!-- ▼ 癒しポイントテキスト -->
                                                    <p class="model_card_description">
                                                        <?php echo CFS()->get('iyashi_point'); ?>
                                                    </p>

                                                    <!-- ▼ spot詳細へのパーマリンク -->
                                                    <a href=" <?php echo the_permalink(); ?>"><button class="spot_more calm_color_dark fun">
                                                            詳細はこちら
                                                            <i class="fas fa-chevron-right"></i>
                                                        </button></a>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- 道路 -->
                                        <span class="calm_color_dark road">
                                            <img class="model_sp_img4" src="image/awaiyashi_sudachi_flower3.png" alt="" />
                                        </span>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <p>Sorry, no posts matched your criteria.</p>
                                <?php endif;
                                wp_reset_postdata(); //クエリのリセット
                                ?>


                                <!-- 中間 -->
                                <span class="calm_color_dark model_circle_set">
                                    <?php
                                    if (!empty($row['travel_time'])) {
                                        echo '<li>所要時間', $row['travel_time'], '</li>';
                                    }
                                    ?>
                                </span>
                                <!-- 道路 -->
                                <span class="calm_color_dark road">
                                    <img class="model_sp_img3" src="image/awaiyashi_sudatiburi.png" alt="" />
                                </span>






                            <?php endforeach; ?>
                        </ul>


                    </article>

                <?php endwhile; ?>
            <?php endif; ?>
                </section>
    </article>

</main>

<!-- ▼ フッター : 開始-->
<?php get_footer(); ?>
<!-- ▲ フッター : 終了-->