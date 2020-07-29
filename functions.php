<?php

/**
 * awaiyashi functions and definitions
 *
 * @package WordPress 5.4.2
 * @subpackage awaiyashi
 * @since awaiyashi 1.0
 */

/**
 * <index>
 *
 * ┗テーマのセットアップ
 *    ┗タイトルを変更
 * ┗CSS・JavaScriptの読み込み
 * ┗パンくずリストの作成
 *    ┗アーカイブの余計なタイトルを削除
 * ┗カスタム投稿タイプの作成
 *    ┗カスタムタイプ ― spot
 *    ┗カスタムタイプ ― model
 *    ┗カスタムタイプ ― info
 * ┗カスタムタクソノミーの作成
 *    ┗カテゴリ、タグ ― spot
 *    ┗カテゴリ、タグ ― model
 *    ┗カテゴリ、タグ ― info
 * ┗カスタム投稿spotのみ検索
 * ┗SQL文を使用して絞り込み検索
 * ┗親カテゴリーの取得関数
 * ┗スラッグの「-」以降をカットする関数
 * ┗ヘッダーバンドの条件分岐
 * ┗検索ページの地図(svg)画像のpath
 * ┗検索ページの配列作成関数(タクソノミークエリー)
 * ┗検索ページの配列作成関数(WPクエリー)
 * ┗サムネイルの有無確認と表示
 */

// コンテンツ幅をセット
global $content_width;
if (!isset($content_width)) {
	$content_width = 723;
}


//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
// テーマのセットアップ
//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
function custom_theme_setup()
{
	// head内にフィードリンクを出力する
	add_theme_support('automatic-feed-links');

	// タイトルタグを動的に出力
	add_theme_support("title-tag");

	// ブロックエディター用のCSSを有効化
	add_theme_support("wp-block-styles");

	// 埋め込みコンテンツをレスポンシブ対応に
	add_theme_support("responsive-embeds");

	// アイキャッチ画像を有効化
	add_theme_support("post-thumbnails");
	set_post_thumbnail(231, 177, false);

	// // カスタムメニュー有効化、メニューの位置を設定
	// register_nav_menus(
	// 	array(
	// 		"globalnav" => "グローバルナビゲーション",
	// 	)
	// );
}
add_action("after_setup_theme", "custom_theme_setup");
// ▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽
// タイトルを変更
// △△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△
function change_title($title)
{
	if (is_search()) {
		$title['title'] = '検索ページ';
	} elseif (is_404()) {
		$title['title'] = 'お探しのページは見つかりません';
	}
	return $title;
};
add_filter('document_title_parts', 'change_title');


//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
// CSS・JavaScriptの読み込み
//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
function myportfolio_scripts()
{
	// ▼▼▼▼▼リセットCSSの読み込み
	wp_enqueue_style(
		"reset-style",
		get_template_directory_uri() . "/css/reset.css"
	);
	// ▼▼▼▼▼ベースCSSの読み込み
	wp_enqueue_style(
		"base-style",
		get_template_directory_uri() . "/css/base.css"
	);
	// ▼▼▼▼▼スタイルCSSの読み込み
	wp_enqueue_style(
		"main-style",          // ハンドル名
		get_stylesheet_uri(),  // ファイルのパス
		array(),               // 依存関係
		"1.0",                 // バージョン指定
		"all"                  // メディアタイプ
	);

	if (!is_admin()) {
		// ▼▼▼▼▼WordPress 本体の jQuery を登録解除
		wp_deregister_script('jquery');
		// ▼▼▼▼▼jQuery を CDN から読み込む
		wp_enqueue_script(
			'jquery',
			'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js',
			array(),
			'3.5.1',
			// true //</body> 終了タグの前で読み込み
		);
		wp_enqueue_script(
			'jquery UI',
			'https://ajax.aspnetcdn.com/ajax/jquery.ui/1.12.1/jquery-ui.min.js',
			array('jquery'),
			'1.12.1',
		);
	}
	// ▼▼▼▼▼ベースJSの読み込み
	wp_enqueue_script(
		'base-script',
		get_template_directory_uri() . '/js/jQuery.js',
		array('jquery'),
		filemtime(get_theme_file_path('/js/jQuery.js')),
		true
	);
	// ▼▼▼▼▼スリックJSの読み込み
	wp_enqueue_script(
		'slick-min-script',
		get_template_directory_uri() . '/js/slick.min.js',
		array('jquery'),
		filemtime(get_theme_file_path('/js/slick.min.js')),
		true
	);
	// ▼▼▼▼▼カスタム投稿spotタクソノミーアーカイブの場合
	if (is_tax('spot_cat')) {
		// archive-spot.jsの読み込み
		wp_enqueue_script(
			'spot-cat-script',
			get_template_directory_uri() . '/js/archive-spot.js',
			array('jquery'),
			filemtime(get_theme_file_path('/js/archive-spot.js')),
			true
		);
	}
	// ▼▼▼▼▼カスタム投稿modelアーカイブの場合
	if (is_post_type_archive('model')) {
		wp_enqueue_script(
			'archive-model-script',
			get_template_directory_uri() . '/js/archive-model.js',
			array('jquery'),
			filemtime(get_theme_file_path('/js/archive-model.js')),
			true
		);
	}
	// ▼▼▼▼▼検索ページの場合
	if (is_post_type_archive('spot')) {
		wp_enqueue_script(
			'search-script',
			get_template_directory_uri() . '/js/search.js',
			array('jquery'),
			filemtime(get_theme_file_path('/js/search.js')),
			true
		);
	}
	// ▼▼▼▼▼カスタム投稿model投稿ページの場合
	if (is_singular('model')) {
		wp_enqueue_script(
			'single-model-script',
			get_template_directory_uri() . '/js/jQuery-modelsingle.js',
			array('jquery'),
			filemtime(get_theme_file_path('/js/jQuery-modelsingle.js')),
			true
		);
	}
	// ▼▼▼▼▼カスタム投稿spot投稿ページの場合
	if (is_singular('spot')) {
		wp_enqueue_script(
			'single-spot-script',
			get_template_directory_uri() . '/js/single-spot.js',
			array('jquery'),
			filemtime(get_theme_file_path('/js/single-spot.js')),
			true
		);
	}
}
add_action("wp_enqueue_scripts", "myportfolio_scripts");


