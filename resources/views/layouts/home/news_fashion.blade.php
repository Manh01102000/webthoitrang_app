<div class="container_content_home container_news_fashion d_flex al_ct jc_ct">
    <div class="content_home news_fashion">
        <div class="content_home_top news_fashion_top d_flex jc_ct jc_sb">
            <div class="cthome_top_left">
                <h2 class="cthome_top_text">Tin tức thời trang</h2>
            </div>
            <div class="cthome_top_right cthome_top_right_all">
                <a href="#" rel="nofollow" class="cthome_top_right_viewall">Xem tất cả</a>
                <img src="{{ asset('images/icon/next.png') }}" width="24px" height="24px" alt="icon">
            </div>
        </div>
        <div class="content_home_center news_fashion_center w100 d_flex al_ct">
            <div class="news_fashion_center_container">
                <?php for ($i=1;$i<4;$i++) { ?>
                <div class="news_fashion_center_item">
                    <div class="news_fashion_center_head">
                        <a href="" class="w100 h100" rel="nofollow">
                            <img class="news_fashion_center lazyload"
                            onerror="this.onerror=null; this.src='{{ asset('images/icon/load.gif') }}';"
                            src="{{ asset('images/upload/news/imgtintuc1.jpg') }}"
                            data-src="{{ asset('images/upload/news/imgtintuc1.jpg') }}?v={{ time() }}"
                            alt="anh">
                        </a>
                    </div>
                    <div class="news_fashion_center_content">
                        <a href="" rel="nofollow">
                            <h3 class="news_fashion_center_title">Mẫu ảnh áo dài Việt Nam</h3>
                        </a>
                        <div class="news_fashion_center_infor">
                            <div class="news_fashion_author">
                                <img src="{{ asset('images/icon/author.svg') }}" width="14px" height="14px" alt="icon">
                                <p class="font_s14 line_h18 cl_000">Mạnh</p>
                            </div>
                            <div class="news_fashion_createdate">
                                <img src="{{ asset('images/icon/date.svg') }}" width="14px" height="14px" alt="icon">
                                <p class="font_s14 line_h18 cl_000">16/02/2025</p>
                            </div>
                        </div>
                        <p class="news_fashion_center_desc">Top những bộ Áo Dài Chụp Ảnh Đẹp Nhất của Áo Dài Nhân dành riêng cho những ai yêu thích lưu giữ những khoảnh khắc đẹp. Mỗi mẫu áo dài trong bộ sưu tập này được chọn lựa kỹ lưỡng với chất liệu vải cao cấp và họa tiết tinh tế, mang lại vẻ đẹp thanh thoát và sang trọng, giúp bạn tỏa sáng trong từng khung hình.</p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="content_home_bottom"></div>
    </div>
        </div>