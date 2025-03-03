$(document).on("click", ".logi-box", function () {
    $(this).find('.logi-box-title').css({
        'transition': "all 0.5s ease",
        'transform': "translateY(0px)",
        'font-size': "14px",
    });

    $(this).find('.logi_inp').focus();
});

$(document).on("focusout", ".logi_inp", function () {
    let checkinput = $(this).val().trim(); // Lấy giá trị input hiện tại

    let title = $(this).closest('.logi-box').find('.logi-box-title'); // Lấy tiêu đề của input này

    if (checkinput === "") {
        title.css({
            'transition': "all 0.5s ease",
            'transform': "translateY(15px)",
            'font-size': "16px",
        });
    }
});

function CloseOpenPass(e) {
    let check = $(e).attr("data-showhide");
    let img_closed = "/images/icon/eyes-closed.png";
    let img_opend = "/images/icon/eyes-opend.png";
    if (check == 0) {
        $(e).attr("data-showhide", 1);
        $(e).attr("src", img_opend);
        $(e).parents(".logi-box").find(".logi_inp").attr("type", "text");
    } else if (check == 1) {
        $(e).attr("data-showhide", 0);
        $(e).attr("src", img_closed);
        $(e).parents(".logi-box").find(".logi_inp").attr("type", "password");
    }
}

// Kiểm tra đã nhập
function validatenew(valuecheck, content, text) {
    let validate = true;
    const value = valuecheck.val().trim();
    if (value === "") {
        if (!valuecheck.parent().hasClass("error-mess")) {
            valuecheck.parent().addClass("error-mess");
            valuecheck.parent().after(
                `<label id='${text}_error' class='error-mess'>${content}</label>`
            );
        }
        valuecheck.focus();
        validate = false;
    } else {
        valuecheck.parent().removeClass("error-mess");
        $(`#${text}_error`).remove();
    }
    return validate;
}
// kiểm tra nhập cho select2
function validateSelect2(valuecheck, content, text) {
    let validate = true;
    const selectedValues = $(valuecheck).val();
    if (!selectedValues) {
        if (!valuecheck.parent().hasClass("error-mess")) {
            valuecheck.parent().addClass("error-mess");
            valuecheck.parent().after(
                `<label id='${text}_error' class='error-mess'>${content}</label>`
            );
        }
        valuecheck.focus();
        validate = false;
    } else {
        valuecheck.parent().removeClass("error-mess");
        $(`#${text}_error`).remove();
    }
    return validate;
}
//
$(document).ready(function () {
    // validate tài khoản
    $(document).on("change", "#admin_account", function () {
        var admin_account = $(this);
        if (admin_account.val().trim() == '') {
            if (admin_account.parent().hasClass("error-mess") == false) {
                admin_account.parent().addClass("error-mess");
                admin_account.parent().after("<label class='error-mess' id='admin_account_error'>Vui lòng nhập tài khoản đăng nhập</label>");
            }
            $('#admin_account').focus();
        } else {
            admin_account.parent().removeClass("error-mess");
            $("#admin_account_error").remove();
        }
    });

    // validate mật khẩu
    $(document).on("keyup", "#admin_password", function () {
        var admin_password = $(this);
        if (admin_password.val().trim() == '') {
            if (admin_password.parent().hasClass("error-mess") == false) {
                admin_password.parent().addClass("error-mess");
                admin_password.parent().after("<label class='error-mess' id='admin_password_error'>Vui lòng nhập mật khẩu</label>");
            }
            $('#admin_password').focus();
        } else {
            admin_password.parent().removeClass("error-mess");
            $("#admin_password_error").remove();
        }
    });
});

function validatelogin() {
    var admin_account = $("#admin_account");
    var admin_password = $("#admin_password");

    let validate1 = validate2 = true;

    if (admin_account.val().trim() == '') {
        if (admin_account.parent().hasClass("error-mess") == false) {
            admin_account.parent().addClass("error-mess");
            admin_account.parent().after("<label class='error-mess' id='admin_account_error'>Vui lòng nhập email đăng ký</label>");
        }
        $('#admin_account').focus();
        validate1 = false;
    } else {
        admin_account.parent().removeClass("error-mess");
        $("#admin_account_error").remove();
    }

    if (admin_password.val().trim() == '') {
        if (admin_password.parent().hasClass("error-mess") == false) {
            admin_password.parent().addClass("error-mess");
            admin_password.parent().after("<label class='error-mess' id='admin_password_error'>Vui lòng nhập mật khẩu</label>");
        }
        $('#admin_password').focus();
        validate2 = false;
    } else {
        admin_password.parent().removeClass("error-mess");
        $("#admin_password_error").remove();
    }


    if (validate1 == false || validate2 == false) {
        return false;
    }
    return true;
}

function login(e) {
    let validate = validatelogin();
    if (validate) {
        $("#loading").show();
        var admin_account = $("#admin_account").val().trim();
        var admin_password = $("#admin_password").val().trim();
        $.ajax({
            type: "POST",
            url: "/admin/Adminlogin",
            async: false,
            dataType: "JSON",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                admin_account: admin_account,
                admin_password: admin_password,
            },
            success: function (data) {
                console.log(data);
                $("#loading").hide();
                if (data && data.result) {
                    alert(data.message);
                    location.href = '/admin/dashboard';
                } else {
                    alert(data.message);
                }
            },
        });
    }

}
