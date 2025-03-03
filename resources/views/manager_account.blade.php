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
    <link rel="stylesheet" href="{{ asset('css/manager_account/manager_account.css') }}?v={{ time() }}">
    <!-- link js chứa hàm chung -->
    <script src="{{ asset('js/function_general.js') }}?v={{ time() }}"></script>
    <!-- link js trang chủ -->
    <script src="{{ asset('js/manager_account/manager_account.js') }}?v={{ time() }}"></script>
</head>

<body>
<div class="container_home">
        <!-- header -->
        @include('layouts.header')
        <h1 hidden>Fashion Houses – Shop Quần Áo Thời Trang Cao Cấp</h1>
        <!-- content -->
        <div class="container-page">
            <div class="container-manageraccount">
                <section class="bread-crumb">
                    <div class="breadcrumb-container">
                        <ul class="breadcrumb dp_fl_fd_r">
                            <li><a href="/" target="_blank" class="otherssite">Trang chủ</a></li>
                            <li class="thissite dp_fl_fd_r">Quản lý tài khoản</li>
                        </ul>
                    </div>
                </section>
                <div class="frame-manageraccount-all">
                    @include('layouts.manager_account.sidebar')
                    <main class="main-container">
                        <div class="personal_profile">
                            <div class="personal_profile_top">
                                <div class="profile_top_title">
                                    <div class="profile_top-img">
                                        <img src="{{ asset('/images/manager_account/icon_profile.png') }}" width="32" height="32" class="profile_top-icon">
                                    </div>
                                    <div class="profile_top-title">
                                        <p class="profile_top-text">Thông tin tài khoản</p>
                                    </div>
                                </div>
                            </div>
                            <div class="personal_profile_content">
                                <div class="profile_content-avatar">
                                    <img onerror='this.onerror=null;this.src="/images/home/logoweberror.png";' src="/images/home/logoweberror.png" data-src="{{ asset($dataAll['data']['data']['us_logo']) }}?v={{ time() }}" class="lazyload profile_content-icon" alt="ảnh người dùng"> 
                                </div>
                                <div class="profile_content-content">
                                    <div class="profile_content-header">
                                        <div class="account-name">{{ !empty($dataAll['data']['data']['us_name']) ? $dataAll['data']['data']['us_name'] : 'Chưa cập nhật' }}</div>
                                        <div class="box-edit-prf cursor_pt" data-id="" onclick="showPopupEditProfile(this)">
                                            <p class="edit-prf font_s13 font_400 line_h16">
                                                Chỉnh sửa thông tin
                                            </p>
                                        </div>
                                    </div>
                                    <div class="profile_content-center">
                                        <p class="type-account profile_content-center-text font_s16 line_h20 font_w500 cl_000">
                                            Loại tài khoản: <span class="font_s16 line_h20 font_w400 cl_000">{{ $dataAll['data']['type'] ? "Tài khoản cá nhân" : "Chưa cập nhật" }}</span>
                                        </p>
                                        <p class="account-created-date profile_content-center-text font_s16 line_h20 font_w500 cl_000">
                                            Ngày sinh: <span class="font_s16 line_h20 font_w400 cl_000">{{ !empty($dataAll['data']['data']['use_birthday']) ? date('d-m-Y', $dataAll['data']['data']['use_birthday']) :'Chưa cập nhật' }}</span>
                                        </p>
                                        <p class="account-phone-num profile_content-center-text font_s16 line_h20 font_w500 cl_000">
                                            Số điện thoại: <span class="font_s16 line_h20 font_w400 cl_000">{{ !empty($dataAll['data']['data']['use_phone']) ? $dataAll['data']['data']['use_phone'] : 'Chưa cập nhật' }}</span>
                                        </p>
                                        <p class="account-email profile_content-center-text font_s16 line_h20 font_w500 cl_000">
                                            Email liên hệ: <span class="font_s16 line_h20 font_w400 cl_000">{{ !empty($dataAll['data']['data']['use_email_contact']) ? $dataAll['data']['data']['use_email_contact'] : 'Chưa cập nhật' }}</span>
                                        </p>
                                        <p class="account-address profile_content-center-text font_s16 line_h20 font_w500 cl_000">
                                            Địa chỉ liên hệ: <span class="font_s16 line_h20 font_w400 cl_000">{{ !empty($dataAll['data']['data']['use_address']) ? $dataAll['data']['data']['use_address'] : 'Chưa cập nhật' }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="personal_profile_edit">
                            <div class="personal_profile_top">
                                <div class="profile_top_title">
                                    <div class="profile_top-img">
                                        <img src="{{ asset('/images/manager_account/icon_profile.png') }}" width="32" height="32" class="profile_top-icon">
                                    </div>
                                    <div class="profile_top-title">
                                        <p class="profile_top-text">Chỉnh sửa thông tin tài khoản</p>
                                    </div>
                                </div>
                            </div>
                            <div class="profile_edit_content">
                                <div class="profile_edit-avatar">
                                    <label for="profile_avatar-input" class="labelavatar-preview cursor_pt">
                                        <img id="avatar-preview" onerror='this.onerror=null;this.src="/images/home/logoweberror.png";' src="/images/home/logoweberror.png" data-src="{{ asset($dataAll['data']['data']['us_logo']) }}?v={{ time() }}" alt="Ảnh đại diện" class="profile_edit-icon lazyload" />
                                        <input type="file" id="profile_avatar-input" accept="image/*" style="display: none" />
                                        <img src="/images/icon/img_uploadlogo.png" width="30px" height="30px" alt="icon" class="icon_uploadimg">
                                    </label>
                                </div>
                                <div class="profile_edit-content">
                                    <div class="profile_edit-center">
                                        <div class="profile_edit-box">
                                            <h2 class="profile_edit-box-title font_s16 line_h20 font_w500">Họ và tên <span style="color: red;">*</span></h2>
                                            <div class="profile_edit-box-item">
                                                <input class="profile_edit_inp" type="text" value="{{ !empty($dataAll['data']['data']['us_name']) ? $dataAll['data']['data']['us_name'] : '' }}" autocomplete="off" id="emp_name">
                                            </div>
                                        </div>
                                        <div class="profile_edit-box">
                                            <h2 class="profile_edit-box-title font_s16 line_h20 font_w500">Email liên hệ <span style="color: red;">*</span></h2>
                                            <div class="profile_edit-box-item">
                                                <input class="profile_edit_inp" type="text" value="{{ !empty($dataAll['data']['data']['use_email_contact']) ? $dataAll['data']['data']['use_email_contact'] : '' }}" autocomplete="off" id="emp_email_contact">
                                            </div>
                                        </div>
                                        <div class="profile_edit-box">
                                            <h2 class="profile_edit-box-title font_s16 line_h20 font_w500">Số điện thoại liên hệ <span style="color: red;">*</span></h2>
                                            <div class="profile_edit-box-item">
                                                <input class="profile_edit_inp" type="text" value="{{ !empty($dataAll['data']['data']['use_phone']) ? $dataAll['data']['data']['use_phone'] : '' }}" autocomplete="off" id="emp_phone">
                                            </div>
                                        </div>
                                        <div class="profile_edit-box">
                                            <h2 class="profile_edit-box-title profile_edit-box-title-birth font_s16 line_h20 font_w500">Ngày sinh <span style="color: red;">*</span></h2>
                                            <div class="profile_edit-box-item">
                                                <input class="profile_edit_inp" value="{{ !empty($dataAll['data']['data']['use_birthday']) ? date('Y-m-d', $dataAll['data']['data']['use_birthday']) :'' }}" type="date" id="emp_birth">
                                            </div>
                                        </div>
                                        <div class="profile_edit-box">
                                            <h2 class="profile_edit-box-title font_s16 line_h20 font_w500">Địa chỉ liên hệ</h2>
                                            <div class="profile_edit-box-item">
                                                <input class="profile_edit_inp" value="{{ !empty($dataAll['data']['data']['use_address']) ? $dataAll['data']['data']['use_address'] : '' }}" type="text" autocomplete="off" id="emp_address">
                                            </div>
                                        </div>
                                        <div class="profile_edit-button">
                                            <button class="btn_edit_profile" onclick="ProfileEdit(this)" type="button">Cập nhật</button>
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
