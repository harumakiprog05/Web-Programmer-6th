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
        <div class="on_footer theme_color_light">
            <div class="flex sns_tag">
                <i class="fab fa-instagram"></i>
                <h2>#あわいやし</h2>
            </div>
            <div class="formbutton_parent">
                <button class="more calm_color_dark">お問い合わせ　<i class="fas fa-chevron-right"></i></button>
                <button class="top_return grande_circle_set calm_color_dark circle"><i class="fas fa-chevron-up"></i></button>
            </div>
        </div>

        <div class="under_footer theme_color_dark">
            <ul class="footer_ul">
                <li>運営者情報</li>
                <li>プライバシーポリシー</li>
            </ul>
            <h1><img src="<?php echo esc_url(get_theme_file_uri("image/logo_white.png")); ?>" alt="あわいやしロゴ"></h1>
            <small class="copyright">Copyright © あわいやし. All rights reserved.</small>
        </div>
    </div>
    <!-- ▲ スマートフォン用フッター : 終了 -->

    <!-- ▼ PC用フッター : 開始 -->
    <div class="pc_footer">

        <!-- ▼ 波のsvg画像 : 開始 -->
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
        <!-- ▲ 波のsvg画像 : 終了 -->

        <div class="on_footer theme_color_light">
            <div class="flex">

                <ul class="footer_ul flex">
                    <li>SNSシェア</li>
                    <li><a href=""><i class="fab fa-twitter-square"></i></a></li>
                    <li><a href=""><i class="fab fa-facebook-square"></i></a></li>
                    <li><a href=""><i class="fab fa-line"></i></a></li>
                </ul>

                <button class="more calm_color_dark">お問い合わせ　<i class="fas fa-chevron-right"></i></button>
            </div>
        </div>

        <div class="under_footer theme_color_dark flex">
            <ul class="flex left">
                <li>運営者情報</li>
                <li>プライバシーポリシー</li>
            </ul>
            <div class="right">
                <h1><img src="<?php echo esc_url(get_theme_file_uri("image/logo_white.png")); ?>" alt="あわいやしロゴ"></h1>
                <small>Copyright © あわいやし. All rights reserved.</small>

            </div>
        </div>
    </div>
    <!-- ▲ PC用フッター : 終了 -->

</footer>

<?php wp_footer(); ?>
</body>

</html>
