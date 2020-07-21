// archive-model画像フェード切替

$(function () {
  var $setElm = $(".model_fade");
  fadeSpeed = 1500;
  switchDelay = 5000;

  $setElm.each(function () {
    var targetObj = $(this);
    var findImg = targetObj.find("img");
    var findImgFirst = targetObj.find("img:first");

    findImg.css({ display: "block", opacity: "0", zIndex: "99" });
    findImgFirst
      .css({ zIndex: "100" })
      .stop()
      .animate({ opacity: "1" }, fadeSpeed);

    setInterval(function () {
      targetObj
        .find("img:first-child")
        .animate({ opacity: "0" }, fadeSpeed)
        .next("img")
        .css({ zIndex: "100" })
        .animate({ opacity: "1" }, fadeSpeed)
        .end()
        .appendTo(targetObj)
        .css({ zIndex: "99" });
    }, switchDelay);
  });
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
