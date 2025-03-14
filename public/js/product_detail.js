$(document).ready(function () {
    $('.icon-copylinkuv').click(function () {
        var linkToCopy = $(this).parents('.box-showcopy').find('.txtlinkuv').text();
        // Tạo một thẻ textarea ẩn để chứa nội dung cần sao chép
        var tempTextarea = $('<textarea>');
        tempTextarea.val(linkToCopy);
        $('body').append(tempTextarea);
        // Chọn và sao chép nội dung từ thẻ textarea tạm thời
        tempTextarea.select();
        document.execCommand('copy');
        // Xóa thẻ textarea tạm sau khi sao chép xong
        tempTextarea.remove();
        alert('Đã sao chép link: ' + linkToCopy);
    });
});

// -------------------SLIDER---------------------
$(document).ready(function () {
    $('.top-image-big').each(function () {
        let slider = $(this);
        slider.attr('data-current-slide', 0); // Đặt slide hiện tại là 0
        startAutoSlide(slider); // Bắt đầu tự động chạy slide
    });
});

function showSlide(index, slider) {
    let slidesContainer = slider.find('.container-image-big');
    let totalSlides = slidesContainer.find('img').length;

    if (index >= totalSlides) {
        index = 0; // Nếu index vượt quá số lượng slide, quay lại slide đầu tiên
    } else if (index < 0) {
        index = totalSlides - 1; // Nếu index < 0, chuyển sang slide cuối cùng
    }

    let offset = -index * 100; // Dịch chuyển theo % (giả sử slide ngang 100% mỗi ảnh)
    slidesContainer.css('transform', `translateX(${offset}%)`); // Áp dụng hiệu ứng trượt

    slider.attr('data-current-slide', index); // Cập nhật slide hiện tại vào attribute
}

function nextSlideProd(button) {
    let slider = $(button).closest('.top-image-big'); // Tìm slider chứa nút bấm
    changeSlide(slider, 1); // Chuyển sang slide kế tiếp
}

function prevSlideProd(button) {
    let slider = $(button).closest('.top-image-big'); // Tìm slider chứa nút bấm
    changeSlide(slider, -1); // Chuyển sang slide trước
}

function changeSlide(slider, step) {
    let currentSlide = parseInt(slider.attr('data-current-slide')) || 0; // Lấy index hiện tại
    showSlide(currentSlide + step, slider); // Hiển thị slide mới
    resetAutoSlide(slider); // Reset lại auto-slide
}

function startAutoSlide(slider, interval = 5000) {
    let autoSlideInterval = setInterval(function () {
        let currentSlide = parseInt(slider.attr('data-current-slide')) || 0;
        showSlide(currentSlide + 1, slider); // Chuyển sang slide tiếp theo
    }, interval);

    slider.data('autoSlideInterval', autoSlideInterval); // Lưu ID interval vào data()
}

function resetAutoSlide(slider) {
    clearInterval(slider.data('autoSlideInterval')); // Dừng auto-slide hiện tại
    startAutoSlide(slider); // Khởi động lại auto-slide
}
// -------------------END---------------------

$(document).on("click", ".change-option_color", function () {
    let $item = $(this).closest('.prod-detail-top');

    // Xóa class active_o cũ và thêm vào phần tử mới click
    $item.find(".change-option_color").removeClass("active_o");
    $(this).addClass("active_o");

    let data_color = $(this).attr("data-color");
    let data_size = $item.find('.change-option_size.active_o').attr("data-size");
    console.log(data_size)
    console.log(data_color)
    if (!data_size) {
        console.warn("Chưa chọn màu sắc!");
        return;
    }

    UpdateStockAndPrice($item, data_size, data_color);
});

