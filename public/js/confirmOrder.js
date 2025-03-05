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

$(document).ready(function () {
    // validate tên
    $(document).on("keyup", "#address_orders_user_name", function () {
        var address_orders_user_name = $(this);
        if (address_orders_user_name.val().trim() == '') {
            if (address_orders_user_name.parent().hasClass("error-mess") == false) {
                address_orders_user_name.parent().addClass("error-mess");
                address_orders_user_name.parent().after("<label class='error-mess' id='address_orders_user_name_error'>Vui lòng nhập họ và tên</label>");
            }
            $('#address_orders_user_name').focus();
        } else {
            address_orders_user_name.parent().removeClass("error-mess");
            $("#address_orders_user_name_error").remove();
        }
    });
    // validate số điện thoại
    $(document).on("keyup", "#address_orders_user_phone", function () {
        var address_orders_user_phone = $(this);
        if (address_orders_user_phone.val().trim() == '') {
            if (address_orders_user_phone.parent().hasClass("error-mess") == false) {
                address_orders_user_phone.parent().addClass("error-mess");
                address_orders_user_phone.parent().after("<label class='error-mess' id='address_orders_user_phone_error'>Vui lòng nhập số điện thoại liên hệ</label>");
            }
            $('#address_orders_user_phone').focus();
        } else {
            address_orders_user_phone.parent().removeClass("error-mess");
            $("#address_orders_user_phone_error").remove();
            if (checkPhoneNumber(address_orders_user_phone.val()) == false) {
                if (address_orders_user_phone.parent().hasClass('error-mess') == false) {
                    address_orders_user_phone.parent().addClass('error-mess');
                    address_orders_user_phone.parent().after("<label id='address_orders_user_phone_error' class='error-mess'>Số điện thoại không đúng hoặc không đúng định dạng</label>");
                }
                $('#address_orders_user_phone').focus();
            } else {
                address_orders_user_phone.parent().removeClass("error-mess");
                $("#address_orders_user_phone_error").remove();
            }
        }
    });
    // validate email
    $(document).on("keyup", "#address_orders_user_email", function () {
        var address_orders_user_email = $(this);
        if (address_orders_user_email.val().trim() == '') {
            if (address_orders_user_email.parent().hasClass("error-mess") == false) {
                address_orders_user_email.parent().addClass("error-mess");
                address_orders_user_email.parent().after("<label class='error-mess' id='address_orders_user_email_error'>Vui lòng nhập email đăng ký</label>");
            }
            $('#address_orders_user_email').focus();
            validate1 = false;
        } else {
            address_orders_user_email.parent().removeClass("error-mess");
            $("#address_orders_user_email_error").remove();
            if (checkEmailAddress(address_orders_user_email.val()) == false) {
                if (address_orders_user_email.parent().hasClass('error-mess') == false) {
                    address_orders_user_email.parent().addClass('error-mess');
                    address_orders_user_email.parent().after("<label id='address_orders_user_email_error' class='error-mess'>Định dạng email không đúng</label>");
                }
                $('#address_orders_user_email').focus();
                validate1 = false;
            } else {
                address_orders_user_email.parent().removeClass("error-mess");
                $("#address_orders_user_email_error").remove();
            }
        }
    });
    // validate tỉnh thành
    $(document).on("change", "#address_orders_city", function () {
        var address_orders_city = $(this);
        if (address_orders_city.val().trim() == 0) {
            if (address_orders_city.parent().hasClass("error-mess") == false) {
                address_orders_city.parent().addClass("error-mess");
                address_orders_city.parent().after("<label class='error-mess' id='address_orders_city_error'>Vui lòng chọn Tỉnh/Thành</label>");
            }
            $('#address_orders_city').focus();
        } else {
            address_orders_city.parent().removeClass("error-mess");
            $("#address_orders_city_error").remove();
            $.ajax({
                'type': "POST",
                'url': "/api/getDistrictsByID",
                'data': {
                    id: address_orders_city.val().trim()
                },
                dataType: "JSON",
                success: function (data) {
                    if (data) {
                        console.log(data);
                        let dataCate = data.data;
                        html = '<option value="0">Chọn Quận/Huyện</option>';
                        dataCate.forEach((element, index) => {
                            html += `<option value=" ${element['district_code']}"> ${element['district_name']}</option>`;
                        });
                        $("#address_orders_district").html(html);
                    }
                }
            });
        }
    });
    // validate quận huyện
    $(document).on("change", "#address_orders_district", function () {
        var address_orders_district = $(this);
        if (address_orders_district.val().trim() == 0) {
            if (address_orders_district.parent().hasClass("error-mess") == false) {
                address_orders_district.parent().addClass("error-mess");
                address_orders_district.parent().after("<label class='error-mess' id='address_orders_district_error'>Vui lòng chọn Quận/Huyện</label>");
            }
            $('#address_orders_district').focus();
        } else {
            address_orders_district.parent().removeClass("error-mess");
            $("#address_orders_district_error").remove();
            $.ajax({
                'type': "POST",
                'url': "/api/getCommunesByID",
                'data': {
                    id: address_orders_district.val().trim()
                },
                dataType: "JSON",
                success: function (data) {
                    if (data) {
                        console.log(data);
                        let dataCate = data.data;
                        html = '<option value="0">Chọn Xã/Trị Trấn</option>';
                        dataCate.forEach((element, index) => {
                            html += `<option value=" ${element['commune_code']}"> ${element['commune_name']}</option>`;
                        });
                        $("#address_orders_commune").html(html);
                    }
                }
            });
        }
    });
    // validate Xã phường
    $(document).on("change", "#address_orders_commune", function () {
        var address_orders_commune = $(this);
        if (address_orders_commune.val().trim() == 0) {
            if (address_orders_commune.parent().hasClass("error-mess") == false) {
                address_orders_commune.parent().addClass("error-mess");
                address_orders_commune.parent().after("<label class='error-mess' id='address_orders_commune_error'>Vui lòng chọn Xã/Phường</label>");
            }
            $('#address_orders_commune').focus();
        } else {
            address_orders_commune.parent().removeClass("error-mess");
            $("#address_orders_commune_error").remove();
        }
    });
    // validate địa chỉ chi tiết
    $(document).on("keyup", "#address_orders_detail", function () {
        var address_orders_detail = $(this);
        if (address_orders_detail.val().trim() == '') {
            if (address_orders_detail.parent().hasClass("error-mess") == false) {
                address_orders_detail.parent().addClass("error-mess");
                address_orders_detail.parent().after("<label class='error-mess' id='address_orders_detail_error'>Vui lòng nhập địa chỉ chi tiết</label>");
            }
            $('#address_orders_detail').focus();
            validate1 = false;
        } else {
            address_orders_detail.parent().removeClass("error-mess");
            $("#address_orders_detail_error").remove();
        }
    });
});