//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
// パンくずリストの作成
//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
function breadcrumb()
{
	// ▽▽▽▽▽ カテゴリー・シングルページのループとリンク出力関数 ▽▽▽▽▽
	function breadcrumb_roop_cat($parent_link, $home_link)
	{
		// 空配列を定義
		$cat_list = array();

		// ▼ 親カテゴリーが0になるまでループ
		while ($parent_link != 0) {
			// 親カテゴリーの情報を取得
			$cat = get_category($parent_link);
			// 親カテゴリーのリンクを取得
			$cat_link = get_category_link($parent_link);
			// 指定した配列の先頭に要素を追加
			// array_unshift ( 第1引数：指定配列 , 第2引数：追加する要素の値 )
			array_unshift($cat_list, '<li><a href="' . $cat_link . '">' . $cat->name . '</a></li>');
			// 親カテゴリーのIDを取得
			$parent_link = $cat->parent;
		}
		// ▼ パンくずリストを出力
		// homeのリンク(liタグ)を出力
		echo $home_link;
		// 親カテゴリーのリンク(liタグ)をループで出力
		foreach ($cat_list as $value) {
			echo $value;
		}
	}


	// ▽▽▽▽▽ homeのリンク(liタグ)を変数へ代入 ▽▽▽▽▽
	$home = '<li><a href="' . get_bloginfo('url') . '" >HOME</a></li>';

	// liタグを格納するulタグを開く
	echo '<ul class="breadcrumb">';

	// ▽▽▽▽▽ フロントページの場合処理なし ▽▽▽▽▽
	if (is_front_page()) {

		// ▽▽▽▽▽ カテゴリーページの場合 ▽▽▽▽▽
	} else if (is_category()) {
		// ページリクエストに応じた情報を取得
		$cat = get_queried_object();
		// 親カテゴリーのIDを取得
		$cat_id = $cat->parent;

		// homeとカテゴリーリンク(liタグ)の出力
		breadcrumb_roop_cat($cat_id, $home);
		// 表示カテゴリーページのリンク(liタグ)を出力
		the_archive_title('<li>', '</li>');

		// ▽▽▽▽▽ 絞り込み検索ページの場合 ▽▽▽▽▽
	} else if (is_post_type_archive('spot')) {
		echo $home;
		echo '<li>検索ページ</li>';

		// ▽▽▽▽▽ アーカイブ・タグページの場合 ▽▽▽▽▽
	} else if (is_archive()) {
		echo $home;
		the_archive_title('<li>', '</li>');

		// ▽▽▽▽▽ カスタム投稿model一覧ページの場合 ▽▽▽▽▽
	} else if (is_singular('model')) {
		echo $home;
		echo '<li><a href="' . get_post_type_archive_link('model') . '">' . 'モデルコース一覧</a></li>';
		the_title('<li>', '</li>');

		// ▽▽▽▽▽ カスタム投稿spot一覧ページの場合 ▽▽▽▽▽
	} else if (is_singular('spot')) {
		$post = get_the_ID();
		$term = get_category_parent($post, 'spot_cat');
		switch ($term->name) {
			case '楽':
				$term_id = 2;
				break;
			case '静':
				$term_id = 3;
				break;
			case '旨':
				$term_id = 4;
				break;
		}
		echo $home;
		echo '<li><a href="' . get_term_link($term_id) . '">' . $term->name . '</a></li>';
		the_title('<li>', '</li>');

		// ▽▽▽▽▽ 投稿ページの場合 ▽▽▽▽▽
	} else if (is_single()) {
		$cat = get_the_category();
		if (isset($cat[0]->cat_ID)) {
			$cat_id = $cat[0]->cat_ID;
		}
		breadcrumb_roop_cat($cat_id, $home);
		the_title('<li>', '</li>');

		// ▽▽▽▽▽ 固定ページの場合 ▽▽▽▽▽
	} else if (is_page()) {
		echo $home;
		the_title('<li>', '</li>');

		// ▽▽▽▽▽ 検索ページの場合 ▽▽▽▽▽
	} else if (is_search()) {
		echo $home;
		echo '<li>「' . get_search_query() . '」の検索結果</li>';

		// ▽▽▽▽▽ 404ページの場合 ▽▽▽▽▽
	} else if (is_404()) {
		echo $home;
		echo '<li>ページが見つかりません</li>';
	}

	// liタグを格納するulタグを閉じる
	echo "</ul>";
}
// ▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽▽
// アーカイブの余計なタイトルを削除
// △△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△△
add_filter('get_the_archive_title', function ($title) {
	if (is_category()) {
		$title = single_cat_title('', false);
	} elseif (is_tag()) {
		$title = single_tag_title('', false);
	} elseif (is_tax()) {
		$title = single_term_title('', false);
	} elseif (is_post_type_archive()) {
		$title = post_type_archive_title('', false);
	}
	return $title;
});


