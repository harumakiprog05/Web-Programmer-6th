<!-- ▼ ヘッダー : 開始-->
<?php get_header('subpage'); ?>
<!-- ▲ ヘッダー : 終了-->
<?php
$modal_count = 0;
$spot_title = get_the_title();
$sudachi_visual = ['view', 'natural', 'relax', 'refresh', 'healthy', 'communication', 'local', 'open'];
$spot_tag_info = ['絶景が楽しめる、自然を眺めがら楽しめる場所', '', '', '', '', '', '', ''];
$main_cat = get_category_parent($post, 'spot_cat');

?>

<main>
	<section class="main_category_description">
		<!-- ▼ スポット個別記事ループ : 開始-->
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : ?>
				<?php the_post(); ?>
				<!-- <section <?php post_class(); ?>> -->
				<!-- ▼ トップイメージ : 開始-->
				<div class="single_eye_catch">
					<img src="<?php echo CFS()->get('top_image'); ?>" alt="">
				</div>

				<nav>
					<?php breadcrumb(); ?>
				</nav>


				<section>
					<!-- 記事タイトル -->
					<div class="section_hedding single_title">
						<?php the_title('<h2>', '</h2>'); ?>
					</div>
					<!-- 癒しの一言 -->
					<div class="single_description">
						<p><?php echo CFS()->get('iyashi_point'); ?></p>
						<span class="title_under_bar"></span>
					</div>
				</section>

				<!-- モーダルウィンドウ -->

				<section class="modal_wrap">
					<div class="content">
						<h2>癒しのポイント</h2>
						<a class="js-modal-open" href="">
							<div class="sudachi_point">
								<ul>
									<?php
									$spot_tag_terms = get_the_terms($post->id, 'spot_tag');
									foreach ($spot_tag_terms as $term) : ?>
										<li>
											<!-- <?php echo $term->slug; ?> -->
											<img class="sudachi_visual" src="<?php echo esc_url(get_theme_file_uri("image/$term->slug.png")); ?>" alt="" />
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</a>
					</div>
					<div class="modal js-modal">
						<div class="modal__bg js-modal-close"></div>
						<div class="modal__content">
							<p>
								すだちは何？？
							</p>
							<div class="inside_modal">
								<ul>
									<?php foreach ($sudachi_visual as $img) : ?>
										<li>
											<div class="sudachi_visual">
												<img src="<?php echo esc_url(get_theme_file_uri("image/$img.png")); ?>" alt="" />
											</div>
											<p><?php echo $spot_tag_info[$modal_count]; ?></p>
										</li>
									<?php $modal_count++;
									endforeach; ?>
								</ul>
							</div>
							<a class="js-modal-close" href="">閉じる</a>
						</div>
						<!--modal__inner-->
					</div>
				</section>
				<!--modal-->


				<!-- ▼ 施設情報・地図 : 開始-->
				<?php $slug = $post->post_name; ?>
				<?php
				// スラッグの「-(ハイフン)」以降をカット
				$slug = cut_string($slug);
				?>
				<div class="info_actab">
					<input id="info_actab_one" type="checkbox" name="tabs" />
					<label class="label_cross fun_color_dark" for="info_actab_one">
						<h3>詳細情報</h3>
					</label>
					<!-- 中身 -->
					<div class="info_actab_content">
						<section class="table_section container">
							<table>
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
										<tr>
											<th>名称</th>
											<td><?php echo CFS()->get('spot_name'); ?><br /></td>
										</tr>
										<tr>
											<th>住所</th>
											<td>
												〒<?php echo CFS()->get('postal_code'), ' ', CFS()->get('address'); ?>
											</td>
										</tr>
										<tr>
											<th>電話番号</th>
											<td><?php echo CFS()->get('tel'); ?><br /></td>
										</tr>
										<tr>
											<th>営業時間</th>
											<td><?php echo CFS()->get('sales_hours'); ?></td>
										</tr>
										<tr>
											<th>定休日</th>
											<td><?php echo CFS()->get('holiday'); ?><br /></td>
										</tr>
										<tr>
											<?php $fee = $main_cat->name == '旨' ? '予算' : '料金'; ?>
											<th><?php echo $fee; ?></th>
											<td><?php echo CFS()->get('fee'); ?><br />
											</td>
										</tr>
										<tr>
											<th>公式HP</th>
											<td class="">
												<?php echo CFS()->get('url'); ?>
											</td>
										</tr>
										<tr>
											<th>アクセス</th>
											<td><?php echo CFS()->get('access'); ?><br /></td>
										</tr>
										<tr>
											<th>駐車場料金</th>
											<td><?php echo CFS()->get('parking_fee'); ?></td>
										</tr>
										<tr>
											<th>駐車場詳細</th>
											<td><?php echo CFS()->get('parking'); ?></td>
										</tr>
										<tr>
											<th>その他</th>
											<td><?php echo CFS()->get('other'); ?><br /></td>
										</tr>
										<tr>
											<th>施設の設備・特徴</th>
											<td><?php echo CFS()->get('spot_feature'); ?><br /></td>
										</tr>
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
								<?php else : ?>
									<tr>
										<th>施設情報がありません。</th>
									</tr>
								<?php endif;
								wp_reset_postdata(); //クエリのリセット
								?>
							</table>
							<div class="single_map">
								<?php echo $gmap; ?>
							</div>
						</section>
					</div>
				</div>
				<!-- ▲ 施設情報・地図 : 終了-->

				<!-- 記事コンテンツ -->
				<div class="single_page_contents container">
					<?php
					$loop = CFS()->get('article_loop');
					foreach ($loop as $row) :
					?>
						<?php if (!empty($row['spot_img2'])) :
							echo '<div class="image_wrap">';
						endif; ?>

						<img class="single_visual" src="<?php echo $row['spot_img1']; ?>" alt="" />

						<?php if (!empty($row['spot_img2'])) :
							echo '<img class="single_visual" src="', $row['spot_img2'], '" alt="" />';
							echo '</div>';
						endif; ?>

						<p class="single_text"><?php echo $row['spot_text']; ?></p>
					<?php endforeach; ?>
				</div>

			<?php endwhile; ?>
		<?php endif; ?>
		<!-- ▲ スポット個別記事ループ : 終了-->


		<!-- ▼ 近くのおススメ : 開始-->
		<?php echo '現在の記事：', $spot_title; ?>
		<div class="spot_wrap">
			<ul class="article_end_spot container">
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
								'post_type' => 'spot',
								'name' => $spot_slug
							);
							$customPosts = get_posts($args);
							if ($customPosts) {
								foreach ($customPosts as $post) {
									setup_postdata($post);
									// 現在の記事と異なるタイトルの場合出力
									if ($spot_title != get_the_title()) {
										echo '<li>';
										echo '<div>';
										echo get_thumbnail($post, 'tumbnail');
										echo '</div>';
										echo the_title('<p>', '</p>');
										echo '</li>';
										$count++;
									}
								}
							}
							wp_reset_postdata(); //クエリのリセット
						}
					endforeach;
					wp_reset_postdata();
				endif;
				?>
			</ul>
		</div>
		<!-- ▲ 近くのおススメ : 終了-->
	</section>


	<!-- ▼ いいねボタン・SNSシェアのショートコード : 開始-->
	<?php echo do_shortcode('[wp_ulike]'); ?>
	<?php echo do_shortcode('[addtoany]'); ?>
	<!-- ▲ いいねボタン・SNSシェアのショートコード : 終了-->

</main>

<!-- ▼ フッター : 開始-->
<?php get_footer(); ?>
<!-- ▲ フッター : 終了-->
