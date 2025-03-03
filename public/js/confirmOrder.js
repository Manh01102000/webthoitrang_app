$(document).ready(function () {
    $("#address_orders_city").select2({
        dropdownParent: $('.box-append-city')
    });

    $("#address_orders_district").select2({
        dropdownParent: $('.box-append-distric')
    });

    $("#address_orders_commune").select2({
        dropdownParent: $('.box-append-commune')
    });
})

function OpendInforship(e) {
    $("#modal_change_inforship").show();
}

function CloseModal(e) {
    $(e).parents(".modal").hide();
}

function AddInforship(e) {
    $("#modal_add_inforship").show();
}

$(document).on("click", ".addinforship-box", function () {
    $(this).find('.addinforship-box-title').css({
        'transition': "all 0.5s ease",
        'transform': "translateY(0px)",
        'font-size': "14px",
    });

    $(this).find('.addinforship_inp').focus();
});

$(document).on("focusout", ".addinforship_inp", function () {
    let checkinput = $(this).val().trim(); // Lấy giá trị input hiện tại

    let title = $(this).closest('.addinforship-box').find('.addinforship-box-title'); // Lấy tiêu đề của input này

    if (checkinput === "") {
        title.css({
            'transition': "all 0.5s ease",
            'transform': "translateY(15px)",
            'font-size': "15px",
        });
    }
});

function PaymentType(e) {
    let check = $(e).val();
    if (check == 1) {
        $(".method_content_cod").css({
            "transition": "all 0.8s ease",
            "display": "none",
        });
    } else {
        $(".method_content_cod").css({
            "transition": "all 0.8s ease",
            "display": "block",
        });
    }
}