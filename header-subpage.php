<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />

    <!--favicon-->
    <link rel="icon" type="image/png" href="<?php echo esc_url(get_theme_file_uri("image/favicon/favicon-32x32.png")); ?>" />
    <link rel="apple-touch-icon" href="<?php echo esc_url(get_theme_file_uri("image/favicon/apple-touch-icon.png")); ?>">
    <link rel="apple-touch-icon" href="<?php echo esc_url(get_theme_file_uri("image/favicon/android-chrome-512x512.png")); ?>">

    <!--CDNでFontAwsome読み込む-->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/earlyaccess/hannari.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&family=Noto+Serif&display=swap" rel="stylesheet" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="sidepage_header">

        <!--スマホ用ナビゲーション-->
        <div class="spheader">
            <div class="adjustment_height"></div>

            <?php echo header_band(); ?>

            <nav class="spgnav">
                <div class="el_humburger">
                    <!--ハンバーガーボタン-->
                    <div class="el_humburger_wrapper">
                        <span class="el_humburger_bar top"></span>
                        <span class="el_humburger_bar middle"></span>
                        <span class="el_humburger_bar bottom"></span>
                    </div>
                </div>

                <!-- ▼ ハンバーガー展開 : 開始 -->
                <div class="gnav_inner">
                    <div class="gnav_item">
                        <a href="<?php echo home_url('/'); ?>">
                            <img class="gnav_logo" src="<?php echo esc_url(get_theme_file_uri("image/logo_black.png")); ?>" width="70" alt="ロゴ" />
                        </a>
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
        </div>

        <!--PC用ナビゲーション-->
        <div class="pcheader">

            <div class="adjustment_height"></div>
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
                            <a href="<?php echo esc_url(get_term_link(4)); ?>"><span class="tasty_color_dark nav_circle_set">旨</span>-うまい-</a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(get_post_type_archive_link('model')); ?>">モデルコース
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

            <?php echo header_band(); ?>

        </div>

    </header>

    <!-- ▼ パンくずリスト : 開始-->
    <nav>
        <?php
        if (!is_singular('spot') && !is_tax('spot_cat')) {
            breadcrumb();
        }
        ?>
    </nav>
    <!-- ▲ パンくずリスト : 終了-->
