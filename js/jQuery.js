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
        if (
            !$(event.target).closest(".bl_header,.el_humburger").length &&
            $("body").hasClass("js_humburgerOpen") &&
            focusFlag
        ) {
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

// $("#pcnav").hide();

let scrollHeight = $(window).scroll(function () {
    scrollVolume = $(this).scrollTop();

    if ($(window).width() >= 1000) {
        if (scrollVolume > visualHeightHeaf) {
            $("#pcgnav").fadeIn();
        } else {
            $("#pcgnav").fadeOut();
        }
    } else {
        $("#pcgnav").css("display", "none");
    }
});

// メインビジュアルのフェードイン・アウト
$(".main_visual_images img:nth-child(n+2)").hide();

setInterval(function () {
    $(".main_visual_images img:first-child").fadeOut(2000);
    $(".main_visual_images img:nth-child(2)").fadeIn(2000);
    $(".main_visual_images img:first-child").appendTo(".main_visual_images");
}, 4000);

// トップページスライドショー

// $(function () {
//     $('#modelCourseSlide').slick();
// });

$(document).ready(function () {
    $("#modelCourseSlide").slick({});
});

//モーダルウィンドウ//
$(function () {
    $(".js-modal-open").on("click", function () {
        $(".js-modal").fadeIn();
        return false;
    });
    $(".js-modal-close").on("click", function () {
        $(".js-modal").fadeOut();
        return false;
    });
});

// archive-model画像フェード切替
$(".model_fade_1 img:nth-child(n+2)").hide();

setInterval(function () {
    $(".model_fade_1 img:first-child").fadeOut(2000);
    $(".model_fade_1 img:nth-child(2)").fadeIn(2000);
    $(".model_fade_1 img:first-child").appendTo("..model_fade_1");
}, 4000);

$(".model_fade_2 img:nth-child(n+2)").hide();

setInterval(function () {
    $(".model_fade_2 img:first-child").fadeOut(2000);
    $(".model_fade_2 img:nth-child(2)").fadeIn(2000);
    $(".model_fade_2 img:first-child").appendTo(".model_fade_2");
}, 4000);
setInterval(function () {
    $(".model_fade_3 img:first-child").fadeOut(2000);
    $(".model_fade_3 img:nth-child(2)").fadeIn(2000);
    $(".model_fade_3 img:first-child").appendTo(".model_fade_3");
}, 4000);
