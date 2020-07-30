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
    arrows: false,
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
    arrows: false,
    autoplay: true,
    autoplaySpeed: 3000,
    dots: true,
    slidesToShow: 1,
    infinite: true,
  });
});
