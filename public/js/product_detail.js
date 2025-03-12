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
        $item.find(".product-card_stock").text(newStock + ' sản phẩm sẵn có');

        if (checkDiscount !== 0) {
            $item.find(".prod-card_price_discount").text(formattedDiscountPrice + " đ");
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