function validateDataInforship() {
    var address_orders_user_name = $("#address_orders_user_name");
    var address_orders_user_phone = $("#address_orders_user_phone");
    var address_orders_user_email = $("#address_orders_user_email");
    var address_orders_city = $("#address_orders_city");
    var address_orders_district = $("#address_orders_district");
    var address_orders_commune = $("#address_orders_commune");
    var address_orders_detail = $("#address_orders_detail");

    let validate1 = validate2 = validate3 = validate4 = validate5 = validate6 = validate7 = true;

    // validate tên
    if (address_orders_user_name.val().trim() == '') {
        if (address_orders_user_name.parent().hasClass("error-mess") == false) {
            address_orders_user_name.parent().addClass("error-mess");
            address_orders_user_name.parent().after("<label class='error-mess' id='address_orders_user_name_error'>Vui lòng nhập họ và tên</label>");
        }
        $('#address_orders_user_name').focus();
        validate1 = false;
    } else {
        address_orders_user_name.parent().removeClass("error-mess");
        $("#address_orders_user_name_error").remove();
    }
    // validate số điện thoại
    if (address_orders_user_phone.val().trim() == '') {
        if (address_orders_user_phone.parent().hasClass("error-mess") == false) {
            address_orders_user_phone.parent().addClass("error-mess");
            address_orders_user_phone.parent().after("<label class='error-mess' id='address_orders_user_phone_error'>Vui lòng nhập số điện thoại liên hệ</label>");
        }
        $('#address_orders_user_phone').focus();
        validate2 = false;
    } else {
        address_orders_user_phone.parent().removeClass("error-mess");
        $("#address_orders_user_phone_error").remove();
        if (checkPhoneNumber(address_orders_user_phone.val()) == false) {
            if (address_orders_user_phone.parent().hasClass('error-mess') == false) {
                address_orders_user_phone.parent().addClass('error-mess');
                address_orders_user_phone.parent().after("<label id='address_orders_user_phone_error' class='error-mess'>Số điện thoại không đúng hoặc không đúng định dạng</label>");
            }
            $('#address_orders_user_phone').focus();
            validate2 = false;
        } else {
            address_orders_user_phone.parent().removeClass("error-mess");
            $("#address_orders_user_phone_error").remove();
        }
    }
    // validate email
    if (address_orders_user_email.val().trim() == '') {
        if (address_orders_user_email.parent().hasClass("error-mess") == false) {
            address_orders_user_email.parent().addClass("error-mess");
            address_orders_user_email.parent().after("<label class='error-mess' id='address_orders_user_email_error'>Vui lòng nhập email đăng ký</label>");
        }
        $('#address_orders_user_email').focus();
        validate3 = false;
    } else {
        address_orders_user_email.parent().removeClass("error-mess");
        $("#address_orders_user_email_error").remove();
        if (checkEmailAddress(address_orders_user_email.val()) == false) {
            if (address_orders_user_email.parent().hasClass('error-mess') == false) {
                address_orders_user_email.parent().addClass('error-mess');
                address_orders_user_email.parent().after("<label id='address_orders_user_email_error' class='error-mess'>Định dạng email không đúng</label>");
            }
            $('#address_orders_user_email').focus();
            validate3 = false;
        } else {
            address_orders_user_email.parent().removeClass("error-mess");
            $("#address_orders_user_email_error").remove();
        }
    }
    // validate tỉnh thành
    if (address_orders_city.val().trim() == 0) {
        if (address_orders_city.parent().hasClass("error-mess") == false) {
            address_orders_city.parent().addClass("error-mess");
            address_orders_city.parent().after("<label class='error-mess' id='address_orders_city_error'>Vui lòng chọn Tỉnh/Thành</label>");
        }
        $('#address_orders_city').focus();
        validate4 = false;
    } else {
        address_orders_city.parent().removeClass("error-mess");
        $("#address_orders_city_error").remove();
    }
    // validate quận huyện
    if (address_orders_district.val().trim() == 0) {
        if (address_orders_district.parent().hasClass("error-mess") == false) {
            address_orders_district.parent().addClass("error-mess");
            address_orders_district.parent().after("<label class='error-mess' id='address_orders_district_error'>Vui lòng chọn Quận/Huyện</label>");
        }
        $('#address_orders_district').focus();
        validate5 = false;
    } else {
        address_orders_district.parent().removeClass("error-mess");
        $("#address_orders_district_error").remove();
    }
    // validate Xã phường
    if (address_orders_commune.val().trim() == 0) {
        if (address_orders_commune.parent().hasClass("error-mess") == false) {
            address_orders_commune.parent().addClass("error-mess");
            address_orders_commune.parent().after("<label class='error-mess' id='address_orders_commune_error'>Vui lòng chọn Xã/Phường</label>");
        }
        $('#address_orders_commune').focus();
        validate6 = false;
    } else {
        address_orders_commune.parent().removeClass("error-mess");
        $("#address_orders_commune_error").remove();
    }
    // validate địa chỉ chi tiết
    if (address_orders_detail.val().trim() == '') {
        if (address_orders_detail.parent().hasClass("error-mess") == false) {
            address_orders_detail.parent().addClass("error-mess");
            address_orders_detail.parent().after("<label class='error-mess' id='address_orders_detail_error'>Vui lòng nhập địa chỉ chi tiết</label>");
        }
        $('#address_orders_detail').focus();
        validate7 = false;
    } else {
        address_orders_detail.parent().removeClass("error-mess");
        $("#address_orders_detail_error").remove();
    }

    if (validate1 == false || validate2 == false || validate3 == false || validate4 == false || validate5 == false || validate6 == false || validate7 == false) {
        return false;
    }
    return true;
}

