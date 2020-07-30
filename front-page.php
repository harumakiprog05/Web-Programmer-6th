<!-- ▼ ヘッダー : 開始 -->
<?php get_header('front'); ?>
<!-- ▲ ヘッダー : 終了 -->
<main>
	<section class="site_about">
		<div class="container">
			<h2 class="site_about_title fun_ftcolor_dark">とくしまの自然と文化に<br class="sp" />癒されに行こう</h2>

			<!-- スマホ用サイト説明 -->
			<div class="info_actab sp_site_about">
				<input id="info_actab_one" type="checkbox" name="tabs" />
				<label class="area_serch_more fun_color_dark" for="info_actab_one">あわいやしとは</label>
				<div class="info_actab_content">
					<div class="site_about_content text-left">
						<p>
							<span class="centering">あなたはどんな時に癒されますか？</span>
							自然の中で思いきり身体を動かした時、静かな場所で過ごした時、美味しい物をお腹いっぱい食べた時・・・<br><br>

							豊かな自然に恵まれた徳島県は、自然がくれる「癒し」の宝庫だと思います。<br>
							『あわいやし』では、徳島の自然や文化が持つ癒しを「楽（たのしい）」「静（しずか）」「旨（うまい）」に分けてご紹介します。<br>
							世の中が急激に変わり始めたこの時代、自然の中で"ゆっくりするから見えてくるもの"があるはずです。
						</p>

						<p>
							週末に阿波の癒しを感じてみませんか？　"ゆっくりするから見えてくるもの"があるはずです。
						</p>
					</div>

				</div>
			</div>

			<!-- PC用サイト説明 -->
			<div class="site_about_content pc_site_about">
				<p>
					<span class="centering">あなたはどんな時に癒されますか？</span>
					自然の中で思いきり身体を動かした時、静かな場所で過ごした時、美味しい物をお腹いっぱい食べた時・・・<br><br>

					豊かな自然に恵まれた徳島県は、自然がくれる「癒し」の宝庫だと思います。<br>
					『あわいやし』では、徳島の自然や文化が持つ癒しを「楽（たのしい）」「静（しずか）」「旨（うまい）」に分けてご紹介します。<br>
					世の中が急激に変わり始めたこの時代、自然の中で"ゆっくりするから見えてくるもの"があるはずです。
				</p>

				<p>
					週末に阿波の癒しを感じてみませんか？　"ゆっくりするから見えてくるもの"があるはずです。
				</p>
			</div>





			<h3 class="contents_copy">あわいやしの癒しコンテンツ</h3>
			<ul class="top_category_set">
				<li class="fun fun_color_dark top_circle_set"><a href="#fun_button">楽</a></li>
				<li class="calm calm_color_dark top_circle_set"><a href="#calm_button">静</a></li>
				<li class="tasty tasty_color_dark top_circle_set"><a href="#tasty_button">旨</a></li>
			</ul>
			<span class="site_about_end fun_ftcolor_dark">今度の休みは、<br class="sp" />どんな癒しでゆっくりしますか？</span>
		</div>
	</section>

	<section class="main_category_description">
		<div class="container">
			<h2 class="global_section_title title_awaiyashi_spot">～あわいやしスポット～</h2>
		</div>

		<section class="fun_category" id="fun_button">
			<div class="fun_category_image"></div>
			<div class="container">
				<span class="fun fun_color_dark grande_circle_set">楽</span>

				<div class="categry_description">
					<h3 class="category_catch_copy fun_ftcolor_dark">とくしまの自然を感じる、楽しいひととき。</h3>
					<p class="text-left">
						自然の中でアクティブに過ごす事で心と身体を癒してみませんか。<br>
						一緒に過ごす大切なひとの笑顔を見て癒されてみませんか。徳島の大自然を楽しめるスポットをご紹介します。
					</p>
				</div>
				<div class="spot_slide_wrap">

					<!-- スライドショー記事ループ開始 -->

					<?php
					$cat_posts = get_posts(array(
						'post_type' => 'spot', // 投稿タイプ
						'spot_cat' => "fun", // カテゴリをスラッグで指定
						'posts_per_page' => 6, // 表示件数
						'orderby' => 'rand', // 表示順の基準
						'order' => 'DESC' // 昇順・降順
					));
					global $post;
					if ($cat_posts) : foreach ($cat_posts as $post) : setup_postdata($post);
					?>

							<!-- ループはじめ -->

							<!-- サムネイルを取得 -->
							<?php if (has_post_thumbnail()) {
								the_post_thumbnail(array(300, 230));
							} else { ?>
								<img src="<?php echo esc_url(get_theme_file_uri("image/noimage.png")); ?>" alt="">

							<?php } ?>

							<!-- ループおわり -->

					<?php endforeach;
					endif;
					wp_reset_postdata(); ?>


				</div>

				<button onclick="location.href='<?php echo esc_url(get_term_link(2)); ?>'" class="spot_more fun_color_dark">楽スポット一覧へ <i class="fas fa-chevron-right"></i></button>

			</div>
		</section>


		<section class="calm_category" id="calm_button">
			<div class="calm_category_image"></div>

			<div class="container">
				<span class="calm calm_color_dark grande_circle_set">静</span>
				<div class="categry_description">
					<h3 class="category_catch_copy calm_ftcolor_dark">日常を忘れる、静かなひととき。</h3>
					<p class="text-left">
						静かな時を過ごして、「わたし」と向き合う。徳島の自然や文化に触れて、新しい発見をする。<br>
						日常の喧騒を忘れ、心をリセットできる静かなスポットをご紹介します。
					</p>
				</div>
				<div class="spot_slide_wrap">

					<!-- スライドショー記事ループ開始 -->

					<?php
					$cat_posts = get_posts(array(
						'post_type' => 'spot', // 投稿タイプ
						'spot_cat' => "calm", // カテゴリをスラッグで指定
						'posts_per_page' => 6, // 表示件数
						'orderby' => 'rand', // 表示順の基準
						'order' => 'DESC' // 昇順・降順
					));
					global $post;
					if ($cat_posts) : foreach ($cat_posts as $post) : setup_postdata($post);
					?>

							<!-- ループはじめ -->

							<!--記事URLを取得-->
							<!-- サムネイルを取得 -->
							<?php if (has_post_thumbnail()) {
								the_post_thumbnail(array(300, 230));
							} else { ?>
								<img src="<?php echo esc_url(get_theme_file_uri("image/noimage.png")); ?>" alt="">

							<?php } ?>
							<!-- ループおわり -->

					<?php endforeach;
					endif;
					wp_reset_postdata(); ?>


				</div>

				<button onclick="location.href='<?php echo esc_url(get_term_link(3)); ?>'" class="spot_more calm_color_dark">静スポット一覧へ <i class="fas fa-chevron-right"></i></button>

				<div class="categry_background calm_color_light"></div>
			</div>
		</section>

		<section class="tasty_category" id="tasty_button">
			<div class="tasty_category_image"></div>

			<div class="container">
				<span class="tasty tasty_color_dark grande_circle_set">旨</span>
				<div class="categry_description">
					<h3 class="category_catch_copy tasty_ftcolor_dark">自然を五感で味わう、旨いひととき。</h3>
					<p class="text-left">
						休みはやはり美味しい物を食べて癒されたい。徳島には様々な「旨い」が揃っています。<br>
						自然の側で味わえる、旨いスポットをご紹介します。
					</p>
				</div>
				<div class="spot_slide_wrap">
					<!-- スライドショー記事ループ開始 -->

					<?php
					$cat_posts = get_posts(array(
						'post_type' => 'spot', // 投稿タイプ
						'spot_cat' => "tasty", // カテゴリをスラッグで指定
						'posts_per_page' => 6, // 表示件数
						'orderby' => 'rand', // 表示順の基準
						'order' => 'DESC' // 昇順・降順
					));
					global $post;
					if ($cat_posts) : foreach ($cat_posts as $post) : setup_postdata($post);
					?>

							<!-- ループはじめ -->

							<!--記事URLを取得-->
							<!-- サムネイルを取得 -->
							<?php if (has_post_thumbnail()) {
								the_post_thumbnail(array(300, 230));
							} else { ?>
								<img src="<?php echo esc_url(get_theme_file_uri("image/noimage.png")); ?>" alt="">

							<?php } ?>
							<!-- ループおわり -->

					<?php endforeach;
					endif;
					wp_reset_postdata(); ?>
				</div>

				<button onclick="location.href='<?php echo esc_url(get_term_link(4)); ?>'" class="spot_more tasty_color_dark">旨 スポット一覧へ <i class="fas fa-chevron-right"></i></button>

				<div class="categry_background tasty_color_light"></div>
			</div>
		</section>
	</section>

	<section class="awaiyashi_plan">
		<div class="container">
			<h2 class="global_section_title fun_ftcolor_dark title_modelcourse">
				ゆっくりのんびり<br class="sp" />
				あわいやしの旅
			</h2>
			<h3>～モデルコース～</h3>
			<div class="modelcose_slide_wrap">
				<img src="<?php echo esc_url(get_theme_file_uri("image/top_modelcourse_01.jpg")); ?>" alt="" />
				<img src="<?php echo esc_url(get_theme_file_uri("image/top_modelcourse_02.jpg")); ?>" alt="" />
				<img src="<?php echo esc_url(get_theme_file_uri("image/top_modelcourse_03.jpg")); ?>" alt="" />

			</div>

			<div class="model_course_description">
				<p class="text-left">
					自然がいっぱいの徳島。車で走ればすぐそこに「癒しの時間」があります。<br>
					ここでは、のんびり行ける癒しのモデルコースご紹介します。<br>
					次の休日は、ご家族やご友人と癒しの旅に出かけてみませんか？
				</p>
				<button onclick="location.href=' <?php echo esc_url(get_post_type_archive_link('model')); ?>'" class="spot_more theme_color_dark">
					モデルコース一覧へ<i class="fas fa-chevron-right"></i></button>
			</div>
		</div>
	</section>

	<h2 class="global_section_title title_instagram">インスタグラム</h2>
	<div class="container">
		<?php echo do_shortcode('[instagram-feed]'); ?>

	</div>

</main>

<!-- ▼ フッター : 開始-->
<?php get_footer(); ?>
<!-- ▲ フッター : 終了-->
