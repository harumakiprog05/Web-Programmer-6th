<?php

/**
 * awaiyashi functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage awaiyashi
 * @since awaiyashi 1.0
 */

/**
 * ＜index＞
 *
 * ┗カスタム投稿spotのみ検索
 * ┗テーマのセットアップ
 * ┗CSS・JavaScriptの読み込み
 * ┗パンくずリストの作成(自作関数)
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
 * ┗親カテゴリーの取得関数(自作関数)
 * ┗スラッグの「-」以降をカットする関数(自作関数)
 * ┗ヘッダーバンドの条件分岐
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
	if (is_tax('spot_cat')) {
		wp_enqueue_script(
			'spot-cat-script',
			get_template_directory_uri() . '/js/archive-spot.js',
			array('jquery'),
			filemtime(get_theme_file_path('/js/archive-spot.js')),
			true
		);
		wp_enqueue_script(
			'spot-cat-script2',
			get_template_directory_uri() . '/js/jquery.morphing.js',
			array('jquery'),
			filemtime(get_theme_file_path('/js/jquery.morphing.js')),
			true
		);
	}
	if (is_post_type_archive('model')) {
		wp_enqueue_script(
			'archive-model-script',
			get_template_directory_uri() . '/js/archive-model.js',
			array('jquery'),
			filemtime(get_theme_file_path('/js/archive-model.js')),
			true
		);
	}
	if (is_singular('model')) {
		wp_enqueue_script(
			'single-model-script',
			get_template_directory_uri() . '/js/jQuery-modelsingle.js',
			array('jquery'),
			filemtime(get_theme_file_path('/js/jQuery-modelsingle.js')),
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

		// ▽▽▽▽▽ アーカイブ・タグページの場合 ▽▽▽▽▽
	} else if (is_archive()) {
		echo $home;
		the_archive_title('<li>', '</li>');

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
// 親カテゴリーの取得関数(自作関数)
//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
function get_category_parent($post, $taxonomy_name)
{
	$cat = get_the_terms($post, $taxonomy_name);
	$cat = $cat[0];

	$cat_id = $cat->parent;
	while ($cat_id != 0) {
		$cat = get_term($cat_id, $taxonomy_name);
		$cat_id = $cat->parent;
	}
	return $cat;
}


//▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼△▼
// スラッグの「-」以降をカットする関数(自作関数)
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
	$search_icon = '<i class="fas fa-search"></i>';

	if (is_tax('spot_cat') || is_post_type_archive('model')) {
		$text =  the_archive_title($header_band_open, $header_band_close);
	} elseif (is_singular('model')) {
		$text =  $header_band_open . 'モデルコース' . $header_band_close;
	} elseif (is_post_type_archive('spot')) {
		$text =  $header_band_open . '検索' . $search_icon . $header_band_close;
	}
	return $text;
}
