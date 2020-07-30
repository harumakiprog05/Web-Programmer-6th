<!-- ▼ ヘッダー : 開始-->
<?php get_header('subpage'); ?>
<!-- ▲ ヘッダー : 終了-->

<main>
	<!-- ▼ searchform : 開始-->
	<?php get_search_form(); ?>
	<!-- ▲ searchform : 終了-->

	<?php
	// <!-- ▼ searchformの値取得と変数定義 : 開始-->
	$tax_name_spot = 'spot_cat';
	$tax_name_info = 'info_cat';
	$s = $get_tags = $get_cats = '';
	$count_spot_fun = $count_spot_calm = $count_spot_tasty =  0;

	if (isset($_GET['s']) && $_GET['s'] != '') {
		$s = $_GET['s'];
	}
	if (isset($_GET['get_tags']) && $_GET['get_tags'] != '') {
		$get_tags = $_GET['get_tags'];
	}
	if (isset($_GET['get_cats']) && $_GET['get_cats'] != '') {
		$get_cats = $_GET['get_cats'];
	}

	$tax_ary_fun[] = create_taxquery_array($get_tags, 'fun');
	$tax_ary_calm[] = create_taxquery_array($get_tags, 'calm');
	$tax_ary_tasty[] = create_taxquery_array($get_tags, 'tasty');
	// <!-- ▲ searchformの値取得と変数定義 : 終了-->
	?>

	<section class="result_section">
		<!-- ▼ 絞り込み検索の結果出力 : 開始-->
		<?php if (!($s || $get_cats || $get_tags)) : ?>

		<?php else : ?>
			<div class="tabBox">
				<ul class="tabArea">
					<li class="one_tab">
						<a href="#tab01"><span class="tab_inner">楽 </span></a>
					</li>
					<li class="one_tab">
						<a href="#tab02"><span class="tab_inner">静</span></a>
					</li>
					<li class="one_tab">
						<a href="#tab03"><span class="tab_inner">旨</span></a>
					</li>
				</ul>
			</div>

			<div class="contents">
				<div id="tab01" class="tab_main fun_result fun_color_light fun_bdcolor_dark">


					<!-- ▼ WP_Query（楽） : 開始------------------------------------------------------>
					<?php $my_query_fun = new WP_Query(create_wp_query($tax_ary_fun, 'AND', $s)); ?>

					<div class="container">
						<h2 class="result_categry_title fun_color_dark grande_circle_set">楽</h2>
						<ul class="result_items flex">
							<?php if ($my_query_fun->have_posts()) : ?>

								<?php while ($my_query_fun->have_posts()) : ?>
									<?php $my_query_fun->the_post(); ?>


									<?php // <!-- ▼ エリア指定が「無い」場合の処理 : 開始 ---------------------->
									if (!$get_cats) :
									?>
										<?php $count_spot_fun++; ?>
										<li class="result_item">
											<a href="<?php the_permalink() ?>">
												<?php set_thumbnail(''); ?>
												<span><?php the_title(); ?></span>
											</a>
										</li>


									<?php // <!-- ▼ エリア指定が「有る」場合の処理 : 開始 ---------------------->
									elseif ($get_cats) :
									?>

										<?php
										// <!-- ▼ カスタム投稿spotのスラッグとID取得 : 開始 -->
										$spot_post_id = get_the_ID();
										$slug = $post->post_name;
										// <!-- スラッグに「-(ハイフン)」が含まれていれば「-」以下カット -->
										$slug = cut_string($slug);
										// <!-- ▲ カスタム投稿spotのスラッグとID取得 : 終了-->
										?>

										<?php
										// <!-- ▼ カスタム投稿spotのスラッグでinfoのカテゴリ（エリア）取得 : 開始 -->
										$args = array(
											'post_type' => 'info', //投稿タイプ名
											'name'      => $slug
										);
										$customPosts = get_posts($args);
										if ($customPosts) {
											foreach ($customPosts as $post) {
												setup_postdata($post);
												$area = get_category_parent($post, $tax_name_info)->slug;
											}
										}
										wp_reset_postdata(); //クエリのリセット
										// <!-- ▲ カスタム投稿spotのスラッグでinfoのカテゴリ（エリア）取得 : 終了-->
										?>

										<?php
										// <!-- ▼ infoのカテゴリスラッグとエリアが一致すれば出力 : 開始 -->
										foreach ($get_cats as $val) {
											if ($area == $val) {
												$post = get_post($spot_post_id);
												echo '<li class="result_item"><a href="', get_permalink(), '">';
												echo get_thumbnail($post, '');
												echo '<span>', $post->post_title, '</span></a></li>';
												$count_spot_fun++;
											}
										}
										// <!-- ▲ infoのカテゴリスラッグとエリアが一致すれば出力 : 終了-->
										?>

									<?php // <!-- ▲ エリア指定が「有る」場合の処理 : 終了---------------------->
									endif; ?>

								<?php endwhile; ?>
								<?php
								if ($count_spot_fun == 0) {
									echo '<li class="result_item">結果が見つかりませんでした。</li>';
								}
								?>
							<?php else : ?>
								<li class="result_item">結果が見つかりませんでした。</li>
							<?php endif; ?>
						</ul>

					</div>
					<!-- ▲ WP_Query（楽） : 終了------------------------------------------------------>
				</div><!-- /#tab01 -->

				<div id="tab02" class="tab_main calm_result calm_color_light  calm_bdcolor_dark">
					<!-- ▼ WP_Query（静） : 開始------------------------------------------------------>
					<?php $my_query_calm = new WP_Query(create_wp_query($tax_ary_calm, 'AND', $s)); ?>
					<div class="container">
						<h2 class="result_categry_title calm_color_dark grande_circle_set">静</h2>
						<ul class="result_items flex">
							<?php if ($my_query_calm->have_posts()) : ?>

								<?php while ($my_query_calm->have_posts()) : ?>
									<?php $my_query_calm->the_post(); ?>

									<?php // <!-- ▼ エリア指定が「無い」場合の処理 : 開始 ---------------------->
									if (!$get_cats) : ?>
										<?php $count_spot_calm++; ?>
										<li class="result_item">
											<a href="<?php the_permalink() ?>">
												<?php set_thumbnail(''); ?>
												<span><?php the_title(); ?></span>
											</a>
										</li>


									<?php // <!-- ▼ エリア指定が「有る」場合の処理 : 開始 ---------------------->
									elseif ($get_cats) : ?>

										<?php
										// <!-- ▼ カスタム投稿spotのスラッグとID取得 : 開始 -->
										$spot_post_id = get_the_ID();
										$slug = $post->post_name;
										// <!-- スラッグに「-(ハイフン)」が含まれていれば「-」以下カット -->
										$slug = cut_string($slug);
										// <!-- ▲ カスタム投稿spotのスラッグとID取得 : 終了-->
										?>


										<?php
										// <!-- ▼ カスタム投稿spotのスラッグでinfoのカテゴリ（エリア）取得 : 開始 -->
										$args = array(
											'post_type' => 'info', //投稿タイプ名
											'name'      => $slug
										);
										$customPosts = get_posts($args);
										if ($customPosts) {
											foreach ($customPosts as $post) {
												setup_postdata($post);
												$area = get_category_parent($post, $tax_name_info)->slug;
											}
										}
										wp_reset_postdata(); //クエリのリセット
										// <!-- ▲ カスタム投稿spotのスラッグでinfoのカテゴリ（エリア）取得 : 終了-->
										?>

										<?php
										// <!-- ▼ infoのカテゴリスラッグとエリアが一致すれば出力 : 開始 -->
										foreach ($get_cats as $val) {
											if ($area == $val) {
												$post = get_post($spot_post_id);
												echo '<li class="result_item"><a href="', get_permalink(), '">';
												echo get_thumbnail($post, '');
												echo '<span>', $post->post_title, '</span></a></li>';
												$count_spot_calm++;
											}
										}
										// <!-- ▲ infoのカテゴリスラッグとエリアが一致すれば出力 : 終了-->
										?>

									<?php // <!-- ▲ エリア指定が「有る」場合の処理 : 終了---------------------->
									endif; ?>

								<?php endwhile; ?>
								<?php
								if ($count_spot_calm == 0) {
									echo '<li class="result_item">結果が見つかりませんでした。</li>';
								}
								?>
							<?php else : ?>
								<li class="result_item">結果が見つかりませんでした。</li>
							<?php endif; ?>
						</ul>
						<!-- <p class="sumber_calm">(<?php //echo $count_spot_calm; ?>件)</p> -->
					</div>
					<!-- ▲ WP_Query（静） : 終了------------------------------------------------------>
				</div><!-- /#tab02 -->

				<div id="tab03" class="tab_main tasty_result tasty_color_light  tasty_bdcolor_dark">
					<!-- ▼ WP_Query（旨） : 開始------------------------------------------------------>
					<?php $my_query_tasty = new WP_Query(create_wp_query($tax_ary_tasty, 'AND', $s)); ?>
					<div class="container">
						<h2 class="result_categry_title tasty_color_dark grande_circle_set">旨</h2>
						<ul class="result_items flex">
							<?php if ($my_query_tasty->have_posts()) : ?>

								<?php while ($my_query_tasty->have_posts()) : ?>
									<?php $my_query_tasty->the_post(); ?>

									<?php // <!-- ▼ エリア指定が「無い」場合の処理 : 開始 ---------------------->
									if (!$get_cats) : ?>
										<?php $count_spot_tasty++; ?>
										<li class="result_item">
											<a href="<?php the_permalink() ?>">
												<?php set_thumbnail(''); ?>
												<span><?php the_title(); ?></span>
											</a>
										</li>


									<?php // <!-- ▼ エリア指定が「有る」場合の処理 : 開始 ---------------------->
									elseif ($get_cats) : ?>

										<?php
										// <!-- ▼ カスタム投稿spotのスラッグとID取得 : 開始 -->
										$spot_post_id = get_the_ID();
										$slug = $post->post_name;
										// <!-- スラッグに「-(ハイフン)」が含まれていれば「-」以下カット -->
										$slug = cut_string($slug);
										// <!-- ▲ カスタム投稿spotのスラッグとID取得 : 終了-->
										?>

										<?php
										// <!-- ▼ カスタム投稿spotのスラッグでinfoのカテゴリ（エリア）取得 : 開始 -->
										$args = array(
											'post_type' => 'info', //投稿タイプ名
											'name'      => $slug
										);
										$customPosts = get_posts($args);
										if ($customPosts) {
											foreach ($customPosts as $post) {
												setup_postdata($post);
												$area = get_category_parent($post, $tax_name_info)->slug;
											}
										}
										wp_reset_postdata(); //クエリのリセット
										// <!-- ▲ カスタム投稿spotのスラッグでinfoのカテゴリ（エリア）取得 : 終了-->
										?>

										<?php
										// <!-- ▼ infoのカテゴリスラッグとエリアが一致すれば出力 : 開始 -->
										foreach ($get_cats as $val) {
											if ($area == $val) {
												$post = get_post($spot_post_id);
												echo '<li class="result_item"><a href="', get_permalink(), '">';
												echo get_thumbnail($post, '');
												echo '<span>', $post->post_title, '</span></a></li>';
												$count_spot_tasty++;
											}
										}
										// <!-- ▲ infoのカテゴリスラッグとエリアが一致すれば出力 : 終了-->
										?>

									<?php // ▲ エリア指定が「有る」場合の処理 : 終了--------------------
									endif; ?>

								<?php endwhile; ?>
								<?php
								if ($count_spot_tasty == 0) {
									echo '<li class="result_item">結果が見つかりませんでした。</li>';
								}
								?>
							<?php else : ?>
								<li class="result_item">結果が見つかりませんでした。</li>
							<?php endif; ?>
						</ul>
						<!-- <p class="sumber_tasty">旨の検索結果：<?php //echo $count_spot_tasty; ?>件</p> -->
					</div>
					<!-- ▲ WP_Query（旨） : 終了------------------------------------------------------>
				</div>
				<!--#tab03-->
			</div>

		<?php endif; ?>

		<?php
		$all_count = $count_spot_fun + $count_spot_calm + $count_spot_tasty;
		?>
		<p class="sumber_all">すべての検索結果：<span><?php echo $all_count; ?></span>件</p>
		<!-- ▲ 絞り込み検索の結果出力 : 終了-->
	</section>

</main>

<!-- ▼ 検証条件クリアする為のJS : 開始-->
<script>
	const protcol = location.protocol;
	const host = location.hostname;
	const url = protcol + "//" + host + "/awaiyashi/?s=";

	function back() {
		// 指定画面に移動
		window.location.href = url;
	}
</script>
<!-- ▲ 検証条件クリアする為のJS : 終了-->


<!-- ▼ フッター : 開始-->
<?php get_footer(); ?>
<!-- ▲ フッター : 終了-->
