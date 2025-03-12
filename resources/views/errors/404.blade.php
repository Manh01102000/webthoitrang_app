<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="robots" content="{{ $dataSeo['robots'] }}">
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
    <link rel="stylesheet" href="{{ asset('css/page_404.css') }}?v={{ time() }}">
    <!-- link js trang chủ -->
    <script src="{{ asset('js/page_404.js') }}?v={{ time() }}" defer></script>
</head>

<body>
    <div class="container_home">
        <!-- header -->
        @include('layouts.header')
        <!-- content -->
        <div class="container-page">
            <div class="error-container">
                <h1 class="error-code">404</h1>
                <p class="error-message">Oops! Trang bạn tìm kiếm không tồn tại.</p>
                <a href="/" class="back-home">Quay lại trang chủ</a>

                <!-- Danh sách sản phẩm gợi ý -->
                <div class="suggested-products">
                    <h2>Sản phẩm bạn có thể thích</h2>
                    <div class="product-list">
                        @foreach ($dataAll['suggestedProducts'] as $product)
                            <div class="product-item">
                                <img src="{{ $product['product_images'] }}" alt="{{ $product['product_name'] }}">
                                <p>{{ $product['product_name'] }}</p>
                            </div>
                        @endforeach
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
