<!-- ▼ ヘッダー : 開始-->
<?php get_header('subpage'); ?>
<!-- ▲ ヘッダー : 終了-->

<?php
// <!-- ▼ 変数の宣言とカテゴリ別テキストの定義 : 開始-->
$cat_info = $select_cat = '';
// カスタム投稿spotのタクソノミー名(category)
$tax_name = 'spot_cat';
// 親カテゴリーを取得
$spot_cat = get_category_parent($post, $tax_name);

if (is_tax($tax_name, 'fun')) {
    $cat_info = 'とくしまの自然を感じる、楽しいひととき。';
    $select_cat = '楽しむ';
} elseif (is_tax($tax_name, 'calm')) {
    $cat_info = '日常を忘れる、静かなひととき。';
    $select_cat = '静か';
} elseif (is_tax($tax_name, 'tasty')) {
    $cat_info = '自然を五感で味わう、旨いひととき。';
    $select_cat = '旨い';
}

$term_id = $spot_cat->term_id;
// サブカテゴリーのID取得
$spot_subcat = get_term_children($term_id, $tax_name);
// <!-- ▲ 変数の定義とカテゴリ別テキストの定義 : 終了-->
?>

<main>

    <section class="spot-Contana">
        <h2 class="<?php echo $spot_cat->slug; ?>_underline spot_title centering <?php echo $spot_cat->slug; ?>_ftcolor_dark"><?php echo $spot_cat->name; ?></h2>
        <p class="centering"><?php echo $cat_info; ?></p>
    </section>

    <nav>
        <?php breadcrumb(); ?>
    </nav>

    <section>
        <nav class="menu_box">
            <div class="menu_btn spot_tag_search <?php echo $spot_cat->slug; ?>_color_dark centering">
                <p>徳島の<span id="select_tag" class="tag_underline">　<?php echo $select_cat; ?>　</span>でゆっくりしませんか？</p>
            </div>


            <ul class="drop_menu <?php echo $spot_cat->slug; ?>_drop_border">
                <?php // <!-- ▼ サブカテゴリー出力 : 開始->
                foreach ($spot_subcat as $value) : ?>
                    <?php $spot_term = get_term($value, $tax_name); ?>
                    <li data-filter="<?php echo $spot_term->slug; ?>">
                        <a>
                            <figure class="<?php echo $spot_cat->slug; ?>_select">
                                <img src="<?php echo esc_url(get_theme_file_uri("image/spot_category/$spot_term->slug.jpg")); ?>" />
                            </figure>
                            <p class="select_text"><?php echo $spot_term->name; ?></p>
                        </a>
                    </li>
                <?php endforeach;
                // <!-- ▲ サブカテゴリー出力 : 終了-->
                ?>
                <li data-filter="all">
                    <a>
                        <figure class="<?php echo $spot_cat->slug; ?>_select">
                            <img src="<?php echo esc_url(get_theme_file_uri("image/spot_category/all_$spot_cat->slug.jpg")); ?>" />
                        </figure>
                        <p class="select_text">ぜんぶ</p>
                    </a>
                </li>
            </ul>
        </nav>


        <div class="spot_wrap boxes">
            <ul class="spot_card">
                <?php // <!-- ▼ 記事ループ : 開始-->
                if (have_posts()) : ?>
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
                                $sub_cat .= $count == ($length - 1) ? $cat->slug : $cat->slug . ' ';
                            }
                            $count++;
                        }
                        ?>
                        <li class="cat_image" data-category="<?php echo $sub_cat; ?>">
                            <a href="<?php the_permalink(); ?>">
                                <figure class="spot_photo">
                                    <?php set_thumbnail('thumbnail'); ?>
                                </figure>
                                <?php the_title('<h3 class="centering">', '</h3>'); ?>
                            </a>
                        </li>
                    <?php endwhile; ?>
                    <!-- <?php the_post_navigation(); ?> -->
                <?php endif;
                // <!-- ▲ 記事ループ : 終了-->
                ?>
            </ul>
        </div>

    </section>
</main>

<!-- ▼ フッター : 開始-->
<?php get_footer(); ?>
<!-- ▲ フッター : 終了-->
