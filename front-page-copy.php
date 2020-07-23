<!-- ▼ ヘッダー : 開始 -->
<?php get_header('front'); ?>
<!-- ▲ ヘッダー : 終了 -->


<!-- ▼ サイト説明 : 開始 -->
<section class="site_about">
	<div class="container">
		<h2 class="site_about_title">あわいやしとは</h2>

		<ul class="top_category_set">
			<li class="circle fun fun_color_dark tall_circle_set">楽</li>
			<li class="circle calm calm_color_dark tall_circle_set">静</li>
			<li class="circle yum yum_color_dark tall_circle_set">旨</li>
		</ul>

		<div class="site_about_content">

			<p>あなたはどんな時に癒されますか?</p>

			<p>自然の中でアクティブに楽しむ<br>
				静かに芸術を感じココロを豊かにする<br>
				旨いものをおなかいっぱい食べて満たされる</p>

			<p>とくしまには、<br>
				まだまだ知らない魅力がいっぱいあります<br>
				当サイト『あわいやし』では、「ココロ」と「カラダ」が癒される場所を<br>
				「楽」「静」「旨」に分けてご紹介します</p>

			<p>週末に阿波の癒しを感じてみませんか?<br>
				"ゆっくりするから見えてくるもの"があるはずです。</p>
		</div>
	</div>
</section>
<!-- ▲ サイト説明 : 終了 -->

<!-- ▼ メインカテゴリの説明 : 開始 -->
<section class="main_category_description">
	<div class="container">
		<h2 class="global_section_title">いやしスポット</h2>
	</div>
	</div>


	<section class="fun_category fun_color_light" id="fadeIn">
		<div class="container">
			<div class="spot_img_frame">
				<img class="spot_img" src="<?php echo esc_url(get_theme_file_uri("image/category_img.png")); ?>" alt="">
				<span class="circle fun fun_color_dark grande_circle_set">楽</span>
				<h3 class="category_catch_copy">自然と文化に触れ<br>楽しむひととき。</h3>

			</div>
			<div class="categry_description">
				<p>
					<!--自然の中でアクティブに過ごすことで<br> -->
					「ココロ」と「カラダ」を癒してみませんか。</p>
				<p>一緒に過ごす大切なひとの笑顔を見て癒されてみませんか。</p>
				<p>まだまだ知らない楽しみ方がとくしまにあります。</p>
				</p>
			</div>
			<a href="<?php echo esc_url(get_term_link(2)); ?>">
				<button class="spot_more fun_color_dark">楽スポット一覧へ　<i class="fas fa-chevron-right"></i></button></a>

		</div>
	</section>

	<section class="calm_category calm_color_light" id="fadeIn">
		<div class="container">
			<div class="spot_img_frame">
				<img class="spot_img" src="<?php echo esc_url(get_theme_file_uri("image/category_img.png")); ?>" alt="">
				<span class="circle calm calm_color_dark grande_circle_set ">静</span>
				<h3 class="category_catch_copy">自分に向き合う<br>静かなひととき。</h3>
			</div>
			<div class="categry_description">
				<p>静かな時を過ごして、「わたし」と向き合う</p>
				<p>日常の喧騒を離れ、音に耳を澄ませてみませんか</p>
				<p>「何もしない贅沢」をとくしまで</p>
			</div>
			<a href="<?php echo esc_url(get_term_link(3)); ?>">
				<button class="spot_more calm_color_dark">静スポット一覧へ　<i class="fas fa-chevron-right"></i></button>
				<div class="categry_background calm_color_light"></div>
			</a>

		</div>
	</section>

	<section class="yum_category yum_color_light" id="fadeIn">
		<div class="container">
			<div class="spot_img_frame">
				<img class="spot_img" src="<?php echo esc_url(get_theme_file_uri("image/category_img.png")); ?>" alt="">
				<span class="circle yum yum_color_dark grande_circle_set">旨</span>
				<h3 class="category_catch_copy">お腹にいやしを。<br>旨いひととき</h3>
			</div>
			<div class="categry_description">
				<p>食べて、満たして、癒される</p>
				<p>とくしまの旨いもの自然の旨いもの</p>
				<p>どこか懐かしさや安心を与えてくれる、旨いもので癒される</p>
			</div>
			<a href="<?php echo esc_url(get_term_link(4)); ?>">
				<button class="spot_more yum_color_dark">旨 スポット一覧へ　<i class="fas fa-chevron-right"></i></button>
				<div class="categry_background yum_color_light"></div>
			</a>

		</div>
	</section>

</section>
<!-- ▲ メインカテゴリの説明 : 終了 -->

<!-- ▼ モデルコースの紹介 : 開始 -->
<section class="awaiyashi_plan">
	<div class="container">
		<section class="main_category_description">

			<h2 class="global_section_title">あわいやしプラン
				<p>～モデルコース～</p>
			</h2>
			<ul id="modelCourseSlide">
				<li><a href=""><img src="" alt=""></a></li>
				<li><a href=""><img src="" alt=""></a></li>
				<li><a href=""><img src="" alt=""></a></li>
			</ul>
			<div class="model_course_description">
				<p>徳島になじみのある方から、初めての方まで癒される</p>
				<p>「楽」「静」「旨」をふんだんに盛り込んだモデルコースをご紹介します。</p>
				<p>週末、ご家族で新たな癒しを探しませんか？</p>
			</div>

		</section>
	</div>
</section>
<!-- ▲ モデルコースの紹介 : 終了 -->

<!-- ▼ Instagramプラグイン : 開始 -->
<section class="instagram">

	<div class="container">
		<div class="section_hedding">
			<h2 class="global_section_title">インスタグラム</h2>
		</div>
		<i class="fab fa-instagram"></i>
		<p>gallery</p>
		<?php echo do_shortcode('[instagram-feed]'); ?>
	</div>
</section>
<!-- ▲ Instagramプラグイン : 終了 -->

<!-- ▼ フッター : 開始-->
<?php get_footer(); ?>
<!-- ▲ フッター : 終了-->
