<link rel="stylesheet" href="{{ asset(path: 'css/layouts/footer.css') }}?v={{ time() }}">
<!-- link js trang chủ -->
<script src="{{ asset('js/common.js') }}?v={{ time() }}" defer></script>
<div id="loading">
    <div class="loading">
        <span class="loading-circle"></span>
        <span class="loading-circle"></span>
        <span class="loading-circle"></span>
        <span class="loading-circle-shadow"></span>
        <span class="loading-circle-shadow"></span>
        <span class="loading-circle-shadow"></span>
    </div>
</div>
<footer id="footer">
    <div class="footer_container">
        <div class="footer_center">
            <div class="footer_center_left">
                <div class="footer_center_left_box">
                    <div class="footer_logo">
                        <img class="footer_img_logo" src="{{ asset('images/home/logoweb.png') }}" alt="icon">
                    </div>
                    <div class="footer_center_left_content">
                        <div class="footer_box_left_content">
                            <img src="{{ asset('images/icon/icongmail.svg') }}" alt="icon">
                            <p class="font_s14 line_h18 cl_fff">Email: fashionhoues@gmail.com</p>
                        </div>
                        <div class="footer_box_left_content">
                            <img src="{{ asset('images/icon/icongmail.svg') }}" alt="icon">
                            <p class="font_s14 line_h18 cl_fff">Điện thoại: 0123456789</p>
                        </div>
                        <div class="footer_box_left_content">
                            <img src="{{ asset('images/icon/icongmail.svg') }}" alt="icon">
                            <p class="font_s14 line_h18 cl_fff">Thời gian: Thứ Hai đến Thứ Bảy, 8:00 sáng đến 6:00 chiều</p>
                        </div>
                        <div class="footer_box_left_content">
                            <img src="{{ asset('images/icon/icongmail.svg') }}" alt="icon">
                            <p class="font_s14 line_h18 cl_fff">Địa chỉ: Hà Nội</p>
                        </div>
                    </div>
                </div>
                <div class="footer_center_left_box">
                    <p class="footer_center_left_boxtitle font_s16 line_h20 font_w500 cl_fff">Thông tin chung</p>
                    <div class="footer_center_left_boxcontent">
                        <div class="footer-list-content">
                            <img width="24px" height="24px" alt="icon" src="{{ asset('/images/icon/Play_fill.png') }}">
                            <a href="" rel="nofollow" class="font_s14 cl_fff font_w400 line_h18">Về chúng tôi</a>
                        </div>
                        <div class="footer-list-content">
                            <img width="24px" height="24px" alt="icon" src="{{ asset('/images/icon/Play_fill.png') }}">
                            <a href="" rel="nofollow" class="font_s14 cl_fff font_w400 line_h18">Câu hỏi thường gặp</a>
                        </div>
                        <div class="footer-list-content">
                            <img width="24px" height="24px" alt="icon" src="{{ asset('/images/icon/Play_fill.png') }}">
                            <a href="" rel="nofollow" class="font_s14 cl_fff font_w400 line_h18">Sự kiện</a>
                        </div>
                        <div class="footer-list-content">
                            <img width="24px" height="24px" alt="icon" src="{{ asset('/images/icon/Play_fill.png') }}">
                            <a href="" rel="nofollow" class="font_s14 cl_fff font_w400 line_h18">Tin tức</a>
                        </div>
                        <div class="footer-list-content">
                            <img width="24px" height="24px" alt="icon" src="{{ asset('/images/icon/Play_fill.png') }}">
                            <a href="" rel="nofollow" class="font_s14 cl_fff font_w400 line_h18">Tuyển dụng</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer_center_right">
                <div class="footer_center_right_box">
                    <p class="footer_center_right_boxtitle font_s16 line_h20 font_w500 cl_fff">Chính sách bán hàng</p>
                    <div class="footer_center_right_boxcontent">
                        <div class="footer-list-content">
                            <img width="24px" height="24px" alt="icon" src="{{ asset('/images/icon/Play_fill.png') }}">
                            <a href="" rel="nofollow" class="font_s14 cl_fff font_w400 line_h18">Chính sách thanh toán</a>
                        </div>
                        <div class="footer-list-content">
                            <img width="24px" height="24px" alt="icon" src="{{ asset('/images/icon/Play_fill.png') }}">
                            <a href="" rel="nofollow" class="font_s14 cl_fff font_w400 line_h18">Chính sách vận chuyển</a>
                        </div>
                        <div class="footer-list-content">
                            <img width="24px" height="24px" alt="icon" src="{{ asset('/images/icon/Play_fill.png') }}">
                            <a href="" rel="nofollow" class="font_s14 cl_fff font_w400 line_h18">Chính sách bảo mật</a>
                        </div>
                        <div class="footer-list-content">
                            <img width="24px" height="24px" alt="icon" src="{{ asset('/images/icon/Play_fill.png') }}">
                            <a href="" rel="nofollow" class="font_s14 cl_fff font_w400 line_h18">Chính sách đổi trả</a>
                        </div>
                    </div>
                </div>
                <div class="footer_center_right_box">
                    <p class="footer_center_right_boxtitle font_s16 line_h20 font_w500 cl_fff">Đăng ký nhận thông tin</p>
                    <div class="footer_center_right_boxcontent">
                        <p class="font_s14 cl_fff font_w400 line_h20">Đăng kí nhận thông tin ưu đãi và xu hướng mới nhất</p>
                        <div class="form_news_letter_email">
                            <div class="icon_email">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512"><g><g><g><path d="M485.743,85.333H26.257C11.815,85.333,0,97.148,0,111.589V400.41c0,14.44,11.815,26.257,26.257,26.257h459.487 c14.44,0,26.257-11.815,26.257-26.257V111.589C512,97.148,500.185,85.333,485.743,85.333z M475.89,105.024L271.104,258.626 c-3.682,2.802-9.334,4.555-15.105,4.529c-5.77,0.026-11.421-1.727-15.104-4.529L36.109,105.024H475.89z M366.5,268.761 l111.59,137.847c0.112,0.138,0.249,0.243,0.368,0.368H33.542c0.118-0.131,0.256-0.23,0.368-0.368L145.5,268.761 c3.419-4.227,2.771-10.424-1.464-13.851c-4.227-3.419-10.424-2.771-13.844,1.457l-110.5,136.501V117.332l209.394,157.046 c7.871,5.862,17.447,8.442,26.912,8.468c9.452-0.02,19.036-2.6,26.912-8.468l209.394-157.046v275.534L381.807,256.367 c-3.42-4.227-9.623-4.877-13.844-1.457C363.729,258.329,363.079,264.534,366.5,268.761z" fill="currentColor" data-original="currentColor"></path></g></g></g></svg>
                            </div>   
                            <input type="email" name="news_letter_email" class="news_letter_input" id="news_letter_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Nhập email của bạn">
                            <div class="container_send_newsletter">
                                <button type="submit" class="button_send_newsletter">Đăng ký</button>
                            </div>
                        </div>
                        <div class="form_mxh">
                            <div class="mxh_icon">
                                <img width="24px" height="24px" alt="icon" src="{{ asset('/images/icon/icon_facebook.png') }}">
                            </div>
                            <div class="mxh_icon">
                                <img width="24px" height="24px" alt="icon" src="{{ asset('/images/icon/icon_instagram.png') }}">
                            </div>
                            <div class="mxh_icon">
                                <img width="24px" height="24px" alt="icon" src="{{ asset('/images/icon/icon_tiktok.png') }}">
                            </div>
                            <div class="mxh_icon">
                                <img width="24px" height="24px" alt="icon" src="{{ asset('/images/icon/icon_youtube.png') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_bottom">
            <p class="font_s14 cl_fff font_w400 line_h18 w100 txt_alct">© Bản quyền thuộc về Fashion Houes</p>
        </div>
    </div>
</footer>