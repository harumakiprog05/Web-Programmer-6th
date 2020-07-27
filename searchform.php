<!-- _/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/ -->

<!-- カスタム投稿タイプspotの絞り込み検索フォーム -->

<!-- _/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/ -->
<section class="search_section">
	<form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>spot/">
		<main>
			<div class="container">
				<div class="tag_search_wrap">
					<h2 class="search_title">絞り込み検索</h2>
					<main>

						<!-- ▼△▼△▼△ カスタム投稿タイプspotのタグ ▼△▼△▼△ -->
						<div class="checkbox_group flex">

							<?php
							// <!-- ▼ PHP : 開始---------------->
							$spot_tag_args = array(
								'orderby' => 'name',
								'order' => 'ASC',
							);
							$spot_tags = get_terms('spot_tag', $spot_tag_args);
							$count_tag = 0;
							$count = 0;
							foreach ($spot_tags as $spot_tag) :
								$check_tag = '';
								if ($_GET['get_tags'][$count_tag] == $spot_tag->slug) {
									$check_tag = 'checked="checked"';
									$count_tag++;
								}
								$count++;
								switch ($count) {
									case '1':
										echo '<div class="left">';
										break;
									case '5':
										echo '<div class="right">';
										break;
								}
							?>
								<!-- ▼ HTML : 開始-->
								<label><input type="checkbox" name="get_tags[]" <?php echo $check_tag; ?> value="<?php echo $spot_tag->slug; ?>"><?php echo $spot_tag->name; ?></label>
								<!-- ▲ HTML : 終了-->

								<?php
								switch ($count % 4) {
									case '0':
										echo '</div>';
										break;
								}
								?>
							<?php endforeach;
							// <!-- ▲ PHP : 終了---------------->
							?>
						</div>


						<!-- ▼△▼△▼△ キーワード検索 ▼△▼△▼△ -->
						<label for="s"><?php _x('Search for:', 'label'); ?></label>
						<input class="calm_bdcolor_dark" type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="キーワードで検索" />


						<!-- ▼△▼△▼△ カスタム投稿タイプinfoのカテゴリ ▼△▼△▼△ -->
						<div class="info_actab">
							<input id="info_actab_one" type="checkbox" name="tabs" />
							<label class="area_serch_more fun_color_dark" for="info_actab_one">マップで検索</label>
							<div class="info_actab_content">
								<div class="area_search_wrap tabele_section">
									<div class="area_search_flex">
										<figure class="actab_cansel">

											<?php
											// <!-- ▼ PHP : 開始---------------->
											$taxonomy_args = array(
												'orderby' => 'name',
												'order' => 'ASC',
											);
											$taxonomies = get_terms('info_cat', ['parent' => 0], $taxonomy_args);
											$count_cat = $count_svg = $arr_num = 0;

											foreach ($taxonomies as $info_cat) :
												$check_cat = '';
												if ($_GET['get_cats'][$count_cat] == $info_cat->slug) {
													$check_cat = 'checked="checked"';
													$count_cat++;
												}

												echo '<input type="checkbox" name="get_cats[]" ', $check_cat, 'value="', $info_cat->slug, '" id="', $info_cat->slug, '" />';
												echo '<label for="', $info_cat->slug, '">';

												$count_svg++;
												switch ($count_svg) {
													case '1':
														echo '<svg class="map_color ', $info_cat->slug, '_map_color" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 286.33 236.07">';
														break;
													case '2':
														echo '<svg class="map_color ', $info_cat->slug, '_map_color" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 760.65 608.43">';
														break;
													case '3':
														echo '<svg class="map_color ', $info_cat->slug, '_map_color" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 415.71 327.4">';
														break;
													case '4':
														echo '<svg class="map_color ', $info_cat->slug, '_map_color" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 793.08 504.36">';
														break;
												}

												echo '<g>';
												echo '<path class="svg" d="', svg_path_array($arr_num), '" ></path>';
												echo '<path d="', svg_path_array($arr_num + 1), '" ></path>';
												echo '<path d="', svg_path_array($arr_num + 2), '" ></path>';
												echo '</g></svg></label>';
												$arr_num += 3;
											?>

											<?php endforeach;
											// <!-- ▲ PHP : 終了---------------->
											?>

										</figure>

									</div>
								</div>
							</div>
						</div>

						<div class="search_button_wrap">

							<label for=""><input class="more calm_color_dark" type="submit" value="この条件で検索" /> <i class="fas fa-search"></i></label>

							<label class="more calm_bdcolor_dark"><input type="button" value="条件をクリア" onclick="back();" /></label>

						</div>
				</div>
			</div>

	</form>
</section>
