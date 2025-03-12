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
    <!-- Thu vien su dung hoac cac muc dung chung -->
    @include('layouts.common_library')
    <!-- link css trang chủ -->
    <link rel="stylesheet" href="{{ asset('css/admin/home.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/admin/sidebar.css') }}?v={{ time() }}">
    <!-- link js trang chủ -->
    <script src="{{ asset('js/admin/home.js') }}?v={{ time() }}"></script>
    <!-- link js trang chủ -->
    <script src="{{ asset('js/admin/list_product.js') }}?v={{ time() }}"></script>
</head>

<body>
    <div class="container_home container_home_admin">
        <div class="dashboard">
            @include("admin.template.sidebar")
            <!-- Main Content -->
            <main id="main">
                @include("admin.template.header")
                <!-- Header -->
                <header class="header">
                    <h1 class="header__title">Danh sách sản phẩm</h1>
                </header>
                <div class="main-container">
                    <div class="main-header">
                        <div class="main-header-nav"></div>
                        <div class="main-header-search">
                            <input type="search" name="product_id" id="product_id" placeholder="ID" value="" class="search">
                            <input type="search" name="product_name" id="product_name" placeholder="Tên sản phẩm" value="" class="search">
                            <button type="button" class="btn-search" onclick="Search(this)">Tìm kiếm</button>
                        </div>
                    </div>
                    <div class="main-content">
                        <table id="listing" cellpadding="5" cellspacing="0" border="1" bordercolor="#C3DAF9" width="100%" class="table">
                            <tbody>
                                <tr>
                                    <th class="h" width="30">Stt</th>
                                    <th class="h">ID</th>
                                    <th class="h">Mã sản phẩm</th>
                                    <th class="h">Quản trị viên tạo</th>
                                    <th class="h">Tên sản phẩm</th>
                                    <th class="h">Ảnh đại diện</th>
                                    <th class="h">Thương hiệu</th>
                                    <th class="h">Kích thước</th>
                                    <th class="h">Màu sắc</th>
                                    <th class="h">Phân loại</th>
                                    <th class="h">Giá sản phẩm</th>
                                    <th class="h">Số lượng kho</th>
                                    <th class="h">Danh mục</th>
                                    <th class="h">Danh mục</th>
                                    <th class="h">Danh mục</th>
                                    <th class="h">Thời gian tạo</th>
                                    <th class="h">Thời gian cập nhật</th>
                                    <th class="h">Kích hoạt</th>
                                    <th class="h">Sửa</th>
                                    <th class="h">Xóa</th>
                                </tr>
                            </tbody>
                            <tbody>
                                @foreach ($dataAll['dataProduct'] as $key => $dataProduct)
                                    <tr>
                                        <td width="15" align="center">{{ $key + 1  }}</td>
                                        <td style="text-align: center">{{ $dataProduct['product_id'] }}</td>
                                        <td style="text-align: center">{{ $dataProduct['product_code'] }}</td>
                                        <td style="text-align: center">{{ $dataProduct['admin_name'] }}</td>
                                        <td>
                                            <a target="_blank" href="" style="text-transform: capitalize;">{{ $dataProduct['product_name'] }}</a>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php 
                                                $array_product_images = explode(',', $dataProduct['product_images']);
                                            ?>
                                            <img style="width:80px;height:80px" src="{{ asset(getUrlImageVideoProduct($dataProduct['product_create_time'], 1) . $array_product_images[0]) }}" alt="{{ $dataProduct['product_name'] }}">
                                        </td>
                                        <td style="text-align: center;">{{ $dataProduct['product_brand'] }}</td>
                                        <td style="text-align: center;">{{ $dataProduct['product_sizes'] }}</td>
                                        <td style="text-align: center;">{{ $dataProduct['product_colors'] }}</td>
                                        <td style="text-align: center;">{{ $dataProduct['product_classification'] }}</td>
                                        <td style="text-align: center;">{{ $dataProduct['product_price'] }}</td>
                                        <td style="text-align: center;">{{ $dataProduct['product_stock'] }}</td>
                                        <td style="text-align: center;">{{ FindCategoryByCatId($dataProduct['category'])['cat_name'] }}</td>
                                        <td style="text-align: center;">{{ FindCategoryByCatId($dataProduct['category_code'])['cat_name'] }}</td>
                                        <td style="text-align: center;">{{ FindCategoryByCatId($dataProduct['category_children_code'])['cat_name'] }}</td>
                                        <td style="text-align: center;">{{ $dataProduct['product_create_time'] }}</td>
                                        <td style="text-align: center;">{{ $dataProduct['product_update_time'] }}</td>
                                        <td width="10" align="center">
                                            <button class="btn-edit" product-id="{{ $dataProduct['product_id'] }}" onclick="ActiveProduct(this)">
                                                <img src="{{ asset('/images/admin/check_' . ($dataProduct['product_active'] == 1 ? 1 : 0) . '.gif') }}" width="12" height="12" alt="icon">
                                            </button>
                                        </td>
                                        <td width="10" align="center">
                                            <a class="btn-edit" rel="nofollow" href="/admin/cap-nhat-san-pham-id{{ $dataProduct['product_id'] }}">
                                                <img src="{{ asset('/images/admin/edit.png') }}" width="12" height="12" alt="icon">
                                            </a>  
                                        </td>  
                                        <td width="10" align="center">
                                            <button class="btn-edit" product-id="{{ $dataProduct['product_id'] }}" onclick="DeleteProduct(this)">
                                                <img src="{{ asset('/images/admin/delete.gif') }}" width="12" height="12" alt="icon">
                                            </button>  
                                        </td> 
                                    </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                    <?php
                        echo renderPagination($dataPagination['totalRecords'], $dataPagination['page'], $dataPagination['page_size'], $dataPagination['canonical']);
                    ?>
                </div>
            </main>
        </div>
    </div>
    @include('admin.html_common')
</body>

</html>