function AddDataInforship(e) {
    let validate = validateDataInforship();
    if (validate) {
        var address_orders_user_name = $("#address_orders_user_name").val().trim();
        var address_orders_user_phone = $("#address_orders_user_phone").val().trim();
        var address_orders_user_email = $("#address_orders_user_email").val().trim();
        var address_orders_city = $("#address_orders_city").val().trim();
        var address_orders_district = $("#address_orders_district").val().trim();
        var address_orders_commune = $("#address_orders_commune").val().trim();
        var address_orders_detail = $("#address_orders_detail").val().trim();
        var formdata = new FormData();
        formdata.append('address_orders_user_name', address_orders_user_name);
        formdata.append('address_orders_user_phone', address_orders_user_phone);
        formdata.append('address_orders_user_email', address_orders_user_email);
        formdata.append('address_orders_city', address_orders_city);
        formdata.append('address_orders_district', address_orders_district);
        formdata.append('address_orders_commune', address_orders_commune);
        formdata.append('address_orders_detail', address_orders_detail);
        $.ajax({
            'type': "POST",
            'url': "/api/AddDataInforship",
            'data': formdata,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function (data) {
                if (data.result) {
                    alert(data.message);
                }
            }
        });
    }
}

function SetShipDefalt(e) {
    var ShipDefalt = $(e).val().trim();
    if (ShipDefalt == 0) {
        alert("Bạn chưa có địa chỉ giao hàng. Vui Lòng thêm hoặc chọn địa chỉ mặc định!!");
        $('html, body').animate({
            scrollTop: 70
        }, 700);
        return false;
    }
    $.ajax({
        url: '/api/SetShipDefalt',
        type: 'POST',
        data: {
            address_orders_id: ShipDefalt
        },
        success: function (data) {
            if (!data.result) {
                return alert(data.message);
            }
            alert(data.message || "Có lỗi xảy ra");
            location.reload();
        }
    })
}

