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
    <link rel="stylesheet" href="{{ asset('css/product_detail.css') }}?v={{ time() }}">
    <!-- link js trang chủ -->
    <script src="{{ asset('js/product_detail.js') }}?v={{ time() }}" defer></script>
</head>

<body>
    <div class="container_home">
        <!-- header -->
        @include('layouts.header')
        <!-- Banner -->
        <h1 hidden>Fashion Houses – Shop Quần Áo Thời Trang Cao Cấp</h1>
        @include('layouts.banner')
        <!-- content -->
        <div class="container-page">
            <div class="container-product-detail">
                <!-- Breadcrumb -->
                {!! renderBreadcrumb($dataAll['breadcrumbItems']) !!}
                <!-- end Breadcrumb -->
                <section class="product-detail">
                    <!-- layout-header -->
                    @include("layouts.product.layout-header")
                    <!-- layout-center -->
                    @include("layouts.product.layout-center")
                    <!-- customer-reviews-mobile -->
                    <div class="customer-reviews-mobile">
                        @include("layouts.product.layout-customer-reviews")
                    </div>
                    <!-- comment -->
                    @include("layouts.comment")
                    <!-- layout-footer -->
                    <!-- suggest product -->
                    @include("layouts.product.layout-suggest-product")
                   <!-- end  -->
                </section>
            </div>
        </div>
        <!-- footer -->
        @include('layouts.footer')
        <!-- end footer -->
    </div>
</body>

</html>
