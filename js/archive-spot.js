var searchItem = ".drop_menu li ul li a";
var listItem = ".cat_image";
var hideClass = "is_hide";

// アコーデオン
$(".menu_btn").on("click", function () {
    $(this).next().slideToggle();
    $(this).toggleClass("active");
});

var $filters = $(".drop_menu [data-filter]");
var $boxes = $(".boxes [data-category]");

$filters.on("click", function (e) {
    e.preventDefault();
    var $this = $(this);
    var $tag = $this.find(".select_text").text();
    console.log($tag);

    var $filterColor = $this.attr("data-filter");
    var $filterColors = document.querySelector('[data-filter*=""]');

    if ($filterColor == "all") {
        $boxes
            .removeClass("is_animated")
            .fadeOut()
            .promise()
            .done(function () {
                $boxes.addClass("is_animated").fadeIn();
            });
    } else {
        $boxes
            .removeClass("is_animated")
            .fadeOut()
            .promise()
            .done(function () {
                $boxes
                    .filter('[data-category~= "' + $filterColor + '"]')
                    .addClass("is_animated")
                    .fadeIn();
            });
    }

    $(".menu_box ul").slideToggle();

    $("#select_tag").text("　" + $tag + "　");
});
