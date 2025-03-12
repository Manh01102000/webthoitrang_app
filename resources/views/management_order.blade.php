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
    <link rel="stylesheet" href="{{ asset('css/manager_account/management_order.css') }}?v={{ time() }}">
    <!-- link js trang chủ -->
    <script src="{{ asset('js/manager_account/management_order.js') }}?v={{ time() }}"></script>
</head>

<body>
<div class="container_home">
        <!-- header -->
        @include('layouts.header')
        <h1 hidden>Fashion Houses – Shop Quần Áo Thời Trang Cao Cấp</h1>
        <!-- content -->
        <div class="container-page">
            <div class="container-general-allpage">
                <!-- breadcrumb -->
                {!! renderBreadcrumb($dataAll['breadcrumbItems']) !!}
                <!-- end breadcrumb -->
                <div class="frame-manageraccount-all">
                    @include('layouts.manager_account.sidebar')
                    <main class="main-container">
                        <div class="container-management-order">
                            <div class="management-order">
                                <nav class="management-order-nav">
                                    <ul class="management-order-top">
                                        <li class="menu-management-order active-management-order">
                                            <a class="management-order-title font_s15 line_h500 font_w500 cl_000" href="/quan-ly-don-hang">
                                                Quản lý đơn hàng
                                            </a>
                                        </li>
                                        <li class="menu-management-order">
                                            <a class="management-order-title font_s15 line_h500 font_w500 cl_000" href="/quan-ly-don-hang/dang-xu-ly">
                                                Đang xử lý (0)
                                            </a>
                                        </li>
                                        <li class="menu-management-order">
                                            <a class="management-order-title font_s15 line_h500 font_w500 cl_000" href="/quan-ly-don-hang/dang-giao-hang">
                                                Đang giao hàng (0)
                                            </a>
                                        </li>
                                        <li class="menu-management-order">
                                            <a class="management-order-title font_s15 line_h500 font_w500 cl_000" href="/quan-ly-don-hang/da-huy">
                                                Đã hủy (0)
                                            </a>
                                        </li>
                                        <li class="menu-management-order">
                                            <a class="management-order-title font_s15 line_h500 font_w500 cl_000" href="/quan-ly-don-hang-ban/da-giao">
                                                Đã giao (0)
                                            </a>
                                        </li>
                                        <li class="menu-management-order">
                                            <a class="management-order-title font_s15 line_h500 font_w500 cl_000" href="/quan-ly-don-hang-ban/hoan-tat">
                                                Hoàn tất (0)
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                                <div class="management-order-content">
                                    <div class="order-content-item">
                                        <div class="order-content-head">
                                            <div class="order-head-brand">
                                                <img src="{{ asset('/images/icon/icon_store_black.png') }}" width="18px" height="18px" alt="icon">
                                                <p class="order-head-brand-name">Fashion Houses</p>
                                            </div>
                                            <div class="order-head-status">
                                                <p class="order-head-status-text">Chờ xử lý</p>
                                            </div>
                                        </div>
                                        <div class="order-content-center">
                                            <div class="box-order-product">
                                                <div class="box-product-avatar">
                                                    <img src="{{ asset('/images/product_sample/anh3.jpg') }}" class="product-avatar" alt="avatar">
                                                </div>
                                                <div class="product-infor">
                                                    <p class="product-infor-name">Tên sản phẩm</p>
                                                    <p class="product-infor-cate">Loại sản phẩm: Áo nữ</p>
                                                    <p class="product-infor-number">Số lượng: x1</p>
                                                    <div class="product-infor-price">
                                                        <p class="infor-price-discount font_s16 line_h20 font_w500 cl_red">
                                                            {{ number_format(100000, 0, ',', '.') }} đ
                                                        </p>
                                                        <p class="infor-price-original font_s14 line_h18 font_w400 cl_333">
                                                            {{ number_format(150000, 0, ',', '.') }} đ
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-order-gift">
                                                <div class="box-gift-avatar">
                                                    <img src="{{ asset('/images/product_sample/anh3.jpg') }}"  class="gift-avatar" alt="avatar">
                                                </div>
                                                <div class="gift-infor">
                                                    <p class="gift-infor-desc">
                                                        Top những bộ Áo Dài Chụp Ảnh Đẹp Nhất của Áo Dài Nhân dành riêng cho những ai yêu thích lưu giữ những khoảnh khắc đẹp. Mỗi mẫu áo dài trong bộ sưu tập này được chọn lựa kỹ lưỡng với chất liệu vải cao cấp và họa tiết tinh tế, mang lại vẻ đẹp thanh thoát và sang trọng, giúp bạn tỏa sáng trong từng khung hình.
                                                    </p>
                                                    <p class="gift-infor-text">Quà tặng</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="order-content-bottom">
                                            <p class="box-total-price">
                                                Tổng số tiền: <span class="total-price">{{ number_format(100000, 0, ',', '.') }} đ</span>
                                            </p>
                                            <div class="container-button">
                                                <button type="button" class="btn-cancel-order">Hủy đơn hàng</button>
                                                <button type="button" class="btn-confirm-order">Xác nhận đơn hàng</button>
                                            </div>
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
