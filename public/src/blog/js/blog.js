var iswap = $('.iswap').val() == '1' ? true : false;
var mt = 0;

window.onload = function () {
    var mydiv = $("mydiv");
    if (mydiv.length < 1) {
        return false;
    }
    var mt = mydiv.offsetTop;
    window.onscroll = function () {
        var t = document.documentElement.scrollTop || document.body.scrollTop;
        if (t > mt) {
            mydiv.style.position = "fixed";
            mydiv.style.margin = "0 0px";
            mydiv.style.top = "0";
        } else {
            mydiv.style.margin = "0px 0px";
            mydiv.style.position = "static";
        }
    };
};

$(function () {
    if (!iswap) {
        $(window).scroll(function () {
            if ($(window).scrollTop() >= 350) {
                $('.actGotop').fadeIn(200);
            } else {
                $('.actGotop').fadeOut(200);
            }
        });
        $(window).scroll(function () {
            if ($(window).scrollTop() >= 1) {
                $('.toutiao_new_v2_nav').css('position', 'fixed');
            } else {
                $('.toutiao_new_v2_nav').css('position', null);
            }
        });
        $('.actGotop').click(function () {
            $('html,body').animate({
                scrollTop: '0px'
            }, 500);
        });
    }
});

$(function () {
    var rTop = $(".mydiv").offset().top;
    if ($(document).scrollTop() >= rTop) {
        $(".mydiv").addClass("fixed");
    }

    $(window).scroll(function () {
        var sTop = $(document).scrollTop();
        if (sTop >= rTop) {
            $(".mydiv").addClass("fixed");
        } else if (sTop < rTop) {
            $(".mydiv").removeClass("fixed");
        }
    });
});

$(function () {
    $("#container img,before_tuijian img").lazyload({effect: "fadeIn"});
});