//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
// カスタム投稿の作成
//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
function create_my_post_types()
{
	// ▽▽▽▽▽ spot カスタム投稿タイプを登録 ▽▽▽▽▽
	register_post_type(
		'spot', //投稿タイプ名（識別子：半角英数字の小文字）
		array(
			'label' => 'スポット記事一覧',  //カスタム投稿タイプの名前（管理画面のメニューに表示される）
			'labels' => array(  //管理画面に表示されるラベルの文字を指定
				'add_new'            => '新規スポット記事追加',
				'edit_item'          => '新規スポット記事の編集',
				'view_item'          => '新規スポット記事を表示',
				'search_items'       => '新規スポット記事を検索',
				'not_found'          => '新規スポット記事は見つかりませんでした。',
				'not_found_in_trash' => 'ゴミ箱に新規スポット記事はありませんでした。'
			),
			'public'       => true,  // 管理画面及びサイト上に公開
			'description'  => 'カスタム投稿タイプ「スポット記事投稿」の説明文です。',  //説明文
			'hierarchicla' => false,  //コンテンツを階層構造にするかどうか
			'has_archive'  => true,  //trueにすると投稿した記事の一覧ページを作成することができる
			'show_in_rest' => false,  //Gutenberg を有効化
			'supports'     => array(  //記事編集画面に表示する項目を配列で指定することができる
				'title',  //タイトル
				'editor',  //本文の編集機能
				'thumbnail',  //アイキャッチ画像
				'excerpt',  //抜粋
				'custom-fields', //カスタムフィールド
				'revisions'  //リビジョンを保存
			),
			'menu_position' => 5, //「投稿」の下に追加
		)
	);

	// ▽▽▽▽▽ model カスタム投稿タイプを登録 ▽▽▽▽▽
	register_post_type(
		'model', //投稿タイプ名（識別子：半角英数字の小文字）
		array(
			'label'  => 'モデルコース一覧',  //カスタム投稿タイプの名前（管理画面のメニューに表示される）
			'labels' => array(  //管理画面に表示されるラベルの文字を指定
				'add_new'   => '新規モデルコース追加',
				'edit_item' => '新規モデルコースの編集',
				'view_item' => '新規モデルコースを表示',
			),
			'public'       => true,  // 管理画面及びサイト上に公開
			'description'  => 'カスタム投稿タイプ「モデルコース」の説明文です。',  //説明文
			'hierarchicla' => false,  //コンテンツを階層構造にするかどうか
			'has_archive'  => true,  //trueにすると投稿した記事の一覧ページを作成することができる
			'show_in_rest' => false,  //Gutenberg を有効化
			'supports'     => array(  //記事編集画面に表示する項目を配列で指定することができる
				'title',  //タイトル
				'editor',  //本文の編集機能
				'thumbnail',  //アイキャッチ画像
				'excerpt',  //抜粋
				'custom-fields', //カスタムフィールド
				'revisions'  //リビジョンを保存
			),
			'menu_position' => 6, //「投稿」の下に追加
		)
	);

	// ▽▽▽▽▽ info カスタム投稿タイプを登録 ▽▽▽▽▽
	register_post_type(
		'info', //投稿タイプ名（識別子：半角英数字の小文字）
		array(
			'label'  => '施設情報',  //カスタム投稿タイプの名前（管理画面のメニューに表示される）
			'labels' => array(  //管理画面に表示されるラベルの文字を指定
				'add_new'   => '施設情報追加',
				'edit_item' => '施設情報の編集',
				'view_item' => '施設情報を表示',
			),
			'public'       => true,  // 管理画面及びサイト上に公開
			'description'  => 'カスタム投稿タイプ「施設情報」の説明文です。',  //説明文
			'hierarchicla' => false,  //コンテンツを階層構造にするかどうか
			'has_archive'  => true,  //trueにすると投稿した記事の一覧ページを作成することができる
			'show_in_rest' => false,  //Gutenberg を有効化
			'supports'     => array(  //記事編集画面に表示する項目を配列で指定することができる
				'title',  //タイトル
				'editor',  //本文の編集機能
				'thumbnail',  //アイキャッチ画像
				'excerpt',  //抜粋
				'custom-fields', //カスタムフィールド
				'revisions'  //リビジョンを保存
			),
			'menu_position' => 7, //「投稿」の下に追加
		)
	);
}
//init アクションフックで登録
add_action('init', 'create_my_post_types');


