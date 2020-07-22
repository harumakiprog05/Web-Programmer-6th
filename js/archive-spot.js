var searchItem = ".dropmenu li ul li a";
var listItem = ".cat_image";
var hideClass = "is-hide";

// アコーデオン
$(".menu-btn").on("click", function () {
  $(this).next().slideToggle();
  $(this).toggleClass("active");
});

var $filters = $(".dropmenu [data-filter]");
var $boxes = $(".boxes [data-category]");

$filters.on("click", function (e) {
  e.preventDefault();
  var $this = $(this);
  var $tag = $this.find(".select-text").text();
  console.log($tag);

  var $filterColor = $this.attr("data-filter");
  var $filterColors = document.querySelector('[data-filter*=""]');

  if ($filterColor == "all") {
    $boxes
      .removeClass("is-animated")
      .fadeOut()
      .promise()
      .done(function () {
        $boxes.addClass("is-animated").fadeIn();
      });
  } else {
    $boxes
      .removeClass("is-animated")
      .fadeOut()
      .promise()
      .done(function () {
        $boxes
          .filter('[data-category~= "' + $filterColor + '"]')
          .addClass("is-animated")
          .fadeIn();
      });
  }

  $(".menu-box ul").slideToggle();

  $("#select_tag").text("　" + $tag + "　");
});
