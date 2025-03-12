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
    <link rel="stylesheet" href="{{ asset('css/admin/add_product.css') }}?v={{ time() }}">
    <!-- link js trang chủ -->
    <script src="{{ asset('js/admin/home.js') }}?v={{ time() }}"></script>
    <!-- Nhúng ckeditor -->
    <script src="{{ asset('ckeditor/ckeditor.js') }}?t=D03G5XL"></script>
    <!-- link js -->
    <script src="{{ asset('js/admin/add_product.js') }}?v={{ time() }}"></script>
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
                    <h1 class="header__title">Thêm mới sản phẩm</h1>
                </header>
                <div class="main-container">
                    <div class="main-header">
                        <div class="main-header-nav"></div>
                    </div>
                    <section class="main-content">
                        <div id="productForm">
                            <div class="productForm-row">
                                <div class="productForm-col">
                                    <div class="form-group w100">
                                        <label class="form-label font_s13 line_h16 font_w400 cl_fff">Mã sản phẩm <span style="color:red">*</span></label>
                                        <input type="text" class="form-control" value="" placeholder="Nhập mã sản phẩm" id="product_code" name="product_code" required>
                                    </div>
                                    <div class="form-group w100">
                                        <label class="form-label font_s13 line_h16 font_w400 cl_fff">ID quản trị <span style="color:red">*</span></label>
                                        <input type="text" class="form-control" value="{{ session('admin_id') }}" placeholder="Nhập nội dung" id="product_admin_id" name="product_admin_id" disabled>
                                    </div>
                                    <div class="form-group w100">
                                        <label class="form-label font_s13 line_h16 font_w400 cl_fff">Tên sản phẩm <span style="color:red">*</span></label>
                                        <input type="text" class="form-control" value="" placeholder="Nhập tên sản phẩm" id="product_name" name="product_name" required>
                                    </div>
                                    <div class="form-group w100">
                                        <label class="form-label font_s13 line_h16 font_w400 cl_fff">Mô tả <span style="color:red">*</span></label>
                                        <textarea class="form-control" id="product_description" placeholder="Nhập mô tả sản phẩm" name="product_description"></textarea>
                                    </div>
                                    <div class="form-group w100">
                                        <label class="form-label font_s13 line_h16 font_w400 cl_fff">Danh mục <span style="color:red">*</span></label>
                                        <div class="container-select">
                                            <select class="category select_100" id="category">
                                                <option value="0">Chọn danh mục</option>
                                                @foreach ($dataAll['Category'] as $key => $val)
                                                    <option value="{{ $val['cat_code'] }}">{{ $val['cat_name'] }}</option>
                                                @endforeach
                                            </select>
                                            <div class="box-append-select box-append-category"></div>
                                        </div>
                                    </div>
                                    <div class="form-group w100">
                                        <label class="form-label font_s13 line_h16 font_w400 cl_fff">Mã danh mục <span style="color:red">*</span></label>
                                        <div class="container-select">
                                            <select class="category_code select_100" id="category_code">
                                                <option value="0">Chọn danh mục</option>
                                            </select>
                                            <div class="box-append-select box-append-category_code"></div>
                                        </div>
                                    </div>
                                    <div class="form-group w100">
                                        <label class="form-label font_s13 line_h16 font_w400 cl_fff">Mã danh mục con <span style="color:red">*</span></label>
                                        <div class="container-select">
                                            <select class="category_children_code select_100" id="category_children_code">
                                                <option value="0">Chọn danh mục</option>
                                            </select>
                                            <div class="box-append-select box-append-category_children_code"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Thông tin sản phẩm -->
                                <div class="productForm-col">
                                    <div class="container_ttbh">
                                        <p class="font_s16 line_h20 font_w500 cl_000">Thông tin sản phẩm</p>
                                        <div class="m_bangphannhomloaisp">
                                            <div class="box_share_bnplsp d_flex gap20 al_ct mg_t15">
                                                <div class="form-group w100">
                                                    <label class="form-label font_s13 line_h16 font_w400 cl_000">Kích thước <span style="color:red">*</span></label>
                                                    <div class="container-select">
                                                        <select class="product_sizes select_100" multiple name="product_sizes[]" id="product_sizes">
                                                            @foreach ($dataAll['product_sizes'] as $key => $val)
                                                                @if($key > 0)
                                                                    <option value="{{ $val }}">{{ $val }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <div class="box-append-select box-append-product_sizes"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group w100">
                                                    <label class="form-label font_s13 line_h16 font_w400 cl_000">Màu sắc <span style="color:red">*</span></label>
                                                    <input type="text" class="form-control" value="" placeholder="Nhập màu sắc cách nhau bởi dấu ',' (ví dụ: Xanh, Đỏ, Vàng)" id="product_colors" name="product_colors">
                                                </div>
                                            </div>
                                            <div class="box_add_bpnlsp w100">
                                                <div class="txt_update_bpnlsp cursor_pt d_flex al_ct jc_ct" onclick="UpdateTTSP(this)">
                                                    <p class="cap_nhat font_s13 line_h16 font_w500 cl_fff">Cập nhật thuộc tính</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m_bangphanloai">
                                            <p class="font_s16 line_h20 font_w500 cl_000">Bảng phân loại</p>
                                            <div class="box_bangphanloai d_flex al_ct">
                                                <div class="box_bpl_loai font_s13 line_h16 font_w500 cl_000">Loại</div>
                                                <div class="box_bpl_soluongkho">
                                                    <p class="bpl_slk_title font_s13 line_h16 font_w500 cl_000">Số lượng trong kho <span class="cl_red">*</span></p>
                                                    <div class="bpl_slk_frame font_s13 line_h16 font_w400 cl_000">Nhập</div>
                                                </div>
                                                <div class="box_bpl_giaban">
                                                    <p class="bpl_gb_title font_s13 line_h16 font_w500 cl_000">Giá bán <span class="cl_red">*</span></p>
                                                    <div class="bpl_gb_frame d_flex al_ct font_s13 line_h16 font_w400 cl_000">
                                                        <p class="gia_bpl font_s13 line_h16 font_w400 cl_000">Giá</p>
                                                    </div>
                                                </div>
                                                <div class="box_bpl_xoa font_s13 line_h16 font_w500 cl_000">Xóa</div>
                                            </div>
                                            <div class="container_ft_bpl"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Khuyến mãi sản phẩm -->
                                <div class="productForm-col">
                                    <div class="container_ttbh">
                                        <p class="font_s16 line_h20 font_w500 cl_000">Khuyến mãi sản phẩm</p>
                                        <div class="m_khuyemmai">
                                            <button type="button" class="khuyemai_add_khuyemmai" onclick="addKhuyenMai(this)">
                                                <p class="txt_add_km cursor_pt d_flex al_ct gap_10">+ Thêm khuyến mãi</p>
                                            </button>
                                            <div class="khuyenmai_bangkm">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Luồng thông tin thêm -->
                                <div class="productForm-col">
                                    <div class="form-group w100">
                                        <label class="form-label font_s13 line_h16 font_w400 cl_fff">Mã màu (tương ứng với màu b) <span style="color:red">*</span></label>
                                        <input type="text" class="form-control" value="000,000,000" placeholder="Nhập mã màu sắc cách nhau bởi dấu ',' (000, fff, ccc)" id="product_code_colors" name="product_code_colors">
                                    </div>
                                    <div class="form-group w100">
                                        <label class="form-label font_s13 line_h16 font_w400 cl_fff">Thương hiệu <span style="color:red">*</span></label>
                                        <input type="text" class="form-control" value="Fashion Houses" placeholder="Nhập tên thương hiệu" id="product_brand" name="product_brand">
                                    </div>
                                    <div class="form-group w100">
                                        <label class="form-label font_s13 line_h16 font_w400 cl_fff">Vận chuyển <span style="color:red">*</span></label>
                                        <div class="container_shipping d_flex al_ct gap_30 w100">
                                            <div class="box_free_shipping d_flex al_ct gap_10">
                                                <input type="radio" name="shipping" id="product_free_ship" value="1" class="product_free_ship shipping_input img20 cursor_pt" checked>
                                                <p class="font_s13 line_h16 font_w400 cl_fff">Miễn phí vận chuyển</p>
                                            </div>
                                            <div class="box_feeshipping d_flex al_ct gap_30">
                                                <div class="box_fee_shipping d_flex al_ct gap_10">
                                                    <input type="radio" name="shipping" id="product_fee_ship" value="2" class="product_fee_ship shipping_input img20 cursor_pt">
                                                    <p class="font_s13 line_h16 font_w400 cl_fff">Phí vận chuyển</p>
                                                </div>
                                                <div class="enter_fee_shipping">
                                                    <div class="npvc_box">
                                                        <input type="text" onkeyup="format_gtri(this)" name="product_feeship" id="product_feeship" class="product_feeship form-control" placeholder="Nhập phí vận chuyển" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group w100">
                                        <label class="form-label font_s13 line_h16 font_w400 cl_fff">Hình ảnh / Video <span style="color:red">*</span></label>
                                        <label for="product_images" class="label_u_video" style="display:block">
                                            <p class="luutaivideo cursor_pt">
                                                <img src="{{ asset('/images/icon/upload_img.png') }}" class="img_luutaivideo" alt=""> 
                                                Tải ảnh hoặc video (Tối đa 10 ảnh và 1 video)
                                            </p>
                                            <input type="file" id="product_images" style="display:none" name="product_images" onchange="loadVideo(event)" placeholder="Tải lên video">
                                        </label>
                                        <div class="list_imgvideo">
                                            <div class="box_listimgvideo">
                                                <div class="frame_imgvideo"></div>
                                                <label for="product_images" class="icon_addimgvideo d_none" style="display: none;">
                                                    <p class="add_picture">
                                                        <img src="{{ asset('/images/icon/icons_plus_file.png') }}" width="18px" height="18px" alt="icon">
                                                        <span class="font_s13 font_w500 line_h16 mt_5">Thêm ảnh/video</span> 
                                                    </p>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" onclick="CreateProduct(this)">Thêm sản phẩm</button>
                        </div>
                    </section>
                </div>
            </main>
        </div>
    </div>
    @include('admin.html_common')
</body>

</html>
