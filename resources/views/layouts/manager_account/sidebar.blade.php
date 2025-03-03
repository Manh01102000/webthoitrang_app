<link rel="stylesheet" href="{{ asset('css/manager_account/sidebar.css') }}?v={{ time() }}">
<aside class="sidebar-container">
    <div class="sidebar-frame">
        <div class="sidebar-header">
            <div class="box-account-avatar">
                <img onerror='this.onerror=null;this.src="/images/home/logoweberror.png";' src="/images/home/logoweberror.png" data-src="{{ asset($dataAll['data']['data']['us_logo']) }}?v={{ time() }}" class="lazyload account-avatar" alt="img">
            </div>
            <div class="box-account-name">
                <p class="account-name-text font_s16 line_h20 w_500 cursor_pt color_000">
                    Mạnh
                </p>
                <p class="account-name-text font_s14 line_h18 w_400 cursor_pt color_000">
                    Ngày tham gia: {{ !empty($dataAll['data']['data']['use_create_time']) ? date('d-m-Y', $dataAll['data']['data']['use_create_time']) :'Chưa cập nhật' }}
                </p>
                <p class="account-name-text font_s14 line_h18 w_400 cursor_pt color_000">
                    {{ $dataAll['data']['type'] ? "Tài khoản cá nhân" : "Chưa cập nhật" }}
                </p>
            </div>
        </div>
        <div class="sidebar-center">
            <a href="/quan-ly-tai-khoan" class="account-sidebar-item {{ $_SERVER['REQUEST_URI'] == '/quan-ly-tai-khoan' ? 'active-sidebar' : '' }}">
                <div class="account-sidebar-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.90219 17H18.0922C19.9922 17 20.9922 16 20.9922 14.1V2H2.99219V14.1C3.00219 16 4.00219 17 5.90219 17Z" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M2 2H22" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M8 22L12 20V17" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M16 22L12 20" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M7.5 11L10.65 8.37C10.9 8.16 11.23 8.22 11.4 8.5L12.6 10.5C12.77 10.78 13.1 10.83 13.35 10.63L16.5 8" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>                              
                </div>
                <div class="account-sidebar-tex">Quản lý tài khoản</div>
            </a>
            <a href="/quan-ly-don-hang" class="account-sidebar-item {{ $_SERVER['REQUEST_URI'] == '/quan-ly-don-hang' ? 'active-sidebar' : '' }}">
                <div class="account-sidebar-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.5 7.66952V6.69952C7.5 4.44952 9.31 2.23952 11.56 2.02952C14.24 1.76952 16.5 3.87952 16.5 6.50952V7.88952" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M8.99983 22H14.9998C19.0198 22 19.7398 20.39 19.9498 18.43L20.6998 12.43C20.9698 9.99 20.2698 8 15.9998 8H7.99983C3.72983 8 3.02983 9.99 3.29983 12.43L4.04983 18.43C4.25983 20.39 4.97983 22 8.99983 22Z" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15.4955 12H15.5045" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M8.49451 12H8.50349" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>                             
                </div>
                <div class="account-sidebar-tex">Quản lý đơn hàng</div>
            </a>
            <a href="/san-pham-yeu-thich" class="account-sidebar-item {{ $_SERVER['REQUEST_URI'] == '/san-pham-yeu-thich' ? 'active-sidebar' : '' }}">
                <div class="account-sidebar-icon">
                    <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.62 18.8101C11.28 18.9301 10.72 18.9301 10.38 18.8101C7.48 17.8201 1 13.6901 1 6.6901C1 3.6001 3.49 1.1001 6.56 1.1001C8.38 1.1001 9.99 1.9801 11 3.3401C12.01 1.9801 13.63 1.1001 15.44 1.1001C18.51 1.1001 21 3.6001 21 6.6901C21 13.6901 14.52 17.8201 11.62 18.8101Z" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>                           
                </div>
                <div class="account-sidebar-tex">Sản phẩm yêu thích</div>
            </a>
            <a href="/doi-mat-khau" class="account-sidebar-item {{ $_SERVER['REQUEST_URI'] == '/doi-mat-khau' ? 'active-sidebar' : '' }}">
                <div class="account-sidebar-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="img_dmk">
                        <path d="M6 10V8C6 4.69 7 2 12 2C17 2 18 4.69 18 8V10" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M17 22H7C3 22 2 21 2 17V15C2 11 3 10 7 10H17C21 10 22 11 22 15V17C22 21 21 22 17 22Z" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15.9965 16H16.0054" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M11.9945 16H12.0035" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M7.99451 16H8.00349" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>                         
                </div>
                <div class="account-sidebar-tex">Đổi mật khẩu</div>
            </a>
        </div>
    </div>
</aside>
<script src="{{ asset('js/manager_account/sidebar.js') }}?v={{ time() }}"></script>