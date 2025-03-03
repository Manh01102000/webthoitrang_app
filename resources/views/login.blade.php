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
    <link rel="stylesheet" href="{{ asset('css/login.css') }}?v={{ time() }}">
    <!-- link js chứa hàm chung -->
    <script src="{{ asset('js/function_general.js') }}?v={{ time() }}"></script>
    <!-- link js trang chủ -->
    <script src="{{ asset('js/login.js') }}?v={{ time() }}"></script>
</head>

<body>
    <div class="container_home">
        <!-- header -->
        @include('layouts.header')
        <h1 hidden>Đăng nhập tài khoản</h1>
        <div id="login">
            <div class="login-container">
                <div class="login-frame">
                    <div class="login-form">
                        <div class="login-form-top">
                            <h1 class="form-top-title">Đăng nhập tài khoản</h1>
                            <p class="form-top-text">Fashion Houses - Mua Sắm Thời Trang Đẳng Cấp</p>
                        </div>
                        <div class="login-form-center">
                            <div class="logi-box">
                                <h2 class="logi-box-title font_s16 line_h20 font_w500">Email <span style="color: red;">*</span></h2>
                                <div class="logi-box-item">
                                    <input class="logi_inp" value="" type="text" autocomplete="off" id="emp_account">
                                </div>
                            </div>
                            <div class="logi-box">
                                <h2 class="logi-box-title font_s16 line_h20 font_w500">Mật khẩu <span style="color: red;">*</span></h2>
                                <div class="logi-box-item">
                                    <input class="logi_inp" type="password" autocomplete="off" id="emp_password">
                                    <img src="{{ asset('images/icon/eyes-closed.png') }}" value="" class="login-icon-pass cursor_pt" onclick="CloseOpenPass(this)" data-showhide="0" alt="icon">
                                </div>
                            </div>
                            <div class="logi-button">
                                <button class="button_login" onclick="login(this)" type="button">Đăng nhập</button>
                            </div>
                        </div>
                        <div class="logi-support">
                            <p class="font_s14 font_w500 line_h18 cl_000">Bạn chưa có tài khoản? <a class="font_s14 line_h18 cl_red" href="/dang-ký-tai-khoan">Đăng ký</a></p>
                        </div>
                    </div>
                    <div class="login-introduce">
                        <img src="{{ asset('images/register/anh_login.png') }}" class="login-introduce-img" alt="icon">
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
