//変数定義
var navigationOpenFlag = false;
var navButtonFlag = true;
var focusFlag = false;

//ハンバーガーメニュー
$(function () {
    $(document).on("click", ".el_humburger", function () {
        if (navButtonFlag) {
            spNavInOut.switch();
            //一時的にボタンを押せなくする
            setTimeout(function () {
                navButtonFlag = true;
            }, 200);
            navButtonFlag = false;
        }
    });
    $(document).on("click touchend", function (event) {
        if (!$(event.target).closest(".bl_header,.el_humburger").length && $("body").hasClass("js_humburgerOpen") && focusFlag) {
            focusFlag = false;
            //scrollBlocker(false);
            spNavInOut.switch();
        }
    });
});

//ナビ開く処理
function spNavIn() {
    $("body").removeClass("js_humburgerClose");
    $("body").addClass("js_humburgerOpen");
    setTimeout(function () {
        focusFlag = true;
    }, 200);
    setTimeout(function () {
        navigationOpenFlag = true;
    }, 200);
}

//ナビ閉じる処理
function spNavOut() {
    $("body").removeClass("js_humburgerOpen");
    $("body").addClass("js_humburgerClose");
    setTimeout(function () {
        $(".uq_spNavi").removeClass("js_appear");
        focusFlag = false;
    }, 200);
    navigationOpenFlag = false;
}

//ナビ開閉コントロール
var spNavInOut = {
    switch: function () {
        if ($("body.spNavFreez").length) {
            return false;
        }
        if ($("body").hasClass("js_humburgerOpen")) {
            spNavOut();
        } else {
            spNavIn();
        }
    },
};

// PC用ナビゲーションの表示・非表示

let visualHeightHeaf = $("#main_visual").outerHeight() / 2;
$(".toppage_header #pcgnav").css("display", "none");

$(window).scroll(function () {
    scrollVolume = $(this).scrollTop();
    // console.log(scrollVolume);


    if ($(window).width() >= 1000) {
        if (scrollVolume > visualHeightHeaf) {
            $(".toppage_header #pcgnav").fadeIn();
        } else {
            $(".toppage_header #pcgnav").fadeOut();
        }
    } else {
        $(".toppage_header #pcgnav").css("display", "none");
    }
});

// メインビジュアルのフェードイン・アウト

$(function () {
    var $width = "100%"; // 横幅
    var $height = "100vh"; // 高さ
    var $interval = 4000; // 切り替わりの間隔（ミリ秒）
    var $fade_speed = 1000; // フェード処理の早さ（ミリ秒）
    $(".main_visual_images ul li").css({ position: "relative", overflow: "hidden", width: $width, height: $height });
    $(".main_visual_images ul li").hide().css({ position: "absolute", top: 0, left: 0 });
    $(".main_visual_images ul li:first").addClass("active").show();
    setInterval(function () {
        var $active = $(".main_visual_images ul li.active");
        var $next = $active.next("li").length ? $active.next("li") : $(".main_visual_images ul li:first");
        $active.fadeOut($fade_speed).removeClass("active");
        $next.fadeIn($fade_speed).addClass("active");
    }, $interval);
});

// メインビジュアルの下に下げるボタン
$(function () {
    let button = $(".fa-chevron-down") //ボタンとなる要素を指定
    let scrollposition = $(".site_about").offset().top; //スクロール先の要素を指定
    let speed = 500; //スクロールするスピード(小さいほど早い)



    button.click(function () {
        $("body, html").animate({ scrollTop: scrollposition }, speed);

    })
})

// トップページの3つの丸をクリックするとページ内リンクするやつ
//楽しい

$(function () {
    $(window).on("load resize", function get_window_w() {
        return $(window).width();
    });

    $('a[href^="#"]')
        .not(".remove-class")
        .click(function () {
            var width = $(window).width();

            var top_px = 0;
            if (width < 1000) {
                var top_px =-5;
            } else {
                var top_px = 50;
            }
            //スクロールのスピード
            var speed = 500;
            //リンク元を取得
            var href = $(this).attr("href");
            //リンク先を取得
            var target = $(href == "#" || href == "" ? "html" : href);
            //リンク先までの距離を取得
            var position = target.offset().top - top_px;
            //スムーススクロール
            $("html, body").animate({ scrollTop: position }, speed, "swing");
            return false;
        });
});



// カテゴリーごとのスポットスライドショー

