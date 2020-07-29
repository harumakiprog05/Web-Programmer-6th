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
  $(".main_visual_images ul li").css({
    position: "relative",
    overflow: "hidden",
    width: $width,
    height: $height,
  });
  $(".main_visual_images ul li")
    .hide()
    .css({ position: "absolute", top: 0, left: 0 });
  $(".main_visual_images ul li:first").addClass("active").show();
  setInterval(function () {
    var $active = $(".main_visual_images ul li.active");
    var $next = $active.next("li").length
      ? $active.next("li")
      : $(".main_visual_images ul li:first");
    $active.fadeOut($fade_speed).removeClass("active");
    $next.fadeIn($fade_speed).addClass("active");
  }, $interval);
});

// メインビジュアルの下に下げるボタン
$(function () {
  let button = $(".fa-chevron-down"); //ボタンとなる要素を指定
  let scrollposition = $(".site_about").offset().top; //スクロール先の要素を指定
  let speed = 500; //スクロールするスピード(小さいほど早い)

  button.click(function () {
    $("body, html").animate({ scrollTop: scrollposition }, speed);
  });
});

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
        var top_px = -5;
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
    responsive: [
      {
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
  pagetop.on("click", function () {
    $("body, html").animate({ scrollTop: 0 }, 800);
    return false;
  });
});
