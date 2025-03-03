$(document).on('click', '.btn_suggest_right .slick-next', function () {
    console.log(1);
    $('.container-showresult-search .list_suggest')[0].scrollLeft = $('.container-showresult-search .list_suggest').scrollLeft() + $('.container-showresult-search .list_suggest').width();
});

$(document).on('click', '.slick-prev', function () {
    console.log(1);
    $('.container-showresult-search .list_suggest').scrollLeft() - $('.container-showresult-search .list_suggest').width() > 0 ? $('.container-showresult-search .list_suggest').scrollLeft() - $('.container-showresult-search .list_suggest').width() : 0;
    $('.container-showresult-search .list_suggest')[0].scrollLeft = $('.container-showresult-search .list_suggest').scrollLeft() - $('.container-showresult-search .list_suggest').width();
});

$(document).on("click", ".infor_detail_price_size", function () {
    let $item = $(this).closest('.home_center_item');

    // Xóa class active_e cũ và thêm vào phần tử mới click
    $item.find(".infor_detail_price_size").removeClass("active_e");
    $(this).addClass("active_e");

    let data_size = $(this).attr("data-size");
    let data_color = $item.find('.infor_detail_price_color.active_e').attr("data-color");

    if (!data_color) {
        console.warn("Chưa chọn màu sắc!");
        return;
    }

    UpdateStockAndPrice($item, data_size, data_color);
});

$(document).on("click", ".infor_detail_price_color", function () {
    let $item = $(this).closest('.home_center_item');

    // Xóa class active_e cũ và thêm vào phần tử mới click
    $item.find(".infor_detail_price_color").removeClass("active_e");
    $(this).addClass("active_e");

    let data_color = $(this).attr("data-color");
    let data_size = $item.find('.infor_detail_price_size.active_e').attr("data-size");

    if (!data_size) {
        console.warn("Chưa chọn kích thước!");
        return;
    }

    UpdateStockAndPrice($item, data_size, data_color);
});

function UpdateStockAndPrice($item, data_size, data_color) {
    // Lấy và chuyển đổi data từ chuỗi sang mảng
    let productClassification = $item.attr("data-classification").split(";");
    let productPrice = $item.attr("data-price").split(";");
    let productStock = $item.attr("data-stock").split(";");
    let checkDiscount = Number($item.attr("data-check-discount"));
    let discountType = Number($item.attr("data-discount-type"));
    let discountPrice = Number($item.attr("data-discount-price"));

    // console.log("Classification:", productClassification);
    // console.log("Price:", productPrice);
    // console.log("Stock:", productStock);

    // Tìm vị trí của cặp (size, color) trong productClassification
    let searchValue = `${data_size},${data_color}`;
    let index = productClassification.indexOf(searchValue);

    if (index !== -1) {
        let newPrice = Number(productPrice[index]);
        let newStock = Number(productStock[index]);

        let formattedPrice = formatCurrency(newPrice);
        let newDiscountPrice = newPrice;

        if (checkDiscount !== 0) {
            if (discountType === 1) {
                let percent_discount = Math.round(newPrice * (discountPrice / 100));
                newDiscountPrice = newPrice - percent_discount;
            } else if (discountType === 2) {
                newDiscountPrice = newPrice - discountPrice;
            }
        }

        let formattedDiscountPrice = formatCurrency(newDiscountPrice);

        // Cập nhật UI
        $item.find(".infor_detail_price_original, .price_item_original").text(formattedPrice + "đ");
        $item.find(".span_productstock").text(newStock);

        if (checkDiscount !== 0) {
            $item.find(".infor_detail_price_discount, .price_item_discount").text(formattedDiscountPrice + "đ");
        }
    } else {
        console.warn("Không tìm thấy sản phẩm với màu và kích cỡ đã chọn.");
    }
}
// Hàm định dạng số thành chuỗi tiền tệ (dấu . ngăn cách hàng nghìn)
function formatCurrency(value) {
    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
// 
function addCart(e) {
    let product_amount = $(e).attr("data-product-amount") || 1;
    let product_code = $(e).attr("data-product-code");
    let product_size = $(e).parents('.home_center_item').find(".infor_detail_price_size.active_e").attr("data-size");
    let product_color = $(e).parents('.home_center_item').find(".infor_detail_price_color.active_e").attr("data-color");
    // console.log(product_amount);
    // console.log(product_code);
    // console.log(product_color);
    // console.log(product_size);
    if (!product_code) {
        return alert("Có lỗi xảy ra");
    }
    $.ajax({
        type: "POST",
        url: "/api/AddToCart",
        data: {
            product_amount,
            product_code,
            product_size,
            product_color,
        },
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            if (!data.result) {
                return alert("Thêm giỏ hàng thất bại");
            }
            alert(data.message);
        }
    });
}