//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
// カスタムタクソノミーの作成
//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
function add_taxonomy()
{
	// ▽▽▽▽▽ スポット記事タクソノミー ▽▽▽▽▽
	// スポット記事カテゴリー
	register_taxonomy(
		'spot_cat',
		'spot',
		array(
			'label'          => 'スポット記事カテゴリ',
			'singular_label' => 'スポット記事カテゴリ',
			'labels'         => array(
				'all_items'    => 'スポット記事カテゴリ一覧',
				'add_new_item' => 'スポット記事カテゴリを追加'
			),
			'public'            => true,
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'hierarchical'      => true
		)
	);
	// スポット記事タグ
	register_taxonomy(
		'spot_tag',
		'spot',
		array(
			'label'          => 'スポット記事のタグ',
			'singular_label' => 'スポット記事のタグ',
			'labels'         => array(
				'add_new_item' => 'スポット記事のタグを追加'
			),
			'public'            => true,
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'hierarchical'      => false
		)
	);

	// ▽▽▽▽▽ モデルコースタクソノミー ▽▽▽▽▽
	// モデルコースカテゴリー
	register_taxonomy(
		'model_cat',
		'model',
		array(
			'label'          => 'モデルコースカテゴリ',
			'singular_label' => 'モデルコースカテゴリ',
			'labels'         => array(
				'all_items'    => 'モデルコースカテゴリ一覧',
				'add_new_item' => 'モデルコースカテゴリを追加'
			),
			'public'            => true,
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'hierarchical'      => true
		)
	);
	// モデルコースタグ
	register_taxonomy(
		'model_tag',
		'model',
		array(
			'label'          => 'モデルコースのタグ',
			'singular_label' => 'モデルコースのタグ',
			'labels'         => array(
				'add_new_item' => 'モデルコースのタグを追加'
			),
			'public'            => true,
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'hierarchical'      => false
		)
	);

	// ▽▽▽▽▽ 施設情報タクソノミー ▽▽▽▽▽
	// 施設情報カテゴリー
	register_taxonomy(
		'info_cat',
		'info',
		array(
			'label'          => '施設情報カテゴリ',
			'singular_label' => '施設情報カテゴリ',
			'labels'         => array(
				'all_items'    => '施設情報カテゴリ一覧',
				'add_new_item' => '施設情報カテゴリを追加'
			),
			'public'            => true,
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'hierarchical'      => true
		)
	);
	// 施設情報タグ
	register_taxonomy(
		'info_tag',
		'info',
		array(
			'label'          => '施設情報のタグ',
			'singular_label' => '施設情報のタグ',
			'labels'         => array(
				'add_new_item' => '施設情報のタグを追加'
			),
			'public'            => true,
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'hierarchical'      => false
		)
	);
}
add_action('init', 'add_taxonomy');

//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
// カスタム投稿タイプのパーマリンク設定
//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
function my_post_type_link($link, $post)
{
	//個々のカスタム投稿のパーマリンク設定を、数字ベースに変更する。
	if ('rental' === $post->post_type) {
		return home_url('/archives/rental/' . $post->ID);
	} elseif ('tea' === $post->post_type) {
		return home_url('/archives/tea/' . $post->ID);
	} else {
		return $link;
	}
}
add_filter('post_type_link', 'my_post_type_link', 1, 2);

function my_rewrite_rules_array($rules)
{
	$new_rules = array(
		'archives/rental/([0-9]+)/?$' => 'index.php?post_type=rental&p=$matches[1]',
	);
	return $new_rules + $rules;
}
add_filter('rewrite_rules_array', 'my_rewrite_rules_array');


//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
// カスタム投稿spotのみ検索
//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
function SearchFilter($query)
{
	if ($query->is_search) {
		$query->set('post_type', 'spot');
	}
	return $query;
}
add_filter('pre_get_posts', 'SearchFilter');


//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
// SQL文を使用して絞り込み検索
//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
function my_custom_search($search, $wp_query)
{
	global $wpdb;

	if (!$wp_query->is_search)
		return $search;
	if (!isset($wp_query->query_vars))
		return $search;
	$search_words = explode(' ', isset($wp_query->query_vars['s']) ? $wp_query->query_vars['s'] : '');
	if (count($search_words) > 0) {
		$search = '';
		foreach ($search_words as $word) {
			if (!empty($word)) {
				$search_word = '%' . esc_sql($word) . '%';
				$search .= " AND (
                    {$wpdb->posts}.post_title LIKE '{$search_word}'
                    OR {$wpdb->posts}.post_content LIKE '{$search_word}'
                    OR {$wpdb->posts}.ID IN (
                        SELECT distinct tr.object_id
                        FROM {$wpdb->term_relationships} AS tr
                        INNER JOIN {$wpdb->term_taxonomy} AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
                        INNER JOIN {$wpdb->terms} AS t ON tt.term_id = t.term_id
                        WHERE t.name LIKE '{$search_word}'
                    OR t.slug LIKE '{$search_word}'
                    OR tt.description LIKE '{$search_word}'
                        )
                    OR {$wpdb->posts}.ID IN (
                        SELECT distinct post_id
                        FROM {$wpdb->postmeta}
                        WHERE meta_value LIKE '{$search_word}'
                        )
                    ) ";
			}
		}
	}
	return $search;
}
add_filter('posts_search', 'my_custom_search', 10, 2);


//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
// 親カテゴリーの取得関数
//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
function get_category_parent($post, $taxonomy_name)
{
	$cats = get_the_terms($post, $taxonomy_name);
	foreach ($cats as $val) :
		if ($val->parent == 0) :
			$cat = $val;
		endif;
	endforeach;
	return $cat;
}