$(document).on("click", ".change-option_size", function () {
    let $item = $(this).closest('.prod-detail-top');

    // Xóa class active_o cũ và thêm vào phần tử mới click
    $item.find(".change-option_size").removeClass("active_o");
    $(this).addClass("active_o");

    let data_size = $(this).attr("data-size");
    let data_color = $item.find('.change-option_color.active_o').attr("data-color");
    console.log(data_size)
    console.log(data_color)
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
        $item.find(".prod-card_price_original").text(formattedPrice + " đ");
        $item.find(".prod-card_price_original").attr("data-price_original", newPrice)
        $item.find(".product-card_stock").text(newStock + ' sản phẩm sẵn có');

        if (checkDiscount !== 0) {
            $item.find(".prod-card_price_discount").text(formattedDiscountPrice + " đ");
            $item.find(".prod-card_price_discount").attr("data-price_discount", newDiscountPrice)
        }
    } else {
        console.warn("Không tìm thấy sản phẩm với màu và kích cỡ đã chọn.");
    }
}
// Hàm định dạng số thành chuỗi tiền tệ (dấu . ngăn cách hàng nghìn)
function formatCurrency(value) {
    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
// Sự kiện nhập số lượng sản phẩm mua
$('.product-card_count').keyup(function () {
    var stock = $(this).parents(".prod-card_amount_buy").attr('data-stock');
    var count_cart = $(this).val();
    if ((Number(count_cart) > Number(stock))) {
        alert("Số lượng đặt hàng tối đa: " + stock + " sản phẩm");
        $(this).val(stock);
        return;
    }
});
// Sự kiện tăng số lượng sản phẩm mua
function PlusCountProduct(e) {
    var stock = $(e).parents(".prod-card_amount_buy").attr('data-stock');
    var count_cart = Number($(e).parents(".prod-card_amount_buy").find('.product-card_count').val());
    var increase_count = ++count_cart;
    $(e).parents(".prod-card_amount_buy").find('.product-card_count').val(increase_count);
    if (stock != "" && increase_count > stock) {
        $(e).parents(".prod-card_amount_buy").find('.product-card_count').val(stock);
    }
}
// Sự kiện Giảm số lượng sản phẩm mua
function MinusCountProduct(e) {
    var stock = $(e).parents(".prod-card_amount_buy").attr('data-stock');
    var count_cart = Number($(e).parents(".prod-card_amount_buy").find('.product-card_count').val());
    var reduce_count = --count_cart;
    $(e).parents(".prod-card_amount_buy").find('.product-card_count').val(reduce_count);
    if (stock != "" && reduce_count <= 0) {
        $(e).parents(".prod-card_amount_buy").find('.product-card_count').val(1);
    }
}
// Chức năng thêm giỏ hàng
function addCart(e) {
    let data_user = $(e).parents('.prod-detail-top').attr("data-user");
    if (!data_user) {
        return alert("Bạn cần đăng nhập để thực hiện chức năng này");
    }
    let product_amount = $(e).parents('.prod-detail-top').find(".product-card_count").val().trim();
    let product_code = $(e).parents('.prod-detail-top').attr("data-product-code");
    let product_size = $(e).parents('.prod-detail-top').find(".change-option_size.active_o").attr("data-size");
    let product_color = $(e).parents('.prod-detail-top').find(".change-option_color.active_o").attr("data-color");
    if (!product_amount) {
        $(e).parents('.prod-detail-top').find(".product-card_count").focus();
        return alert("Vui lòng nhập số lượng sản phẩm");
    }
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
// Chức năng mua ngay
function BuyNow(e) {
    let data_user = $(e).parents('.prod-detail-top').attr("data-user");
    if (!data_user) {
        return alert("Bạn cần đăng nhập để thực hiện chức năng này");
    }
    // Lấy phí ship
    var feeship = Number($(e).parents('.prod-detail-top').find('.prod-card_shipping .fee_ship').attr('data-feeship'));
    // Lấy mã sản phẩm
    var product_code = $(e).parents('.prod-detail-top').attr('data-product-code');
    // Lấy giá tiền
    var checkdiscount = $(e).parents('.prod-detail-top').attr('data-check-discount');
    let unitprice = 0;
    if (checkdiscount == 0) {
        unitprice = Number($(e).parents('.prod-detail-top').find('.prod-card_price_original').attr('data-price_original'));
    } else {
        unitprice = Number($(e).parents('.prod-detail-top').find('.prod-card_price_discount').attr("data-price_discount"));
    }
    // Lấy classification
    let product_size = $(e).parents('.prod-detail-top').find(".change-option_size.active_o").attr("data-size");
    let product_color = $(e).parents('.prod-detail-top').find(".change-option_color.active_o").attr("data-color");
    var product_classification = product_size + ',' + product_color;
    product_classification = product_classification.trim();
    // Lấy số lượng sản phẩm
    var product_amount = Number($(e).parents(".prod-detail-top").find('.prod-card_amount_buy .product-card_count').val()) || 1;
    // Lấy tổng giá tiền
    var total_price = (product_amount * unitprice) || 0;

    console.log('product_code', product_code);
    console.log('product_amount', product_amount);
    console.log('product_classification', product_classification);
    console.log('total_price', total_price);
    console.log('unitprice', unitprice);
    console.log('feeship', feeship);

    var formdata = new FormData();
    formdata.append('product_code', product_code);
    formdata.append('product_amount', product_amount);
    formdata.append('product_classification', product_classification);
    formdata.append('total_price', total_price);
    formdata.append('unitprice', unitprice);
    formdata.append('feeship', feeship);
    $.ajax({
        url: '/api/ConfirmOrderBuyNow',
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
    });

}
// Đánh giá sản phẩm
function RatingProduct(e) {
    let data_user = $(e).attr("data-user");
    if (!data_user) {
        return alert("Bạn cần đăng nhập để thực hiện chức năng này!");
    }
    var rating = $(e).parents('.review-form').find("#rating").val();
    if (!rating) {
        return alert("Bạn chưa chọn số sao đánh giá!");
    }
    var product_id = $(e).attr("data-proid");
    if(!product_id){
        return alert("Có lỗi xảy ra vui lòng tải lại trang!");
    }
    $.ajax({
        type: "POST",
        url: "/api/RatingProduct",
        data: {
            rating,
            product_id,
        },
        dataType: "JSON",
        success: function (data) {
            if (!data.result) {
                return alert("Đánh giá thất bại");
            }
            alert(data.message);
            location.reload();
        }
    });
}