<main>

    <article>
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : ?>
                <?php the_post(); ?>

                <article <?php post_class(); ?>>

                    <h3 class="">
                        <?php the_title(); ?>
                    </h3>

                    <p>モデルコース説明テキスト：</br>
                        <?php echo CFS()->get('model_info'); ?>
                    </p>

                    <div>
                        <?php echo CFS()->get('map_if');; ?>
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
                                    <div>
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                    <!-- ▼ 癒しポイントテキスト -->
                                    <p>
                                        <?php echo CFS()->get('iyashi_point'); ?>
                                    </p>
                                    <!-- ▼ spot詳細へのパーマリンク -->
                                    <div>
                                        <a href="<?php echo the_permalink(); ?>">詳細はこちら☛</a>
                                    </div>

                                <?php endforeach; ?>
                            <?php else : ?>
                                <p>Sorry, no posts matched your criteria.</p>
                            <?php endif;
                            wp_reset_postdata(); //クエリのリセット
                            ?>

                            <?php
                            if (!empty($row['travel_time'])) {
                                echo '<li>所要時間', $row['travel_time'], '</li>';
                            }
                            ?>
                        <?php endforeach; ?>
                    </ul>


                </article>

            <?php endwhile; ?>
        <?php endif; ?>

    </article>

</main>

<!-- ▼ フッター : 開始-->
<?php get_footer(); ?>
<!-- ▲ フッター : 終了-->