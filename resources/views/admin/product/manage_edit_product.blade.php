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
    <!-- link js chứa hàm chung -->
    <script src="{{ asset('js/function_general.js') }}?v={{ time() }}"></script>
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
                    <h1 class="header__title">Cập nhật sản phẩm</h1>
                </header>
                <section class="main-content">
                    <div id="productForm">
                        <div class="productForm-row">
                            <div class="productForm-col">
                                <div class="form-group w100">
                                    <label class="form-label font_s13 line_h16 font_w400 cl_fff">Mã sản phẩm <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" value="{{ $dataAll['dataProduct']['product_code'] }}" disabled placeholder="Nhập mã sản phẩm" id="product_code" name="product_code" required>
                                </div>
                                <div class="form-group w100">
                                    <label class="form-label font_s13 line_h16 font_w400 cl_fff">ID quản trị <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" value="{{ session('admin_id') }}" placeholder="Nhập nội dung" id="product_admin_id" name="product_admin_id" disabled>
                                </div>
                                <div class="form-group w100">
                                    <label class="form-label font_s13 line_h16 font_w400 cl_fff">Tên sản phẩm <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" value="{{ $dataAll['dataProduct']['product_name'] }}" placeholder="Nhập tên sản phẩm" id="product_name" name="product_name" required>
                                </div>
                                <div class="form-group w100">
                                    <label class="form-label font_s13 line_h16 font_w400 cl_fff">Mô tả <span style="color:red">*</span></label>
                                    <textarea class="form-control" id="product_description" placeholder="Nhập mô tả sản phẩm" name="product_description">{{ $dataAll['dataProduct']['product_description'] }}</textarea>
                                </div>
                                <div class="form-group w100">
                                    <label class="form-label font_s13 line_h16 font_w400 cl_fff">Danh mục <span style="color:red">*</span></label>
                                    <div class="container-select">
                                        <select class="category select_100" id="category">
                                            <option value="0">Chọn danh mục</option>
                                            @foreach ($dataAll['Category'] as $key => $val)
                                                <option {{ $dataAll['dataProduct']['category'] == $val['cat_code'] ? "selected" : "" }} value="{{ $val['cat_code'] }}">{{ $val['cat_name'] }}</option>
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
                                            @foreach ($dataAll['category_code'] as $key => $val)
                                                <option {{ $dataAll['dataProduct']['category_code'] == $val['cat_code'] ? "selected" : "" }} value="{{ $val['cat_code'] }}">{{ $val['cat_name'] }}</option>
                                            @endforeach
                                        </select>
                                        <div class="box-append-select box-append-category_code"></div>
                                    </div>
                                </div>
                                <div class="form-group w100">
                                    <label class="form-label font_s13 line_h16 font_w400 cl_fff">Mã danh mục con <span style="color:red">*</span></label>
                                    <div class="container-select">
                                        <select class="category_children_code select_100" id="category_children_code">
                                            <option value="0">Chọn danh mục</option>
                                            @foreach ($dataAll['category_children_code'] as $key => $val)
                                                <option {{ $dataAll['dataProduct']['category_children_code'] == $val['cat_code'] ? "selected" : "" }} value="{{ $val['cat_code'] }}">{{ $val['cat_name'] }}</option>
                                            @endforeach
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
                                                        <?php $array_sz = explode(',', $dataAll['dataProduct']['product_sizes']); ?>
                                                        @foreach ($dataAll['product_sizes'] as $key => $val)
                                                            @if($key > 0)
                                                                <option {{ in_array($val, $array_sz) ? "selected" : "" }} value="{{ $val }}">{{ $val }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <div class="box-append-select box-append-product_sizes"></div>
                                                </div>
                                            </div>
                                            <div class="form-group w100">
                                                <label class="form-label font_s13 line_h16 font_w400 cl_000">Màu sắc <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" value="{{ $dataAll['dataProduct']['product_colors'] }}" placeholder="Nhập màu sắc cách nhau bởi dấu ',' (ví dụ: Xanh, Đỏ, Vàng)" id="product_colors" name="product_colors">
                                            </div>
                                        </div>
                                        <div class="box_add_bpnlsp w100">
                                            <div class="txt_update_bpnlsp cursor_pt d_flex al_ct jc_ct" onclick="UpdateTTSP(this)">
                                                <p class="cap_nhat font_s13 line_h16 font_w500 cl_fff">Cập nhật thuộc tính</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m_bangphanloai" style="{{ $dataAll['dataProduct']['product_classification'] != "" ? "display: block" : "" }}">
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
                                        <div class="container_ft_bpl">
                                        <?php 
                                            $product_classification = !empty($dataAll['dataProduct']['product_classification'])
                                            ? explode(';', $dataAll['dataProduct']['product_classification'])
                                            : [];

                                            $product_stock = !empty($dataAll['dataProduct']['product_stock'])
                                            ? explode(';', $dataAll['dataProduct']['product_stock'])
                                            : [];

                                            $product_price = !empty($dataAll['dataProduct']['product_price'])
                                            ? explode(';', $dataAll['dataProduct']['product_price'])
                                            : [];
                                        ?>
                                        @foreach ($product_classification as $key => $classification)
                                            <div class="footer_bangphanloai bangphanloai_item d_flex al_ct">
                                                <div class="footer_bpl_loai font_s13 line_h16 font_w400 cl_000 product_classification">
                                                    {{ $classification }}
                                                </div>
                                                <div class="footer_bpl_soluongkho">
                                                    <input type="number" min="0" name="product_stock" value="{{ $product_stock[$key] ?? '' }}" id="product_stock_{{ $key + 1 }}" class="product_stock" placeholder="Nhập số lượng kho">
                                                </div>
                                                <div class="footer_bpl_giaban">
                                                    <input type="text" onkeyup="format_gtri(this)" name="product_price" value="{{trim(number_format($product_price[$key], 0, ",")) ?? ''}}" id="product_price_{{ $key + 1 }}" class="product_price" placeholder="Nhập giá sản phẩm">
                                                </div>
                                                <div class="footer_bpl_xoa">
                                                    <img src="/images/icon/icon_delete.png" width="18px" height="19px" class="icon_delete_loai cursor_pt" onclick="delete_bangplsp(this)">
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Khuyến mãi sản phẩm -->
                            <div class="productForm-col">
                                <div class="container_ttbh">
                                    <p class="font_s16 line_h20 font_w500 cl_000">Khuyến mãi sản phẩm</p>
                                    <div class="m_khuyemmai">
                                        <button type="button" style="{{ $dataAll['dataProduct']['discount_id'] != "" ? "display: none" : "" }}" class="khuyemai_add_khuyemmai" onclick="addKhuyenMai(this)">
                                            <p class="txt_add_km cursor_pt d_flex al_ct gap_10">+ Thêm khuyến mãi</p>
                                        </button>
                                        <div class="khuyenmai_bangkm" style="{{ $dataAll['dataProduct']['discount_id'] != "" ? "display: block" : "" }}">
                                            @if ($dataAll['dataProduct']['discount_id'] != "")
                                                <div class="container_km_bangkm d_flex fl_cl gap_10">
                                                    <div class="bkm_xoa_km w100 d_flex jc_end">
                                                        <img src="/images/icon/icon_delete.png" width="18px" height="19px" class="icon_xoa_km cursor_pt" onclick="DeleteDiscount(this)">
                                                    </div>
                                                    <div class="bkm_loai_giatri_km d_flex gap_10">
                                                        <div class="box_loai_km box_input_infor">
                                                            <label class="form-label font_s13 line_h16 font_w500 cl_000">Loại giảm giá <span style="color:red">*</span></label>
                                                            <div class="container-select">
                                                                <select class="discount_type select_100" id="discount_type" onchange="ChangeDiscType(this)">
                                                                    <option value="">Chọn</option>
                                                                    <option {{ $dataAll['dataProduct']['discount_type'] == 1 ? "selected" : "" }} value="1">Giảm %</option>
                                                                    <option {{ $dataAll['dataProduct']['discount_type'] == 2 ? "selected" : "" }} value="2">Giảm số tiền</option>
                                                                </select>
                                                                <div class="box-append-select box-append-discount_type"></div>
                                                            </div>
                                                        </div>
                                                        <div class="box_giatri_km box_input_infor">
                                                            <label class="form-label font_s13 line_h16 font_w500 cl_000">Giá trị <span style="color:red">*</span></label>
                                                            <div class="giatri_km d_flex al_ct">
                                                                @if ($dataAll['dataProduct']['discount_type'] == 1)
                                                                    <input type="text" name="discount_price" id="discount_price" value="{{ trim(number_format($dataAll['dataProduct']['discount_price'], 0, ",")) }}" min="0" max="100" maxlength = 3 class="discount_price font_s13 line_h16 font_w400 cl_000" onkeyup="format_gtri(this)" placeholder="0">
                                                                @else
                                                                    <input type="text" name="discount_price" id="discount_price" value="{{ trim(number_format($dataAll['dataProduct']['discount_price'], 0, ",")) }}" class="discount_price font_s13 line_h16 font_w400 cl_000" onkeyup="format_gtri(this)" placeholder="Nhập giá trị giảm giá">
                                                                @endif
                                                                <p class="show_dv_km font_s13 line_h16 font_w400 cl_000">%</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bkm_ngaybd_ngaykt_km d_flex gap_10">
                                                        <div class="box_bkm_ngaybd box_input_infor">
                                                            <label class="form-label font_s13 line_h16 font_w500 cl_000">Ngày bắt đầu <span style="color:red">*</span></label>
                                                            <input type="date" name="discount_start_time" value="{{ date('Y-m-d', $dataAll['dataProduct']['discount_start_time']) }}" class="discount_start_time" id="discount_start_time">
                                                        </div>
                                                        <div class="box_bkm_ngaykt box_input_infor">
                                                            <label class="form-label font_s13 line_h16 font_w500 cl_000">Ngày kết thúc <span style="color:red">*</span></label>
                                                            <input type="date" name="discount_end_time" value="{{ date('Y-m-d', $dataAll['dataProduct']['discount_end_time']) }}" class="discount_end_time" id="discount_end_time">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Luồng thông tin thêm -->
                            <div class="productForm-col">
                                <div class="form-group w100">
                                    <label class="form-label font_s13 line_h16 font_w400 cl_fff">Mã màu (tương ứng với màu b) <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" value="000,000,000" value="{{ $dataAll['dataProduct']['product_code_colors'] }}" placeholder="Nhập mã màu sắc cách nhau bởi dấu ',' (000, fff, ccc)" id="product_code_colors" name="product_code_colors">
                                </div>
                                <div class="form-group w100">
                                    <label class="form-label font_s13 line_h16 font_w400 cl_fff">Thương hiệu <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" value="Fashion Houses" value="{{ $dataAll['dataProduct']['product_brand'] }}" placeholder="Nhập tên thương hiệu" id="product_brand" name="product_brand">
                                </div>
                                <div class="form-group w100">
                                    <label class="form-label font_s13 line_h16 font_w400 cl_fff">Vận chuyển <span style="color:red">*</span></label>
                                    <div class="container_shipping d_flex al_ct gap_30 w100">
                                        <div class="box_free_shipping d_flex al_ct gap_10">
                                            <input type="radio" name="shipping" id="product_free_ship" value="1" class="product_free_ship shipping_input img20 cursor_pt" {{ $dataAll['dataProduct']['product_ship'] == 1 ? "checked" : "" }}>
                                            <p class="font_s13 line_h16 font_w400 cl_fff">Miễn phí vận chuyển</p>
                                        </div>
                                        <div class="box_feeshipping d_flex al_ct gap_30">
                                            <div class="box_fee_shipping d_flex al_ct gap_10">
                                                <input type="radio" name="shipping" id="product_fee_ship" value="2" class="product_fee_ship shipping_input img20 cursor_pt" {{ $dataAll['dataProduct']['product_ship'] == 2 ? "checked" : "" }}>
                                                <p class="font_s13 line_h16 font_w400 cl_fff">Phí vận chuyển</p>
                                            </div>
                                            <div class="enter_fee_shipping" style="{{ $dataAll['dataProduct']['product_ship'] == 2 ? "display: block" : "" }}">
                                                <div class="npvc_box">
                                                    <input type="text" onkeyup="format_gtri(this)" name="product_feeship" id="product_feeship" value="{{ trim(number_format($dataAll['dataProduct']['product_feeship'], 0, ",")) ?? '' }}" class="product_feeship form-control" placeholder="Nhập phí vận chuyển" autocomplete="off">
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
                                            <div class="frame_imgvideo">
                                                @if ($dataAll['dataProduct']['product_images'] != "")
                                                    <?php $product_images = explode(',', $dataAll['dataProduct']['product_images']); ?>
                                                    @foreach ($product_images as $key => $image)
                                                    <?php $url_image = getUrlImageVideoProduct($dataAll['dataProduct']['product_create_time'], 1) . $image; ?>
                                                        <div class="box_img_video" data_del="" data_name="<?= $image ?>" data-new-img="0" data="" data-img="1">
                                                            <img src="{{ asset($url_image) }}" class="imgvideo_preview">
                                                            <img src="/images/icon/xoaanh.svg" class="icon_delete" onclick="icon_delete_img(this)">
                                                        </div>
                                                    @endforeach
                                                @endif

                                                @if ($dataAll['dataProduct']['product_videos'] != "")
                                                    <?php $product_videos = explode(',', $dataAll['dataProduct']['product_videos']); ?>
                                                    @foreach ($product_videos as $key => $video)
                                                    <?php $url_video = getUrlImageVideoProduct($dataAll['dataProduct']['product_create_time'], 2) . $image; ?>
                                                        <div class="box_img_video" data_del="" data_name="<?= $video ?>" data-new-video="0" data="" data-video="1">
                                                            <video src="{{ asset($url_video) }}" controls class="imgvideo_preview"></video>
                                                            <img src="/images/icon/xoaanh.svg" class="icon_delete" onclick="icon_delete_img(this)">
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
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
                        <button type="submit" class="btn btn-primary" product-id="{{ $dataAll['dataProduct']['product_id'] }}" onclick="UpdateProduct(this)">Thêm sản phẩm</button>
                    </div>
                </section>
            </main>
        </div>
    </div>
    @include('admin.html_common')
</body>

</html>
