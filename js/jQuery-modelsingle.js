//モデルコースシングル用コンテンツが横から出てくる
jQuery(function () {
    var appear = false;
    var modelmove = $("#modelSpotCard1");
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            if (appear == false) {
                appear = true;
                modelmove.stop().fadeIn(500).animate(
                    {
                        right: "2%",
                    },
                    {
                        duration: 300,
                        queue: false,
                    }
                );
            }
        }
    });
});

jQuery(function () {
    var appear = false;
    var modelmove = $("#modelSpotCard2");
    $(window).scroll(function () {
        if ($(this).scrollTop() > 600) {
            if (appear == false) {
                appear = true;
                modelmove.stop().fadeIn(500).animate(
                    {
                        left: "2%",
                    },
                    {
                        duration: 300,
                        queue: false,
                    }
                );
            }
        }
    });
});

jQuery(function () {
    var appear = false;
    var modelmove = $("#modelSpotCard3");
    $(window).scroll(function () {
        if ($(this).scrollTop() > 1000) {
            if (appear == false) {
                appear = true;
                modelmove.stop().fadeIn(500).animate(
                    {
                        right: "2%",
                    },
                    {
                        duration: 300,
                        queue: false,
                    }
                );
            }
        }
    });
});
