<!-- ▼ ヘッダー : 開始-->
<?php get_header(); ?>

<?php
// カスタム投稿spotのタクソノミー名(category)
$tax_name = 'spot_cat';
// 親カテゴリーを取得
$spot_cat = get_category_parent($post, $tax_name);

// ヘッダーの条件分岐
if ($spot_cat->name == '楽') {
    // ここにヘッダーを入力

} elseif ($spot_cat->name == '静') {
    // ここにヘッダーを入力

} elseif ($spot_cat->name == '旨') {
    // ここにヘッダーを入力

}
?>
<!-- ▲ ヘッダー : 終了-->


<main>

    <section>
        <!-- ▼ 記事ループ : 開始-->
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : ?>
                <?php the_post(); ?>
                <?php
                // 記事のカテゴリー取得
                $spot_cat_term = get_the_terms($post, $tax_name);
                $length = count($spot_cat_term);
                $count = $length == 2 ? 1 : 0;
                // サブカテゴリーのみ文字列として変数に代入
                $sub_cat = '';
                foreach ($spot_cat_term as $cat) {
                    if ($cat->parent != 0) {
                        $sub_cat .= $count == $length - 1 ? $cat->slug : $cat->slug . ' ';
                    }
                    $count++;
                }
                ?>

                <article <?php post_class(); ?>>
                    <a href="<?php the_permalink(); ?>" data-group="<?php echo $sub_cat; ?>">
                        <h3 class="">記事タイトル：
                            <?php the_title(); ?>
                        </h3>
                    </a>

                </article>

            <?php endwhile; ?>
            <!-- <?php the_post_navigation(); ?> -->
        <?php endif; ?>
        <!-- ▲ 記事ループ : 終了-->
    </section>

    <!-- ▼ サブカテゴリー出力 : 開始-->
    <div class="cat_search">
        <?php
        $term_id = $spot_cat->term_id;
        // サブカテゴリーのID取得
        $spot_subcat = get_term_children($term_id, $tax_name);
        echo '<ul>';
        foreach ($spot_subcat as $value) {
            echo '<li>', get_the_category_by_ID($value), '</li>';
        }
        echo '</ul>';
        ?>
    </div>
    <!-- ▲ サブカテゴリー出力 : 終了-->

</main>

<!-- ▼ フッター : 開始-->
<?php get_footer(); ?>
<!-- ▲ フッター : 終了-->