//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
// スラッグの「-」以降をカットする関数
//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
function cut_string($slug)
{
	// 文字列に「-(ハイフン)」が含まれている場合
	if (strpos($slug, '-') !== false) {
		$slug = strstr($slug, '-', true);
		return $slug;
	} else {
		return $slug;
	}
}



//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
// ヘッダーバンドの条件分岐
//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
function header_band()
{
	$header_band_open = '<div class="header_band"><h1>';
	$header_band_close = '</h1></div>';

	$model_icon = '<i class="fas fa-car"></i>'; // 検索ページのアイコン
	$search_icon = '<i class="fas fa-search"></i>'; // モデルコース一覧のアイコン

	if (is_tax('spot_cat')) {
		// $text =  the_archive_title($header_band_open, $header_band_close);
	} elseif (is_singular('model')) {
		$text =  $header_band_open . 'モデルコース' . $model_icon . $header_band_close;
	} elseif (is_post_type_archive('model')) {
		$text =  the_archive_title($header_band_open, $model_icon . $header_band_close);
	} elseif (is_post_type_archive('spot')) {
		$text =  $header_band_open . '検　索' . $search_icon . $header_band_close;
	}
	return $text;
}


//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
// 検索ページの地図(svg)画像のpath
//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
function svg_path_array($num)
{
	$path = [
		'M1026.6,630l2.72-5.44,30,14,7-27s-8,1-11,1-2-9-2-9l4,3,4-11s4-12,14-15,18-12,7-12-28-16-28-16,13-2,14,0,7,7,12,1,23-40,23-40h-16c-12,0-12-13-10-10s8,2,8,2,1-3,0-15,3-20,3-20l12-16-6-9a16.78,16.78,0,0,1-12,3c-7-1-13,1-12,10s11,7,11,7l-4,7s-6-4-8-4-7,1-14,4a23.07,23.07,0,0,1-14,1l5-10,4,7s7-10,7-15,8-8,8-8v3c0,3,11-6,11-6a24.43,24.43,0,0,1-2-13c1-7-5-9-10-9s-16,13-16,13l-3,8-1-8-12,3s-17,5-10,10,2,9,2,9l-14,1c-14,1-24-5-38-6s-31,8-50,21-34,3-34,3-2,13-4,22-4,6-9,8,4,8,4,8l1,12a28,28,0,0,0-8,5c-3,3-8,12-13,11s-5-9-14-13c-3,4-13,2-13,2s-14,6-14,19,9,19,10,21,0,7-6,11,3,15,11,15,6-6,12-3,12,10,7,24-17,10-11,20,3,20,6,19,11-14,25-15,21,2,26,1,0-8,3-9,11-7,19-5,24,19,28,15,3-12,12-15,14-6,17-2,0,12,4,11,12,5,14,1-1-31,2-29S994.88,598.39,1026.6,630Z" transform="translate(-817.82 -422.02)',

		'M921.76,567.23a67.89,67.89,0,0,1-15.91,13.07,26.13,26.13,0,0,0-3.89-3.24c5.41-3,11.68-7.65,14.78-11.74ZM934,562.61v18.48H929V562.61H910.6v1.78h-4.81V526.71h4.81v31.48h50.16v4.42Zm19.07-9.3H917.34v-29.9H953.1ZM948.42,527H922v5.21h26.4Zm0,8.64H922V541h26.4Zm0,8.78H922v5.34h26.4Zm-3.23,20.72a162.94,162.94,0,0,1,15.64,12.14l-4.36,3.1a131.42,131.42,0,0,0-15.31-12.6Z" transform="translate(-817.82 -422.02)" style="fill:#fff;stroke:#fff;stroke-miterlimit:10',

		'M985.84,522.09h4.95V580.5h-4.95V565.71c-5.94,2.58-11.88,5.09-16.63,7.07l-2.31-4.95c4.82-1.52,11.88-4.29,18.94-7V542.35H969v-4.82h16.89Zm34.06,52.73c3,0,3.49-2.84,4-13.73a13.47,13.47,0,0,0,4.68,2.31c-.59,12-1.91,16.24-8.31,16.24h-10.56c-6.14,0-7.86-2-7.86-9v-48.5h5v21.78a101.56,101.56,0,0,0,16.3-11.82l3.63,4.23c-5.47,4.35-13,8.77-19.93,12.67v21.71c0,3.43.6,4.09,3.44,4.09Z" transform="translate(-817.82 -422.02)" style="fill:#fff;stroke:#fff;stroke-miterlimit:10',

		'M1317.91,462.22c-15,11-14,3-14,3s-10-4-17,0-7,3-7,3h-13s7-12,17-12,26-4,26-4,0-2-12-5-19,1-19,1l-2-6s-13,7-14,7-3-2-3-2l-4,5-4-6s-1,5-4,6-3-7-3-7,0,5-6,6,0,2-16,0c6-12,14-8,18-10s7-15,4-16a66.59,66.59,0,0,1-7-3l-1,4-14,1v6a19.27,19.27,0,0,1-9,3s-1,4,1-9c10-12,28-7,30-13,1.42-4.28-2.74-6-5.25-6.66,2.31.45,6.95,1.33,14.25,2.66,2-2-5-8,0-9s4,2,11,0c1-10,5-11,7-17s7-1,13-8,4-17,6-27c-7.56-.84-10.17-5.19-10.82-6.57,1.09.05,3.56,0,8.82-.43,3-9,6-8-9-14,0-11,5-19-16-22-24-10-8-3-25-27-6-24-18-37-23-39s-22,10-4,11c2,17-5,12-5,12s-8.5-1.5-13.5.5-3,14-3,14-2,2-3-3,5-15,5-15a84.09,84.09,0,0,0-10-4c-1.84-.62-3.59-2.74-5.13-5.38l-2.65-3.4c-1.26-.37-3.91-.17-7.22-3.22-6.34-5.84-15.42-7.67-26-3-2.05.9.55-.45-2-3-1-1-13-2-9,3s2,13,1,19-13,3-8,23c13-7,29-1,25,5s-2,6,0,9,6,10,0,17,2,9-5,18-10,4-11,10,0,4-15,8-12,12-22,13-3,1-10,5-6,3-13,2-8-3-12,3-3,8-7,8-6,2-12,8,1,8,6,14-5,14-15,20-12,7-25,12-16-1-23-6-7,4-16,8-17,2-26-1-8,7-15,10-9-2-11-4,2-15-8-12a30.54,30.54,0,0,1-18,0s3-11-4-15,0-12,0-21-23-23-27-25,0,4-2,10-3,2-11-11-4-4-14-3-18,1-25-1c-5.22-1.5-11,4.8-13.6,8.1a51.5,51.5,0,0,0,1.6,4.9,38.05,38.05,0,0,0,9,13c4,4-4,6-6,9s-15,8-19,8-14,4-19,6-4-5-13-5-5,6-7,8-5-1-8,0,0,7,1,9-7,3-8,3-6-1-10,0-12,1-18-2-9,0-10,0-4,7-8,9-3,2-7,2-12,1-15,5-7,1-15,3-4,6-7,11-12-2-17-1-4,5-10,12-8,0-17,0-10.11,9.83-10.11,9.83c6.48,6.58-.89,11.57-.89,21.17,0,10,11,15,11,15v12a26.21,26.21,0,0,1,16,21c2,16-8,16-6,28s18,22,13,26-4,11-4,13,10,9,10,9-6,4-10,19c-6,6-2,9,4,12s22-8,27-7,30-3,38-3,13,10,22,13,10-6,20-2,4-4,9,14c-13,8,1,19,1,19l-3,3,12,13s-8,2-19,13-16.5,9.5-16.5,9.5l1,11s-4,7,3,11,23,10,23,10-3,2-4,12c11,4,17,25,14,25s8,6,8,6-1,17,6,12,22-5,22-5,12,10,20,14,31,3,35,2,4-9,4-9l18,3,4,5,11,2v7l15,13,5-3-10-14,6-3-12-13c-12-13,8-22,8-22s4,5,19,4,29-7,29-7l-15-4s10,0,15-3,0-12,0-12l11-15,9-5a116.66,116.66,0,0,0,9-14c3-6-29-4-29-4l11-4s-12-3,0-5,20-20,20-20l4,4v-8s0,2,7-6c8,9,17,10,19-7,6,3,24,4,24,4s4-14,8-15,6-9,25-16a155.25,155.25,0,0,0,34-18s3,4,9,0-2-8,0-9,3-1,12,0c5-8,19-16,19-16s-5-22,0-24,9,3,9,3v-8l5,4s1,23,10,9,7-36,3-39,4-7,4-2,10,0,10,0v-10l7,3,5-3v7c0,3,10,3,10,3v-9l4-11s1,6,7,0,8-9,8-9l18,4,5,5-4-12s2,3,12,0,5-12,20-15c3.72-.75,6-1.12,7.39-1.27.72-1.76,2.67-4.73,7.61-4.73,7,0,6-3,12-8s58-27,58-27S1332.91,451.22,1317.91,462.22Z" transform="translate(-579.91 -236.4)',

		'M889.85,569.42a67.6,67.6,0,0,1-15.91,13.07,25.46,25.46,0,0,0-3.89-3.23c5.41-3,11.68-7.66,14.78-11.75Zm12.27-4.62v18.48H897V564.8H878.69v1.79h-4.81V528.9h4.81v31.48h50.16v4.42Zm19.07-9.3H885.43V525.6h35.76Zm-4.68-26.33h-26.4v5.21h26.4Zm0,8.64h-26.4v5.35h26.4Zm0,8.78h-26.4v5.35h26.4Zm-3.24,20.72a163.5,163.5,0,0,1,15.65,12.15l-4.36,3.1A130.4,130.4,0,0,0,909.25,570Z" transform="translate(-579.91 -236.4)" style="fill:#fff;stroke:#fff;stroke-miterlimit:10',

		'M967.53,534.25c-.33,2.44-.73,4.88-1.06,7H991v36.37c0,2.9-.73,4.22-2.84,4.95s-5.87.79-11.16.79a22.84,22.84,0,0,0-1.78-4.42c4.16.2,8.19.2,9.31.13s1.52-.4,1.52-1.45V545.8H945.16v37.48h-4.82v-42h21.45c.33-2,.59-4.48.85-7H936.77v-4.62h26.34c.19-2.38.39-4.69.46-6.67l5.28.6c-.2,1.91-.46,4-.73,6.07h26.33v4.62Zm.2,36.16V582H963V570.41H948.85v-4.09H963v-6.66h-12.8v-4h6.93a32.06,32.06,0,0,0-3.63-7.79l3.89-1a31.12,31.12,0,0,1,3.83,7.66l-3.57,1.12h11.82a79.23,79.23,0,0,0,3.76-9l4.42,1c-1.25,2.77-2.57,5.61-3.83,8h7.46v4H967.73v6.66h14.71v4.09Z" transform="translate(-579.91 -236.4)" style="fill:#fff;stroke:#fff;stroke-miterlimit:10',

		'M1161.23,429.84c2-6-6-11-6-11l-24-12,2.29-4.57c-31.72-31.56-26.29-17.43-29.29-19.43s0,25-2,29-10-2-14-1-1-7-4-11-8-1-17,2-8,11-12,15-20-13-28-15-16,4-19,5,2,8-3,9-12-2-26-1c-13.55,1-21.48,13.18-24.69,14.87,1.45,4.47,6.73,25.45-17.31,36.13-27,12-32-4-43,6s-11,32-19,30-24-16-26-3-8,25-17,25-14,2-25,22-19,31-19,31-21-2-23,7,6,11,3,19-19,22-14,26,21,6,21,6,8-12,15-10,15,2,25,1,6-10,14,3,9,17,11,11-2-12,2-10,27,16,27,25-7,17,0,21,4,15,4,15a30.54,30.54,0,0,0,18,0c10-3,6,10,8,12s4,7,11,4,6-13,15-10,17,5,26,1,9-13,16-8,10,11,23,6,15-6,25-12,20-14,15-20-12-8-6-14,8-8,12-8,3-2,7-8,5-4,12-3,6,2,13-2,0-4,10-5,7-9,22-13,14-2,15-8,4-1,11-10-1-11,5-18,2-14,0-17-4-3,0-9-12-12-25-5c-5-20,7-17,8-23s3-14-1-19,8-4,9-3c2.55,2.55,0,3.9,2,3,10.59-4.67,19.67-2.84,26,3,4.48,4.13,7.76,2.31,8,4-1-7-2-11-2-11s2-8,0-15a13.58,13.58,0,0,0-8-9l3-3s1-5,2-11,6-3,6-3a80.08,80.08,0,0,0-13-8l-12-6,8-1s14,4,22,5C1168.23,444.84,1171.23,437.84,1161.23,429.84Z" transform="translate(-752.77 -380.87)',

		'M933.67,566.55a67.76,67.76,0,0,1-15.9,13.06,26.14,26.14,0,0,0-3.9-3.23c5.42-3,11.69-7.66,14.79-11.75ZM946,561.93v18.48h-5.08V561.93H922.52v1.78H917.7V526h4.82V557.5h50.15v4.43ZM965,552.62H929.25V522.73H965Zm-4.69-26.33H933.94v5.21h26.39Zm0,8.65H933.94v5.34h26.39Zm0,8.77H933.94v5.35h26.39Zm-3.23,20.72a163.27,163.27,0,0,1,15.64,12.15l-4.36,3.1a131.41,131.41,0,0,0-15.31-12.61Z" transform="translate(-752.77 -380.87)" style="fill:#fff;stroke:#fff;stroke-miterlimit:10',

		'M1015.84,560.61a63.78,63.78,0,0,0,23.83,14.71,16.38,16.38,0,0,0-3.44,4.23,69.93,69.93,0,0,1-24.55-17.1v18h-4.95V562.65a69.28,69.28,0,0,1-24,16.77,19.93,19.93,0,0,0-3.43-4.1,63.65,63.65,0,0,0,23.36-14.71h-16v-24h20.06V531h-25.8v-4.62h25.8v-6.2h4.95v6.2h26.47V531h-26.47v5.54h21.19v24Zm-24.42-13.86h15.31v-6.27H991.42Zm0,10h15.31v-6.4H991.42Zm20.26-16.3v6.27h16.24v-6.27Zm16.24,9.9h-16.24v6.4h16.24Z" transform="translate(-752.77 -380.87)" style="fill:#fff;stroke:#fff;stroke-miterlimit:10',

		'M960.12,750s1.11-9.84,10.11-9.84,11,7,17,0,5-11,10-12,14,6,17,1-1-9,7-11,12,1,15-3,11-5,15-5,3,0,7-2,7-9,8-9,4-3,10,0,14,3,18,2,9,0,10,0,9-1,8-3-4-8-1-9,6,2,8,0-2-8,7-8,8,7,13,5,15-6,19-6,17-5,19-8,10-5,6-9a38.05,38.05,0,0,1-9-13,49.85,49.85,0,0,1-1.59-4.9l.48-.59c-1.18,1.43-1.89,2.49-1.89,2.49s-16-2-21-6,11-18,14-26-5-10-3-19,23-7,23-7,8-11,19-31,16-22,25-22,15-12,17-25,18,1,26,3,8-20,19-30,16,6,43-6c24-10.68,18.76-31.65,17.31-36.13h0a1.58,1.58,0,0,1-.31.13c-3,1,0-9-6-19s6-6,11-20-1-21-7-24-4,3-12,3-17-11-11-15,7-9,6-11-10-8-10-21,14-19,14-19l.42.08-.42-1.08s5-12-7-10-11-3-23-11-14,0-14,0,2,7-3,11-13-2-18-1-10-9-12-1-16,10-20,10,0-9-2-14-19,3-20,1-6-9-19-4-18-3-33,0-3,5-26,9-14-15-34,0-24-2-26,12-12,4-10,16,8,10,3,19-5,1-7,11a13.32,13.32,0,0,1-11,11s-13,5-34,5c-12-11-18,0-18,0s-3,10-14,3-16-1-19,5,1,9-10,14-5,19-9,19-20-6-22,3-5,9-8,11-12-5-12-5-8,3-11,3-8-10-8-10l-6,1-3-4h3c3,0-17-12-17-12s2-4-2-9a56.71,56.71,0,0,1-6-9l4-8s-14-9-26,8-17,5-25,0c-8,7-27,7-27,7s-6-15-16,0-14,1-21,7-11,5-11,5,2,10-3,14,1,9,0,11-17,5-23,6-7-10-6-10-16-9-16,0-14,9-16,9-2,8-8,17-18,7-28,17-8,28-8,28l-13,8s-4-3-13,0c-8.63,2.88-17.24,4.83-17.93,5,.38,0,2.45.37,6.93,12-13,7-11,24-11,24s8-6,10,3-11,12-5,18,9-2,5,8,7,0,8,14-7,3-14,13-3,18-3,18h10s6,11-2,18-4,17-7,26-21,6-15,19,0,6,11,17,13,4,21,9,4,3,30,6,16,7,21,10,7,14,23,7,26,1,26,1,31,3,40-7c14-9,16,4,23,6s9,12,9,12a80.51,80.51,0,0,1,17,29c16,5,24,1,24,1s0,5,9,13c14,1,12,4,12,4l9-12c9,5,20,4,23,2s11-16,8-37c11-9,25-10,37-14,3,15-1,13,16,22s26-13,34-6C959.56,749.41,959.85,749.69,960.12,750Z" transform="translate(-564.52 -290.07)',

		'M906.67,566.83a67.8,67.8,0,0,1-15.9,13.07,25.54,25.54,0,0,0-3.9-3.23c5.42-3,11.69-7.66,14.79-11.75ZM919,562.21v18.48h-5.08V562.21H895.52V564H890.7V526.31h4.82v31.48h50.16v4.42Zm19.07-9.3H902.25V523H938Zm-4.69-26.33H906.94v5.21h26.39Zm0,8.64H906.94v5.35h26.39Zm0,8.78H906.94v5.34h26.39Zm-3.23,20.72a161.7,161.7,0,0,1,15.64,12.14l-4.35,3.1a132.45,132.45,0,0,0-15.32-12.6Z" transform="translate(-564.52 -290.07)" style="fill:#fff;stroke:#fff;stroke-miterlimit:10',

		'M991.42,529.48V539h17.29v41.18h-5V576.4H961.12v4h-4.75V539H972v-9.5H953.53v-4.69h57.55v4.69Zm12.34,42.37V557.66c-.8,2.57-2.18,3.3-4.76,3.3h-6.53c-4.88,0-5.94-1.26-5.94-6V543.54h-9.7v3.1c0,6.2-2.18,13.46-11.75,18.21a14.48,14.48,0,0,0-3.43-3.23c9-4.29,10.56-10.1,10.56-15v-3H961.12v28.31Zm-17.23-42.37h-9.7V539h9.7Zm17.23,14.06H991.22V555c0,1.45.2,1.65,1.91,1.65h5.28c1.45,0,1.72-.59,1.85-5a13.1,13.1,0,0,0,3.5,1.58Z" transform="translate(-564.52 -290.07)" style="fill:#fff;stroke:#fff;stroke-miterlimit:10'
	];
	return $path[$num];
}


