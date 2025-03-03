$(document).ready(function () {
    $('.profile_edit-box').each(function () {
        let checkinput = $(this).find('.profile_edit_inp').val().trim(); // Lấy giá trị input hiện tại
        console.log(checkinput);
        let title = $(this).find('.profile_edit-box-title'); // Lấy tiêu đề của input này

        if (checkinput !== "") {
            title.css({
                'transition': "all 0.5s ease",
                'transform': "translateY(0px)",
                'font-size': "15px",
            });
        }
    });
})

$(document).on("click", ".profile_edit-box", function () {
    $(this).find('.profile_edit-box-title').css({
        'transition': "all 0.5s ease",
        'transform': "translateY(0px)",
        'font-size': "15px",
    });

    $(this).find('.profile_edit_inp').focus();
});

$(document).on("focusout", ".profile_edit_inp", function () {
    let checkinput = $(this).val().trim(); // Lấy giá trị input hiện tại

    let title = $(this).closest('.profile_edit-box').find('.profile_edit-box-title'); // Lấy tiêu đề của input này

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
        $(e).parents(".profile_edit-box").find(".profile_edit_inp").attr("type", "text");
    } else if (check == 1) {
        $(e).attr("data-showhide", 0);
        $(e).attr("src", img_closed);
        $(e).parents(".profile_edit-box").find(".profile_edit_inp").attr("type", "password");
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
    // validate mật khẩu cũ
    $(document).on("keyup", "#emp_oldpassword", function () {
        var emp_oldpassword = $(this);
        if (emp_oldpassword.val().trim() == '') {
            if (emp_oldpassword.parent().hasClass("error-mess") == false) {
                emp_oldpassword.parent().addClass("error-mess");
                emp_oldpassword.parent().after("<label class='error-mess' id='emp_oldpassword_error'>Vui lòng nhập mật khẩu cũ</label>");
            }
            $('#emp_oldpassword').focus();
        } else {
            emp_oldpassword.parent().removeClass("error-mess");
            $("#emp_oldpassword_error").remove();
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
            if (checkPassWord(emp_password.val()) == false) {
                if (emp_password.parent().hasClass('error-mess') == false) {
                    emp_password.parent().addClass('error-mess');
                    emp_password.parent().after("<label id='emp_password_error' class='error-mess'>Mật khẩu: 6 ký tự, 1 chữ cái, 1 số, không có khoảng trắng.</label>");
                }
                $('#emp_password').focus();
            } else {
                emp_password.parent().removeClass("error-mess");
                $("#emp_password_error").remove();
            }
        }
    });
    // validate mật khẩu nhập lại
    $(document).on("keyup", "#emp_repassword", function () {
        var emp_password = $("#emp_password").val().trim();
        var emp_repassword = $(this);
        if (emp_repassword.val().trim() == '') {
            if (emp_repassword.parent().hasClass("error-mess") == false) {
                emp_repassword.parent().addClass("error-mess");
                emp_repassword.parent().after("<label class='error-mess' id='emp_repassword_error'>Vui lòng nhập mật khẩu</label>");
            }
            $('#emp_repassword').focus();
        } else {
            emp_repassword.parent().removeClass("error-mess");
            $("#emp_repassword_error").remove();
            if ((emp_repassword.val().trim()) != emp_password) {
                if (emp_repassword.parent().hasClass('error-mess') == false) {
                    emp_repassword.parent().addClass('error-mess');
                    emp_repassword.parent().after("<label id='emp_repassword_error' class='error-mess'>Mật khẩu nhập lại không đúng</label>");
                }
                $('#emp_repassword').focus();
            } else {
                emp_repassword.parent().removeClass("error-mess");
                $("#emp_repassword_error").remove();
            }
        }
    });
});

