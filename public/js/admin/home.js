function ShowHideParents(e) {
    let checkshow = $(e).attr("data-showhide");
    if (checkshow == 0) {
        $(e).find(".line2-showhide").css({
            "transform": "rotate(180deg)",
        });
        $(e).attr("data-showhide", 1);
        $(e).parents(".sidebar-item").find(".submenu-child").css({
            "opacity": 1,
            "display": 'flex',
            "animation": "slide-up 0.6s ease",
        });
    } else if (checkshow == 1) {
        $(e).find(".line2-showhide").css({
            "transform": "rotate(90deg)",
        });
        $(e).attr("data-showhide", 0);
        $(e).parents(".sidebar-item").find(".submenu-child").css({
            "opacity": -1,
            "display": 'none',
        });
    }
}

function OpenInforUse(e) {
    $('.ShowInforAccount-container').css({
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

