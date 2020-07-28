<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo("charset"); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&family=Noto+Serif&display=swap" rel="stylesheet">

  <!--favicon-->
  <link rel="icon" type="image/png" href="<?php echo esc_url(get_theme_file_uri("image/favicon/favicon-32x32.png")); ?>" />
  <link rel="apple-touch-icon" href="<?php echo esc_url(get_theme_file_uri("image/favicon/apple-touch-icon.png")); ?>">
  <link rel="apple-touch-icon" href="<?php echo esc_url(get_theme_file_uri("image/favicon/android-chrome-512x512.png")); ?>">

  <!--CDNでFontAwsome読み込む-->
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&family=Noto+Serif&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/earlyaccess/hannari.css" rel="stylesheet">

  <!-- <title>あわいやし</title> -->

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header class="toppage_header">

    <!-- ▼ スマホ用ナビゲーション : 開始 -->
    <nav class="spgnav">
      <div class="el_humburger">
        <!-- ▼ ハンバーガーボタン : 終了開始 -->
        <div class="el_humburger_wrapper">
          <span class="el_humburger_bar top"></span>
          <span class="el_humburger_bar middle"></span>
          <span class="el_humburger_bar bottom"></span>
        </div>
      </div>
      <!-- ▲ ハンバーガーボタン : 終了 -->

      <!-- ▼ ハンバーガー展開 : 終了開始 -->
      <div class="gnav_inner">
        <div class="gnav_item">
          <a href="<?php echo home_url('/'); ?>"><img class="gnav_logo" src="<?php echo esc_url(get_theme_file_uri("image/logo_black.png")); ?>" width="70" alt="ロゴ" /></a>
        </div>
        <div class="gnav_menu">
          <a href="<?php echo esc_url(get_term_link(2)); ?>">
            <div class="gnav_item">
              <span class="fun fun_color_dark tall_circle_set">楽</span>-たのしい-
            </div>
          </a>
          <a href="<?php echo esc_url(get_term_link(3)); ?>">
            <div class="gnav_item">
              <span class="calm calm_color_dark tall_circle_set">静</span>-しずか-
            </div>
          </a>

          <a href="<?php echo esc_url(get_term_link(4)); ?>">
            <div class="gnav_item">
              <span class="tasty tasty_color_dark tall_circle_set">旨</span>-うまい-
            </div>
          </a>

          <a href="<?php echo esc_url(get_post_type_archive_link('model')); ?>">
            <div class="gnav_item">モデルコース</div>
          </a>

          <a href="<?php echo home_url('/?s=&post_type=spot'); ?>">
            <div class="gnav_item">検索</div>
          </a>
        </div>
      </div>
      <!-- ▲ ハンバーガー展開 : 終了 -->
    </nav>
    <!-- ▲ スマホ用ナビゲーション : 終了 -->


    <!-- ▼ メインビジュアル : 開始 -->
    <div class="main_visual_contain">
      <div id="main_visual" class="main_visual">
        <div class="main_visual_images">
          <ul>
            <li><img class="main_visual_image" src="<?php echo esc_url(get_theme_file_uri("image/main_visual_img_01.jpg")); ?>" alt="top-image" /></li>
            <li><img class="main_visual_image" src="<?php echo esc_url(get_theme_file_uri("image/main_visual_img_02.jpg")); ?>" alt="top-image" /></li>
            <li><img class="main_visual_image" src="<?php echo esc_url(get_theme_file_uri("image/main_visual_img_03.jpg")); ?>" alt="top-image" /></li>
          </ul>
        </div>
        <div class="visual_logo_wrap">
          <img src="<?php echo esc_url(get_theme_file_uri("image/logo.png")); ?>" class="main_visual_logo" alt="" />
          <h2 class="visual_subtitle">とくしまの癒し再発見。</h2>
        </div>
        <h1 class="main_catch_copy">ゆっくりするから、<br />見えてくるもの。</h1>
      </div>
      <i class="fas fa-chevron-down"></i>

    </div>
    <!-- ▲ メインビジュアル : 終了 -->


    <!-- ▼ PC用ナビゲーション : 開始 -->
    <nav id="pcgnav" class="pcgnav theme_color_dark">
      <div class="container">

        <ul class="flex">
          <li>
            <a href="<?php echo home_url('/'); ?>">
              <img class="gnav_logo" src="<?php echo esc_url(get_theme_file_uri("image/logo.png")); ?>" alt="あわいやしロゴ">
            </a>
          </li>
          <li>
            <a href="<?php echo esc_url(get_term_link(2)); ?>">
              <span class="fun_color_dark nav_circle_set">楽</span>-たのしい-
            </a>
          </li>
          <li>
            <a href="<?php echo esc_url(get_term_link(3)); ?>">
              <span class="calm_color_dark nav_circle_set">静</span>-しずか-
            </a>
          </li>
          <li>
            <a href="<?php echo esc_url(get_term_link(4)); ?>">

              <span class="tasty_color_dark nav_circle_set">旨</span>-うまい-
            </a>
          </li>
          <li>
            <a href="<?php echo esc_url(get_post_type_archive_link('model')); ?>">
              モデルコース
            </a>
          </li>
          <li>
            <a href="<?php echo home_url('/?s=&post_type=spot'); ?>">
              <i class="fas fa-search"></i> 検索
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- ▲ PC用ナビゲーション : 終了 -->

  </header>
