<div class="container_content_home container_section_product_sale d_flex al_ct jc_ct">
    <div class="content_home section_product_sale">
        <div class="content_home_top section_product_sale_top d_flex jc_ct jc_sb">
            <div class="cthome_top_left">
                <h2 class="cthome_top_text">💰 Sản Phẩm Giảm Giá Sốc</h2>
            </div>
        </div>
        <div class="content_home_center section_product_sale_center w100 d_flex al_ct">
            <div class="product_sale_center_banner">
                <img src="{{ asset('images/product_sample/banner_sale.jpg') }}" class="img_product_sale_banner" alt="image">
            </div>
            <div class="product_sale_center_show">
                <div class="ct_home_center_frame w100 d_flex al_ct">
                    @foreach ($dataAll['hotDealProducts'] as $key => $hotDealProducts)
                    <?php
                        $product_images = explode(',', $hotDealProducts['product_images']);
                        $url_avarta = getUrlImageVideoProduct($hotDealProducts['product_create_time'], 1) . $product_images[0];
                        $product_sizes = explode(',',$hotDealProducts['product_sizes']);
                        $product_colors = explode(',',$hotDealProducts['product_colors']);
                        $product_classification = explode(';',$hotDealProducts['product_classification']);
                        $product_stock = explode(';',$hotDealProducts['product_stock']);
                        $product_price = explode(';',$hotDealProducts['product_price']);
                        // Lấy phần tử đầu của 2 mảng product_sizes, product_colors
                        $product_sizes_index0 = $product_sizes[0];
                        $product_colors_index0 = $product_colors[0];
                        // Sau đó ghộp nó lại và Tìm kiếm key trong mảng product_classification xem key bao nhiêu
                        $search_value = $product_sizes_index0 . "," . $product_colors_index0;
                        $position = array_search($search_value, $product_classification);
                        // sau khi có key = position thì tìm lấy value tương ứng trong mảng product_stock,product_price
                        $product_stock_position = $product_stock[$position];
                        $product_price_position = $product_price[$position];
                        // Bảng khuyến mãi
                        $discount_active = $hotDealProducts['discount_active'];
                        $discount_type = $hotDealProducts['discount_type'];
                        $discount_start_time = $hotDealProducts['discount_start_time'];
                        $discount_end_time = $hotDealProducts['discount_end_time'];
                        $discount_price = $hotDealProducts['discount_price'];
                        // Sét giá trị mặc địch cho bảng là giá gốc
                        $check_discount = 0;
                        // Kiểm tra xem có active không
                        if($discount_active == 1 && $discount_start_time <= time() && $discount_end_time >= time()){
                            $check_discount = 1;
                            // Bằng 1 giảm giá %
                            if ($discount_type == 1) {
                                $percent_discount = ceil(($product_price_position * ($discount_price / 100)));
                                $product_discount = (int)$product_price_position - (int)$percent_discount;
                            }
                            // Bằng 2 giảm giá số tiền
                            else if ($discount_type == 2) {
                                $product_discount = (int)$product_price_position - (int)$discount_price;
                            }
                        }
                     ?>
                    <div class="home_center_item"
                        data-classification="{{ implode(';',$product_classification) }}" 
                        data-price="{{ implode(';',$product_price) }}" 
                        data-stock="{{ implode(';',$product_stock) }}"
                        data-check-discount="{{ $check_discount }}"
                        data-discount-type="{{ $discount_type }}"
                        data-discount-price="{{ $discount_price }}">
                        <div class="home_center_item_head">
                            <img class="home_center_item_img lazyload"
                            onerror="this.onerror=null; this.src='{{ asset('images/icon/load.gif') }}';"
                            src="{{ asset('images/product_sample/anh1.jpg') }}"
                            data-src="{{ asset($url_avarta) }}?v={{ time() }}"
                            alt="anh">
                        </div>
                        <div class="home_center_item_desc">
                            <h3 class="hct_item_desc font_s16 line_h24 font_w600 cl_fff" title="{{ $hotDealProducts['product_name'] }}">{{ $hotDealProducts['product_name'] }}</h3>
                            <div class="container_price_item">
                                @if ($check_discount != 0)
                                    <p class="price_item_discount font_s16 line_h20 font_w500 cl_fff">{{ number_format($product_discount,0,',','.') }}đ</p>
                                @endif
                                <p class="price_item_original {{ $check_discount != 0 ? "active_discount" : "" }} font_s16 line_h20 font_w500 cl_fff">{{ number_format($product_price_position,0,',','.') }}đ</p>
                            </div>
                        </div>
                        <div class="home_center_item_infor">
                            <div class="hct_item_infor_detail">
                                <div class="infor_detail_top">
                                    <div class="infor_detail_top_title">
                                        <img class="infor_detail_img lazyload" 
                                        onerror="this.onerror=null; this.src='{{ asset('images/icon/load.gif') }}';"
                                        src="{{ asset('images/product_sample/anh1.jpg') }}"
                                        data-src="{{ asset($url_avarta) }}?v={{ time() }}" alt="anh">
                                        <p class="infor_detail_name font_s16 line_h20 font_w500">{{ $hotDealProducts['product_name'] }}</p>
                                    </div>
                                    <div class="infor_detail_top_des">
                                        <p class="infor_detail_productcode">Mã sản phẩm: <span class="span_prdcode">{{ $hotDealProducts['product_code'] }}</span></p>
                                        <p class="infor_detail_brand">Thương hiệu: <span class="span_brand">{{ $hotDealProducts['product_brand'] }}</span></p>
                                        <p class="infor_detail_productstock">Số lượng trong kho: <span class="span_productstock">{{ $product_stock_position }}</span></p>
                                    </div>
                                </div>
                                <div class="infor_detail_center">
                                    <div class="boxinfor_detail_price">
                                        <div class="boxinfor_detail_title">Giá bán</div>
                                        <div class="boxinfor_detail_content">
                                            @if ($check_discount != 0)
                                                <p class="infor_detail_price_discount font_s18 line_h30 font_w500">{{ number_format($product_discount,0,',','.') }}đ</p>
                                            @endif
                                            <p class="infor_detail_price_original {{ $check_discount != 0 ? "active_infdetail_discount" : "" }} font_s18 line_h30 font_w500">{{ number_format($product_price_position,0,',','.') }}đ</p>
                                        </div>
                                    </div>
                                    <div class="boxinfor_detail_color">
                                        <div class="boxinfor_detail_title">Màu sắc</div>
                                        <div class="boxinfor_detail_content">
                                            @foreach ($product_colors as $key => $color)
                                                <span class="infor_detail_price_color {{ $key == 0 ? 'active_e' : '' }}" data-color="{{ $color }}">{{ $color }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="boxinfor_detail_size">
                                        <div class="boxinfor_detail_title">Kích cỡ</div>
                                        <div class="boxinfor_detail_content">
                                            @foreach ($product_sizes as $key => $size)
                                                <span class="infor_detail_price_size {{ $key == 0 ? 'active_e' : '' }}" data-size="{{ $size }}">{{ $size }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="infor_detail_bottom">
                                    <button class="infor_detail_bottom_button">
                                        <p class="infor_detail_bottom_text">Thêm giỏ hàng</p>
                                        <svg width="15" class="svg-inline--fa fa-cart-plus fa-w-18" aria-hidden="true" data-prefix="fa" data-icon="cart-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="#FFF" d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach  
                </div>
            </div>
        </div>
        <div class="content_home_bottom"></div>
    </div>
</div>  