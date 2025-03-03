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
    <link rel="stylesheet" href="{{ asset('css/news.css') }}?v={{ time() }}">
    <!-- link js trang chủ -->
    <script src="{{ asset('js/news.js') }}?v={{ time() }}"></script>
</head>

<body>
    <div class="container_home">
        <!-- header -->
        @include('layouts.header')
        <h1 hidden>Fashion Houses – Shop Quần Áo Thời Trang Cao Cấp</h1>
        <!-- content -->
        <div class="container-page">
            <div class="container-blog">
                <section class="bread-crumb">
                    <div class="breadcrumb-container">
                        <ul class="breadcrumb dp_fl_fd_r">
                            <li><a href="/" target="_blank" class="otherssite">Trang chủ</a></li>
                            <li class="thissite dp_fl_fd_r">Tin tức</li>
                        </ul>
                    </div>
                </section>
                <div class="frame-blog-all">
                    <!-- Bài viết nổi bật -->
                    <div class="frame-blog blog-hot">
                        <div class="blog-center">
                            <div class="blog_heading">
                                <h2 class="blog_heading_h2">Bài viết nổi bật</h2>
                            </div>
                            <div class="blog_center_container">
                                <?php for ($i = 1; $i < 10; $i++) { ?>
                                <div class="blog_center_item">
                                    <div class="blog_center_head">
                                        <a href="" class="w100 h100" rel="nofollow">
                                            <img class="blog_center lazyload"
                                            onerror="this.onerror=null; this.src='{{ asset('images/icon/load.gif') }}';"
                                            src="{{ asset('images/upload/news/imgtintuc1.jpg') }}"
                                            data-src="{{ asset('images/upload/news/imgtintuc1.jpg') }}?v={{ time() }}"
                                            alt="anh">
                                        </a>
                                    </div>
                                    <div class="blog_center_content">
                                        <a href="" rel="nofollow">
                                            <h3 class="blog_center_title">Mẫu ảnh áo dài Việt Nam</h3>
                                        </a>
                                        <div class="blog_center_infor">
                                            <div class="blog_author">
                                                <img src="{{ asset('images/icon/author.svg') }}" width="14px" height="14px" alt="icon">
                                                <p class="font_s14 line_h18 cl_000">Mạnh</p>
                                            </div>
                                            <div class="blog_createdate">
                                                <img src="{{ asset('images/icon/date.svg') }}" width="14px" height="14px" alt="icon">
                                                <p class="font_s14 line_h18 cl_000">16/02/2025</p>
                                            </div>
                                        </div>
                                        <p class="blog_center_desc">Top những bộ Áo Dài Chụp Ảnh Đẹp Nhất của Áo Dài Nhân dành riêng cho những ai yêu thích lưu giữ những khoảnh khắc đẹp. Mỗi mẫu áo dài trong bộ sưu tập này được chọn lựa kỹ lưỡng với chất liệu vải cao cấp và họa tiết tinh tế, mang lại vẻ đẹp thanh thoát và sang trọng, giúp bạn tỏa sáng trong từng khung hình.</p>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="frame-blog blog-others">
                        <div class="blog-left">
                            <!-- XU HUONG THOI TRANG -->
                            <div class="blog-fashiontrends">
                                <div class="blog_heading">
                                    <h2 class="blog_heading_h2">Xu hướng thời trang</h2>
                                    <a class="hide_mobile" href="/xu-huong-thoi-trang">Xem tất cả</a>
                                </div>
                                <div class="blog_center_container">
                                    <?php for ($i = 1; $i < 10; $i++) { ?>
                                    <div class="blog_center_item">
                                        <div class="blog_center_head">
                                            <a href="" class="w100 h100" rel="nofollow">
                                                <img class="blog_center lazyload"
                                                onerror="this.onerror=null; this.src='{{ asset('images/icon/load.gif') }}';"
                                                src="{{ asset('images/upload/news/imgtintuc1.jpg') }}"
                                                data-src="{{ asset('images/upload/news/imgtintuc1.jpg') }}?v={{ time() }}"
                                                alt="anh">
                                            </a>
                                        </div>
                                        <div class="blog_center_content">
                                            <a href="" rel="nofollow">
                                                <h3 class="blog_center_title">Mẫu ảnh áo dài Việt Nam</h3>
                                            </a>
                                            <div class="blog_center_infor">
                                                <div class="blog_author">
                                                    <img src="{{ asset('images/icon/author.svg') }}" width="14px" height="14px" alt="icon">
                                                    <p class="font_s14 line_h18 cl_000">Mạnh</p>
                                                </div>
                                                <div class="blog_createdate">
                                                    <img src="{{ asset('images/icon/date.svg') }}" width="14px" height="14px" alt="icon">
                                                    <p class="font_s14 line_h18 cl_000">16/02/2025</p>
                                                </div>
                                            </div>
                                            <p class="blog_center_desc">Top những bộ Áo Dài Chụp Ảnh Đẹp Nhất của Áo Dài Nhân dành riêng cho những ai yêu thích lưu giữ những khoảnh khắc đẹp. Mỗi mẫu áo dài trong bộ sưu tập này được chọn lựa kỹ lưỡng với chất liệu vải cao cấp và họa tiết tinh tế, mang lại vẻ đẹp thanh thoát và sang trọng, giúp bạn tỏa sáng trong từng khung hình.</p>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- TUYEN DUNG -->
                            <div class="blog-recruitment">
                                <div class="blog_heading">
                                    <h2 class="blog_heading_h2">Tin tức tuyển dụng</h2>
                                    <a class="hide_mobile" href="/tin-tuc-tuyen-dung">Xem tất cả</a>
                                </div>
                                <div class="blog_center_container">
                                    <?php for ($i = 1; $i < 10; $i++) { ?>
                                    <div class="blog_center_item">
                                        <div class="blog_center_head">
                                            <a href="" class="w100 h100" rel="nofollow">
                                                <img class="blog_center lazyload"
                                                onerror="this.onerror=null; this.src='{{ asset('images/icon/load.gif') }}';"
                                                src="{{ asset('images/upload/news/imgtintuc1.jpg') }}"
                                                data-src="{{ asset('images/upload/news/imgtintuc1.jpg') }}?v={{ time() }}"
                                                alt="anh">
                                            </a>
                                        </div>
                                        <div class="blog_center_content">
                                            <a href="" rel="nofollow">
                                                <h3 class="blog_center_title">Mẫu ảnh áo dài Việt Nam</h3>
                                            </a>
                                            <div class="blog_center_infor">
                                                <div class="blog_author">
                                                    <img src="{{ asset('images/icon/author.svg') }}" width="14px" height="14px" alt="icon">
                                                    <p class="font_s14 line_h18 cl_000">Mạnh</p>
                                                </div>
                                                <div class="blog_createdate">
                                                    <img src="{{ asset('images/icon/date.svg') }}" width="14px" height="14px" alt="icon">
                                                    <p class="font_s14 line_h18 cl_000">16/02/2025</p>
                                                </div>
                                            </div>
                                            <p class="blog_center_desc">Top những bộ Áo Dài Chụp Ảnh Đẹp Nhất của Áo Dài Nhân dành riêng cho những ai yêu thích lưu giữ những khoảnh khắc đẹp. Mỗi mẫu áo dài trong bộ sưu tập này được chọn lựa kỹ lưỡng với chất liệu vải cao cấp và họa tiết tinh tế, mang lại vẻ đẹp thanh thoát và sang trọng, giúp bạn tỏa sáng trong từng khung hình.</p>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="blog-right">
                            <div class="blog-right-box">
                                <p class="blog-right-head">Danh mục</p>
                                <div class="blog-right-content">
                                    <p class="blog-right-text">Bài viết nổi bật</p>
                                    <p class="blog-right-text">Xu hướng thời trang</p>
                                    <p class="blog-right-text">Tin tức tuyển dụng</p>
                                </div>
                            </div>
                            <div class="blog-right-box">
                                <p class="blog-right-head">Xem nhiều nhất</p>
                                <div class="blog-right-content">
                                    <div class="blog-right-item">
                                        <div class="blog-item-img">
                                            <a href="" class="w100 h100" rel="nofollow">
                                                <img class="blogitemimg lazyload"
                                                onerror="this.onerror=null; this.src='{{ asset('images/icon/load.gif') }}';"
                                                src="{{ asset('images/upload/news/imgtintuc1.jpg') }}"
                                                data-src="{{ asset('images/upload/news/imgtintuc1.jpg') }}?v={{ time() }}"
                                                alt="anh">
                                            </a>
                                        </div>
                                        <div class="blog-item-content">
                                            <p class="blog-item-title">Mẫu ảnh áo dài Việt Nam</p>
                                            <p class="blog-item-desc">Top những bộ Áo Dài Chụp Ảnh Đẹp Nhất của Áo Dài Nhân dành riêng cho những ai yêu thích lưu giữ những khoảnh khắc đẹp. Mỗi mẫu áo dài trong bộ sưu tập này được chọn lựa kỹ lưỡng với chất liệu vải cao cấp và họa tiết tinh tế, mang lại vẻ đẹp thanh thoát và sang trọng, giúp bạn tỏa sáng trong từng khung hình.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