$(function () {


    $(".spot_slide_wrap").slick({
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 5,
        infinite: true,
        responsive: [{
            breakpoint: 1000,
            settings: {
                slidesToShow: 3,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
            },
        },
        ],
    });
});

// モデルコーススライドショー

$(function () {
    $(".modelcose_slide_wrap").slick({
        autoplay: true,
        autoplaySpeed: 3000,
        dots: true,
        slidesToShow: 1,
        infinite: true,

    });
});

// トップへ戻るボタン実装
$(".top_return_button").css("display", "none");

// ボタンの表示・非表示
$(document).ready(function () {
    var pagetop = $(".top_return_button");

    $(window).scroll(function () {
        if ($(this).scrollTop() > 800) {
            pagetop.fadeIn();
        } else {
            pagetop.fadeOut();
        }
    });

    // クリックでトップへ戻る
    pagetop.click(function () {
        $("body, html").animate({ scrollTop: 0 }, 800);
        return false;
    });
});




//検索ページの結果表示タブ

$(function () {

    var tabMenu = function () {

        /**
         * 変数の指定
         * $tab_area          : tabの親要素のjQueryオブジェクト
         * $content           : tabによって切り替わる要素のjQueryオブジェクト
         * TAB_ACTIVE_CLASS   : tabが選択されたスタイルを変更するclass名
         * CONTENT_SHOW_CLASS : contentを表示させるためのclass名
         * id_arr             : $contentのIDを配列に格納
         */
        var $tab_area = $('.tabArea');
        var $content = $('.contents .tab_main');
        var TAB_ACTIVE_CLASS = 'select';
        var CONTENT_SHOW_CLASS = 'is_show';
        var id_arr = $content.map(function () { return '#' + $(this).attr('id'); }).get();

        /**
         * 該当するhashデータがある場合、hashを返す
         * 該当とは id_arr[] に含まれるもの
         * @return {string} 該当する場合
         * @return {false} 該当しない（存在しない）場合
         */
        var getHash = function () {
            var hash = window.location.hash;
            var index = id_arr.indexOf(hash);

            if (index === -1) {
                return false;
            } else {
                return id_arr[index];
            }
        };

        /**
         * ページ読み込み時に実行
         * 1. hashがあれば、hashをhrefに持つタブのスタイル変更（専用のclass付与）
         * 2. hashがあれば、hashをidに持つコンテンツを表示（専用のclassを付与）
         * 3. hashがなければ、タブの先頭が選択された状態とする
         */
        var initialize = function () {
            var hash = getHash();
            if (hash) {
                $tab_area.find('a[href="' + hash + '"]').addClass(TAB_ACTIVE_CLASS); // 1
                $(hash).addClass(CONTENT_SHOW_CLASS); // 2
                $(window).on('load', function () {
                    setTimeout(function () {
                        // 移動先を100px上にずらす
                        var adjust = 100;
                        // スクロールの速度
                        var speed = 400; // ミリ秒
                        // 移動先を取得
                        var target = $(hash);
                        // 移動先を調整
                        var position = target.offset().top - adjust;
                        // スムーススクロール
                        $('body,html').animate({ scrollTop: position }, speed, 'swing');
                    }, 100);
                });
            } else {
                $tab_area.find('.one_tab:first > a').addClass(TAB_ACTIVE_CLASS); // 3
                $($content[0]).addClass(CONTENT_SHOW_CLASS); // 3
            }
        };

        /**
         * タブのクリックイベント
         * 1. クリックされたタブのhref, 該当するcontentを取得
         * 2. 既にクリック済みの状態であればスキップ
         * 3. 一旦タブ・contentの専用classを全削除
         * 4. クリックしたタブのスタイルを変更、該当するcontentを表示（それぞれ専用のclassを付与）
         */
        var addEvent = function () {
            $tab_area.find('a').on('click', function () {
                // 1
                var href = $(this).attr('href');
                var $targetContent = $(href);

                // 2
                if ($(this).hasClass(TAB_ACTIVE_CLASS)) {
                    return false;
                }

                // 3
                $tab_area.find('a').removeClass(TAB_ACTIVE_CLASS);
                $content.removeClass(CONTENT_SHOW_CLASS);

                // 4
                $(this).addClass(TAB_ACTIVE_CLASS);
                $targetContent.addClass(CONTENT_SHOW_CLASS);

                return false;
            });
        };

        return [initialize(), addEvent()];
    };

    // 実行
    tabMenu();
});
