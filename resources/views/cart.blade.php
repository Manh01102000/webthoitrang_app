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
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}?v={{ time() }}">
    <!-- link js chứa hàm chung -->
    <script src="{{ asset('js/function_general.js') }}?v={{ time() }}"></script>
    <!-- link js trang chủ -->
    <script src="{{ asset('js/cart.js') }}?v={{ time() }}"></script>
</head>

<body>
    <div class="container_home">
        <!-- header -->
        @include('layouts.header')
        <h1 hidden>Fashion Houses – Shop Quần Áo Thời Trang Cao Cấp</h1>
        <!-- content -->
        <div class="container-page">
            <div class="container-cart">
                <section class="bread-crumb">
                    <div class="breadcrumb-container">
                        <ul class="breadcrumb dp_fl_fd_r">
                            <li><a href="/" target="_blank" class="otherssite">Trang chủ</a></li>
                            <li class="thissite dp_fl_fd_r">Giỏ hàng</li>
                        </ul>
                    </div>
                </section>
                <section class="section-cart-all">
                    <div class="cart-all-left">
                        <div class="cart_left_title w100 d_flex al_ct">
                            <div class="cart_checkbox_productall">
                                <input type="checkbox" class="checkall_product">
                                <p class="font_s15 line_h20 font_w500 cl_000">Sản phẩm</p>
                            </div>
                            <div class="cart_left_title_other">
                                <div class="cart_title_general cart_title_unitprice">
                                    <p class="font_s15 line_h20 font_w500 cl_000">Đơn giá</p>
                                </div>
                                <div class="cart_title_general cart_title_count">
                                    <p class="font_s15 line_h20 font_w500 cl_000">Số lượng</p>
                                </div>
                                <div class="cart_title_general cart_title_activities d_flex">
                                    <div class="ctn_product_activity cart_title_price">
                                        <p class="font_s15 line_h20 font_w500 cl_000">Số tiền</p>
                                    </div>
                                    <div class="ctn_product_activity cart_title_activity">
                                        <p class="font_s15 line_h20 font_w500 cl_000">Thao tác</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cart_left_content">
                            @foreach ($dataAll['datacart'] as $datacart)
                            <?php
                                $product_images = explode(',', $datacart['product_images']);
                                $url_avarta = getUrlImageVideoProduct($datacart['product_create_time'], 1) . $product_images[0];
                                $product_classification = explode(';',$datacart['product_classification']);
                                $product_stock = explode(';',$datacart['product_stock']);
                                $product_price = explode(';',$datacart['product_price']);
                                // Sau đó ghộp nó lại và Tìm kiếm key trong mảng product_classification xem key bao nhiêu
                                $search_value = $datacart['cart_product_classification'];
                                $position = array_search($search_value, $product_classification);
                                // sau khi có key = position thì tìm lấy value tương ứng trong mảng product_stock,product_price
                                $product_stock_position = $product_stock[$position];
                                $product_price_position = $product_price[$position];
                                // Bảng khuyến mãi
                                $discount_active = $datacart['discount_active'];
                                $discount_type = $datacart['discount_type'];
                                $discount_start_time = $datacart['discount_start_time'];
                                $discount_end_time = $datacart['discount_end_time'];
                                $discount_price = $datacart['discount_price'];
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
                            <div class="cart_left_item cart_item" data-idcart="{{ $datacart['cart_id'] }}" data-check-discount="{{ $check_discount != 0 ? 1 : 0 }}">
                                <div class="cartleft_item_top">
                                    <div class="cart_checkbox_product">
                                        <input type="checkbox" class="check_product">
                                        <p class="name_user_order font_s15 line_h20 font_w500 cl_000" title="{{ $datacart['product_brand'] }}">{{ $datacart['product_brand'] }}</p>
                                    </div>
                                </div>
                                <div class="cartleft_item_center">
                                    <div class="cartleft_item d_flex">
                                        <div class="container-product-avatar">
                                            <img class="product-avatar lazyload"
                                            onerror="this.onerror=null; this.src='{{ asset('images/icon/load.gif') }}';"
                                            src="{{ asset('images/product_sample/anh1.jpg') }}"
                                            data-src="{{ asset($url_avarta) }}?v={{ time() }}"
                                            alt="{{ $datacart['product_name'] }}">
                                        </div>
                                        <div class="container-product-show d_flex">
                                            <p class="product-name w100">
                                                <a href="/" class="font_s16 line_h20 font_w500 cl_main product-name-link" title="{{ $datacart['product_name'] }}">
                                                    {{ $datacart['product_name'] }}
                                                </a>
                                            </p>
                                            <div class="product-type d_flex w100">
                                                <div class="button-product-type d_flex cursor_pt" onclick="ploai_sp(this)">
                                                    <div class="product-type-box">
                                                        <p class="product-type-text">Kích cỡ:</p>
                                                        <span class="product-type-txt">{{ explode(',',$datacart['cart_product_classification'])[0] ?? '' }}</span>
                                                    </div>
                                                    <div class="product-type-box">
                                                        <p class="product-type-text">Màu sắc:</p>
                                                        <span class="product-type-txt">{{ explode(',',$datacart['cart_product_classification'])[1] ?? '' }}</span>
                                                    </div>
                                                    <div class="product-type-box">
                                                        <p class="product-type-text">Số lượng kho:</p>
                                                        <span class="product-type-txt">{{ $product_stock_position }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cartleft_item_other">
                                        <div class="cart_item_unitprice cart_item_general">
                                            @if ($check_discount != 0)
                                                <p class="item_unitprice unitsellingprice_discount font_s15 line_h20 font_w400 cl_red" data-price_discount="{{ $product_discount }}">
                                                    {{ number_format($product_discount,0,',','.') }} đ
                                                </p>
                                            @endif
                                            <p class="item_unitprice unitsellingprice_original font_s15 line_h20 font_w400 cl_red {{ $check_discount != 0 ? "active_discount" : "" }}" data-price_original="{{ $product_price_position }}">
                                                {{ number_format($product_price_position,0,',','.') }} đ
                                            </p>
                                        </div>
                                        <div class="cart_item_general cart_item_count">
                                            <p class="minus-product minus_plus_gnr d_flex cursor_pt" CheckDiscount="{{ $check_discount != 0 ? 1 : 0 }}" data="0" onclick="MinusPrice(this)">-</p>
                                            <p class="product-count font_s15 line_h20 font_w400 cl_000">{{ $datacart['cart_product_amount'] ?? 1 }}</p>
                                            <p class="plus-product minus_plus_gnr d_flex cursor_pt" CheckDiscount="{{ $check_discount != 0 ? 1 : 0 }}" data="0" onclick="PlusPrice(this)">+</p>
                                        </div>
                                        <div class="cart_item_general cart_item_priceall d_flex">
                                            <div class="ctn_product_activity cart_item_price">
                                                @if ($check_discount != 0)
                                                    <p class="product-total-price font_s15 line_h20 font_w400 cl_000" data-totalprice="{{ (int)$product_discount * (int)($datacart['cart_product_amount'] ?? 1) }}">
                                                        {{ number_format((int)$product_discount * (int)($datacart['cart_product_amount'] ?? 1),0,',','.') }} đ
                                                    </p>
                                                @else
                                                    <p class="product-total-price font_s15 line_h20 font_w400 cl_000" data-totalprice="{{ (int)$product_price_position * (int)($datacart['cart_product_amount'] ?? 1) }}">
                                                        {{ number_format((int)$product_price_position * (int)($datacart['cart_product_amount'] ?? 1),0,',','.') }} đ
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="ctn_product_activity cart_item_activity cursor_pt">
                                                <img src="{{ asset('images/icon/icon_delete.png') }}" width="18" height="19" onclick="DeleteProductCart(this)" class="delete-product-cart">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cartleft_item_bottom">
                                    <div class="ctn_fee_ship w100 d_flex">
                                        <img src="{{ asset('images/icon/icon_vanchuyen.png') }}" width="20" height="20">
                                        <p class="fee_ship font_s14 font_w400 line_h20 d_flex" data-feeship="{{ !empty($datacart['product_ship']) && $datacart['product_ship'] == 1 ? 0 : $datacart['product_feeship'] ?? 0 }}">
                                            {{ !empty($datacart['product_ship']) && $datacart['product_ship'] == 1 ? "Miễn phí vận chuyển" : number_format($datacart['product_feeship'] ?? 0, 0, ',', '.') . ' đ' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="cart-all-right">
                        <div class="cart_avatar d_flex w100 al_ct jc_ct">
                            <img src="{{ asset('/images/icon/imggiohang.png') }}" class="img-cart">
                        </div>
                        <!-- <div class="account_balance w100 d_flex jc_sb">
                            <p class="font_s15 line_h20 font_w500 cl_333">Số dư tài khoản:</p>
                            <p class="font_s18 line_h24 font_w500 cl_red">11,111,110 đ</p>
                        </div> -->
                        <div class="cart_infor_detail">
                            <p class="cart_detail_title font_s18 line_h30 font_w500 cl_000">Thông tin chi tiết</p>
                            <div class="cart_detail_content">
                                <p class="detail_count_product font_s14 line_h20 font_w400 cl_333">Tổng đơn hàng (<span class="count_product">0</span>)</p>
                                <div class="detail_shipping_fee w100 d_flex jc_sb">
                                    <p class="font_s14 line_h20 font_w400 cl_333">Phí ship</p>
                                    <div class="shipping_fee_unit">
                                        <p class="font_s14 line_h20 font_w400 cl_red shipping_fee">0</p>
                                        <p class="font_s14 line_h20 font_w400 cl_red unit_shipfee">đ</p>
                                    </div>
                                </div>
                                <div class="detail_total_payment_noship w100 d_flex jc_sb">
                                    <p class="font_s14 line_h20 font_w400 cl_333">Tổng thanh toán (chưa phí ship)</p>
                                    <div class="total_payment_noship_unit">
                                        <p class="font_s14 line_h20 font_w400 cl_red total_payment_noship">0</p>
                                        <p class="font_s14 line_h20 font_w400 cl_red unit_totalpayment">đ</p>
                                    </div>
                                </div>
                                <div class="detail_total_payment w100 d_flex jc_sb">
                                    <p class="font_s14 line_h20 font_w400 cl_333">Tổng thanh toán (đã phí ship)</p>
                                    <div class="total_payment_unit">
                                        <p class="font_s14 line_h20 font_w400 cl_red total_payment">0</p>
                                        <p class="font_s14 line_h20 font_w400 cl_red unit_totalpayment">đ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container_button_payment">
                            <button class="btnpayment d_flex w100 cursor_pt" onclick="ConfirmOrder(this)">Thanh toán</button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- footer -->
        @include('layouts.footer')
        <!-- end footer -->
    </div>
</body>

</html>
