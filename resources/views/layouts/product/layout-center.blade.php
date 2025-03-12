<div class="prod-detail-center">
    <div class="detail-infor-poduct d_flex fl_cl gap_15 w100">
        <div class="detail-center-title">
            <h2 class="font_s16 line_h20 font_w600 cl_000">Thông tin chi tiết</h2>
        </div>
        <div class="detail-infor-content d_flex w100 gap_15 fl_wrap">
            <div class="item-infor-content d_flex al_ct gap_10">
                <img src="{{ asset("/images/product_icon/icon-brand.svg") }}" width="28" height="28" alt="icon">
                <div class="show-infor-content">
                    <p class="infor-content-title font_s15 font_w500 cl_000">Hãng</p>
                    <p class="infor-content-text font_s15 font_w400 cl_333">{{ $dataAll['ProductDetails']['product_brand'] }}</p>
                </div>
            </div>
            <div class="item-infor-content d_flex al_ct gap_10">
                <img src="{{ asset("/images/product_icon/icon-color.svg") }}" width="28" height="28" alt="icon">
                <div class="show-infor-content">
                    <p class="infor-content-title font_s15 font_w500 cl_000">Màu sắc</p>
                    <p class="infor-content-text font_s15 font_w400 cl_333">{{ $dataAll['ProductDetails']['product_colors'] }}</p>
                </div>
            </div>
            <div class="item-infor-content d_flex al_ct gap_10">
                <img src="{{ asset("/images/product_icon/icon-size.svg") }}" width="28" height="28" alt="icon">
                <div class="show-infor-content">
                    <p class="infor-content-title font_s15 font_w500 cl_000">Kích thước</p>
                    <p class="infor-content-text font_s15 font_w400 cl_333">{{ $dataAll['ProductDetails']['product_sizes'] }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="detail-desc-poduct d_flex fl_cl gap_15 w100">
        <div class="detail-center-title">
            <h2 class="font_s16 line_h20 font_w600 cl_000">Mô tả sản phẩm</h2>
        </div>
        <div class="detail-desc-content">
            <div class="show-text-desc">
                {!! $dataAll['ProductDetails']['product_description'] !!}
            </div>
        </div>
    </div>
    <div class="detail-cate-poduct d_flex fl_cl gap_15 w100">
        <div class="detail-center-title">
            <h2 class="font_s16 line_h20 font_w600 cl_000">Chi tiết danh mục</h2>
        </div>
        <div class="detail-cate-content">
            <a class="cate-content-txt" href="{{ '/' . FindCategoryByCatId($dataAll['ProductDetails']['category'])['cat_alias'] . '/' . FindCategoryByCatId($dataAll['ProductDetails']['category_code'])['cat_alias'] . '/' . FindCategoryByCatId($dataAll['ProductDetails']['category_children_code'])['cat_alias'] }}">
                {{ FindCategoryByCatId($dataAll['ProductDetails']['category_children_code'])['cat_name'] }}
            </a>
        </div>
    </div>
</div>