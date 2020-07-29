<footer>

    <!-- ▼ スマートフォン用フッター : 開始 -->
    <div class="sp_footer">
        <div class="wave_footer">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(100, 149, 237, 0.1)" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(175, 238, 238, 0.4)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(25, 25, 112, 0.05)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="rgba(173, 216, 230, 0.4)" />
                </g>
            </svg>
        </div>

        <div class="under_footer">
            <ul class="footer_ul">
                <li>
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>">お問い合わせ</a>
                </li>
                <li>
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>">運営者情報</a>
                </li>
                <li>
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('privacy-policy'))); ?>">プライバシーポリシー</a>
                </li>
            </ul>
            <a href="<?php echo home_url() ?>">
                <h1>
                    <img src="<?php echo esc_url(get_theme_file_uri("image/logo.png")); ?>" width="170" alt="あわいやしロゴ" />
                </h1>
            </a>
            <small class="copyright">Copyright © あわいやし. All rights reserved.</small>
            <i class="top_return_button fas fa-chevron-up circle calm_color_dark"></i>
        </div>
    </div>
    <!-- ▲ スマートフォン用フッター : 終了 -->

    <!-- ▼ PC用フッター : 開始 -->
    <div class="pc_footer">

        <!-- ▼ 波のsvg画像 : 開始 -->
        <div class="wave_footer">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave2" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave2" x="48" y="0" fill="rgba(100, 149, 237, 0.1)" />
                    <use xlink:href="#gentle-wave2" x="48" y="3" fill="rgba(175, 238, 238, 0.4)" />
                    <use xlink:href="#gentle-wave2" x="48" y="5" fill="rgba(25, 25, 112, 0.05)" />
                    <use xlink:href="#gentle-wave2" x="48" y="7" fill="rgba(173, 216, 230, 0.4)" />
                </g>
            </svg>
        </div>
        <!-- ▲ 波のsvg画像 : 終了 -->

        <div class="under_footer calm_ftcolor_dark">
            <div class="container">
                <ul class="flex left">
                    <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>">運営者情報</a></li>
                    <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('privacy-policy'))); ?>">プライバシーポリシー</a></li>
                    <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>">お問い合わせ</a></li>
                </ul>
                <a href="<?php echo home_url() ?>">
                    <img src="<?php echo esc_url(get_theme_file_uri("image/logo.png")); ?>" class="footer_logo" alt="" />
                </a>

                <small>Copyright © あわいやし. All rights reserved.</small>
                <i class="top_return_button fas fa-chevron-up circle calm_color_dark"></i>
            </div>
        </div>
    </div>
    <!-- ▲ PC用フッター : 終了 -->
</footer>

<?php wp_footer(); ?>
</body>

</html>
