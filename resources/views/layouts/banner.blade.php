<link rel="stylesheet" href="{{ asset('css/layouts/banner.css') }}?v={{ time() }}">
<div class="banner al_ct jc_ct">
    <div class="banner_top">
        <div class="container_banner_top m_slider">
            <div class="banner_top_img m_slides">
                <img src="{{ asset('images/banner/banner.webp') }}?v={{ time() }}" alt="banner" class="image_banner">
                <img src="{{ asset('images/banner/banner.webp') }}?v={{ time() }}" alt="banner" class="image_banner">
                <img src="{{ asset('images/banner/banner.webp') }}?v={{ time() }}" alt="banner" class="image_banner">
            </div>
            <button class="prev" onclick="prevSlide(this)">&#10094;</button>
            <button class="next" onclick="nextSlide(this)">&#10095;</button>
        </div>
    </div>
    <div class="banner_content">
        <div class="container_banner_content d_flex al_ct jc_sb">
            <div class="item_banner_content d_flex al_ct jc_ct">
                <img src="{{ asset('images/home/giaohang.webp') }}?v={{ time() }}" class="item_banner_content_img" alt="icon">
                <p class="item_banner_content_title font_s16 line_h20 color_fff font_w500">Miễn phí giao hàng</p>
                <p class="item_banner_content_text font_s14 line_h18 color_fff">Miễn phí ship với đơn hàng 599k</p>
            </div>
            <div class="item_banner_content d_flex al_ct jc_ct">
                <img src="{{ asset('images/home/thanhtoan.webp') }}?v={{ time() }}" class="item_banner_content_img" alt="icon">
                <p class="item_banner_content_title font_s16 line_h20 color_fff font_w500">Thanh toán COD</p>
                <p class="item_banner_content_text font_s14 line_h18 color_fff">Thanh toán khi nhận hàng</p>
            </div>
            <div class="item_banner_content d_flex al_ct jc_ct">
                <img src="{{ asset('images/home/vip.webp') }}?v={{ time() }}" class="item_banner_content_img" alt="icon">
                <p class="item_banner_content_title font_s16 line_h20 color_fff font_w500">Khách hàng VIP</p>
                <p class="item_banner_content_text font_s14 line_h18 color_fff">Ưu đãi cho khách hàng VIP</p>
            </div>
            <div class="item_banner_content d_flex al_ct jc_ct">
                <img src="{{ asset('images/home/baohanh.webp') }}?v={{ time() }}" class="item_banner_content_img" alt="icon">
                <p class="item_banner_content_title font_s16 line_h20 color_fff font_w500">Hỗ trợ bảo hành</p>
                <p class="item_banner_content_text font_s14 line_h18 color_fff">Đổi, sửa tại các chuỗi cửa hàng</p>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/layouts/banner.js') }}?v={{ time() }}"></script>