function PayMent(e) {
    // Kiểm tra xác thực chính sách mua hàng
    if ($("input[name='purchasing_policy_input']:checked").length == 0) {
        $("input[name='purchasing_policy_input']").focus();
        alert("Vui lòng xác nhận chính sách mua hàng của Fashion Houes");
        return false;
    }
    // Kiểm tra địa chỉ mua hàng
    var shipaddress = $("#shipaddress").val();
    if (shipaddress == 0) {
        alert("Bạn chưa có địa chỉ giao hàng. Vui Lòng thêm hoặc chọn địa chỉ mặc định!!");
        $('html, body').animate({
            scrollTop: 70
        }, 700);
        return false;
    }
    // Mã đơn hàng
    var order_code = $(e).attr("data-order-code");
    // Lấy địa chỉ giao hàng mặc định
    var address_orders_user_name = $('.confirmOrder-ship .address_orders_user_name').text().trim();
    var address_orders_detail = $('.confirmOrder-ship .address_orders_detail').text().trim();
    var address_orders_user_phone = $('.confirmOrder-ship .address_orders_user_phone').text().trim();
    var address_orders_user_email = $('.confirmOrder-ship .address_orders_user_email').text().trim();
    // ghi chú
    var payment_note = $("#ghi_chu").val().trim();
    // thông tin sản phẩm
    var arr_confirm_id = [];
    var arr_cart_id = [];
    var arr_product_code = [];
    var arr_product_amount = [];
    var arr_product_classification = [];
    var arr_product_totalprice = [];
    var arr_product_feeship = [];
    var arr_product_unitprice = [];
    $(".data-confirmOrder .item-detail-order").each(function () {
        var cart_id = $(this).attr("data-cart-id");
        var order_confirm_id = $(this).attr("data-order-confirm-id");
        var ordetail_product_code = $(this).attr("data-product-code");
        var ordetail_product_amount = $(this).attr("data-product-amount");
        var ordetail_product_classification = $(this).attr("data-product-classification");
        var ordetail_product_totalprice = $(this).attr("data-product-totalprice");
        var ordetail_product_feeship = $(this).attr("data-product-feeship");
        var ordetail_product_unitprice = $(this).attr("data-product-unitprice");
        arr_confirm_id.push(order_confirm_id);
        arr_cart_id.push(cart_id);
        arr_product_code.push(ordetail_product_code);
        arr_product_amount.push(ordetail_product_amount);
        arr_product_classification.push(ordetail_product_classification);
        arr_product_totalprice.push(ordetail_product_totalprice);
        arr_product_feeship.push(ordetail_product_feeship);
        arr_product_unitprice.push(ordetail_product_unitprice);
    });
    // Phương thức thanh toán
    var payment_type = $("input[name='payment-type']:checked").val().trim();
    var total_all_payment = $(".container-detail-paymentall .total_all_payment").attr('data').trim();
    // Thông tin tài khoản
    var account_number = $(".account_number").text().trim();
    var bank_name = $(".account_number").text().trim();
    var account_owner = $(".account_number").text().trim();
    var bank_branch = $(".bank_branch").text().trim();
    var bank_content_tranfer = $(".bank_content_tranfer").text().trim();

    var formdata = new FormData();
    formdata.append("order_code", order_code);
    formdata.append("address_orders_user_name", address_orders_user_name);
    formdata.append("address_orders_detail", address_orders_detail);
    formdata.append("address_orders_user_phone", address_orders_user_phone);
    formdata.append("address_orders_user_email", address_orders_user_email);
    formdata.append("payment_note", payment_note);
    formdata.append("arr_confirm_id", arr_confirm_id.join(','));
    formdata.append("arr_cart_id", arr_cart_id.join(','));
    formdata.append("arr_product_code", arr_product_code.join(','));
    formdata.append("arr_product_amount", arr_product_amount.join(','));
    formdata.append("arr_product_classification", arr_product_classification.join(','));
    formdata.append("arr_product_totalprice", arr_product_totalprice.join(','));
    formdata.append("arr_product_feeship", arr_product_feeship.join(','));
    formdata.append("arr_product_unitprice", arr_product_unitprice.join(','));
    formdata.append("payment_type", payment_type);
    formdata.append("total_all_payment", total_all_payment);
    formdata.append("account_number", account_number);
    formdata.append("bank_name", bank_name);
    formdata.append("account_owner", account_owner);
    formdata.append("bank_branch", bank_branch);
    formdata.append("bank_content_tranfer", bank_content_tranfer);

    $.ajax({
        url: "/api/PayMent",
        data: formdata,
        type: "POST",
        dataType: "JSON",
        processData: false,
        contentType: false,
        success: function (data) {
            console.log(data);
            if(!data.result){
                alert(data.message);
            }
            alert(data.message);
            location.href='/quan-ly-don-hang'
        }
    });
}