//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
// 検索ページの配列作成関数(タクソノミークエリー)
//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
function create_taxquery_array($terms, $spot_cat)
{
	if ($terms != NULL) {
		$taxquery_arr = array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'spot_tag',
				'field'    => 'slug',
				'terms'    => $terms,
				'operator' => 'AND', //ANDかIN
			),
			array(
				'taxonomy' => 'spot_cat',
				'field'    => 'slug',
				'terms'    => $spot_cat,
				'operator' => 'IN',
			),
		);
	} else {
		$taxquery_arr = array(
			'taxonomy' => 'spot_cat',
			'field'    => 'slug',
			'terms'    => $spot_cat,
			'operator' => 'IN',
		);
	}
	return $taxquery_arr;
}


//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
// 検索ページの配列作成関数(WPクエリー)
//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
function create_wp_query($tax_array, $rela, $s)
{
	$wpquery_arr = array(
		'paged'     => get_query_var('paged'),
		'post_type' => 'post',
		'tax_query' => $tax_array,
		'relation'  => $rela, //ANDかOR
		's'         => $s,
	);
	return $wpquery_arr;
}


//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
// サムネイルの有無確認と表示
//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
function set_thumbnail($size)
{
	if (has_post_thumbnail()) {
		the_post_thumbnail($size);
	} else {
		echo '<img src="', esc_url(get_theme_file_uri("image/noimage.png")), '" alt="">';
	}
}
function get_thumbnail($post, $size)
{
	if (get_the_post_thumbnail($post)) {
		return get_the_post_thumbnail($post, $size);
	} else {
		return '<img src="' . esc_url(get_theme_file_uri("image/noimage.png")) . '" alt="">';
	}
}
