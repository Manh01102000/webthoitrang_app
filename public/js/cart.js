$(document).ready(function () {
    $(".checkall_product").change(function () {
        if (this.checked) {
            $(".check_product").each(function () {
                this.checked = true;
                $(this).parents('.cart_item').addClass("active_ck")
            })
        } else {
            $(".check_product").each(function () {
                this.checked = false;
                $(this).parents('.cart_item').removeClass("active_ck")
            })
        };
        spam_chon();
    });

    $(".check_product").click(function () {
        if ($(this).is(":checked")) {
            $(this).parents('.cart_item').addClass("active_ck")
            var isAllChecked = 0;
            $(".check_product").each(function () {
                if (!this.checked)
                    isAllChecked = 1;
            })
            if (isAllChecked == 0) {
                $(".checkall_product").prop("checked", true);
            }
        } else {
            $(".checkall_product").prop("checked", false);
            $(this).parents('.cart_item').removeClass("active_ck")
        }

        spam_chon();
    });
});

function spam_chon() {
    var tongsp = 0;
    var phi_vc = 0;
    var tongtien = 0;
    var tongtienchuaship = 0;
    $(".cart_item.active_ck").each(function () {
        tongsp = ++tongsp;
        var phivc = Number($(this).find(".fee_ship").attr("data-feeship"));
        phi_vc = Number(phi_vc) + phivc;
        var tien_tt = Number($(this).find('.product-total-price').attr("data-totalprice"));
        tongtienchuaship = Number(tongtienchuaship) + Number(tien_tt);
        tongtien = Number(tongtien) + Number(tien_tt) + Number(phivc);
    });

    $('.cart_infor_detail .detail_count_product').find('.count_product').text(tongsp);
    $('.cart_infor_detail .shipping_fee').text(format_money(phi_vc, 0, ',', '.'));
    $('.cart_infor_detail .total_payment_noship').text(format_money(tongtienchuaship, 0, ',', '.'));
    $('.cart_infor_detail .total_payment').text(format_money(tongtien, 0, ',', '.'));
}

function PlusPrice(e) {
    var key = $(e).attr("data");
    var CheckDiscount = $(e).attr("CheckDiscount");
    var data_idcart = $(e).parents(".cart_item").attr("data-idcart");
    var so_luong = $(e).parents(".cart_item").find('.product-count').text().trim();
    if (CheckDiscount == 1) {
        var don_gia = $(e).parents(".cart_item").find('.unitsellingprice_discount').attr("data-price_discount");
    } else {
        var don_gia = $(e).parents(".cart_item").find('.unitsellingprice_original').attr("data-price_original");
    }
    so_luong = ++so_luong;
    var tongtien = Number(don_gia) * Number(so_luong);

    $(e).parents(".cart_item").find('.product-count').text(so_luong);
    $(e).parents(".cart_item").find('.product-total-price').attr('data-totalprice', tongtien);
    $(e).parents(".cart_item").find('.product-total-price').text(format_money(tongtien, '0', ',', '.') + ' đ');
    updateCountProduct(so_luong, data_idcart);
    spam_chon();
}

function MinusPrice(e) {
    var key = $(e).attr("data");
    var CheckDiscount = $(e).attr("CheckDiscount");
    var data_idcart = $(e).parents(".cart_item").attr("data-idcart");
    var so_luong = $(e).parents(".cart_item").find('.product-count').text().trim();
    if (CheckDiscount == 1) {
        var don_gia = $(e).parents(".cart_item").find('.unitsellingprice_discount').attr("data-price_discount");
    } else {
        var don_gia = $(e).parents(".cart_item").find('.unitsellingprice_original').attr("data-price_original");
    }
    if (so_luong > 1) {
        so_luong = --so_luong;
        var tongtien = Number(don_gia) * Number(so_luong);

        $(e).parents(".cart_item").find('.product-count').text(so_luong);
        $(e).parents(".cart_item").find('.product-total-price').attr('data-totalprice', tongtien);
        $(e).parents(".cart_item").find('.product-total-price').text(format_money(tongtien, '0', ',', '.') + ' đ');
        updateCountProduct(so_luong, data_idcart);
        spam_chon();
    }
}

function updateCountProduct(cart_product_amount, cart_id) {
    if (cart_id && cart_product_amount) {
        $.ajax({
            url: '/api/updateCartCountBuy',
            type: 'POST',
            data: {
                cart_product_amount,
                cart_id
            },
            success: function (e) { },
        });
    }

}

function ConfirmOrder(e) {
    var count_product = $(".detail_count_product").find('.count_product').text().trim();
    if (Number(count_product) > 0) {
        var arr_cart_id = [];
        var arr_total_price = [];
        var arr_unitprice = [];
        var arr_feeship = [];
        $(".cart_item.active_ck").each(function () {
            var cart_id = $(this).attr('data-idcart');
            var checkdiscount = $(this).attr('data-check-discount');
            var total_price = Number($(this).find('.product-total-price').attr('data-totalprice'));
            var feeship = Number($(this).find('.fee_ship').attr('data-feeship'));
            let unitprice = 0;
            if (checkdiscount == 0) {
                unitprice = Number($(this).find('.unitsellingprice_original').attr('data-price_original'));
            } else {
                unitprice = Number($(this).find('.unitsellingprice_discount').attr("data-price_discount"));
            }
            arr_cart_id.push(cart_id);
            arr_total_price.push(total_price);
            arr_unitprice.push(unitprice);
            arr_feeship.push(feeship);
        });
        var formdata = new FormData();
        formdata.append('arr_cart_id', arr_cart_id.join(','));
        formdata.append('arr_total_price', arr_total_price.join(','));
        formdata.append('arr_unitprice', arr_unitprice.join(','));
        formdata.append('arr_feeship', arr_feeship.join(','));
        $.ajax({
            url: '/api/ConfirmOrder',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.result) {
                    alert(data.message);
                    location.href = "/xac-nhan-don-hang";
                }
            }
        })
    } else {
        alert("Bạn chưa chọn sản phẩm cần mua!!");
        $('html, body').animate({
            scrollTop: 70
        }, 700);
    }
}