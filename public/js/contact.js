$(document).on("click", ".contact-box", function () {
    $(this).find('.contact-box-title').css({
        'transition': "all 0.5s ease",
        'transform': "translateY(0px)",
        'font-size': "14px",
    });

    $(this).find('.contact_inp').focus();
});

$(document).on("focusout", ".contact_inp", function () {
    let checkinput = $(this).val().trim(); // Lấy giá trị input hiện tại

    let title = $(this).closest('.contact-box').find('.contact-box-title'); // Lấy tiêu đề của input này

    if (checkinput === "") {
        title.css({
            'transition': "all 0.5s ease",
            'transform': "translateY(15px)",
            'font-size': "15px",
        });
    }
});