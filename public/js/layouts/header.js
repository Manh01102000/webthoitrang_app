
$("#select-type-fashion").select2({
    dropdownParent: $('.box-append-typefashion')
});

$("#select-type-fashion-mobile").select2({
    dropdownParent: $('.box-append-typefashion-mobile')
});

function openSuggestSearch(e) {
    $('#header .collection-selector').css({
        "opacity": 1,
        "z-index": 1,
        "display": 'block',
    });
}

function openSuggestSearchMobile(e) {
    console.log(11)
    $('.header_container_mobile .collection-selector-mobile').css({
        "opacity": 1,
        "z-index": 1,
        "display": 'block',
    });
}

function closeCollectionSelector(e) {
    $(e).parents('#header').find('.collection-selector').css({
        "opacity": 0,
        "z-index": -1,
        "display": 'none',
    });
}

$(window).click(function (e) {
    if (!$(".collection-selector").is(e.target) && $(".collection-selector").has(e.target).length == 0 && !$(".search-text").is(e.target) && $(".search-text").has(e.target).length == 0) {
        $('#header .collection-selector').css({
            "opacity": 0,
            "z-index": -1,
            "display": 'none',
        });
    }

    if (!$(".SearchMobile-container").is(e.target) && $(".SearchMobile-container").has(e.target).length == 0 && !$(".button-search-mobile").is(e.target) && $(".button-search-mobile").has(e.target).length == 0) {
        $('.header_container_mobile .SearchMobile-container').css({
            "opacity": 0,
            "display": 'none',
        });
    }

    if (!$(".ShowInforAccountMb-container").is(e.target) && $(".ShowInforAccountMb-container").has(e.target).length == 0 && !$(".icon-user-mb").is(e.target) && $(".icon-user-mb").has(e.target).length == 0) {
        $('.header_container_mobile .ShowInforAccountMb-container').css({
            "opacity": 0,
            "display": 'none',
        });
    }

    if (!$(".ShowInforAccount-container").is(e.target) && $(".ShowInforAccount-container").has(e.target).length == 0 && !$(".hd-account").is(e.target) && $(".hd-account").has(e.target).length == 0) {
        $('.header_container_pc .ShowInforAccount-container').css({
            "opacity": 0,
            "display": 'none',
        });
    }
});

function buttonOpenNav(e) {
    $('.container_navigation_mobile').css({
        "opacity": 1,
        "z-index": 3,
        "display": 'block',
    });
}

function buttonCloseNav(e) {
    $(e).parents('.container_navigation_mobile').css({
        "opacity": 0,
        "z-index": -1,
        "display": 'none',
    });
}

function ShowHideParents(e) {
    let checkshow = $(e).attr("data-showhide");
    if (checkshow == 0) {
        $(e).find(".line2-showhide").css({
            "transform": "rotate(180deg)",
        });
        $(e).attr("data-showhide", 1);
        $(e).parents(".navmobile-menu-lvl0").find(".navmobile-menu-lvl1").css({
            "opacity": 1,
            "display": 'flex',
            "animation": "slide-up 0.6s ease",
        });
    } else if (checkshow == 1) {
        $(e).find(".line2-showhide").css({
            "transform": "rotate(90deg)",
        });
        $(e).attr("data-showhide", 0);
        $(e).parents(".navmobile-menu-lvl0").find(".navmobile-menu-lvl1").css({
            "opacity": -1,
            "display": 'none',
        });
    }
}

function ShowHideChilds(e) {
    let checkshow = $(e).attr("data-showhide");
    if (checkshow == 0) {
        $(e).find(".line2-showhide").css({
            "transform": "rotate(180deg)",
        });
        $(e).attr("data-showhide", 1);
        $(e).parents(".navmobile-menu-child").find(".navmobile-menu-lvl2").css({
            "opacity": 1,
            "display": 'flex',
            "animation": "slide-up 0.6s ease",
        });
    } else if (checkshow == 1) {
        $(e).find(".line2-showhide").css({
            "transform": "rotate(90deg)",
        });
        $(e).attr("data-showhide", 0);
        $(e).parents(".navmobile-menu-child").find(".navmobile-menu-lvl2").css({
            "opacity": -1,
            "display": 'none',
        });
    }
}

function buttonSearchMobile(e) {
    $('.header_container_mobile .SearchMobile-container').css({
        "opacity": 1,
        "display": 'block',
    });
}

