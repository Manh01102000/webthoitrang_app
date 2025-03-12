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
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}?v={{ time() }}">
    <!-- link js trang chủ -->
    <script src="{{ asset('js/contact.js') }}?v={{ time() }}"></script>
</head>

<body>
    <div class="container_home">
        <!-- header -->
        @include('layouts.header')
        <h1 hidden>Fashion Houses – Shop Quần Áo Thời Trang Cao Cấp</h1>
        <!-- content -->
        <div class="container-page">
            <div class="container-contact">
                <!-- breadcrumb -->
                {!! renderBreadcrumb($dataAll['breadcrumbItems']) !!}
                <!-- end breadcrumb -->
                <div class="frame-contact-all">
                    <div class="contact-all-left">
                        <div class="contact">
                            <div class="font_s15 line_h30 font_w500 txt-tf-up cl_main">Fashion House</div>
                            <div class="time_work">
                                <div class="item">
                                    <svg width="16" height="16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-marker-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-map-marker-alt fa-w-12"><path fill="#1c2d5b" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z" class=""></path></svg>
                                    <p class="font_s15 line_h20 font_w500">Địa chỉ: <span class="font_s14 line_h20 font_w400 cl_000">Hà Nội</span></p>
                                </div>
                                <div class="item">
                                    <svg width="16" height="16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-envelope fa-w-16"><path fill="#1c2d5b" d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z" class=""></path></svg>
                                    <p class="font_s15 line_h20 font_w500">Email: <a href="mailto:fashionhoues@gmail.com" class="font_s14 line_h20 font_w400 cl_000">fashionhoues@gmail.com</a></p>
                                </div>
                                <div class="item">
                                    <svg width="16" height="16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-phone-alt fa-w-16"><path fill="#1c2d5b" d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z" class=""></path></svg>
                                    <p class="font_s15 line_h20 font_w500">Số điện thoại: <a href="tel:0123456789" class="font_s14 line_h20 font_w400 cl_000">0123456789</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-contact">
                            <div class="font_s15 line_h30 font_w500 txt-tf-up cl_main"> Liên hệ với chúng tôi</div>
                            <div class="contact-form-center">
                                <div class="contact-box">
                                    <h2 class="contact-box-title font_s15 line_h20 font_w500">Họ và tên <span style="color: red;">*</span></h2>
                                    <div class="contact-box-item">
                                        <input class="contact_inp" type="text" id="contact_name">
                                    </div>
                                </div>
                                <div class="contact-box">
                                    <h2 class="contact-box-title font_s15 line_h20 font_w500">Email <span style="color: red;">*</span></h2>
                                    <div class="contact-box-item">
                                        <input class="contact_inp" type="text" id="contact_account">
                                    </div>
                                </div>
                                <div class="contact-box">
                                    <h2 class="contact-box-title font_s15 line_h20 font_w500">Số điện thoại liên hệ <span style="color: red;">*</span></h2>
                                    <div class="contact-box-item">
                                        <input class="contact_inp" type="text" id="contact_phone">
                                    </div>
                                </div>
                                <div class="contact-box contact_content">
                                    <h2 class="contact-box-title contact-box-title-content font_s15 line_h20 font_w500">Nội dung <span style="color: red;">*</span></h2>
                                    <div class="contact-box-item">
                                        <textarea class="contact_inp" placeholder="Nhập nội dung" id="contact_content" rows="5" cols="5"></textarea>
                                    </div>
                                </div>
                                <div class="contact-button">
                                    <button class="button_contact" onclick="Contact(this)" type="button">Gửi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="contact-all-right">
                        <img src="{{ asset('images/banner/anhcontact.jpg') }}" class="img-contact cursor_pt" alt="icon">
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
