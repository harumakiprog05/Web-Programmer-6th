<!-- ▼ ヘッダー : 開始-->
<?php get_header("front"); ?>
<!-- ▲ ヘッダー : 終了-->

<main>

	<article>
		<!-- ▼ スポット個別記事ループ : 開始-->
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : ?>
				<?php the_post(); ?>
				<img src="<?php echo CFS()->get('top_image'); ?>" alt="">

				<?php $spot_title = get_the_title(); ?>

				<article <?php post_class(); ?>>

					<h2 class="">
						<?php the_title(); ?>
					</h2>

					<!-- ▼ 施設情報・地図 : 開始-->
					<?php $slug = $post->post_name; ?>
					<?php
					// スラッグの「-(ハイフン)」以降をカット
					$slug = cut_string($slug);
					?>

					<ul>
						<?php $args = array(
							'post_type' => 'info', //投稿タイプ名
							'name' => $slug
						);
						$customPosts = get_posts($args);
						if ($customPosts) :
							foreach ($customPosts as $post) :
								setup_postdata($post);
								$gmap = CFS()->get('gmap_if');
						?>

								<li>名称：<?php echo CFS()->get('spot_name'); ?></li>
								<li>名称かな：<?php echo CFS()->get('spot_ruby'); ?></li>
								<li>郵便番号：〒<?php echo CFS()->get('postal_code'); ?></li>
								<li>住所：<?php echo CFS()->get('address'); ?></li>
								<li>緯度：<?php echo CFS()->get('latitude'); ?></li>

								<li>営業時間：<?php echo CFS()->get('sales_hours'); ?></li>
								<li>定休日：<?php echo CFS()->get('holiday'); ?></li>
								<li>料金<?php echo CFS()->get('fee'); ?></li>


								<?php
								// 施設のエリアスラッグを取得
								$info_cat = get_the_terms($post, 'info_cat');
								foreach ($info_cat as $term) :
									if ($term->parent) :
										$slug_area = $term->slug;
									endif;
								endforeach;
								?>


							<?php endforeach; ?>
						<?php else : //記事が無い場合
						?>
							<p>Sorry, no posts matched your criteria.</p>
						<?php endif;
						wp_reset_postdata(); //クエリのリセット
						?>
					</ul>

					<div>
						<?php echo $gmap; ?>
					</div>

					<!-- ▲ 施設情報・地図 : 終了-->
					<!-- <?php
								$upload_dir = wp_upload_dir();
								$medialibrary_url = $upload_dir['baseurl'] . '/';
								?> -->

					<div class="">
						<dl>
							<dt>癒しひと言：</dt>
							<dd><?php echo CFS()->get('iyashi_point'); ?></dd>

							<dt>癒しバッジ：</dt>
							<dd><img src="<?php echo $medialibrary_url . 'img' . CFS()->get('iyashi_badge'); ?>"></dd>

							<?php
							$loop = CFS()->get('article_loop');
							foreach ($loop as $row) :
							?>

								<dt>画像1：</dt>
								<dd><img src="<?php echo $row['spot_img1']; ?>"></dd>

								<dt>画像2：</dt>
								<?php if (!empty($row['spot_img2'])) : ?>
									<dd><img src="<?php echo $row['spot_img2']; ?>"></dd>
								<?php endif; ?>

								<dt>テキスト：</dt>
								<dd><?php echo $row['spot_text']; ?></dd>

							<?php endforeach; ?>
						</dl>
					</div>

				</article>

			<?php endwhile; ?>
		<?php endif; ?>
		<!-- ▲ スポット個別記事ループ : 終了-->
	</article>


	<!-- ▼ 近くのおススメ : 開始-->
	<article>
		<?php
		$taxonomy_name = 'info_cat'; // タクソノミーのスラッグ名
		$post_type = 'info'; // カスタム投稿のスラッグ名

		$tax_posts = get_posts(array(
			'post_type' => $post_type,
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy_name,
					'terms' => array($slug_area),
					'field' => 'slug',
					// 'include_children' => true, //子タクソノミーを含める
				)
			),
			'orderby' => 'rand'
		));

		if ($tax_posts) :
			$count = 1;
			$num = 4;

			foreach ($tax_posts as $tax_post) :
				setup_postdata($tax_post);

				$spot_slug = $tax_post->post_name;

				if ($num < $count) { // 表示数の制限
					break;
				} else {
					$args = array(
						'post_type' => 'spot', //投稿タイプ名
						'name' => $spot_slug
					);
					$customPosts = get_posts($args);
					if ($customPosts) {
						foreach ($customPosts as $post) {
							setup_postdata($post);
							// 現在の記事と異なるタイトルの場合出力
							if ($spot_title != get_the_title()) {
								echo '<ul>';
								echo '<li>テスト', the_title(), '</li>';
								echo '</ul>';
								$count++;
							}
						}
					} else {
						echo '<ul>';
						echo '<li>テスト', '投稿がありません。', '</li>';
						echo '</ul>';
					}
					wp_reset_postdata(); //クエリのリセット
				}

			endforeach;
			wp_reset_postdata();

		endif;
		?>
	</article>
	<!-- ▲ 近くのおススメ : 終了-->

	<!-- ▼ いいねボタン・SNSシェアのショートコード : 開始-->
	<?php echo do_shortcode('[wp_ulike]'); ?>
	<?php echo do_shortcode('[addtoany]'); ?>
	<!-- ▲ いいねボタン・SNSシェアのショートコード : 終了-->

</main>

<!-- ▼ フッター : 開始-->
<?php get_footer(); ?>
<!-- ▲ フッター : 終了-->
