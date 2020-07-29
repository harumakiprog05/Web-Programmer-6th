// ┏◆◇─────－- - - << jQuery >> - - – -－─────◇◆┓
//            内部リンクのスムーススクロール
// ┗◆◇──────────－- - -  - - – -－────────────◇◆┛
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
        var top_px = 20;
      } else {
        var top_px = 90;
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
