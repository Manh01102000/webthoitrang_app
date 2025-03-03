$(document).on("click", ".regis-box", function () {
    $(this).find('.regis-box-title').css({
        'transition': "all 0.5s ease",
        'transform': "translateY(0px)",
        'font-size': "14px",
    });

    $(this).find('.regis_inp').focus();
});

$(document).on("focusout", ".regis_inp", function () {
    let checkinput = $(this).val().trim(); // Lấy giá trị input hiện tại

    let title = $(this).closest('.regis-box').find('.regis-box-title'); // Lấy tiêu đề của input này

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
        $(e).parents(".regis-box").find(".regis_inp").attr("type", "text");
    } else if (check == 1) {
        $(e).attr("data-showhide", 0);
        $(e).attr("src", img_closed);
        $(e).parents(".regis-box").find(".regis_inp").attr("type", "password");
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
                emp_account.parent().after("<label class='error-mess' id='emp_account_error'>Vui lòng nhập email đăng ký</label>");
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
                $.ajax({
                    type: "POST",
                    url: "/api/check_account_register",
                    async: false,
                    dataType: "JSON",
                    data: {
                        account_check: emp_account.val().trim(),
                    },
                    success: function (data) {
                        if (data.data == 1) {
                            if (emp_account.parent().hasClass("error-mess") == false) {
                                emp_account.parent().addClass("error-mess");
                                emp_account.parent().after("<label class='error-mess' id='emp_account_error'>Tài khoản đã tồn tại</label>");
                            }
                            $('#emp_account').focus();
                        } else {
                            emp_account.parent().removeClass("error-mess");
                            $("#emp_account_error").remove();
                        }
                    },
                });
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
    // validate tên
    $(document).on("keyup", "#emp_name", function () {
        var emp_name = $(this);
        if (emp_name.val().trim() == '') {
            if (emp_name.parent().hasClass("error-mess") == false) {
                emp_name.parent().addClass("error-mess");
                emp_name.parent().after("<label class='error-mess' id='emp_name_error'>Vui lòng nhập họ và tên</label>");
            }
            $('#emp_name').focus();
        } else {
            emp_name.parent().removeClass("error-mess");
            $("#emp_name_error").remove();
            if (checkKTDB(emp_name.val().trim()) == false) {
                if (emp_name.parent().hasClass('error-mess') == false) {
                    emp_name.parent().addClass('error-mess');
                    emp_name.parent().after("<label id='emp_name_error' class='error-mess'>Họ và tên không chứa ký tự đặc biệt</label>");
                }
                $('#emp_name').focus();
            } else {
                emp_name.parent().removeClass("error-mess");
                $("#emp_name_error").remove();
            }
        }
    });
    // validate số điện thoại
    $(document).on("keyup", "#emp_phone", function () {
        var emp_phone = $(this);
        if (emp_phone.val().trim() == '') {
            if (emp_phone.parent().hasClass("error-mess") == false) {
                emp_phone.parent().addClass("error-mess");
                emp_phone.parent().after("<label class='error-mess' id='emp_phone_error'>Vui lòng nhập số điện thoại liên hệ</label>");
            }
            $('#emp_phone').focus();
        } else {
            emp_phone.parent().removeClass("error-mess");
            $("#emp_phone_error").remove();
            if (checkPhoneNumber(emp_phone.val()) == false) {
                if (emp_phone.parent().hasClass('error-mess') == false) {
                    emp_phone.parent().addClass('error-mess');
                    emp_phone.parent().after("<label id='emp_phone_error' class='error-mess'>Số điện thoại không đúng hoặc không đúng định dạng</label>");
                }
                $('#emp_phone').focus();
            } else {
                emp_phone.parent().removeClass("error-mess");
                $("#emp_phone_error").remove();
            }
        }
    });
    // validate ngày sinh
    $(document).on("change", "#emp_birth", function () {
        var emp_birth = $(this);
        if (emp_birth.val().trim() == '') {
            if (emp_birth.parent().hasClass("error-mess") == false) {
                emp_birth.parent().addClass("error-mess");
                emp_birth.parent().after("<label class='error-mess' id='emp_birth_error'>Vui lòng nhập ngày sinh</label>");
            }
            $('#emp_birth').focus();
        } else {
            emp_birth.parent().removeClass("error-mess");
            $("#emp_birth_error").remove();
        }
    });
});

