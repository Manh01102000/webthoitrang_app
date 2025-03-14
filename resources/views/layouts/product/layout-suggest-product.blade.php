<div class="prod-detail-bottom">
    <h2 class="font_s16 line_h20 font_w600 cl_000">Sản phẩm tương tự</h2>
    <div class="product-suggest-list">
    @foreach ($dataAll['similarProducts'] as $key => $products)
        <?php
        $product_images = explode(',', $products['product_images']);
        $url_avarta = getUrlImageVideoProduct($products['product_create_time'], 1) . $product_images[0];
        $product_sizes = explode(',',$products['product_sizes']);
        $product_colors = explode(',',$products['product_colors']);
        $product_classification = explode(';',$products['product_classification']);
        $product_stock = explode(';',$products['product_stock']);
        $product_price = explode(';',$products['product_price']);
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
        $discount_active = $products['discount_active'];
        $discount_type = $products['discount_type'];
        $discount_start_time = $products['discount_start_time'];
        $discount_end_time = $products['discount_end_time'];
        $discount_price = $products['discount_price'];
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
        <div class="product-suggest-item">
            <div class="product-suggest-item-avatar">
                <img class="product-suggest-item-img lazyload" 
                    onerror="this.onerror=null; this.src='{{ asset('images/icon/load.gif') }}';"
                    src="{{ asset('images/product_sample/anh1.jpg') }}" 
                    data-src="{{ asset($url_avarta) }}?v={{ time() }}"
                    alt="{{ $products['product_name'] ?? "" }}">
                <img src="{{ asset('/images/product_icon/favorite_product.svg') }}" class="icon-favorite cursor_pt" width="20" height="20" prod-id="{{ $products['product_id'] }}" onclick="FavoriteProduct(this)" alt="icon">
            </div>
            <div class="product-suggest-item-desc">
                <a href="{{ rewriteProduct($products['product_id'],$products['product_alias'],$products['product_name']) }}" rel="nofollow">
                    <h3 class="product-suggest-desc-name font_s16 line_h24 font_w500 cl_000">{{ $products['product_name'] }}</h3>
                </a>
                <p class="product-suggest-desc-text">Số lượng kho: {{ $product_stock_position }}</p>
                <div class="product-price">
                    @if ($check_discount != 0)
                        <p class="product-price-discount">
                            {{ number_format($product_discount,0,',','.') }} đ
                        </p>
                    @endif
                    <p class="product-price-original {{ $check_discount != 0 ? "active_price" : "" }} font_s18 line_h30 font_w500">
                        {{ number_format($product_price_position,0,',','.') }} đ
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>