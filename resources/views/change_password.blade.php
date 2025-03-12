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
    <link rel="stylesheet" href="{{ asset('css/manager_account/change_password.css') }}?v={{ time() }}">
    <!-- link js trang chủ -->
    <script src="{{ asset('js/manager_account/change_password.js') }}?v={{ time() }}"></script>
</head>

<body>
<div class="container_home">
        <!-- header -->
        @include('layouts.header')
        <h1 hidden>Fashion Houses – Shop Quần Áo Thời Trang Cao Cấp</h1>
        <!-- content -->
        <div class="container-page">
            <div class="container-changepassword">
                <!-- breadcrumb -->
                {!! renderBreadcrumb($dataAll['breadcrumbItems']) !!}
                <!-- end breadcrumb -->
                <div class="frame-manageraccount-all">
                    @include('layouts.manager_account.sidebar')
                    <main class="main-container">
                        <div class="personal_profile_edit">
                            <div class="personal_profile_top">
                                <div class="profile_top_title">
                                    <div class="profile_top-img">
                                        <img src="{{ asset('/images/manager_account/icon_profile.png') }}" width="32" height="32" class="profile_top-icon">
                                    </div>
                                    <div class="profile_top-title">
                                        <p class="profile_top-text">Thay đổi mật khẩu</p>
                                    </div>
                                </div>
                            </div>
                            <div class="profile_edit_content">
                                <div class="profile_edit-content">
                                    <div class="profile_edit-center">
                                        <div class="profile_edit-box">
                                            <h2 class="profile_edit-box-title font_s16 line_h20 font_w500">Mật khẩu cũ <span style="color: red;">*</span></h2>
                                            <div class="profile_edit-box-item">
                                                <input class="profile_edit_inp" type="password" value="" autocomplete="off" id="emp_oldpassword">
                                                <img src="{{ asset('images/icon/eyes-closed.png') }}" class="profile_edit-icon-pass cursor_pt" onclick="CloseOpenPass(this)" data-showhide="0" alt="icon">
                                            </div>
                                        </div>
                                        <div class="profile_edit-box">
                                            <h2 class="profile_edit-box-title font_s16 line_h20 font_w500">Mật khẩu mới <span style="color: red;">*</span></h2>
                                            <div class="profile_edit-box-item">
                                                <input class="profile_edit_inp" type="password" value="" autocomplete="off" id="emp_password">
                                                <img src="{{ asset('images/icon/eyes-closed.png') }}" class="profile_edit-icon-pass cursor_pt" onclick="CloseOpenPass(this)" data-showhide="0" alt="icon">
                                            </div>
                                        </div>
                                        <div class="profile_edit-box">
                                            <h2 class="profile_edit-box-title font_s16 line_h20 font_w500">Mật khẩu nhập lại <span style="color: red;">*</span></h2>
                                            <div class="profile_edit-box-item">
                                                <input class="profile_edit_inp" type="password" value="" autocomplete="off" id="emp_repassword">
                                                <img src="{{ asset('images/icon/eyes-closed.png') }}" class="profile_edit-icon-pass cursor_pt" onclick="CloseOpenPass(this)" data-showhide="0" alt="icon">
                                            </div>
                                        </div>
                                        <div class="profile_edit-button">
                                            <button class="btn_edit_profile" onclick="ChangePassword(this)" type="button">Cập nhật</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
        <!-- footer -->
        @include('layouts.footer')
        <!-- end footer -->
    </div>
</body>

</html>
