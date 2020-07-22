<main>

    <article>
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : ?>
                <?php the_post(); ?>

                <article <?php post_class(); ?>>

                    <h3 class="">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>


                    <p>モデルコース説明テキスト：</br>
                        <?php echo CFS()->get('iyashi_point'); ?>
                    </p>

                    <ul>
                        <?php
                        $loop = CFS()->get('course_loop');
                        foreach ($loop as $row) :
                        ?>
                            <li>画像：<img src="<?php echo $row['model_spot_img']; ?>"></li>
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