function closeSearchMobile(e) {
    $(e).parents('.SearchMobile-container').css({
        "opacity": 0,
        "display": 'none',
    });
}

function ActiveNavBar(e) {
    let checkdata = $(e).attr('data');
    $(".nav-bar-box").removeClass('active-nav-bar');
    $(e).addClass('active-nav-bar');
    if (checkdata == 1) {
        location.href = '/';
    }
    else if (checkdata == 2) {
        $('.container_navigation_mobile').css({
            "opacity": 1,
            "z-index": 3,
            "display": 'block',
        });
    }
    else if (checkdata == 3) {
        location.href = '/gio-hang';
    }
    else if (checkdata == 4) {
        location.href = '/dang-nhap-tai-khoan';
    }
    else if (checkdata == 5) {
        location.href = '/quan-ly-tai-khoan';
    }
}

function OpenInforUse(e) {
    $('.ShowInforAccount-container').css({
        "opacity": 1,
        "display": 'block',
    });
}

function OpenInforUseMobile(e) {
    $('.ShowInforAccountMb-container').css({
        "opacity": 1,
        "display": 'block',
    });
}

function closeShowInforAccount(e) {
    $(e).parents('.ShowInforAccount-container').css({
        "opacity": 1,
        "display": 'none',
    });
}

function closeShowInforAccountMb(e) {
    $(e).parents('.ShowInforAccountMb-container').css({
        "opacity": 1,
        "display": 'none',
    });
}

function LogOut(e) {
    if (confirm("Bạn có chắc muốn đăng xuất?")) {
        location.href = '/dang-xuat';
    }
}

function checkscrolltopPC() {
    let lastScrollTop = 0; // Lưu vị trí cuộn trước đó
    $(window).scroll(function () {
        let currentScroll = $(this).scrollTop();
        if (currentScroll < lastScrollTop) {
            if (currentScroll > 80) {
                $(".header_container_pc").css({
                    'position': 'fixed',
                    'top': '0px',
                    'left': '0px',
                    'width': '100%',
                    'z-index': '2',
                    'transition': 'all 0.6s ease',
                    'animation': 'slide-down 0.6s alternate ease',
                });
            } else {
                $(".header_container_pc").css({
                    'position': 'unset',
                    'top': '0px',
                    'left': '0px',
                    'width': '100%',
                    'z-index': '2',
                    'transition': 'all 0.6s ease',
                    'animation': 'unset',
                });
            }
        } else {
            $(".header_container_pc").css({
                'position': 'unset',
                'top': '0px',
                'left': '0px',
                'width': '100%',
                'z-index': '2',
                'transition': 'all 0.6s ease',
                'animation': 'unset',
            });
        }

        lastScrollTop = currentScroll; // Cập nhật vị trí cuộn cũ
    });
}

function checkscrolltop() {
    if ($(window).width() < 600) {
        let CheckScrollTop = $(window).scrollTop(); // Đúng cú pháp
        if (CheckScrollTop > 70) {
            $(".container-navbar-bottom").addClass('active-navbar-bottom');
        } else {
            $(".container-navbar-bottom").removeClass('active-navbar-bottom');
        }
    }
    $(window).scroll(function () {
        if ($(window).width() < 600) {
            let scrollTop = $(window).scrollTop(); // Đúng cú pháp
            if (scrollTop > 70) {
                $(".container-navbar-bottom").addClass('active-navbar-bottom');
            } else {
                $(".container-navbar-bottom").removeClass('active-navbar-bottom');
            }
        } else {
            $(".container-navbar-bottom").removeClass('active-navbar-bottom');
        }
    });
}

function ShowBackToTop() {
    let CheckScrollTop = $(window).scrollTop(); // Đúng cú pháp
    if (CheckScrollTop > 70) {
        $(".back_to_top").fadeIn()
    } else {
        $(".back_to_top").fadeOut();
    }
    $(window).scroll(function () {
        let scrollTop = $(window).scrollTop(); // Đúng cú pháp
        if (scrollTop > 70) {
            $(".back_to_top").fadeIn()
        } else {
            $(".back_to_top").fadeOut();
        }
    });
}

function BackToTop(e) {
    $('html, body').animate(
        {
            scrollTop: 0,
        },
        {
            duration: 800, // Thời gian cuộn
            easing: 'swing',
        }
    );
}

$(document).ready(function () {
    checkscrolltop();
    checkscrolltopPC();
    ShowBackToTop();
});
