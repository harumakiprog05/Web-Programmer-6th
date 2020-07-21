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

let scrollHeight = $(window).scroll(function () {
    scrollVolume = $(this).scrollTop();

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
$(".main_visual_images img:nth-child(n+2)").hide();

setInterval(function () {
    $(".main_visual_images img:first-child").fadeOut(3000);
    $(".main_visual_images img:nth-child(2)").fadeIn(3000);
    $(".main_visual_images img:first-child").appendTo(".main_visual_images");
}, 3000);



// カテゴリーごとのスポットスライドショー

$(function (){
    $('.spot_slide_wrap').slick({
        autoplay: true,
        autoplaySpeed: 2000,
        dots: true,
        slidesToShow: 5,
        infinite: true,
        responsive: [

            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                }
            },
        ]
    });
})

// トップページのモデルコーススライドショー

$(function () {
    $('.modelcose_slide_wrap').slick({
        autoplay: true,
        autoplaySpeed: 2000,
        dots: true,
        slidesToShow: 5,
        infinite: true,
        responsive: [

            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                }
            },
        ]
    });
})
