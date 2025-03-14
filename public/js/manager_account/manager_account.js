$(document).ready(function () {
    $('.profile_edit-box').each(function () {
        let checkinput = $(this).find('.profile_edit_inp').val().trim(); // Lấy giá trị input hiện tại
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

function showPopupEditProfile(e) {
    $(e).parents(".personal_profile").fadeOut();
    $("#loading").show();
    setInterval(() => {
        $("#loading").hide();
        $(".personal_profile_edit").show();
    }, 300);

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
    $(document).on("change", "#emp_email_contact", function () {
        var emp_email_contact = $(this);
        if (emp_email_contact.val().trim() == '') {
            if (emp_email_contact.parent().hasClass("error-mess") == false) {
                emp_email_contact.parent().addClass("error-mess");
                emp_email_contact.parent().after("<label class='error-mess' id='emp_email_contact_error'>Vui lòng nhập email liên hệ</label>");
            }
            $('#emp_email_contact').focus();
        } else {
            emp_email_contact.parent().removeClass("error-mess");
            $("#emp_email_contact_error").remove();
            if (checkEmailAddress(emp_email_contact.val()) == false) {
                if (emp_email_contact.parent().hasClass('error-mess') == false) {
                    emp_email_contact.parent().addClass('error-mess');
                    emp_email_contact.parent().after("<label id='emp_email_contact_error' class='error-mess'>Định dạng email không đúng</label>");
                }
                $('#emp_email_contact').focus();
            } else {
                emp_email_contact.parent().removeClass("error-mess");
                $("#emp_email_contact_error").remove();
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
    var emp_email_contact = $("#emp_email_contact");

    let validate1 = validate2 = validate3 = validate4 = true;

    if (emp_email_contact.val().trim() == '') {
        if (emp_email_contact.parent().hasClass("error-mess") == false) {
            emp_email_contact.parent().addClass("error-mess");
            emp_email_contact.parent().after("<label class='error-mess' id='emp_email_contact_error'>Vui lòng nhập email liên hệ</label>");
        }
        $('#emp_email_contact').focus();
        validate1 = false;
    } else {
        emp_email_contact.parent().removeClass("error-mess");
        $("#emp_email_contact_error").remove();
        if (checkEmailAddress(emp_email_contact.val()) == false) {
            if (emp_email_contact.parent().hasClass('error-mess') == false) {
                emp_email_contact.parent().addClass('error-mess');
                emp_email_contact.parent().after("<label id='emp_email_contact_error' class='error-mess'>Định dạng email không đúng</label>");
            }
            $('#emp_email_contact').focus();
            validate1 = false;
        } else {
            emp_email_contact.parent().removeClass("error-mess");
            $("#emp_email_contact_error").remove();
        }
    }

    if (emp_name.val().trim() == '') {
        if (emp_name.parent().hasClass("error-mess") == false) {
            emp_name.parent().addClass("error-mess");
            emp_name.parent().after("<label class='error-mess' id='emp_name_error'>Vui lòng nhập họ và tên</label>");
        }
        $('#emp_name').focus();
        validate2 = false;
    } else {
        emp_name.parent().removeClass("error-mess");
        $("#emp_name_error").remove();
        if (checkKTDB(emp_name.val().trim()) == false) {
            if (emp_name.parent().hasClass('error-mess') == false) {
                emp_name.parent().addClass('error-mess');
                emp_name.parent().after("<label id='emp_name_error' class='error-mess'>Họ và tên không chứa ký tự đặc biệt</label>");
            }
            $('#emp_name').focus();
            validate2 = false;
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
        validate3 = false;
    } else {
        emp_phone.parent().removeClass("error-mess");
        $("#emp_phone_error").remove();
        if (checkPhoneNumber(emp_phone.val()) == false) {
            if (emp_phone.parent().hasClass('error-mess') == false) {
                emp_phone.parent().addClass('error-mess');
                emp_phone.parent().after("<label id='emp_phone_error' class='error-mess'>Số điện thoại không đúng hoặc không đúng định dạng</label>");
            }
            $('#emp_phone').focus();
            validate3 = false;
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
        validate4 = false;
    } else {
        emp_birth.parent().removeClass("error-mess");
        $("#emp_birth_error").remove();
        if (checkBirth(emp_birth.val().trim()) == false) {
            if (emp_birth.parent().hasClass('error-mess') == false) {
                emp_birth.parent().addClass('error-mess');
                emp_birth.parent().after("<label id='emp_birth_error' class='error-mess'>Ngày sinh không hợp lệ</label>");
            }
            $('#emp_birth').focus();
            validate4 = false;
        } else {
            emp_birth.parent().removeClass("error-mess");
            $("#emp_birth_error").remove();
        }
    }

    if (validate1 == false || validate2 == false || validate3 == false || validate4 == false) {
        return false;
    }
    return true;
}

function ProfileEdit(e) {
    let validate = validateRegister();
    if (validate) {
        $("#loading").show();
        var emp_email_contact = $("#emp_email_contact").val().trim();
        var emp_name = $("#emp_name").val().trim();
        var emp_phone = $("#emp_phone").val().trim();
        var emp_birth = $("#emp_birth").val().trim();
        var emp_birth = new Date($("#emp_birth").val().trim()).getTime() / 1000;
        var emp_address = $("#emp_address").val().trim();
        var avatar = $('#profile_avatar-input').prop('files')[0];
        let formData = new FormData();
        formData.append('emp_email_contact', emp_email_contact);
        formData.append('emp_name', emp_name);
        formData.append('emp_phone', emp_phone);
        formData.append('emp_birth', emp_birth);
        formData.append('emp_address', emp_address);
        formData.append('avatar', avatar);
        $.ajax({
            type: "POST",
            url: "/api/AccountUpdate",
            async: false,
            dataType: "JSON",
            processData: false,
            contentType: false,
            data: formData,
            success: function (data) {
                $("#loading").hide();
                if (data && data.result) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            }, error: function (xhr) {
                $("#loading").hide();
                if (xhr.status === 401) {
                    alert(xhr.responseJSON.message);
                    window.location.href = "/dang-nhap-tai-khoan";
                } else {
                    alert(xhr.responseJSON.message);
                }
            }
        });
    }
}

$(document).on("change", "#profile_avatar-input", function () {
    var file_data = $('#profile_avatar-input').prop('files')[0];
    if (file_data != undefined) {
        var size = (file_data.size / (1024 * 1024)).toFixed(2);
        var type = file_data.type;
        var name = file_data.name;
        var image = new Image();
        image.src = URL.createObjectURL(file_data);
        var match = ['image/gif', 'image/png', 'image/jpg', 'image/jpeg', 'image/jfif', 'image/PNG'];
        if (type == match[0] || type == match[1] || type == match[2] || type == match[3] || type == match[4] || type == match[5]) {
            if (size <= 10) {
                $("#avatar-preview").attr('src', URL.createObjectURL(file_data));
            } else {
                alert(name + " Video tải lên vượt quá 10 MB");
            }
        } else {
            alert(name + " sai định dạng ảnh vui lòng chọn ảnh hợp lệ có định dạng: png, jpg, jpeg, gif, jfif");
        }
    };
});