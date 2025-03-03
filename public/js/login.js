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
    $(document).on("change", "#emp_account", function () {
        var emp_account = $(this);
        if (emp_account.val().trim() == '') {
            if (emp_account.parent().hasClass("error-mess") == false) {
                emp_account.parent().addClass("error-mess");
                emp_account.parent().after("<label class='error-mess' id='emp_account_error'>Vui lòng nhập email đăng nhập</label>");
            }
            $('#emp_account').focus();
        } else {
            emp_account.parent().removeClass("error-mess");
            $("#emp_account_error").remove();
            if (checkEmailAddress(emp_account.val()) == false) {
                if (emp_account.parent().hasClass('error-mess') == false) {
                    emp_account.parent().addClass('error-mess');
                    emp_account.parent().after("<label id='emp_account_error' class='error-mess'>Định dạng email không đúng</label>");
                }
                $('#emp_account').focus();
            } else {
                emp_account.parent().removeClass("error-mess");
                $("#emp_account_error").remove();
            }
        }
    });

    // validate mật khẩu
    $(document).on("keyup", "#emp_password", function () {
        var emp_password = $(this);
        if (emp_password.val().trim() == '') {
            if (emp_password.parent().hasClass("error-mess") == false) {
                emp_password.parent().addClass("error-mess");
                emp_password.parent().after("<label class='error-mess' id='emp_password_error'>Vui lòng nhập mật khẩu</label>");
            }
            $('#emp_password').focus();
        } else {
            emp_password.parent().removeClass("error-mess");
            $("#emp_password_error").remove();
        }
    });
});

function validatelogin() {
    var emp_account = $("#emp_account");
    var emp_password = $("#emp_password");

    let validate1 = validate2 = true;

    if (emp_account.val().trim() == '') {
        if (emp_account.parent().hasClass("error-mess") == false) {
            emp_account.parent().addClass("error-mess");
            emp_account.parent().after("<label class='error-mess' id='emp_account_error'>Vui lòng nhập email đăng ký</label>");
        }
        $('#emp_account').focus();
        validate1 = false;
    } else {
        emp_account.parent().removeClass("error-mess");
        $("#emp_account_error").remove();
        if (checkEmailAddress(emp_account.val()) == false) {
            if (emp_account.parent().hasClass('error-mess') == false) {
                emp_account.parent().addClass('error-mess');
                emp_account.parent().after("<label id='emp_account_error' class='error-mess'>Định dạng email không đúng</label>");
            }
            $('#emp_account').focus();
            validate1 = false;
        } else {
            emp_account.parent().removeClass("error-mess");
            $("#emp_account_error").remove();
        }
    }

    if (emp_password.val().trim() == '') {
        if (emp_password.parent().hasClass("error-mess") == false) {
            emp_password.parent().addClass("error-mess");
            emp_password.parent().after("<label class='error-mess' id='emp_password_error'>Vui lòng nhập mật khẩu</label>");
        }
        $('#emp_password').focus();
        validate2 = false;
    } else {
        emp_password.parent().removeClass("error-mess");
        $("#emp_password_error").remove();
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
        var emp_account = $("#emp_account").val().trim();
        var emp_password = $("#emp_password").val().trim();
        $.ajax({
            type: "POST",
            url: "/api/Accountlogin",
            async: false,
            dataType: "JSON",
            data: {
                emp_account: emp_account,
                emp_password: emp_password,
            },
            success: function (data) {
                $("#loading").hide();
                if (data && data.result) {
                    alert(data.message);
                    location.href = '/';
                } else {
                    alert(data.message);
                }
            },
        });
    }

}
