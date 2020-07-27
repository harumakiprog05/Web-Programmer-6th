<!-- ▼ ヘッダー : 開始 -->
<?php get_header('front'); ?>
<!-- ▲ ヘッダー : 終了 -->
<main>
	<section class="site_about">
		<div class="container">
			<h2 class="site_about_title fun_ftcolor_dark">とくしまの自然と文化に<br class="sp" />癒されに行こう</h2>

			<div class="site_about_content">
				<p>
					あなたはどんな時に癒されますか？自然の中でアクティブに楽しむ静かに芸術を感じココロを豊かにする旨いものをおなかいっぱい食べて満たされるとくしまには、まだまだ知らない魅力がいっぱいあります当サイト『あわいやし』では、「ココロ」と「カラダ」が癒される場所を「楽しい（たのしい）」「静か（しずか）」「旨い（うまい）」に分けてご紹介します。
				</p>

				<p>
					週末に阿波の癒しを感じてみませんか？　"ゆっくりするから見えてくるもの"があるはずです。
				</p>
			</div>

			<h3 class="contents_copy">あわいやしの癒しコンテンツ</h3>
			<ul class="top_category_set">
				<li class="fun fun_color_dark top_circle_set">楽</li>
				<li class="calm calm_color_dark top_circle_set">静</li>
				<li class="tasty tasty_color_dark top_circle_set">旨</li>
			</ul>
			<span class="site_about_end fun_ftcolor_dark">今度の休みは、<br class="sp" />どんな癒しでゆっくりしますか？</span>
		</div>
	</section>

	<section class="main_category_description">
		<div class="container">
			<h2 class="global_section_title">～あわいやしスポット～</h2>
		</div>

		<section class="fun_category">
			<div class="fun_category_image"></div>
			<div class="container">
				<span class="fun fun_color_dark grande_circle_set">楽</span>

				<div class="categry_description">
					<h3 class="category_catch_copy fun_ftcolor_dark">とくしまの自然を感じる、楽しいひととき。</h3>
					<p>
						<!--自然の中でアクティブに過ごすことで<br> -->
						「ココロ」と「カラダ」を癒してみませんか。<br />
						一緒に過ごす大切なひとの笑顔を見て癒されてみませんか。<br />
						まだまだ知らない楽しみ方がとくしまにあります。
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

				<button onclick="location.href='<?php echo esc_url(get_term_link(2)); ?>'" class="spot_more fun_color_dark">楽スポット一覧へ <i class="fas fa-chevron-right"></i></button>

			</div>
		</section>


		<section class="calm_category">
			<div class="calm_category_image"></div>

			<div class="container">
				<span class="calm calm_color_dark grande_circle_set">静</span>
				<div class="categry_description">
					<h3 class="category_catch_copy calm_ftcolor_dark">とくしまの自然を感じる、楽しいひととき。</h3>
					<p>
						静かな時を過ごして、「わたし」と向き合う<br />日常の喧騒を離れ、音に耳を澄ませてみませんか<br />「何もしない贅沢」をとくしまで
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

		<section class="tasty_category">
			<div class="tasty_category_image"></div>

			<div class="container">
				<span class="tasty tasty_color_dark grande_circle_set">旨</span>
				<div class="categry_description">
					<h3 class="category_catch_copy tasty_ftcolor_dark">とくしまの自然を感じる、楽しいひととき。</h3>
					<p>
						食べて、満たして、癒される<br />
						とくしまの旨いもの自然の旨いもの<br />
						どこか懐かしさや安心を与えてくれる、旨いもので癒される
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
			<h2 class="global_section_title fun_ftcolor_dark">
				ゆっくりのんびり<br class="sp" />
				あわいやしの旅
			</h2>
			<h3>～モデルコース～</h3>
			<div class="modelcose_slide_wrap">
				<img src="<?php echo esc_url(get_theme_file_uri("image/main_visual_img_01.jpg")); ?>" alt="" />
				<img src="<?php echo esc_url(get_theme_file_uri("image/main_visual_img_02.jpg")); ?>" alt="" />
				<img src="<?php echo esc_url(get_theme_file_uri("image/main_visual_img_03.jpg")); ?>" alt="" />

			</div>

			<div class="model_course_description">
				<p>
					徳島になじみのある方から、初めての方まで癒される<br class="sp" />
					「楽」「静」「旨」をふんだんに盛り込んだモデルコースをご紹介します。<br />
					週末、ご家族で新たな癒しを探しませんか？
				</p>
			</div>
		</div>
	</section>

	<h2 class="global_section_title">インスタグラム</h2>
	<?php echo do_shortcode('[instagram-feed]'); ?>
	<section class="instagram">
		<div class="insta_container">
			<div class="container">
				<h3 class="insta_hashtag_title">
					#あわいやし
				</h3>
				<i class="fab fa-instagram"></i>
				<p>
					Instagramにとくしまのいやしを投稿<br />
					あなただけのお気に入りスポットを紹介しよう！
				</p>

				<button class="more calm_bdcolor_dark">Instagram</button>

				<!-- ここにインスタのAPI -->
			</div>
		</div>
	</section>
</main>

<!-- ▼ フッター : 開始-->
<?php get_footer(); ?>
<!-- ▲ フッター : 終了-->