function validateRegister() {
    var emp_phone = $("#emp_phone");
    var emp_birth = $("#emp_birth");
    var emp_name = $("#emp_name");
    var emp_password = $("#emp_password");
    var emp_repassword = $("#emp_repassword");
    var emp_account = $("#emp_account");

    let validate1 = validate2 = validate3 = validate4 = validate5 = validate6 = true;

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
            $.ajax({
                type: "POST",
                url: "/api/check_account_register",
                async: false,
                dataType: "JSON",
                data: {
                    account_check: emp_account.val().trim(),
                },
                success: function (data) {
                    emp_account.parent().removeClass("error-mess");
                    $("#emp_account_error").remove();
                    if (data.data == 1) {
                        if (emp_account.parent().hasClass("error-mess") == false) {
                            emp_account.parent().addClass("error-mess");
                            emp_account.parent().after("<label class='error-mess' id='emp_account_error'>Tài khoản đã tồn tại</label>");
                        }
                        $('#emp_account').focus();
                        validate1 = false;
                    } else {
                        emp_account.parent().removeClass("error-mess");
                        $("#emp_account_error").remove();
                    }
                },
            });
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

    if (emp_name.val().trim() == '') {
        if (emp_name.parent().hasClass("error-mess") == false) {
            emp_name.parent().addClass("error-mess");
            emp_name.parent().after("<label class='error-mess' id='emp_name_error'>Vui lòng nhập họ và tên</label>");
        }
        $('#emp_name').focus();
        validate4 = false;
    } else {
        emp_name.parent().removeClass("error-mess");
        $("#emp_name_error").remove();
        if (checkKTDB(emp_name.val().trim()) == false) {
            if (emp_name.parent().hasClass('error-mess') == false) {
                emp_name.parent().addClass('error-mess');
                emp_name.parent().after("<label id='emp_name_error' class='error-mess'>Họ và tên không chứa ký tự đặc biệt</label>");
            }
            $('#emp_name').focus();
            validate4 = false;
        } else {
            emp_name.parent().removeClass("error-mess");
            $("#emp_name_error").remove();
        }
    }

    if (emp_phone.val().trim() == '') {
        if (emp_phone.parent().hasClass("error-mess") == false) {
            emp_phone.parent().addClass("error-mess");
            emp_phone.parent().after("<label class='error-mess' id='emp_phone_error'>Vui lòng nhập số điện thoại liên hệ</label>");
        }
        $('#emp_phone').focus();
        validate5 = false;
    } else {
        emp_phone.parent().removeClass("error-mess");
        $("#emp_phone_error").remove();
        if (checkPhoneNumber(emp_phone.val()) == false) {
            if (emp_phone.parent().hasClass('error-mess') == false) {
                emp_phone.parent().addClass('error-mess');
                emp_phone.parent().after("<label id='emp_phone_error' class='error-mess'>Số điện thoại không đúng hoặc không đúng định dạng</label>");
            }
            $('#emp_phone').focus();
            validate5 = false;
        } else {
            emp_phone.parent().removeClass("error-mess");
            $("#emp_phone_error").remove();
        }
    }

    if (emp_birth.val().trim() == '') {
        if (emp_birth.parent().hasClass("error-mess") == false) {
            emp_birth.parent().addClass("error-mess");
            emp_birth.parent().after("<label class='error-mess' id='emp_birth_error'>Vui lòng nhập ngày sinh</label>");
        }
        $('#emp_birth').focus();
        validate6 = false;
    } else {
        emp_birth.parent().removeClass("error-mess");
        $("#emp_birth_error").remove();
        if (checkBirth(emp_birth.val().trim()) == false) {
            if (emp_birth.parent().hasClass('error-mess') == false) {
                emp_birth.parent().addClass('error-mess');
                emp_birth.parent().after("<label id='emp_birth_error' class='error-mess'>Ngày sinh không hợp lệ</label>");
            }
            $('#emp_birth').focus();
            validate6 = false;
        } else {
            emp_birth.parent().removeClass("error-mess");
            $("#emp_birth_error").remove();
        }
    }

    if (validate1 == false || validate2 == false || validate3 == false || validate4 == false || validate5 == false || validate6 == false) {
        return false;
    }
    return true;
}

function Register(e) {
    let validate = validateRegister();
    if (validate) {
        $("#loading").show();
        var emp_account = $("#emp_account").val().trim();
        var emp_name = $("#emp_name").val().trim();
        var emp_password = $("#emp_password").val().trim();
        var emp_phone = $("#emp_phone").val().trim();
        var emp_birth = $("#emp_birth").val().trim();
        var emp_birth = new Date($("#emp_birth").val().trim()).getTime() / 1000;
        $.ajax({
            type: "POST",
            url: "/api/AccountRegister",
            async: false,
            dataType: "JSON",
            data: {
                emp_account: emp_account,
                emp_name: emp_name,
                emp_password: emp_password,
                emp_phone: emp_phone,
                emp_birth: emp_birth,
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
