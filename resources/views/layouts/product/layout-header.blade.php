<?php
    $product_sizes = explode(',',$dataAll['ProductDetails']['product_sizes']);
    $product_colors = explode(',',$dataAll['ProductDetails']['product_colors']);
    $product_classification = explode(';',$dataAll['ProductDetails']['product_classification']);
    $product_stock = explode(';',$dataAll['ProductDetails']['product_stock']);
    $product_price = explode(';',$dataAll['ProductDetails']['product_price']);
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
    $discount_active = $dataAll['ProductDetails']['discount_active'];
    $discount_type = $dataAll['ProductDetails']['discount_type'];
    $discount_start_time = $dataAll['ProductDetails']['discount_start_time'];
    $discount_end_time = $dataAll['ProductDetails']['discount_end_time'];
    $discount_price = $dataAll['ProductDetails']['discount_price'];
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
<div class="prod-detail-top d_flex gap_15 w100"
    data-user = "{{ $dataAll['data']['data']['us_id'] ?? 0 }}"
    data-product-code="{{ $dataAll['ProductDetails']['product_code'] }}"
    data-classification="{{ implode(';',$product_classification) }}" 
    data-price="{{ implode(';',$product_price) }}" 
    data-stock="{{ implode(';',$product_stock) }}"
    data-check-discount="{{ $check_discount }}"
    data-discount-type="{{ $discount_type }}"
    data-discount-price="{{ $discount_price }}">
    <div class="detail-top-left">
        <div class="top-left-image d_flex gap_15 fl_cl">
            <div class="top-image-big">
               <div class="container-image-big">
                    <?php $product_images = explode(',', $dataAll['ProductDetails']['product_images']); ?>
                    @foreach ($product_images as $key => $valimages)
                        <?php $url_avarta = getUrlImageVideoProduct($dataAll['ProductDetails']['product_create_time'], 1) . $valimages; ?>
                        <div class="item-image-big" data="{{ $key }}">
                            <img class="image-big lazyload" 
                            onerror="this.onerror=null; this.src='{{ asset('images/icon/load.gif') }}';"
                            src="{{ asset('images/product_sample/anh1.jpg') }}"
                            data-src="{{ asset($url_avarta) }}?v={{ time() }}" 
                            alt="{{ $dataAll['ProductDetails']['product_name'] }}">
                        </div>
                    @endforeach
               </div>
               <button class="prev" onclick="prevSlideProd(this)">❮</button>
               <button class="next" onclick="nextSlideProd(this)">❯</button>
            </div>
            <div class="top-image-item d_flex gap_10">
                @if(count($product_images) > 1)
                    @for ($i = 1; $i < count($product_images); $i++)
                        <?php $url_avarta = getUrlImageVideoProduct($dataAll['ProductDetails']['product_create_time'], 1) . $product_images[$i]; ?>
                        <div class="top-image-small cursor_pt">
                            <img class="image-small lazyload" 
                            onerror="this.onerror=null; this.src='{{ asset('images/icon/load.gif') }}';"
                            src="{{ asset('images/product_sample/anh1.jpg') }}"
                            data-src="{{ asset($url_avarta) }}?v={{ time() }}" alt="{{ $dataAll['ProductDetails']['product_name'] }}">
                        </div>
                    @endfor
                @else
                    @for ($i = 0; $i < count($product_images); $i++)
                        <?php $url_avarta = getUrlImageVideoProduct($dataAll['ProductDetails']['product_create_time'], 1) . $product_images[$i]; ?>
                        <div class="top-image-small cursor_pt">
                            <img class="image-small lazyload" 
                            onerror="this.onerror=null; this.src='{{ asset('images/icon/load.gif') }}';"
                            src="{{ asset('images/product_sample/anh1.jpg') }}"
                            data-src="{{ asset($url_avarta) }}?v={{ time() }}" alt="{{ $dataAll['ProductDetails']['product_name'] }}">
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>
    <div class="detail-top-right d_flex gap_10">
        <div class="detail-right-product d_flex gap_10 fl_cl w100">
            <h1 class="prod-card_title font_s20 font_w600 line_h28 cl_main w100">{{ $dataAll['ProductDetails']['product_name'] }}</h1>
            <div class="prod-card_common prod-card_timesold d_flex gap_10 al_ct">
                <div class="prod-card_time d_flex al_ct gap_5">
                    <div class="timesold-icon">
                        <img src="{{ asset('/images/product_icon/timer.svg') }}" width="18" height="18" alt="icon">
                    </div>
                    <p class="font_s14 mt_5 line_h16 font_w400 cl_000">Cập nhật {{ timeAgo($dataAll['ProductDetails']['product_update_time']) }}</p>
                </div>
                <div class="prod-card_sold d_flex al_ct gap_5">
                    <div class="timesold-icon">
                        <img src="{{ asset('/images/product_icon/shopping-cart.svg') }}" width="18" height="18" alt="icon">
                    </div>
                    <p class="font_s14 mt_5 line_h16 font_w400 cl_000">{{ $dataAll['ProductDetails']['product_sold'] }} Đã bán</p>
                </div>
            </div>
            <div class="prod-card_common prod-card_price d_flex al_ct gap_10 w100">
                <p class="prod-card_price_original font_s18 line_h24 font_w600 cl_red {{ $check_discount != 0 ? "active_price_discount" : "" }}" data-price_original="{{ $product_price_position }}">{{ number_format($product_price_position,0,',','.') }} đ</p>
                @if ($check_discount != 0)
                    <p class="prod-card_price_discount font_s18 line_h24 font_w600 cl_red" data-price_discount="{{ $product_discount }}">{{ number_format($product_discount,0,',','.') }} đ</p>
                @endif
            </div>
            <div class="prod-card_common prod-card_color d_flex fl_cl w100 gap_5">
                <p class="prod-card_text font_s14 font_w500 line_h20 cl_000">Màu sắc</p>
                <div class="prod-card_option d_flex al_ct gap_10 w100">
                    @foreach ($product_colors as $key => $color)
                        <span class="item-card_option change-option_color {{ $key == 0 ? 'active_o' : '' }}" data-color="{{ $color }}">{{ $color }}</span>
                    @endforeach
                </div>
            </div>
            <div class="prod-card_common prod-card_size d_flex fl_cl w100 gap_5">
                <p class="prod-card_text font_s14 font_w500 line_h20 cl_000">Kích thước</p>
                <div class="prod-card_option d_flex al_ct gap_10 w100">
                    @foreach ($product_sizes as $key => $size)
                        <span class="item-card_option change-option_size {{ $key == 0 ? 'active_o' : '' }}" data-size="{{ $size }}">{{ $size }}</span>
                    @endforeach
                </div>
            </div>
            <div class="prod-card_common prod-card_amount_buy d_flex al_ct w100 gap_15" data-stock="{{ $product_stock_position }}">
                <p class="prod-card_text font_s14 font_w500 line_h20 cl_000">Số lượng</p>
                <div class="prod-card_option d_flex al_ct gap_15">
                    <button type="button" class="minus-product minus_plus_gnr d_flex cursor_pt" checkdiscount="0" data="0" onclick="MinusCountProduct(this)">-</button>
                    <input type="text" name="product-card_count" value="1" class="product-card_count font_s15 line_h20 font_w400 cl_000">
                    <button type="button" class="plus-product minus_plus_gnr d_flex cursor_pt" checkdiscount="0" data="0" onclick="PlusCountProduct(this)">+</button>
                </div>
                <span class="product-card_stock font_s15 line_h20 font_w400 cl_000">{{ $product_stock_position }} sản phẩm sẵn có</span>
            </div>
            <div class="prod-card_common prod-card_ship d_flex al_ct w100 gap_10">
                <p class="prod-card_text font_s14 font_w500 line_h20 cl_000">Vận chuyển</p>
                <div class="prod-card_shipping d_flex al_ct gap_10">
                    <img src="{{ asset('/images/product_icon/truck-fast.svg') }}" width="18" height="18" alt="icon">
                    <p class="fee_ship font_s14 mt_5 line_h16 font_w400 cl_main" data-feeship="{{ !empty($dataAll['ProductDetails']['product_ship']) && $dataAll['ProductDetails']['product_ship'] == 1 ? 0 : $dataAll['ProductDetails']['product_feeship'] ?? 0 }}">
                        {{ !empty($dataAll['ProductDetails']['product_ship']) && $dataAll['ProductDetails']['product_ship'] == 1 ? "Miễn phí vận chuyển" : number_format($dataAll['ProductDetails']['product_feeship'] ?? 0, 0, ',', '.') . ' đ' }}
                    </p>
                </div>
            </div>
            <div class="prod-card_common prod-card_button d_flex al_ct w100 gap_10">
                <button class="card_button card_button_buy" onclick="BuyNow(this)">
                    <p class="font_s14 line_h16 font_w400 cl_main">Mua ngay</p>
                </button>
                <button class="card_button card_button_addcart" onclick="addCart(this)">
                    <div class="icon_addcart">
                        <svg width="18" height="18" class="svg-inline--fa fa-cart-plus fa-w-18" aria-hidden="true" data-prefix="fa" data-icon="cart-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z"></path>
                        </svg>
                    </div>
                    <p class="font_s14 line_h16 font_w400 cl_main">Thêm giỏ hàng</p>
                </button>
                <button class="card_button card_button_chat">
                    <div class="icon_chat">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 13.5997 2.37562 15.1116 3.04346 16.4525C3.22094 16.8088 3.28001 17.2161 3.17712 17.6006L2.58151 19.8267C2.32295 20.793 3.20701 21.677 4.17335 21.4185L6.39939 20.8229C6.78393 20.72 7.19121 20.7791 7.54753 20.9565C8.88837 21.6244 10.4003 22 12 22Z" fill="currentColor"/>
                            <path d="M15 12C15 12.5523 15.4477 13 16 13C16.5523 13 17 12.5523 17 12C17 11.4477 16.5523 11 16 11C15.4477 11 15 11.4477 15 12Z" fill="#FFF"/>
                            <path d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z" fill="#FFF"/>
                            <path d="M7 12C7 12.5523 7.44772 13 8 13C8.55228 13 9 12.5523 9 12C9 11.4477 8.55228 11 8 11C7.44772 11 7 11.4477 7 12Z" fill="#FFF"/>
                        </svg>
                    </div>
                    <p class="font_s14 line_h16 font_w400 cl_main">Chat</p>
                </button>
                <button class="card_button card_button_contact">
                    <div class="icon_contact">
                        <svg width="18" height="18" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.9958 20.8541C14.96 20.8541 13.8691 20.6066 12.7416 20.13C11.6416 19.6625 10.5325 19.0208 9.45081 18.2416C8.37831 17.4533 7.34248 16.5733 6.36165 15.6108C5.38998 14.63 4.50998 13.5941 3.73081 12.5308C2.94248 11.4308 2.30998 10.3308 1.86081 9.26748C1.38415 8.13081 1.14581 7.03081 1.14581 5.99498C1.14581 5.27998 1.27415 4.60165 1.52165 3.96915C1.77831 3.31831 2.19081 2.71331 2.74998 2.19081C3.45581 1.49415 4.26248 1.14581 5.12415 1.14581C5.48165 1.14581 5.84831 1.22831 6.15998 1.37498C6.51748 1.53998 6.81998 1.78748 7.03998 2.11748L9.16665 5.11498C9.35915 5.38081 9.50581 5.63748 9.60665 5.89415C9.72581 6.16915 9.78998 6.44415 9.78998 6.70998C9.78998 7.05831 9.68915 7.39748 9.49665 7.71831C9.35915 7.96581 9.14831 8.23165 8.88248 8.49748L8.25915 9.14831C8.26831 9.17581 8.27748 9.19415 8.28665 9.21248C8.39665 9.40498 8.61665 9.73498 9.03831 10.23C9.48748 10.7433 9.90915 11.2108 10.3308 11.6416C10.8716 12.1733 11.3208 12.595 11.7425 12.9433C12.265 13.3833 12.6041 13.6033 12.8058 13.7041L12.7875 13.75L13.4566 13.09C13.7408 12.8058 14.0158 12.595 14.2816 12.4575C14.7858 12.1458 15.4275 12.0908 16.0691 12.3566C16.3075 12.4575 16.5641 12.595 16.8391 12.7875L19.8825 14.9508C20.2216 15.18 20.4691 15.4733 20.6158 15.8216C20.7533 16.17 20.8175 16.4908 20.8175 16.8116C20.8175 17.2516 20.7166 17.6916 20.5241 18.1041C20.3316 18.5166 20.0933 18.8741 19.7908 19.2041C19.2683 19.7816 18.7 20.1941 18.04 20.46C17.4075 20.7166 16.72 20.8541 15.9958 20.8541ZM12.7875 13.7591L12.6408 14.3825L12.8883 13.7408C12.8425 13.7316 12.8058 13.7408 12.7875 13.7591Z" fill="currentColor"/>
                            <path d="M16.9583 8.93752C16.5825 8.93752 16.2708 8.62585 16.2708 8.25002C16.2708 7.92002 15.9408 7.23252 15.3908 6.64585C14.85 6.06835 14.2542 5.72919 13.75 5.72919C13.3742 5.72919 13.0625 5.41752 13.0625 5.04169C13.0625 4.66585 13.3742 4.35419 13.75 4.35419C14.6392 4.35419 15.5742 4.83085 16.39 5.70169C17.1508 6.51752 17.6458 7.51669 17.6458 8.25002C17.6458 8.62585 17.3342 8.93752 16.9583 8.93752Z" fill="currentColor"/>
                            <path d="M20.1667 8.93748C19.7908 8.93748 19.4792 8.62581 19.4792 8.24998C19.4792 5.08748 16.9125 2.52081 13.75 2.52081C13.3742 2.52081 13.0625 2.20915 13.0625 1.83331C13.0625 1.45748 13.3742 1.14581 13.75 1.14581C17.6642 1.14581 20.8542 4.33581 20.8542 8.24998C20.8542 8.62581 20.5425 8.93748 20.1667 8.93748Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <p class="font_s14 line_h16 font_w400 cl_main">Liên hệ</p>
                </button>
            </div>
        </div>
        <div class="detail-right-brand">
            <!-- layout-customer-reviews -->
            @include("layouts.product.layout-customer-reviews")
            <!--  -->
        </div>
    </div>
</div>