<!-- ▼ ヘッダー : 開始-->
<?php get_header(); ?>
<!-- ▲ ヘッダー : 終了-->

<!-- ▼ searchform : 開始-->
<?php get_search_form(); ?>
<!-- ▲ searchform : 終了-->

<!-- ▼ searchformの値取得 : 開始-->
<?php
$s = $_GET['s'];
$get_tags = $_GET['get_tags'];
$get_cats = $_GET['get_cats'];


if ($get_tags) {
	$tax_ary[] = array(
		'taxonomy' => 'spot_tag',
		'field' => 'slug',
		'terms' => $get_tags,
		'operator' => 'AND', //ANDかIN
	);
}
?>
<!-- ▲ searchformの値取得 : 終了-->

<!-- ▼ 絞り込み検索の結果出力 : 開始-->
<?php if (!($s || $get_cats || $get_tags)) : ?>

<?php else : ?>

	<h2>＜＜＜検索結果＞＞＞</h2>

	<!-- ▼ WP_Query（楽） : 開始------------------------------------------------------>
	<?php
	$my_query = new WP_Query(array(
		'paged' => get_query_var('paged'),
		'post_type' => 'post',
		'tax_query' => $tax_ary,
		'relation' => 'AND', //ANDかOR
		's' => $s,
	)); ?>

	<?php if ($my_query->have_posts()) : ?>

		<h2>楽</h2>
		<ul>
			<?php while ($my_query->have_posts()) : ?>
				<?php $my_query->the_post(); ?>

				<!-- ▼ メインカテゴリになるまで親カテゴリーを取得 : 開始 -->
				<?php
				$cat = get_the_terms($post, 'spot_cat');
				$cat = $cat[0];

				$cat_id = $cat->parent;
				while ($cat_id != 0) {
					$cat = get_term($cat_id, 'spot_cat');
					$cat_id = $cat->parent;
				}
				?>
				<!-- ▲ メインカテゴリになるまで親カテゴリーを取得 : 終了-->

				<!-- ▼ エリア指定「無」の処理 : 開始 -->
				<?php if (!$get_cats) : ?>
					<?php if ($cat->name == '楽') : ?>
						<li>(<?php echo $cat->name; ?>)タグ：<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
						</li>
					<?php endif; ?>
					<!-- ▲ エリア指定「無」の処理 : 終了-->


					<!-- ▼ エリア指定「有」の処理 : 開始 -->
				<?php elseif ($get_cats) : ?>
					<!-- ▼ カスタム投稿spotのスラッグ取得 : 開始 -->
					<?php if ($cat->name == '楽') : ?>
						<?php $slug = $post->post_name; ?>
						<?php $spot_post_id = get_the_ID(); ?>

						<?php
						// 文字列に「-(ハイフン)」が含まれている場合
						if (strpos($slug, '-') !== false) {
							$cut = 2; //カットしたい文字数
							$slug = substr(
								$slug,
								0,
								strlen($slug) - $cut
							);
						}
						?>
					<?php endif; ?>
					<!-- ▲ カスタム投稿spotのスラッグ取得 : 終了-->

					<!-- ▼ カスタム投稿spotのスラッグでinfoのカテゴリ取得 : 開始 -->
					<?php
					$args = array(
						'post_type' => 'info', //投稿タイプ名
						'name' => $slug
					);
					$customPosts = get_posts($args);
					if ($customPosts) {
						foreach ($customPosts as $post) {
							setup_postdata($post);
							$area = get_the_terms($post, 'info_cat');
							$area = $area[0]->slug;
						}
					}
					wp_reset_postdata(); //クエリのリセット
					?>
					<!-- ▲ カスタム投稿spotのスラッグでinfoのカテゴリ取得 : 終了-->

					<!-- ▼ infoのカテゴリスラッグとエリアが一致すれば出力 : 開始 -->
					<?php
					foreach ($get_cats as $val) {
						if ($area == $val && $cat->name == '楽') {
							$post = get_post($spot_post_id);
							echo '<li><a href="', get_permalink(), '">', $post->post_title, '</a></li>';
						}
					}
					?>
					<!-- ▲ infoのカテゴリスラッグとエリアが一致すれば出力 : 終了-->
				<?php endif; ?>
			<?php endwhile; ?>
		</ul>
	<?php else : ?>
		<p>結果が見つかりませんでした。</p>
	<?php endif; ?>
	<!-- ▲ WP_Query（楽） : 終了------------------------------------------------------>

	<!-- ▼ WP_Query（静） : 開始------------------------------------------------------>
	<?php
	$my_query = new WP_Query(array(
		'paged' => get_query_var('paged'),
		'post_type' => 'post',
		'tax_query' => $tax_ary,
		'relation' => 'AND', //ANDかOR
		's' => $s,
	)); ?>

	<?php if ($my_query->have_posts()) : ?>

		<h2>静</h2>
		<ul>
			<?php while ($my_query->have_posts()) : ?>
				<?php $my_query->the_post(); ?>

				<!-- ▼ メインカテゴリになるまで親カテゴリーを取得 : 開始 -->
				<?php
				$cat = get_the_terms($post, 'spot_cat');
				$cat = $cat[0];

				$cat_id = $cat->parent;
				while ($cat_id != 0) {
					$cat = get_term($cat_id, 'spot_cat');
					$cat_id = $cat->parent;
				}
				?>
				<!-- ▲ メインカテゴリになるまで親カテゴリーを取得 : 終了-->

				<!-- ▼ エリア指定「無」の処理 : 開始 -->
				<?php if (!$get_cats) : ?>
					<?php if ($cat->name == '静') : ?>
						<li>(<?php echo $cat->name; ?>)タグ：<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
						</li>
					<?php endif; ?>
					<!-- ▲ エリア指定「無」の処理 : 終了-->


					<!-- ▼ エリア指定「有」の処理 : 開始 -->
				<?php elseif ($get_cats) : ?>
					<!-- ▼ カスタム投稿spotのスラッグ取得 : 開始 -->
					<?php $slug = $post->post_name; ?>
					<?php
					// 文字列に「-(ハイフン)」が含まれている場合
					if (strpos($slug, '-') !== false) {
						$cut = 2; //カットしたい文字数
						$slug = substr(
							$slug,
							0,
							strlen($slug) - $cut
						);
					}
					?>
					<!-- ▲ カスタム投稿spotのスラッグ取得 : 終了-->

					<!-- ▼ カスタム投稿spotのスラッグでinfoのカテゴリ取得 : 開始 -->
					<?php
					$args = array(
						'post_type' => 'info', //投稿タイプ名
						'name' => $slug
					);
					$customPosts = get_posts($args);
					if ($customPosts) {
						foreach ($customPosts as $post) {
							setup_postdata($post);
							$area = get_the_terms($post, 'info_cat');
							$area = $area[0]->slug;
						}
					}
					wp_reset_postdata(); //クエリのリセット
					?>
					<!-- ▲ カスタム投稿spotのスラッグでinfoのカテゴリ取得 : 終了-->

					<!-- ▼ infoのカテゴリスラッグとエリアが一致すれば出力 : 開始 -->
					<?php
					foreach ($get_cats as $val) {
						if ($area == $val) {
							$args = array(
								'post_type' => 'spot', //投稿タイプ名
								'name' => $slug
							);
							$customPosts = get_posts($args);
							if ($customPosts) {
								foreach ($customPosts as $post) {
									setup_postdata($post);
									if ($cat->name == '静') {
										echo '<li><a href="', the_permalink(), '">', the_title(), '</a></li>';
									}
								}
							}
							wp_reset_postdata(); //クエリのリセット
						}
					}
					?>
					<!-- ▲ infoのカテゴリスラッグとエリアが一致すれば出力 : 終了-->
				<?php endif; ?>
			<?php endwhile; ?>
		</ul>
	<?php else : ?>
		<p>結果が見つかりませんでした。</p>
	<?php endif; ?>
	<!-- ▲ WP_Query（楽） : 終了------------------------------------------------------>

	<!-- ▼ WP_Query（旨） : 開始------------------------------------------------------>
	<?php
	$my_query = new WP_Query(array(
		'paged' => get_query_var('paged'),
		'post_type' => 'post',
		'tax_query' => $tax_ary,
		'relation' => 'AND', //ANDかOR
		's' => $s,
	)); ?>

	<?php if ($my_query->have_posts()) : ?>

		<h2>旨</h2>
		<ul>
			<?php while ($my_query->have_posts()) : ?>
				<?php $my_query->the_post(); ?>

				<!-- ▼ メインカテゴリになるまで親カテゴリーを取得 : 開始 -->
				<?php
				$cat = get_the_terms($post, 'spot_cat');
				$cat = $cat[0];

				$cat_id = $cat->parent;
				while ($cat_id != 0) {
					$cat = get_term($cat_id, 'spot_cat');
					$cat_id = $cat->parent;
				}
				?>
				<!-- ▲ メインカテゴリになるまで親カテゴリーを取得 : 終了-->

				<!-- ▼ エリア指定「無」の処理 : 開始 -->
				<?php if (!$get_cats) : ?>
					<?php if ($cat->name == '旨') : ?>
						<li>(<?php echo $cat->name; ?>)タグ：<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
						</li>
					<?php endif; ?>
					<!-- ▲ エリア指定「無」の処理 : 終了-->


					<!-- ▼ エリア指定「有」の処理 : 開始 -->
				<?php elseif ($get_cats) : ?>
					<!-- ▼ カスタム投稿spotのスラッグ取得 : 開始 -->
					<?php $slug = $post->post_name; ?>
					<?php
					// 文字列に「-(ハイフン)」が含まれている場合
					if (strpos($slug, '-') !== false) {
						$cut = 2; //カットしたい文字数
						$slug = substr(
							$slug,
							0,
							strlen($slug) - $cut
						);
					}
					?>
					<!-- ▲ カスタム投稿spotのスラッグ取得 : 終了-->

					<!-- ▼ カスタム投稿spotのスラッグでinfoのカテゴリ取得 : 開始 -->
					<?php
					$args = array(
						'post_type' => 'info', //投稿タイプ名
						'name' => $slug
					);
					$customPosts = get_posts($args);
					if ($customPosts) {
						foreach ($customPosts as $post) {
							setup_postdata($post);
							$area = get_the_terms($post, 'info_cat');
							$area = $area[0]->slug;
						}
					}
					wp_reset_postdata(); //クエリのリセット
					?>
					<!-- ▲ カスタム投稿spotのスラッグでinfoのカテゴリ取得 : 終了-->

					<!-- ▼ infoのカテゴリスラッグとエリアが一致すれば出力 : 開始 -->
					<?php
					foreach ($get_cats as $val) {
						if ($area == $val) {
							$args = array(
								'post_type' => 'spot', //投稿タイプ名
								'name' => $slug
							);
							$customPosts = get_posts($args);
							if ($customPosts) {
								foreach ($customPosts as $post) {
									setup_postdata($post);
									if ($cat->name == '旨') {
										echo '<li><a href="', the_permalink(), '">', the_title(), '</a></li>';
									}
								}
							}
							wp_reset_postdata(); //クエリのリセット
						}
					}
					?>
					<!-- ▲ infoのカテゴリスラッグとエリアが一致すれば出力 : 終了-->
				<?php endif; ?>
			<?php endwhile; ?>
		</ul>
	<?php else : ?>
		<p>結果が見つかりませんでした。</p>
	<?php endif; ?>
	<!-- ▲ WP_Query（旨） : 終了------------------------------------------------------>


<?php endif; ?>
<!-- ▲ 絞り込み検索の結果出力 : 終了-->

<!-- ▼ 検証条件クリアする為のJS : 開始-->
<script>
	const protcol = location.protocol;
	const host = location.hostname;
	const url = protcol + "//" + host + "/awaiyashi/?s=&post_type=spot";

	function back() {
		// 指定画面に移動
		window.location.href = url;
	}
</script>
<!-- ▲ 検証条件クリアする為のJS : 終了-->


<!-- ▼ フッター : 開始-->
<?php get_footer(); ?>
<!-- ▲ フッター : 終了-->
