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
            <a href="/tiep-thi-lien-ket" class="account-sidebar-item {{ $_SERVER['REQUEST_URI'] == '/tiep-thi-lien-ket' ? 'active-sidebar' : '' }}">
                <div class="account-sidebar-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.9897 22.5C11.5897 22.5 12.5197 22.21 13.4097 20.75L15.1697 17.9C15.3397 17.62 15.8597 17.35 16.1797 17.37L19.5198 17.54C21.5198 17.64 22.2197 16.81 22.4697 16.31C22.7197 15.81 22.9398 14.74 21.6398 13.22L19.6597 10.92C19.4597 10.68 19.3497 10.16 19.4397 9.86002L20.4498 6.63004C20.9598 5.01004 20.3898 4.14004 20.0098 3.76004C19.6298 3.38004 18.7497 2.83003 17.1297 3.37003L14.1797 4.34003C13.9097 4.43003 13.4097 4.35003 13.1797 4.19003L10.0997 1.97003C8.68972 0.950032 7.66976 1.22003 7.19976 1.47003C6.72976 1.72003 5.92977 2.40005 5.95977 4.14005L6.02977 7.93002C6.03977 8.21002 5.80977 8.67003 5.58977 8.84003L3.10973 10.72C1.75973 11.75 1.70973 12.78 1.79973 13.31C1.88973 13.84 2.28972 14.8 3.90972 15.3L7.13976 16.31C7.43976 16.4 7.80976 16.79 7.88976 17.09L8.65972 20.03C9.16972 21.96 10.1697 22.39 10.7297 22.47C10.7997 22.49 10.8897 22.5 10.9897 22.5ZM16.1498 15.87C15.2898 15.87 14.3398 16.39 13.8998 17.11L12.1398 19.96C11.6398 20.78 11.1898 21.03 10.9498 20.99C10.7198 20.96 10.3597 20.58 10.1097 19.66L9.33977 16.72C9.12977 15.92 8.37977 15.13 7.58977 14.89L4.35973 13.88C3.73973 13.69 3.33977 13.38 3.27977 13.06C3.21977 12.74 3.49976 12.32 4.01976 11.92L6.49974 10.04C7.10974 9.58004 7.54972 8.66002 7.53972 7.90002L7.46972 4.11002C7.45972 3.44002 7.61972 2.94004 7.90972 2.79004C8.19972 2.64004 8.68974 2.79002 9.23974 3.18002L12.3198 5.40002C12.9298 5.84002 13.9397 6.00004 14.6697 5.76004L17.6197 4.79004C18.2397 4.59004 18.7397 4.60002 18.9697 4.83002C19.1997 5.06002 19.2198 5.56002 19.0298 6.18002L18.0198 9.41003C17.7698 10.2 17.9898 11.27 18.5298 11.89L20.5098 14.19C21.1398 14.92 21.2397 15.43 21.1297 15.64C21.0297 15.85 20.5497 16.08 19.5997 16.03L16.2598 15.86C16.2198 15.87 16.1798 15.87 16.1498 15.87Z" fill="currentcolor"></path>
                        <path d="M2.08969 22.7502C2.27969 22.7502 2.46966 22.6802 2.61966 22.5302L5.64969 19.5002C5.93969 19.2102 5.93969 18.7302 5.64969 18.4402C5.35969 18.1502 4.87969 18.1502 4.58969 18.4402L1.55966 21.4702C1.26966 21.7602 1.26966 22.2402 1.55966 22.5302C1.70966 22.6802 1.89969 22.7502 2.08969 22.7502Z" fill="currentcolor"></path>
                    </svg>                        
                </div>
                <div class="account-sidebar-tex">Tiếp thị liên kết</div>
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