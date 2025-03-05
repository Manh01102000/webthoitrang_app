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
    <link rel="stylesheet" href="{{ asset('css/confirmOrder.css') }}?v={{ time() }}">
    <!-- link js chứa hàm chung -->
    <script src="{{ asset('js/function_general.js') }}?v={{ time() }}"></script>
    <!-- link js trang chủ -->
    <script src="{{ asset('js/confirmOrder.js') }}?v={{ time() }}"></script>
</head>

<body>
    <div class="container_home">
        <!-- header -->
        @include('layouts.header')
        <h1 hidden>Fashion Houses – Shop Quần Áo Thời Trang Cao Cấp</h1>
        <!-- content -->
        <div class="container-page">
            <div class="container-confirmOrder">
                <section class="bread-crumb">
                    <div class="breadcrumb-container">
                        <ul class="breadcrumb dp_fl_fd_r">
                            <li><a href="/" target="_blank" class="otherssite">Trang chủ</a></li>
                            <li><a href="/gio-hang" class="otherssite">Giỏ hàng</a></li>
                            <li class="thissite dp_fl_fd_r">Xác nhận đơn hàng</li>
                        </ul>
                    </div>
                </section>
                <section class="section-confirmOrder-all">
                    <div class="frame-confirmOrder-all">
                        <div class="confirmOrder-all-left">
                            <div class="confirmOrder confirmOrder-ship">
                                <div class="font_s15 line_h30 font_w500 txt-tf-up cl_main">Thông tin nhận hàng</div>
                                <div class="time_work">
                                    <div class="item item-confirm-address">
                                        <input type="radio" class="confirm-shipaddress" checked name="shipaddress" id="shipaddress" value="{{ $dataAll['address_default']['address_orders_default'] ?? "0" }}">
                                        <p class="font_s15 line_h20 font_w500">Tên người nhận: <span class="address_orders_user_name font_s14 line_h20 font_w400 cl_000">{{ $dataAll['address_default']['address_orders_user_name'] ?? "Chưa cập nhật" }}</span></p>
                                        <div class="container-edit-inforship">
                                            <button type="button" class="btn-edit-inforship" onclick="OpendInforship(this)">
                                                <img src="{{ asset('images/icon/icon_edit_black.png') }}" width="16" height="16" alt="icon">
                                                Thay đổi
                                            </button>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <svg width="16" height="16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-marker-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-map-marker-alt fa-w-12"><path fill="#1c2d5b" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z" class=""></path></svg>
                                        <p class="font_s15 line_h20 font_w500">Địa chỉ: <span class="address_orders_detail font_s14 line_h20 font_w400 cl_000">{{ $dataAll['address_default']['address_orders_detail'] ?? "Chưa cập nhật" }}</span></p>
                                    </div>
                                    <div class="item">
                                        <svg fill="#1c2d5b" height="16" width="16" version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve"><g><g><path d="M16,16.8l13.8-9.2C29.2,5.5,27.3,4,25,4H7C4.7,4,2.8,5.5,2.2,7.6L16,16.8z"/></g><g><path d="M16.6,18.8C16.4,18.9,16.2,19,16,19s-0.4-0.1-0.6-0.2L2,9.9V23c0,2.8,2.2,5,5,5h18c2.8,0,5-2.2,5-5V9.9L16.6,18.8z"/></g></g></svg>
                                        <p class="font_s15 line_h20 font_w500">Email: <span class="address_orders_user_email font_s14 line_h20 font_w400 cl_000">{{ $dataAll['address_default']['address_orders_user_email'] ?? "Chưa cập nhật" }}</span></p>
                                    </div>
                                    <div class="item">
                                        <svg width="16" height="16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-phone-alt fa-w-16"><path fill="#1c2d5b" d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z" class=""></path></svg>
                                        <p class="font_s15 line_h20 font_w500">Số điện thoại: <span class="address_orders_user_phone font_s14 line_h20 font_w400 cl_000">{{ $dataAll['address_default']['address_orders_user_phone'] ?? "Chưa cập nhật" }}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-confirmOrder data-confirmOrder">
                                <div class="font_s15 line_h30 font_w500 txt-tf-up cl_main w100">Thông tin đơn hàng</div>
                                <div class="container-detail-order">
                                    <?php
                                        $total_payment = 0;
                                        $total_ship = 0;
                                        $total_payment_all = 0;
                                        $total_payment_percent = 0;
                                        $total_order = 0;
                                    ?>
                                    @foreach ($dataAll['dataconfirm'] as $dataconfirm)
                                    <?php 
                                        $total_order++;
                                        $total_payment += (int)$dataconfirm['conf_total_price'];
                                        $total_ship += (int)$dataconfirm['conf_feeship'];
                                        $total_payment_all = $total_payment + $total_ship;
                                        $total_payment_percent = ceil($total_payment_all * (10 / 100));
                                        $product_images = explode(',', $dataconfirm['product_images']);
                                        $url_avarta = getUrlImageVideoProduct($dataconfirm['product_create_time'], 1) . $product_images[0];
                                    ?>
                                    <div class="item-detail-order"
                                    data-order-confirm-id = "{{ $dataconfirm['order_confirm_id'] }}"
                                    data-cart-id = "{{ $dataconfirm['conf_cart_id'] }}"
                                    data-product-code = "{{ $dataconfirm['product_code'] }}"
                                    data-product-amount = "{{ $dataconfirm['conf_product_amount'] }}"
                                    data-product-classification = "{{ $dataconfirm['conf_product_classification'] }}"
                                    data-product-totalprice = "{{ $dataconfirm['conf_total_price'] }}"
                                    data-product-feeship = "{{ $dataconfirm['conf_feeship'] }}"
                                    data-product-unitprice = "{{ $dataconfirm['conf_unitprice'] }}">
                                        <div class="item-detail-order-infor">
                                            <div class="detail-product-avatar">
                                                <img class="product-avatar lazyload"
                                                onerror="this.onerror=null; this.src='{{ asset('images/icon/load.gif') }}';"
                                                src="{{ asset('images/product_sample/anh1.jpg') }}"
                                                data-src="{{ asset($url_avarta) }}?v={{ time() }}"
                                                alt="{{ $dataconfirm['product_name'] }}">
                                            </div>
                                            <div class="detail-order-infor">
                                                <div class="order-infor">
                                                    <a href="/" class="infor-name-product font_s18 line_h26 font_w500 cl_main" title="{{ $dataconfirm['product_name'] }}">
                                                        {{ $dataconfirm['product_name'] }}
                                                    </a>
                                                </div>
                                                <div class="order-infor">
                                                    <p class="order-infor-text infor-codeproduct font_s15 line_h18 font_w500 cl_000">
                                                        Mã sản phẩm:
                                                        <span class="ordetail_product_code span-infor-codeproduct font_s14 line_h18 font_w400 cl_000">{{ $dataconfirm['product_code'] ?? "" }}</span>
                                                    </p>
                                                </div>
                                                <div class="order-infor">
                                                    <p class="order-infor-text infor-priceproduct font_s15 line_h18 font_w500 cl_000">
                                                        Giá sản phẩm:
                                                        <span class="span-infor-priceproduct font_s14 line_h18 font_w400 cl_000">{{ number_format($dataconfirm['conf_unitprice'] ?? 0,0,',','.') }} đ</span>
                                                    </p>
                                                </div>
                                                <div class="order-infor">
                                                    <p class="order-infor-text infor-countsp font_s15 line_h18 font_w500 cl_000">
                                                        Số lượng:
                                                        <span class="ordetail_product_amount span-infor-countsp font_s14 line_h18 font_w400 cl_000">{{ $dataconfirm['conf_product_amount'] ?? "" }}</span>
                                                    </p>
                                                </div>
                                                <div class="order-infor">
                                                    <p class="order-infor-text infor-sizesp font_s15 line_h18 font_w500 cl_000">
                                                        Kích cỡ:
                                                        <span class="span-infor-sizesp font_s14 line_h18 font_w400 cl_000">{{ explode(',',$dataconfirm['conf_product_classification'])[0] ?? '' }}</span>
                                                    </p>
                                                </div>
                                                <div class="order-infor">
                                                    <p class="order-infor-text infor-colorsp font_s15 line_h18 font_w500 cl_000">
                                                        Màu sắc:
                                                        <span class="span-infor-colorsp font_s14 line_h18 font_w400 cl_000">{{ explode(',',$dataconfirm['conf_product_classification'])[1] ?? '' }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="detail-order-price">
                                            <p class="order-infor-text infor-total-price font_s15 line_h20 font_w500 cl_000">
                                                Phí ship:
                                                <span class="span-infor-colorsp font_s15 line_h20 font_w500 cl_red">{{ number_format($dataconfirm['conf_feeship'] ?? 0,0,',','.') }} đ</span>
                                            </p>
                                            <p class="order-infor-text infor-total-price font_s15 line_h20 font_w500 cl_000">
                                                Tổng tiền hàng:
                                                <span class="span-infor-colorsp font_s15 line_h20 font_w500 cl_red">{{ number_format($dataconfirm['conf_total_price'] ?? 0,0,',','.') }} đ</span>
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-confirmOrder">
                                <div class="font_s15 line_h30 font_w500 txt-tf-up cl_main w100">Ghi chú</div>
                                <div class="container-detail-order">
                                    <div class="item-detail-order">
                                        <textarea id="ghi_chu" name="ghi_chu" rows="5" cols="5" placeholder="Nhập ghi chú cho người bán hàng"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-confirmOrder">
                                <!-- Phuong thuc thanh toan -->
                                <div class="font_s15 line_h30 font_w500 txt-tf-up cl_main w100">Phương thức thanh toán</div>
                                <div class="container-detail-payment_method">
                                    <div class="payment_method_top">
                                        <div class="payment_method_top_item">
                                            <div class="payment_method_child d_flex fl_row al_ct ">
                                                <input type="radio" class="payment-type cursor_pt" name="payment-type" id="payment-bankall" onclick="PaymentType(this)" value="1" checked>
                                                <div class="show-payment-type">
                                                    <p class="font_s15 font_w400 line_h18">Thanh toán toàn bộ đơn hàng</p>
                                                    <p class="font_s18 font_w500 line_h26 cl_red">{{ number_format($total_payment_all,0,',','.') }} đ</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="payment_method_top_item">
                                            <div class="payment_method_child d_flex fl_row al_ct ">
                                                <input type="radio" class="payment-type cursor_pt" name="payment-type" onclick="PaymentType(this)" id="payment-bankpercent" value="2">
                                                <div class="show-payment-type">
                                                    <p class="font_s15 font_w400 line_h18">Thanh toán trả trước 10%</p>
                                                    <p class="font_s18 font_w500 line_h26 cl_red">{{ number_format($total_payment_percent,0,',','.') }} đ</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="payment_method_content">
                                        <div class="method_content">
                                            <div class="method_content_cod">
                                                Bạn sẽ thanh toán nốt số tiền khi nhận được đơn hàng
                                            </div>
                                            <div class="method_content_bank">
                                                <div class="method_bank_infor">
                                                    <div class="method_bank_infor_header">
                                                        <p class="method_bank_infor_hd_text sh_clr_two sh_size_four cr_bold">Thông tin tài khoản</p>
                                                        <div class="method_bank_infor_hd_img">
                                                            <img class="bank-avatar" src="{{ asset('/images/bank/mbbank.png') }}">
                                                        </div>
                                                    </div>
                                                    <div class="method_bank_infor_content">
                                                        <div class="bank_infor_content">
                                                            <span class="span_account font_s16 line_h24 font_w500">Ngân hàng:</span>
                                                            <span class="bank_name font_s15 font_w400 line_h18 cl_red">MB Bank</span>
                                                        </div>
                                                        <div class="bank_infor_content">
                                                            <span class="span_account font_s16 line_h24 font_w500">Số tài khoản:</span>
                                                            <span class="account_number font_s15 font_w400 line_h18 cl_red">XXXXXXXXXXXXXXXXX</span>
                                                        </div>
                                                        <div class="bank_infor_content">
                                                            <span class="span_account font_s16 line_h24 font_w500">Chủ tài khoản:</span>
                                                            <span class="account_owner font_s15 font_w400 line_h18 cl_red">XXXX XXX XXX</span>
                                                        </div>
                                                        <div class="bank_infor_content">
                                                            <span class="span_account font_s16 line_h24 font_w500">Chi nhánh:</span>
                                                            <span class="bank_branch font_s15 font_w400 line_h18 cl_red">XXX, XXX</span>
                                                        </div>
                                                        <div class="bank_infor_content">
                                                            <span class="span_account font_s16 line_h24 font_w500">Nội dung chuyển khoản:</span>
                                                            <span class="bank_content_tranfer font_s15 font_w400 line_h18 cl_red">
                                                                Mua hang tren Fashion Houes - [{{ $dataAll['order_code'] }}]
                                                            </span>
                                                        </div>
                                                        <div class="bank_infor_content">
                                                            <span class="span_account font_s16 line_h24 font_w500 cl_red">Lưu ý:</span>
                                                            <span class="bank_content_careful font_s15 font_w400 line_h18 cl_red">
                                                                Khi chuyển khoản vui lòng ghi đúng nội dung
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- So tien thanh toan -->
                                <div class="font_s15 line_h30 font_w500 txt-tf-up cl_main w100">Số tiền thanh toán</div>
                                <div class="container-detail-paymentall">
                                    <div class="paymentall-all-right">
                                        <div class="paymentall_avatar d_flex w100 al_ct jc_ct">
                                            <img src="http://127.0.0.1:8000/images/icon/imggiohang.png" class="img-paymentall">
                                        </div>
                                        <div class="paymentall_infor_detail">
                                            <p class="paymentall_detail_title font_s18 line_h30 font_w500 cl_000">Thông tin chi tiết</p>
                                            <div class="paymentall_detail_content">
                                                <p class="detail_count_product font_s15 line_h20 font_w400 cl_333">Tổng đơn hàng (<span class="count_product">{{ $total_order }}</span>)</p>
                                                <div class="detail_shipping_fee w100 d_flex jc_sb">
                                                    <p class="font_s15 line_h20 font_w400 cl_333">Phí ship</p>
                                                    <div class="shipping_fee_unit">
                                                        <p class="font_s15 line_h20 font_w400 cl_red total_all_shipping_fee">{{ number_format($total_ship,0,',','.') }}</p>
                                                        <p class="font_s15 line_h20 font_w400 cl_red unit_shipfee">đ</p>
                                                    </div>
                                                </div>
                                                <div class="detail_total_payment w100 d_flex jc_sb">
                                                    <p class="font_s15 line_h20 font_w400 cl_333">Tổng thanh toán (chưa tính ship)</p>
                                                    <div class="total_payment_unit">
                                                        <p class="font_s15 line_h20 font_w400 cl_red total_payment">{{ number_format($total_payment,0,',','.') }}</p>
                                                        <p class="font_s15 line_h20 font_w400 cl_red unit_totalpayment">đ</p>
                                                    </div>
                                                </div>
                                                <div class="detail_total_payment w100 d_flex jc_sb">
                                                    <p class="font_s15 line_h20 font_w400 cl_333">Tổng thanh toán (đã tính ship)</p>
                                                    <div class="total_payment_unit">
                                                        <p class="font_s15 line_h20 font_w400 cl_red total_all_payment" data="{{ $total_payment_all }}">{{ number_format($total_payment_all,0,',','.') }}</p>
                                                        <p class="font_s15 line_h20 font_w400 cl_red unit_totalpayment">đ</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="purchasing_policy">
                                            <input class="purchasing_policy_input cursor_pt" type="checkbox" name="purchasing_policy_input">
                                            <p class="text_med-atm font_s15 font_w400 line_h18">Tôi hiểu rõ và đồng ý với <a href="/chinh-sach-mua-hang"><span class="cl_red">chính sách mua hàng</span></a> của Fashion Houes</p>
                                        </div>
                                        <div class="container_button_payment">
                                            <a href="/gio-hang" class="return_payment_link" rel="nofollow">
                                                <button class="btn_return_payment d_flex w100 cursor_pt">Quay lại</button>
                                            </a>
                                            <button class="btnpayment d_flex w100 cursor_pt" data-order-code = "{{ $dataAll['order_code'] }}" onclick="PayMent(this)">Thanh toán</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="confirmOrder-all-right">
                            <img src="{{ asset('images/banner/image-confirm-order.jpg') }}" class="img-confirmOrder cursor_pt" alt="icon">
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- modal -->
        <div id="modal_change_inforship" class="modal">
            <div class="container_modal">
                <div class="modal-top">
                    <p class="modal-top-title font_s15 line_h20 font_w500 w100 txt_alct cl_fff">Thông tin nhận hàng</p>
                    <p class="font_s15 font_w500 close-modal cl_fff cursor_pt" onclick="CloseModal(this)">X</p>
                </div>
                <div class="modal-content">
                    <div class="show_infor_ship">
                        @if (count($dataAll['address_order']) > 0)
                            @foreach ($dataAll['address_order'] as $address_order)
                            <div class="item-infor-ship">
                                <div class="time_work">
                                    <div class="item item-confirm-address">
                                        <input type="radio" class="confirm-shipaddress" name="confirm-shipaddress" {{ $address_order['address_orders_default'] == 1 ? 'checked' : '' }} value="{{ $address_order['address_orders_id'] ?? "0" }}" onclick="SetShipDefalt(this)">
                                        <p class="font_s15 line_h20 font_w500">Tên người nhận: <span class="font_s14 line_h20 font_w400 cl_000">{{ $address_order['address_orders_user_name'] ?? "Chưa cập nhật" }}</span></p>
                                        <div class="container-edit-inforship">
                                            <button type="button" class="btn-edit-inforship" data-id="1" onclick="EditInforship(this)">
                                                <img src="{{ asset('images/icon/icon_edit_black.png') }}" width="16" height="16" alt="icon">
                                                Thay đổi
                                            </button>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <svg width="16" height="16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-marker-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-map-marker-alt fa-w-12"><path fill="#1c2d5b" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z" class=""></path></svg>
                                        <p class="font_s15 line_h20 font_w500">Địa chỉ: <span class="font_s14 line_h20 font_w400 cl_000">{{ $address_order['address_orders_detail'] ?? "Chưa cập nhật" }}</span></p>
                                    </div>
                                    <div class="item">
                                        <svg width="16" height="16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-phone-alt fa-w-16"><path fill="#1c2d5b" d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z" class=""></path></svg>
                                        <p class="font_s15 line_h20 font_w500">Số điện thoại: <span class="font_s14 line_h20 font_w400 cl_000">{{ $address_order['address_orders_user_phone'] ?? "Chưa cập nhật" }}</span></p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="time_work">
                                <div class="item item-confirm-address">
                                    <input type="radio" class="confirm-shipaddress" checked name="confirm-shipaddress" value="0" onclick="SetShipDefalt(this)">
                                    <p class="font_s15 line_h20 font_w500">Tên người nhận: <span class="font_s14 line_h20 font_w400 cl_000">Chưa cập nhật</span></p>
                                </div>
                                <div class="item">
                                    <svg width="16" height="16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-marker-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-map-marker-alt fa-w-12"><path fill="#1c2d5b" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z" class=""></path></svg>
                                    <p class="font_s15 line_h20 font_w500">Địa chỉ: <span class="font_s14 line_h20 font_w400 cl_000">Chưa cập nhật</span></p>
                                </div>
                                <div class="item">
                                    <svg width="16" height="16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-phone-alt fa-w-16"><path fill="#1c2d5b" d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z" class=""></path></svg>
                                    <p class="font_s15 line_h20 font_w500">Số điện thoại: <span class="font_s14 line_h20 font_w400 cl_000">Chưa cập nhật</span></p>
                                </div>
                            </div>
                        @endif
                        
                    </div>
                    <div class="container-add-inforship">
                        <button type="button" class="font_s15 font_w500 line_h20" onclick="AddInforship(this)">+ Thêm thông tin</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal_add_inforship" class="modal">
            <div class="container_modal">
                <div class="modal-top">
                    <p class="modal-top-title font_s15 line_h20 font_w500 w100 txt_alct cl_fff">Thêm thông tin nhận hàng</p>
                    <p class="font_s15 font_w500 close-modal cl_fff cursor_pt" onclick="CloseModal(this)">X</p>
                </div>
                <div class="modal-content">
                    <div class="show_addinfor_ship">
                        <div class="addinforship-box">
                            <div class="addinforship-box-title font_s15 line_h20 font_w500">Họ và tên <span style="color: red;">*</span></div>
                            <div class="addinforship-box-item">
                                <input class="addinforship_inp" type="text" id="address_orders_user_name">
                            </div>
                        </div>
                        <div class="addinforship-box">
                            <div class="addinforship-box-title font_s15 line_h20 font_w500">Số điện thoại <span style="color: red;">*</span></div>
                            <div class="addinforship-box-item">
                                <input class="addinforship_inp" type="text" id="address_orders_user_phone">
                            </div>
                        </div>
                        <div class="addinforship-box">
                            <div class="addinforship-box-title font_s15 line_h20 font_w500">Email <span style="color: red;">*</span></div>
                            <div class="addinforship-box-item">
                                <input class="addinforship_inp" type="text" id="address_orders_user_email">
                            </div>
                        </div>
                        <div class="addinforship-box city-dist-com">
                            <div class="addinforship-box-title font_s15 line_h20 font_w500">Tỉnh / Thành phố <span style="color: red;">*</span></div>
                            <div class="addinforship-box-item">
                                <div class="container-select">
                                    <select id="address_orders_city" class="address_orders_city">
                                        <option value="0">Chọn tỉnh / thành phố</option>
                                        <?php foreach($dataAll['datacity'] as $key => $val){ ?>
                                            <option value="{{ $val['cit_code'] }}">{{ $val['cit_name'] }}</option>
                                        <?php } ?>
                                    </select>
                                    <div class="box-append-city"></div>
                                </div>
                            </div>
                        </div>
                        <div class="addinforship-box city-dist-com">
                            <div class="addinforship-box-title font_s15 line_h20 font_w500">Quận / Huyện <span style="color: red;">*</span></div>
                            <div class="addinforship-box-item">
                                <div class="container-select">
                                    <select id="address_orders_district" class="address_orders_district">
                                        <option value="0">Chọn quận / huyện</option>
                                    </select>
                                    <div class="box-append-distric"></div>
                                </div>
                            </div>
                        </div>
                        <div class="addinforship-box city-dist-com">
                            <div class="addinforship-box-title font_s15 line_h20 font_w500">Xã / Thị trấn <span style="color: red;">*</span></div>
                            <div class="addinforship-box-item">
                                <div class="container-select">
                                    <select id="address_orders_commune" class="address_orders_commune">
                                        <option value="0">Chọn xã / thị trấn</option>
                                    </select>
                                    <div class="box-append-commune"></div>
                                </div>
                            </div>
                        </div>
                        <div class="addinforship-box">
                            <div class="addinforship-box-title font_s15 line_h20 font_w500">Địa chỉ chi tiết <span style="color: red;">*</span></div>
                            <div class="addinforship-box-item">
                                <input class="addinforship_inp" type="text" id="address_orders_detail">
                            </div>
                        </div>
                    </div>
                    <div class="container-add-inforship">
                        <button type="button" class="font_s15 font_w500 line_h20" onclick="AddDataInforship(this)">Thêm thông tin</button>
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
