// ┏◆◇─────－- - - << jQuery >> - - – -－─────◇◆┓
//            検索ページの結果表示タブ
// ┗◆◇──────────－- - -  - - – -－────────────◇◆┛
$(function () {
  $('#tabcontents .panel[id != "panel1"]').hide();
  $("span[data-href]").on("click", function () {
    $("#tabcontents .panel").hide();
    $($(this).data("href")).show();
    $(".current").removeClass("current");
    $(this).addClass("current");
    return false;
  });
  //わざと1つ目を表示させておくことができます
  $form_bottom = $(".tag_search_wrap").offset();
  $("body, html").animate({ scrollTop: 0 }, 800);
  return false;

  $("span[data-href]:eq(0)").trigger("click");
});