function validateRegister() {
    var emp_password = $("#emp_password");
    var emp_repassword = $("#emp_repassword");
    var emp_oldpassword = $("#emp_oldpassword");

    let validate1 = validate2 = validate3 = true;

    if (emp_oldpassword.val().trim() == '') {
        if (emp_oldpassword.parent().hasClass("error-mess") == false) {
            emp_oldpassword.parent().addClass("error-mess");
            emp_oldpassword.parent().after("<label class='error-mess' id='emp_oldpassword_error'>Vui lòng nhập mật khẩu cũ</label>");
        }
        $('#emp_oldpassword').focus();
        validate1 = false;
    } else {
        emp_oldpassword.parent().removeClass("error-mess");
        $("#emp_oldpassword_error").remove();
        $.ajax({
            type: "POST",
            url: "/api/check_password_old",
            async: false,
            dataType: "JSON",
            data: {
                emp_oldpassword: emp_oldpassword.val().trim(),
            },
            success: function (data) {
                if (data.data == 1) {
                    if (emp_oldpassword.parent().hasClass("error-mess") == false) {
                        emp_oldpassword.parent().addClass("error-mess");
                        emp_oldpassword.parent().after("<label class='error-mess' id='emp_oldpassword_error'>Mật khẩu cũ không chính xác vui lòng nhập lại</label>");
                    }
                    $('#emp_oldpassword').focus();
                    validate1 = false;
                } else {
                    emp_oldpassword.parent().removeClass("error-mess");
                    $("#emp_oldpassword_error").remove();
                }
            },
        });
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
        if (checkPassWord(emp_password.val()) == false) {
            if (emp_password.parent().hasClass('error-mess') == false) {
                emp_password.parent().addClass('error-mess');
                emp_password.parent().after("<label id='emp_password_error' class='error-mess'>Mật khẩu: 6 ký tự, 1 chữ cái, 1 số, không có khoảng trắng.</label>");
            }
            $('#emp_password').focus();
            validate2 = false;
        } else {
            emp_password.parent().removeClass("error-mess");
            $("#emp_password_error").remove();
            $.ajax({
                type: "POST",
                url: "/api/check_password_new",
                async: false,
                dataType: "JSON",
                data: {
                    emp_password: emp_password.val().trim(),
                },
                success: function (data) {
                    if (data.data == 1) {
                        if (emp_password.parent().hasClass("error-mess") == false) {
                            emp_password.parent().addClass("error-mess");
                            emp_password.parent().after("<label class='error-mess' id='emp_password_error'>Mật khẩu mới trùng khớp với mật khẩu cũ</label>");
                        }
                        $('#emp_password').focus();
                        validate2 = false;
                    } else {
                        emp_password.parent().removeClass("error-mess");
                        $("#emp_password_error").remove();
                    }
                },
            });
        }
    }

    if (emp_repassword.val().trim() == '') {
        if (emp_repassword.parent().hasClass("error-mess") == false) {
            emp_repassword.parent().addClass("error-mess");
            emp_repassword.parent().after("<label class='error-mess' id='emp_repassword_error'>Vui lòng nhập mật khẩu</label>");
        }
        $('#emp_repassword').focus();
        validate3 = false;
    } else {
        emp_repassword.parent().removeClass("error-mess");
        $("#emp_repassword_error").remove();
        if ((emp_repassword.val().trim()) != emp_password.val().trim()) {
            if (emp_repassword.parent().hasClass('error-mess') == false) {
                emp_repassword.parent().addClass('error-mess');
                emp_repassword.parent().after("<label id='emp_repassword_error' class='error-mess'>Mật khẩu nhập lại không đúng</label>");
            }
            $('#emp_repassword').focus();
            validate3 = false;
        } else {
            emp_repassword.parent().removeClass("error-mess");
            $("#emp_repassword_error").remove();
        }
    }

    if (validate1 == false || validate2 == false || validate3 == false) {
        return false;
    }
    return true;
}

function ChangePassword(e) {
    let validate = validateRegister();
    if (validate) {
        $("#loading").show();
        var emp_password = $("#emp_password").val().trim();
        $.ajax({
            type: "POST",
            url: "/api/ChangePassword",
            async: false,
            dataType: "JSON",
            data: {
                emp_password: emp_password,
            },
            success: function (data) {
                $("#loading").hide();
                if (data && data.result) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            },
        });
    }
}