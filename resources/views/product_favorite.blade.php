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
    <link rel="stylesheet" href="{{ asset('css/manager_account/product_favorite.css') }}?v={{ time() }}">
    <!-- link js chứa hàm chung -->
    <script src="{{ asset('js/function_general.js') }}?v={{ time() }}"></script>
    <!-- link js trang chủ -->
    <script src="{{ asset('js/manager_account/product_favorite.js') }}?v={{ time() }}"></script>
</head>

<body>
<div class="container_home">
        <!-- header -->
        @include('layouts.header')
        <h1 hidden>Fashion Houses – Shop Quần Áo Thời Trang Cao Cấp</h1>
        <!-- content -->
        <div class="container-page">
            <div class="container-general-allpage">
                <section class="bread-crumb">
                    <div class="breadcrumb-container">
                        <ul class="breadcrumb dp_fl_fd_r">
                            <li><a href="/" target="_blank" class="otherssite">Trang chủ</a></li>
                            <li class="thissite dp_fl_fd_r">Sản phẩm yêu thích</li>
                        </ul>
                    </div>
                </section>
                <div class="frame-manageraccount-all">
                    @include('layouts.manager_account.sidebar')
                    <main class="main-container">
                        <div class="container-product-favorite">
                            <div class="product-favorite">
                                <div class="product-favorite-top">
                                    <p class="product-favorite-title">Sản phẩm yêu thích</p>
                                </div>
                                <div class="product-favorite-content">
                                    @for ($i = 1; $i < 6; $i++)
                                    <div class="prodfav-item">
                                        <div class="prodfav-item-avatar">
                                            <img class="prodfav-item-img lazyload"
                                            onerror="this.onerror=null; this.src='{{ asset('images/icon/load.gif') }}';"
                                            src="{{ asset('images/product_sample/anh1.jpg') }}"
                                            data-src="{{ asset('images/product_sample/anh2.jpg') }}?v={{ time() }}"
                                            alt="anh">
                                            <img src="{{ asset('images/icon/favorite_active.png') }}" class="icon-favorite cursor_pt" width="16px" height="16px" prod-id="" onclick="FavoriteProduct(this)" alt="icon">
                                        </div>
                                        <div class="prodfav-item-desc">
                                            <p class="prodfav-desc-name">Tên sản phẩm</p>
                                            <p class="prodfav-desc-text">Số lượng kho: 10</p>
                                            <div class="product-price">
                                                <p class="product-price-discount">
                                                    {{ number_format(100000, 0, ',', '.') }} đ
                                                </p>
                                                <p class="product-price-original">
                                                    {{ number_format(150000, 0, ',', '.') }} đ
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
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
