<!-- _/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/ -->

<!-- カスタム投稿タイプspotの絞り込み検索フォーム -->

<!-- _/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/ -->


<form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>spot/">

  <!-- ▼△▼△▼△ カスタム投稿タイプspotのタグ ▼△▼△▼△ -->
  <h2>カスタムspotタグ</h2>

  <!-- ▼ PHP : 開始---------------->
  <?php
  $spot_tag_args = array(
    'orderby' => 'name',
    'order' => 'ASC',
  );
  $spot_tags = get_terms('spot_tag', $spot_tag_args);
  foreach ($spot_tags as $spot_tag) :
  ?>

    <?php
    $url = $_SERVER['REQUEST_URI'];
    if (strstr($url, $spot_tag->slug) == true) :
    ?>
      <!-- ▼ HTML : 開始-->
      <label><input type="checkbox" name="get_tags[]" checked="checked" value="<?php echo $spot_tag->slug; ?>"><?php echo $spot_tag->name; ?></label>
      <!-- ▲ HTML : 終了-->
    <?php else : ?>
      <!-- ▼ HTML : 開始-->
      <label><input type="checkbox" name="get_tags[]" value="<?php echo $spot_tag->slug; ?>"><?php echo $spot_tag->name; ?></label>
      <!-- ▲ HTML : 終了-->
    <?php endif; ?>

  <?php endforeach; ?>
  <!-- ▲ PHP : 終了---------------->


  <!-- ▼△▼△▼△ カスタム投稿タイプinfoのカテゴリ ▼△▼△▼△ -->
  <h2>カスタムinfoカテゴリー</h2>

  <!-- ▼ PHP : 開始---------------->
  <?php
  $taxonomy_args = array(
    'orderby' => 'name',
    'order' => 'ASC',
  );
  $taxonomies = get_terms('info_cat', $taxonomy_args);

  foreach ($taxonomies as $info_cat) :
  ?>

    <?php
    $url = $_SERVER['REQUEST_URI'];
    if (strstr($url, $info_cat->slug) == true) :
    ?>
      <!-- ▼ HTML : 開始-->
      <label><input type="checkbox" name="get_cats[]" checked="checked" value="<?php echo $info_cat->slug; ?>"><?php echo $info_cat->name; ?></label>
      <!-- ▲ HTML : 終了-->
    <?php else : ?>
      <!-- ▼ HTML : 開始-->
      <label><input type="checkbox" name="get_cats[]" value="<?php echo $info_cat->slug; ?>"><?php echo $info_cat->name; ?></label>
      <!-- ▲ HTML : 終了-->
    <?php endif; ?>

  <?php endforeach; ?>
  <!-- ▲ PHP : 終了---------------->

  <!-- ▼ HTML : 開始-->
  <h2><?php _x('Search for:', 'label'); ?>キーワード</h2>
  <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="キーワードを入力してください" />


  <input type="submit" value="検索" />
  <input type="button" value="リセット" onclick="back();">
</form>
