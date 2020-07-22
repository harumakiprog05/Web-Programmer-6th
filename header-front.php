<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&family=Noto+Serif&display=swap" rel="stylesheet">

  <!--CDNでFontAwsome読み込む-->
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

  <title>あわいやし</title>

  <?php wp_head(); ?>
</head>

<body>
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
          <a href="<?php echo home_url('/'); ?>"><img class="gnav_logo" src="<?php echo esc_url(get_theme_file_uri("image/logo.png")); ?>" width="70" alt="ロゴ" /></a>
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
              <span class="yum yum_color_dark tall_circle_set">旨</span>-うまい-
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

    <!-- ▼ PC用ナビゲーション : 開始 -->
    <nav id="pcgnav" class="pcgnav theme_color_dark">
      <div class="container">

        <ul class="flex">
          <a href="<?php echo home_url('/'); ?>">
            <li><img src="<?php echo esc_url(get_theme_file_uri("image/logo_white.png")); ?>" alt="あわいやしロゴ"> </li>
          </a>
          <a href="<?php echo esc_url(get_term_link(2)); ?>">
            <li><span class="circle fun_color_dark nav_circle_set">楽</span>-たのしい-</li>
          </a>
          <a href="<?php echo esc_url(get_term_link(3)); ?>">
            <li><span class="circle calm_color_dark nav_circle_set">静</span>-しずか-</li>
          </a>
          <a href="<?php echo esc_url(get_term_link(4)); ?>">
            <li>
              <span class="circle yum_color_dark nav_circle_set">旨</span>-うまい-
            </li>
          </a>
          <a href="<?php echo esc_url(get_post_type_archive_link('model')); ?>">
            <li>モデルコース</li>
          </a>
          <a href="<?php echo home_url('/?s=&post_type=spot'); ?>">
            <li><i class="fas fa-search"></i> 検索</li>
          </a>
        </ul>
      </div>
    </nav>
    <!-- ▲ PC用ナビゲーション : 終了 -->

    <!-- ▼ メインビジュアル : 開始 -->
    <!-- <div id="main_visual" class="main_visual">
      <img class="main_visual_logo" src="<?php echo esc_url(get_theme_file_uri("image/main_visual_img.png")); ?>" alt="top-image">
      <h1 class="main_catch_copy">ゆっくりするから、<br>見えてくるもの。</h1>
    </div> -->
    <!-- ▲ メインビジュアル : 終了 -->

    <!-- ▼ パンくずリスト : 開始-->
    <nav class="breadcrumb">
      <?php breadcrumb(); ?>
    </nav>
    <!-- ▲ パンくずリスト : 終了-->

  </header>
