// ┏◆◇─────－- - - << jQuery >> - - – -－─────◇◆┓
//            検索ページの結果表示タブ
// ┗◆◇──────────－- - -  - - – -－────────────◇◆┛
$(function () {
  $('.tabBox a[href^="#tab"]').click(function () {
    $(".tab_main").hide();
    $(this.hash).fadeIn();
    return false;
  });
  $('.tabBox a[href^="#tab"]:eq(0)').trigger("click");

  const form = document.getElementById("searchform");
  const form_rect = form.getBoundingClientRect();
  const scroll_h = form_rect.bottom - 10;

  if (document.URL.match(/tabs=on/)) {
    $("body, html").stop().animate({ scrollTop: scroll_h }, 500);
  } else if (document.URL.match(/get_tags/)) {
    $("body, html").stop().animate({ scrollTop: scroll_h }, 500);
  } else if (document.URL.indexOf("/spot/?s=")) {
    $("body, html").stop().animate({ scrollTop: scroll_h }, 500);
  }
});

// $(window).on("load", function () {
//   const form = document.getElementById("searchform");
//   const form_rect = form.getBoundingClientRect();
//   const scroll_h = form_rect.bottom + 10;

//   if (document.URL.match(/tabs=on/)) {
//     $("body, html").stop().animate({ scrollTop: scroll_h }, 500);
//   } else if (document.URL.match(/get_tags/)) {
//     $("body, html").stop().animate({ scrollTop: scroll_h }, 500);
//   } else if (document.URL.indexOf("/spot/?s=")) {
//     $("body, html").stop().animate({ scrollTop: scroll_h }, 500);
//   }
// });
