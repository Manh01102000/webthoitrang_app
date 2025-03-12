<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="robots" content="noindex,nofollow">
    <title>{{ $dataSeo['seo_title'] }}</title>
    <!-- SEO -->
    <meta name="keywords" content="{{ $dataSeo['seo_keyword'] }}" />
    <meta name="description" content="{{ $dataSeo['seo_desc'] }}" />
    <link rel="canonical" href="{{ $dataSeo['canonical'] }}" />
    <base href="{{ $domain }}" />
    <!-- the twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@fashionhoues">
    <meta name="twitter:title" content='{{ $dataSeo['seo_title'] }}' />
    <meta name="twitter:description" content='{{ $dataSeo['seo_desc'] }}' />
    <meta name="twitter:image" content="{{ $domain }}/images/home/logoweb.png" />
    <!-- the og -->
    <meta property="og:image" content="{{ $domain }}/images/home/logoweb.png" />
    <meta property="og:title" content="{{ $dataSeo['seo_title'] }}" />
    <meta property="og:description" content="{{ $dataSeo['seo_desc'] }}" />
    <meta property="og:url" content="{{ $dataSeo['canonical'] }}" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="website" />
    <!-- Thu vien su dung hoac cac muc dung chung -->
    @include('layouts.common_library')
    <!-- link css trang chủ -->
    <link rel="stylesheet" href="{{ asset('css/register.css') }}?v={{ time() }}">
    <!-- link js trang chủ -->
    <script src="{{ asset('js/register.js') }}?v={{ time() }}"></script>
</head>

<body>
    <div class="container_home">
        <!-- header -->
        @include('layouts.header')
        <h1 hidden>Đăng ký tài khoản</h1>
        <div id="register">
            <div class="register-container">
                <div class="register-frame">
                    <div class="register-introduce">
                        <img src="{{ asset('images/register/icon_man_fashion.png') }}" class="register-introduce-img" alt="icon">
                    </div>
                    <div class="register-form">
                        <div class="register-form-top">
                            <h1 class="form-top-title">Đăng ký tài khoản</h1>
                            <p class="form-top-text">Fashion Houses - Mua Sắm Thời Trang Đẳng Cấp</p>
                        </div>
                        <div class="register-form-center">
                            <div class="regis-box">
                                <h2 class="regis-box-title font_s16 line_h20 font_w500">Email <span style="color: red;">*</span></h2>
                                <div class="regis-box-item">
                                    <input class="regis_inp" value="" type="text" autocomplete="off" id="emp_account">
                                </div>
                            </div>
                            <div class="regis-box">
                                <h2 class="regis-box-title font_s16 line_h20 font_w500">Mật khẩu <span style="color: red;">*</span></h2>
                                <div class="regis-box-item">
                                    <input class="regis_inp" type="password" id="emp_password">
                                    <img src="{{ asset('images/icon/eyes-closed.png') }}" value="" class="register-icon-pass cursor_pt" onclick="CloseOpenPass(this)" data-showhide="0" alt="icon">
                                </div>
                            </div>
                            <div class="regis-box">
                                <h2 class="regis-box-title font_s16 line_h20 font_w500">Mật khẩu nhập lại <span style="color: red;">*</span></h2>
                                <div class="regis-box-item">
                                    <input class="regis_inp" type="password" id="emp_repassword">
                                    <img src="{{ asset('images/icon/eyes-closed.png') }}" class="register-icon-pass cursor_pt" onclick="CloseOpenPass(this)" data-showhide="0" alt="icon">
                                </div>
                            </div>
                            <div class="regis-box">
                                <h2 class="regis-box-title font_s16 line_h20 font_w500">Họ và tên <span style="color: red;">*</span></h2>
                                <div class="regis-box-item">
                                    <input class="regis_inp" type="text" autocomplete="off" id="emp_name">
                                </div>
                            </div>
                            <div class="regis-box">
                                <h2 class="regis-box-title font_s16 line_h20 font_w500">Số điện thoại liên hệ <span style="color: red;">*</span></h2>
                                <div class="regis-box-item">
                                    <input class="regis_inp" type="text" autocomplete="off" id="emp_phone">
                                </div>
                            </div>
                            <div class="regis-box">
                                <h2 class="regis-box-title regis-box-title-birth font_s16 line_h20 font_w500">Ngày sinh <span style="color: red;">*</span></h2>
                                <div class="regis-box-item">
                                    <input class="regis_inp" type="date" id="emp_birth">
                                </div>
                            </div>
                            <div class="regis-button">
                                <button class="button_register" onclick="Register(this)" type="button">Đăng ký</button>
                            </div>
                        </div>
                        <div class="regis-support">
                            <p class="font_s14 font_w500 line_h18 cl_000">Bạn đã có tài khoản? <a class="font_s14 line_h18 cl_red" href="/dang-nhap-tai-khoan">Đăng nhập</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer -->
        @include('layouts.footer')
        <!-- end footer -->
    </div>
</body>

</html>
