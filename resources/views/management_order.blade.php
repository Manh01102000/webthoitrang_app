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
                                <!-- navigation -->
                                @include('layouts.manager_order.order_navigation')
                                <!-- end navigation -->
                                <div class="management-order-content">
                                    @foreach ($dataAll['dataOrder'] as $key => $order)
                                        @php
                                            $dataorder = $order['order'];
                                            $dataorderdetail = $order['details'];
                                        @endphp
                                        <div class="order-content-item" data-ordercode="{{ $dataorder['order_code'] }}">
                                            <div class="order-content-head">
                                                <div class="order-head-brand">
                                                    <p class="order-head-brand-name">Mã đơn hàng: {{ $dataorder['order_code'] }}</p>
                                                </div>
                                                <div class="order-head-status">
                                                    <p class="order-head-status-text">{{ OrderStatus()[$dataorder['order_status']] }}</p>
                                                </div>
                                            </div>
                                            <div class="order-content-center">
                                                <div class="box-order-product">
                                                    @foreach ($dataorderdetail as $orderdetail)
                                                        @php 
                                                        $data_product = $orderdetail['product']; 
                                                        $product_images = explode(',', $data_product['product_images']);
                                                        $url_avarta = getUrlImageVideoProduct($data_product['product_create_time'], 1) . $product_images[0];
                                                        @endphp
                                                        <div class="item-order-product">
                                                            <div class="box-product-avatar">
                                                                <img class="product-avatar lazyload"
                                                                onerror="this.onerror=null; this.src='{{ asset('images/icon/load.gif') }}';"
                                                                src="{{ asset('images/product_sample/anh1.jpg') }}"
                                                                data-src="{{ asset($url_avarta) }}?v={{ time() }}"
                                                                alt="{{ $data_product['product_name'] }}">
                                                            </div>
                                                            <div class="product-infor">
                                                                <a href="{{ rewriteProduct($data_product['product_id'], $data_product['product_alias'], $data_product['product_name']) }}" rel="nofollow" class="product-infor-name cl_000" title="{{ $data_product['product_name'] }}">
                                                                    {{ $data_product['product_name'] }}
                                                                </a>
                                                                <p class="product-infor-cate">Loại sản phẩm: {{ FindCategoryByCatId($data_product['category_children_code'])['cat_name'] }}</p>
                                                                <p class="product-infor-cate">Thương hiệu: {{ $data_product['product_brand'] ?? '' }}</p>
                                                                <p class="product-infor-number">Số lượng: x{{ $orderdetail['ordetail_product_amount'] ?? 1 }}</p>
                                                                <div class="product-infor-price">
                                                                    <p class="font_s14 line_h16 font_w400 cl_red">Thành tiền:</p>
                                                                    <p class="infor-price-discount font_s14 line_h16 font_w400 cl_red">
                                                                        {{ number_format($orderdetail['ordetail_product_totalprice'] ?? 0, 0, ',', '.') }} đ
                                                                    </p>
                                                                </div>
                                                                <div class="product-infor-ship">
                                                                    <p class="font_s14 line_h16 font_w400 cl_1287db">Phí ship:</p>
                                                                    <p class="infor-price-discount font_s14 line_h16 font_w400 cl_1287db">
                                                                        {{ number_format($orderdetail['ordetail_product_feeship'] ?? 0, 0, ',', '.') }} đ
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <!-- <div class="box-order-gift">
                                                    <div class="box-gift-avatar">
                                                        <img src="{{ asset('/images/product_sample/anh3.jpg') }}"  class="gift-avatar" alt="avatar">
                                                    </div>
                                                    <div class="gift-infor">
                                                        <p class="gift-infor-desc">
                                                            Top những bộ Áo Dài Chụp Ảnh Đẹp Nhất của Áo Dài Nhân dành riêng cho những ai yêu thích lưu giữ những khoảnh khắc đẹp. Mỗi mẫu áo dài trong bộ sưu tập này được chọn lựa kỹ lưỡng với chất liệu vải cao cấp và họa tiết tinh tế, mang lại vẻ đẹp thanh thoát và sang trọng, giúp bạn tỏa sáng trong từng khung hình.
                                                        </p>
                                                        <p class="gift-infor-text">Quà tặng</p>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="order-content-bottom">
                                                <p class="box-total-price">
                                                    Tổng số tiền: <span class="total-price">{{ number_format($dataorder['order_total_price'], 0, ',', '.') }} đ</span>
                                                </p>
                                                <div class="container-button">
                                                    <button type="button" class="btn-cancel-order" data-status="3" onclick="CancelOrder(this)">Hủy đơn hàng</button>
                                                    <button type="button" class="btn-confirm-order" data-status="1" onclick="ConfirmOrder(this)">Xác nhận đơn hàng</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
