$(document).ready(function () {
    $('.m_slider').each(function () {
        let slider = $(this);
        slider.attr('data-current-slide', 0); // Đặt slide hiện tại là 0
        startAutoSlideBanner(slider); // Bắt đầu tự động chạy slide
    });
});

function showSlideBanner(index, slider) {
    let slidesContainer = slider.find('.m_slides');
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

function nextSlide(button) {
    let slider = $(button).closest('.m_slider'); // Tìm slider chứa nút bấm
    changeSlideBanner(slider, 1); // Chuyển sang slide kế tiếp
}

function prevSlide(button) {
    let slider = $(button).closest('.m_slider'); // Tìm slider chứa nút bấm
    changeSlideBanner(slider, -1); // Chuyển sang slide trước
}

function changeSlideBanner(slider, step) {
    let currentSlide = parseInt(slider.attr('data-current-slide')) || 0; // Lấy index hiện tại
    showSlideBanner(currentSlide + step, slider); // Hiển thị slide mới
    resetAutoSlideBanner(slider); // Reset lại auto-slide
}

function startAutoSlideBanner(slider, interval = 3000) {
    let autoSlideInterval = setInterval(function () {
        let currentSlide = parseInt(slider.attr('data-current-slide')) || 0;
        showSlideBanner(currentSlide + 1, slider); // Chuyển sang slide tiếp theo
    }, interval);

    slider.data('autoSlideInterval', autoSlideInterval); // Lưu ID interval vào data()
}

function resetAutoSlideBanner(slider) {
    clearInterval(slider.data('autoSlideInterval')); // Dừng auto-slide hiện tại
    startAutoSlideBanner(slider); // Khởi động lại auto-slide
}
