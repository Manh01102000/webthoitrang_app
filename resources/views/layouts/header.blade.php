<!--================================== HEADER================================= -->
<link rel="preload" href="{{ asset('css/layouts/header.css') }}?v={{ time() }}" media="all" as="style">
<link rel="stylesheet" href="{{ asset('css/layouts/header.css') }}?v={{ time() }}">
<header class="header_container header_container_pc w100">
    <!-- header -->
    <div id="header">
        <div class="container-header">
            <a href="/" class="boxlogo">
                <img src="{{ asset('images/home/logoweb.png') }}?v={{ time() }}" class="logoHeader" alt="logo">
            </a>
            <div class="header_search">
                <!-- loai san pham tim kiem -->
                <div id="search_info" class="list_search">
                    <div class="container-select2">
                        <select class="select-type-fashion" id="select-type-fashion">
                            <option class="search_item" value="0" title="Tất cả">Tất cả</option>       
                            @foreach ($dataAll['Category'] as $key => $val)
                                <option class="search_item" value="{{ $val['cat_code'] }}" datacode="{{ $val['cat_parent_code'] }}" title="{{ $val['cat_name'] }}">{{ $val['cat_name'] }}</option>
                                @foreach ($val['children'] as $key => $valchild)
                                    <option class="search_item" value="{{ $valchild['cat_code'] }}" datacode="{{ $valchild['cat_parent_code'] }}" title="{{ $valchild['cat_name'] }}">{{ $valchild['cat_name'] }}</option>
                                    @foreach ($valchild['children'] as $key => $valchild2)
                                        <option class="search_item" value="{{ $valchild2['cat_code'] }}" datacode="{{ $valchild2['cat_parent_code'] }}" title="{{ $valchild2['cat_name'] }}">{{ $valchild2['cat_name'] }}</option>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </select>
                        <div class="box-append-select2 box-append-typefashion"></div>
                    </div>
                </div>
                <!-- input tim kiem -->
                <input type="search" name="query" value="" id="search-text" placeholder="Tìm sản phẩm bạn mong muốn" class="input-group-field st-default-search-input search-text" autocomplete="off" onclick="openSuggestSearch(this)">
                <!-- button tim kiem -->
                <div class="container_input_search">
                    <button class="btn_search cursor_pt">
                        <img src="{{ asset('images/header/icon-search-white.png') }}?v={{ time() }}" width="20" height="20" alt="icon">
                    </button>
                </div>
                <!-- Box goi y tim kiem -->
                <div class="collection-selector">
                    <div class="collection-selector-top">
                        <p class="title-colslecttop">Kết quả tìm kiếm</p>
                        <button type="button" class="close-collection-selector" onclick="closeCollectionSelector(this)">x</button>
                    </div>
                    <div class="collection-selector-center">
                        <div class="box-show-colslectcenter">
                            <div class="show-colslectcenter-head">
                                <p class="txt-colslecttop-left">Sản phẩm</p>
                                <p class="txt-colslecttop-right">Xem tất cả</p>
                            </div>
                            <div class="show-colslectcenter-content">
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                <div class="colslectcenter-content-item">
                                    <div class="colslectcenter-content-item-img">
                                        <img src="{{ asset('images/product_sample/product.png') }}" class="item-img" alt="image">
                                    </div>
                                    <div class="colslectcenter-content-item-detail">
                                        <p class="item-detail-title font_s16 line_h20">Set Đồ Nam ICONDENIM Mind's Maze</p>
                                        <p class="item-detail-price font_s14 line_h16 cl_red">340,00 <sup>đ</sup></p>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="collection-selector-bottom"></div>
                </div>
            </div>
            <div class="account-header">
                <?php if($dataAll['data']['islogin'] == 0){ ?>
                    <div class="hd-account">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M11.8575 11.6341C13.181 11.6341 14.327 11.1594 15.2635 10.2228C16.1998 9.28636 16.6747 8.14058 16.6747 6.81689C16.6747 5.49365 16.2 4.34771 15.2634 3.41098C14.3268 2.4747 13.1809 2 11.8575 2C10.5338 2 9.388 2.4747 8.45157 3.41113C7.51514 4.34756 7.04028 5.49349 7.04028 6.81689C7.04028 8.14058 7.51514 9.28652 8.45157 10.2229C9.3883 11.1592 10.5342 11.6341 11.8575 11.6341V11.6341ZM9.28042 4.23983C9.99896 3.5213 10.8418 3.17203 11.8575 3.17203C12.8729 3.17203 13.716 3.5213 14.4347 4.23983C15.1532 4.95852 15.5026 5.80157 15.5026 6.81689C15.5026 7.83251 15.1532 8.6754 14.4347 9.39409C13.716 10.1128 12.8729 10.4621 11.8575 10.4621C10.8422 10.4621 9.99926 10.1126 9.28042 9.39409C8.56173 8.67556 8.21231 7.83251 8.21231 6.81689C8.21231 5.80157 8.56173 4.95852 9.28042 4.23983Z" fill="white"></path>
                            <path d="M20.2863 17.379C20.2592 16.9893 20.2046 16.5642 20.1242 16.1153C20.043 15.663 19.9385 15.2354 19.8134 14.8447C19.684 14.4408 19.5084 14.0419 19.2909 13.6597C19.0656 13.2629 18.8007 12.9175 18.5034 12.6332C18.1926 12.3358 17.812 12.0967 17.372 11.9223C16.9334 11.7488 16.4475 11.6609 15.9276 11.6609C15.7234 11.6609 15.526 11.7447 15.1447 11.9929C14.91 12.146 14.6355 12.323 14.3291 12.5188C14.0671 12.6857 13.7122 12.8421 13.2738 12.9837C12.8461 13.1221 12.4118 13.1923 11.983 13.1923C11.5546 13.1923 11.1203 13.1221 10.6923 12.9837C10.2544 12.8423 9.89931 12.6859 9.63778 12.5189C9.33428 12.325 9.05962 12.148 8.82143 11.9928C8.44042 11.7445 8.24297 11.6608 8.03881 11.6608C7.51879 11.6608 7.03295 11.7488 6.59457 11.9225C6.15481 12.0966 5.77411 12.3357 5.46298 12.6334C5.16574 12.9178 4.90085 13.2631 4.67563 13.6597C4.45849 14.0419 4.28271 14.4406 4.15332 14.8448C4.02835 15.2356 3.92383 15.663 3.84265 16.1153C3.76208 16.5636 3.70761 16.9888 3.6806 17.3794C3.65405 17.7614 3.64062 18.1589 3.64062 18.5605C3.64062 19.6045 3.9725 20.4497 4.62695 21.073C5.27331 21.6881 6.12841 21.9999 7.1686 21.9999H16.7987C17.8386 21.9999 18.6937 21.6881 19.3402 21.073C19.9948 20.4501 20.3267 19.6046 20.3267 18.5603C20.3265 18.1573 20.313 17.7598 20.2863 17.379V17.379ZM18.5321 20.2238C18.105 20.6303 17.538 20.8279 16.7986 20.8279H7.1686C6.42901 20.8279 5.862 20.6303 5.43506 20.224C5.0162 19.8253 4.81265 19.281 4.81265 18.5605C4.81265 18.1857 4.82501 17.8157 4.84973 17.4605C4.87384 17.112 4.92312 16.7291 4.99621 16.3223C5.06839 15.9206 5.16025 15.5435 5.2695 15.2022C5.37433 14.8749 5.5173 14.5508 5.69461 14.2386C5.86383 13.941 6.05853 13.6858 6.27337 13.4801C6.47433 13.2877 6.72763 13.1302 7.02609 13.0121C7.30212 12.9028 7.61233 12.843 7.94909 12.834C7.99013 12.8558 8.06322 12.8975 8.18163 12.9747C8.42257 13.1317 8.70028 13.3108 9.00728 13.5069C9.35335 13.7276 9.79921 13.9268 10.3319 14.0988C10.8765 14.2749 11.4319 14.3643 11.9832 14.3643C12.5345 14.3643 13.0901 14.2749 13.6344 14.099C14.1675 13.9267 14.6132 13.7276 14.9597 13.5066C15.2739 13.3058 15.5438 13.1319 15.7848 12.9747C15.9032 12.8976 15.9763 12.8558 16.0173 12.834C16.3542 12.843 16.6644 12.9028 16.9406 13.0121C17.2389 13.1302 17.4922 13.2878 17.6932 13.4801C17.908 13.6856 18.1027 13.9409 18.2719 14.2387C18.4494 14.5508 18.5925 14.875 18.6972 15.202C18.8066 15.5438 18.8986 15.9207 18.9706 16.3222C19.0436 16.7297 19.093 17.1127 19.1171 17.4606V17.4609C19.142 17.8148 19.1545 18.1846 19.1547 18.5605C19.1545 19.2811 18.951 19.8253 18.5321 20.2238V20.2238Z" fill="white"></path>
                        </svg>
                        <div class="list-unstyled">
                            <a class="hd-btn-login font_s16 line_h20 cursor_pt color_fff" href="/dang-nhap-tai-khoan" title="Đăng nhập">Đăng nhập</a>
                            <span>/</span>
                            <a class="hd-btn-regis font_s16 line_h20 cursor_pt color_fff" href="/dang-ky-tai-khoan" title="Đăng ký">Đăng ký</a>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="hd-account" onclick="OpenInforUse(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M11.8575 11.6341C13.181 11.6341 14.327 11.1594 15.2635 10.2228C16.1998 9.28636 16.6747 8.14058 16.6747 6.81689C16.6747 5.49365 16.2 4.34771 15.2634 3.41098C14.3268 2.4747 13.1809 2 11.8575 2C10.5338 2 9.388 2.4747 8.45157 3.41113C7.51514 4.34756 7.04028 5.49349 7.04028 6.81689C7.04028 8.14058 7.51514 9.28652 8.45157 10.2229C9.3883 11.1592 10.5342 11.6341 11.8575 11.6341V11.6341ZM9.28042 4.23983C9.99896 3.5213 10.8418 3.17203 11.8575 3.17203C12.8729 3.17203 13.716 3.5213 14.4347 4.23983C15.1532 4.95852 15.5026 5.80157 15.5026 6.81689C15.5026 7.83251 15.1532 8.6754 14.4347 9.39409C13.716 10.1128 12.8729 10.4621 11.8575 10.4621C10.8422 10.4621 9.99926 10.1126 9.28042 9.39409C8.56173 8.67556 8.21231 7.83251 8.21231 6.81689C8.21231 5.80157 8.56173 4.95852 9.28042 4.23983Z" fill="white"></path>
                            <path d="M20.2863 17.379C20.2592 16.9893 20.2046 16.5642 20.1242 16.1153C20.043 15.663 19.9385 15.2354 19.8134 14.8447C19.684 14.4408 19.5084 14.0419 19.2909 13.6597C19.0656 13.2629 18.8007 12.9175 18.5034 12.6332C18.1926 12.3358 17.812 12.0967 17.372 11.9223C16.9334 11.7488 16.4475 11.6609 15.9276 11.6609C15.7234 11.6609 15.526 11.7447 15.1447 11.9929C14.91 12.146 14.6355 12.323 14.3291 12.5188C14.0671 12.6857 13.7122 12.8421 13.2738 12.9837C12.8461 13.1221 12.4118 13.1923 11.983 13.1923C11.5546 13.1923 11.1203 13.1221 10.6923 12.9837C10.2544 12.8423 9.89931 12.6859 9.63778 12.5189C9.33428 12.325 9.05962 12.148 8.82143 11.9928C8.44042 11.7445 8.24297 11.6608 8.03881 11.6608C7.51879 11.6608 7.03295 11.7488 6.59457 11.9225C6.15481 12.0966 5.77411 12.3357 5.46298 12.6334C5.16574 12.9178 4.90085 13.2631 4.67563 13.6597C4.45849 14.0419 4.28271 14.4406 4.15332 14.8448C4.02835 15.2356 3.92383 15.663 3.84265 16.1153C3.76208 16.5636 3.70761 16.9888 3.6806 17.3794C3.65405 17.7614 3.64062 18.1589 3.64062 18.5605C3.64062 19.6045 3.9725 20.4497 4.62695 21.073C5.27331 21.6881 6.12841 21.9999 7.1686 21.9999H16.7987C17.8386 21.9999 18.6937 21.6881 19.3402 21.073C19.9948 20.4501 20.3267 19.6046 20.3267 18.5603C20.3265 18.1573 20.313 17.7598 20.2863 17.379V17.379ZM18.5321 20.2238C18.105 20.6303 17.538 20.8279 16.7986 20.8279H7.1686C6.42901 20.8279 5.862 20.6303 5.43506 20.224C5.0162 19.8253 4.81265 19.281 4.81265 18.5605C4.81265 18.1857 4.82501 17.8157 4.84973 17.4605C4.87384 17.112 4.92312 16.7291 4.99621 16.3223C5.06839 15.9206 5.16025 15.5435 5.2695 15.2022C5.37433 14.8749 5.5173 14.5508 5.69461 14.2386C5.86383 13.941 6.05853 13.6858 6.27337 13.4801C6.47433 13.2877 6.72763 13.1302 7.02609 13.0121C7.30212 12.9028 7.61233 12.843 7.94909 12.834C7.99013 12.8558 8.06322 12.8975 8.18163 12.9747C8.42257 13.1317 8.70028 13.3108 9.00728 13.5069C9.35335 13.7276 9.79921 13.9268 10.3319 14.0988C10.8765 14.2749 11.4319 14.3643 11.9832 14.3643C12.5345 14.3643 13.0901 14.2749 13.6344 14.099C14.1675 13.9267 14.6132 13.7276 14.9597 13.5066C15.2739 13.3058 15.5438 13.1319 15.7848 12.9747C15.9032 12.8976 15.9763 12.8558 16.0173 12.834C16.3542 12.843 16.6644 12.9028 16.9406 13.0121C17.2389 13.1302 17.4922 13.2878 17.6932 13.4801C17.908 13.6856 18.1027 13.9409 18.2719 14.2387C18.4494 14.5508 18.5925 14.875 18.6972 15.202C18.8066 15.5438 18.8986 15.9207 18.9706 16.3222C19.0436 16.7297 19.093 17.1127 19.1171 17.4606V17.4609C19.142 17.8148 19.1545 18.1846 19.1547 18.5605C19.1545 19.2811 18.951 19.8253 18.5321 20.2238V20.2238Z" fill="white"></path>
                        </svg>
                        <div class="list-unstyled">
                            <p class="hd-btn-login font_s16 line_h20 cursor_pt color_fff">{{ getLastWord($dataAll['data']['data']['us_name']) }}</p>
                        </div>
                    </div>
                <?php } ?>
                <div class="hd-cart">
                    <a href="/gio-hang" class="header-cart" aria-label="Xem giỏ hàng" title="Giỏ hàng">
                        <img src="{{ asset('images/home/cartorder.png') }}" class="icon_cartorder" alt="icon">
                        <span class="count_item_pr">{{ $dataAll['data']['data']['totalCarts'] ?? 0 }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- navigation -->
    <nav class="navigation">    
        <div class="nav-menu">
            <div class="nav-col-menu">
                <nav class="header-nav">
                    <ul class="item_big">
                        <!-- thoi trang nam -->
                        @foreach ($dataAll['Category'] as $key => $val)
                            <li class="nav-item active-nav">
                                <div class="nav-item_big">
                                    <a class="a-img product-down cl_000 w100 font_s16 line_h20 font_w500" href="{{ $val['cat_alias'] }}" title="Thời trang nam">
                                        {{ $val['cat_name'] }}
                                    </a>
                                </div>
                                <ul class="nav-item_small">
                                    @foreach ($val['children'] as $key => $valchild)
                                        <li>
                                            <div class="item_small-head">
                                                <a class="font_s14 line_h16 cl_000 w100" href="{{ $val['cat_alias'] . '/' . $valchild['cat_alias'] }}" title="Sơ mi nam">
                                                    {{ $valchild['cat_name'] }}
                                                </a>
                                            </div>
                                            <ul class="item_small-content">
                                                @foreach ($valchild['children'] as $key => $valchild2)
                                                    <li>
                                                        <a href="{{ $val['cat_alias'] . '/' . $valchild['cat_alias'] . '/' . $valchild2['cat_alias']}}" title="Sơ mi ngắn tay" class="font_s14 line_h16 cl_000 w100">
                                                            {{ $valchild2['cat_name'] }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                        <!-- Tin tức -->
                        <li class="nav-item">
                            <div class="nav-item_big">
                                <a class="a-img product-down cl_000 w100 font_s16 line_h20 font_w500" href="/tin-tuc" title="Tin tức">
                                    Tin tức
                                </a>
                            </div>
                            <ul class="nav-item_small">
                                <li>
                                    <a class="font_s14 line_h16 cl_000 w100" href="/tin-tuc" title="Bài viết nổi bật">
                                        Bài viết nổi bật
                                    </a>
                                </li>
                                <li>
                                    <a class="font_s14 line_h16 cl_000 w100" href="/xu-huong-thoi-trang" title="Xu hướng thời trang">
                                        Xu hướng thời trang
                                    </a>
                                </li>
                                <li>
                                    <a class="font_s14 line_h16 cl_000 w100" href="/tin-tuc-tuyen-dung" title="Tuyển dụng">
                                        Tuyển dụng
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Liên hệ -->
                        <li class="nav-item">
                            <div class="nav-item_big">
                                <a class="a-img cl_000 w100 font_s16 line_h20 font_w500" href="/lien-he" title="Liên hệ">
                                    Liên hệ
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </nav>
    <!-- end navigation -->
    <!-- ---------SHOW INFOR ACCOUNT-------------- -->
    <?php if($dataAll['data']['islogin'] == 1){ ?>
        <div class="ShowInforAccount-container">
            <div class="ShowInforAccount">
                <div class="ShowInforAccount-top">
                    <p class="ShowInforAccount-top-title">Thông tin tài khoản</p>
                    <button class="close-ShowInforAccount" onclick="closeShowInforAccount(this)">x</button>
                </div>
                <div class="ShowInforAccount-content">
                    <div class="account-content-header">
                        <div class="box-account-avatar">
                            <img onerror='this.onerror=null;this.src="/images/home/logoweberror.png";' src="/images/home/logoweberror.png" data-src="{{ asset($dataAll['data']['data']['us_logo']) }}?v={{ time() }}" class="lazyload account-avatar" alt="img">
                        </div>
                        <div class="box-account-name">
                            <p class="account-name-text font_s16 line_h20 w_500 cursor_pt color_000">
                                {{ getLastWord($dataAll['data']['data']['us_name']) }}
                            </p>
                            <p class="account-name-text font_s14 line_h18 w_400 cursor_pt color_000">
                                {{ $dataAll['data']['type'] == 1 ? "Tài khoản cá nhân" : "" }}
                            </p>
                        </div>
                    </div>
                    <div class="account-content-center">
                        <a href="/quan-ly-tai-khoan" class="account-content-item">
                            <div class="account-content-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.90219 17H18.0922C19.9922 17 20.9922 16 20.9922 14.1V2H2.99219V14.1C3.00219 16 4.00219 17 5.90219 17Z" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M2 2H22" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M8 22L12 20V17" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M16 22L12 20" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M7.5 11L10.65 8.37C10.9 8.16 11.23 8.22 11.4 8.5L12.6 10.5C12.77 10.78 13.1 10.83 13.35 10.63L16.5 8" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>                              
                            </div>
                            <div class="account-content-tex">Quản lý tài khoản</div>
                        </a>
                        <a href="/quan-ly-don-hang" class="account-content-item">
                            <div class="account-content-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.5 7.66952V6.69952C7.5 4.44952 9.31 2.23952 11.56 2.02952C14.24 1.76952 16.5 3.87952 16.5 6.50952V7.88952" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M8.99983 22H14.9998C19.0198 22 19.7398 20.39 19.9498 18.43L20.6998 12.43C20.9698 9.99 20.2698 8 15.9998 8H7.99983C3.72983 8 3.02983 9.99 3.29983 12.43L4.04983 18.43C4.25983 20.39 4.97983 22 8.99983 22Z" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M15.4955 12H15.5045" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M8.49451 12H8.50349" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>                             
                            </div>
                            <div class="account-content-tex">Quản lý đơn hàng</div>
                        </a>
                        <a href="/san-pham-yeu-thich" class="account-content-item">
                            <div class="account-content-icon">
                                <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.62 18.8101C11.28 18.9301 10.72 18.9301 10.38 18.8101C7.48 17.8201 1 13.6901 1 6.6901C1 3.6001 3.49 1.1001 6.56 1.1001C8.38 1.1001 9.99 1.9801 11 3.3401C12.01 1.9801 13.63 1.1001 15.44 1.1001C18.51 1.1001 21 3.6001 21 6.6901C21 13.6901 14.52 17.8201 11.62 18.8101Z" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>                           
                            </div>
                            <div class="account-content-tex">Sản phẩm yêu thích</div>
                        </a>
                        <a href="/doi-mat-khau" class="account-content-item">
                            <div class="account-content-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="img_dmk">
                                    <path d="M6 10V8C6 4.69 7 2 12 2C17 2 18 4.69 18 8V10" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M17 22H7C3 22 2 21 2 17V15C2 11 3 10 7 10H17C21 10 22 11 22 15V17C22 21 21 22 17 22Z" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M15.9965 16H16.0054" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M11.9945 16H12.0035" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M7.99451 16H8.00349" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>                            
                            </div>
                            <div class="account-content-tex">Đổi mật khẩu</div>
                        </a>
                        <div class="account-content-item" onclick="LogOut(this)">
                            <div class="account-content-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.89844 7.56219C9.20844 3.96219 11.0584 2.49219 15.1084 2.49219H15.2384C19.7084 2.49219 21.4984 4.28219 21.4984 8.75219V15.2722C21.4984 19.7422 19.7084 21.5322 15.2384 21.5322H15.1084C11.0884 21.5322 9.23844 20.0822 8.90844 16.5422" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M14.9972 12H3.61719" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M5.85 8.64844L2.5 11.9984L5.85 15.3484" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>                                    
                            </div>
                            <div class="account-content-tex">Đăng xuất</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</header>
<!-- =================================HEADER MOBILE=========================== -->
<link rel="preload" href="{{ asset('css/layouts/header_mobile.css') }}?v={{ time() }}" media="all" as="style">
<link rel="stylesheet" href="{{ asset('css/layouts/header_mobile.css') }}?v={{ time() }}">
<header class="header_container header_container_mobile w100">
    <!-- ---------HEADER MOBILE-------------- -->
    <div id="header_mobile">
        <div class="hd-mobile_left">
            <div class="icon-show-menu" onclick="buttonOpenNav(this)">
                <div class="icon-line-showmn line1-showmn"></div>
                <div class="icon-line-showmn line2-showmn"></div>
                <div class="icon-line-showmn line3-showmn"></div>
            </div>
        </div>
        <div class="hd-mobile_center">
            <a href="/" class="hd-mobile-logo">
                <img src="{{ asset('images/home/logoweb.png') }}?v={{ time() }}" class="hd-mobile-imglogo" alt="logo">
            </a>
        </div>
        <div class="hd-mobile_right">
            <div class="hd-mobile-cart">
                <a href="/gio-hang" class="header-mobile-cart" aria-label="Xem giỏ hàng" title="Giỏ hàng">
                    <img src="{{ asset('images/home/cartorder.png') }}" class="icon-mobile_cartorder" alt="icon">
                    <span class="count_item_pr">{{ $dataAll['data']['data']['totalCarts'] ?? 0 }}</span>
                </a>
            </div>
            <button class="button-search-mobile" onclick="buttonSearchMobile(this)">
                <img src="{{ asset('images/header/icon-search-white.png') }}?v={{ time() }}" width="20" height="20" class="icon_search" alt="logo">
            </button>
            <?php if($dataAll['data']['islogin'] == 0){ ?>
                <a href="/dang-nhap-tai-khoan">
                    <div class="icon-user-mb cursor_pt">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M11.8575 11.6341C13.181 11.6341 14.327 11.1594 15.2635 10.2228C16.1998 9.28636 16.6747 8.14058 16.6747 6.81689C16.6747 5.49365 16.2 4.34771 15.2634 3.41098C14.3268 2.4747 13.1809 2 11.8575 2C10.5338 2 9.388 2.4747 8.45157 3.41113C7.51514 4.34756 7.04028 5.49349 7.04028 6.81689C7.04028 8.14058 7.51514 9.28652 8.45157 10.2229C9.3883 11.1592 10.5342 11.6341 11.8575 11.6341V11.6341ZM9.28042 4.23983C9.99896 3.5213 10.8418 3.17203 11.8575 3.17203C12.8729 3.17203 13.716 3.5213 14.4347 4.23983C15.1532 4.95852 15.5026 5.80157 15.5026 6.81689C15.5026 7.83251 15.1532 8.6754 14.4347 9.39409C13.716 10.1128 12.8729 10.4621 11.8575 10.4621C10.8422 10.4621 9.99926 10.1126 9.28042 9.39409C8.56173 8.67556 8.21231 7.83251 8.21231 6.81689C8.21231 5.80157 8.56173 4.95852 9.28042 4.23983Z" fill="white"></path>
                            <path d="M20.2863 17.379C20.2592 16.9893 20.2046 16.5642 20.1242 16.1153C20.043 15.663 19.9385 15.2354 19.8134 14.8447C19.684 14.4408 19.5084 14.0419 19.2909 13.6597C19.0656 13.2629 18.8007 12.9175 18.5034 12.6332C18.1926 12.3358 17.812 12.0967 17.372 11.9223C16.9334 11.7488 16.4475 11.6609 15.9276 11.6609C15.7234 11.6609 15.526 11.7447 15.1447 11.9929C14.91 12.146 14.6355 12.323 14.3291 12.5188C14.0671 12.6857 13.7122 12.8421 13.2738 12.9837C12.8461 13.1221 12.4118 13.1923 11.983 13.1923C11.5546 13.1923 11.1203 13.1221 10.6923 12.9837C10.2544 12.8423 9.89931 12.6859 9.63778 12.5189C9.33428 12.325 9.05962 12.148 8.82143 11.9928C8.44042 11.7445 8.24297 11.6608 8.03881 11.6608C7.51879 11.6608 7.03295 11.7488 6.59457 11.9225C6.15481 12.0966 5.77411 12.3357 5.46298 12.6334C5.16574 12.9178 4.90085 13.2631 4.67563 13.6597C4.45849 14.0419 4.28271 14.4406 4.15332 14.8448C4.02835 15.2356 3.92383 15.663 3.84265 16.1153C3.76208 16.5636 3.70761 16.9888 3.6806 17.3794C3.65405 17.7614 3.64062 18.1589 3.64062 18.5605C3.64062 19.6045 3.9725 20.4497 4.62695 21.073C5.27331 21.6881 6.12841 21.9999 7.1686 21.9999H16.7987C17.8386 21.9999 18.6937 21.6881 19.3402 21.073C19.9948 20.4501 20.3267 19.6046 20.3267 18.5603C20.3265 18.1573 20.313 17.7598 20.2863 17.379V17.379ZM18.5321 20.2238C18.105 20.6303 17.538 20.8279 16.7986 20.8279H7.1686C6.42901 20.8279 5.862 20.6303 5.43506 20.224C5.0162 19.8253 4.81265 19.281 4.81265 18.5605C4.81265 18.1857 4.82501 17.8157 4.84973 17.4605C4.87384 17.112 4.92312 16.7291 4.99621 16.3223C5.06839 15.9206 5.16025 15.5435 5.2695 15.2022C5.37433 14.8749 5.5173 14.5508 5.69461 14.2386C5.86383 13.941 6.05853 13.6858 6.27337 13.4801C6.47433 13.2877 6.72763 13.1302 7.02609 13.0121C7.30212 12.9028 7.61233 12.843 7.94909 12.834C7.99013 12.8558 8.06322 12.8975 8.18163 12.9747C8.42257 13.1317 8.70028 13.3108 9.00728 13.5069C9.35335 13.7276 9.79921 13.9268 10.3319 14.0988C10.8765 14.2749 11.4319 14.3643 11.9832 14.3643C12.5345 14.3643 13.0901 14.2749 13.6344 14.099C14.1675 13.9267 14.6132 13.7276 14.9597 13.5066C15.2739 13.3058 15.5438 13.1319 15.7848 12.9747C15.9032 12.8976 15.9763 12.8558 16.0173 12.834C16.3542 12.843 16.6644 12.9028 16.9406 13.0121C17.2389 13.1302 17.4922 13.2878 17.6932 13.4801C17.908 13.6856 18.1027 13.9409 18.2719 14.2387C18.4494 14.5508 18.5925 14.875 18.6972 15.202C18.8066 15.5438 18.8986 15.9207 18.9706 16.3222C19.0436 16.7297 19.093 17.1127 19.1171 17.4606V17.4609C19.142 17.8148 19.1545 18.1846 19.1547 18.5605C19.1545 19.2811 18.951 19.8253 18.5321 20.2238V20.2238Z" fill="white"></path>
                        </svg>
                    </div>
                </a>
            <?php } else { ?>
                <div class="icon-user-mb cursor_pt" onclick="OpenInforUseMobile(this)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M11.8575 11.6341C13.181 11.6341 14.327 11.1594 15.2635 10.2228C16.1998 9.28636 16.6747 8.14058 16.6747 6.81689C16.6747 5.49365 16.2 4.34771 15.2634 3.41098C14.3268 2.4747 13.1809 2 11.8575 2C10.5338 2 9.388 2.4747 8.45157 3.41113C7.51514 4.34756 7.04028 5.49349 7.04028 6.81689C7.04028 8.14058 7.51514 9.28652 8.45157 10.2229C9.3883 11.1592 10.5342 11.6341 11.8575 11.6341V11.6341ZM9.28042 4.23983C9.99896 3.5213 10.8418 3.17203 11.8575 3.17203C12.8729 3.17203 13.716 3.5213 14.4347 4.23983C15.1532 4.95852 15.5026 5.80157 15.5026 6.81689C15.5026 7.83251 15.1532 8.6754 14.4347 9.39409C13.716 10.1128 12.8729 10.4621 11.8575 10.4621C10.8422 10.4621 9.99926 10.1126 9.28042 9.39409C8.56173 8.67556 8.21231 7.83251 8.21231 6.81689C8.21231 5.80157 8.56173 4.95852 9.28042 4.23983Z" fill="white"></path>
                        <path d="M20.2863 17.379C20.2592 16.9893 20.2046 16.5642 20.1242 16.1153C20.043 15.663 19.9385 15.2354 19.8134 14.8447C19.684 14.4408 19.5084 14.0419 19.2909 13.6597C19.0656 13.2629 18.8007 12.9175 18.5034 12.6332C18.1926 12.3358 17.812 12.0967 17.372 11.9223C16.9334 11.7488 16.4475 11.6609 15.9276 11.6609C15.7234 11.6609 15.526 11.7447 15.1447 11.9929C14.91 12.146 14.6355 12.323 14.3291 12.5188C14.0671 12.6857 13.7122 12.8421 13.2738 12.9837C12.8461 13.1221 12.4118 13.1923 11.983 13.1923C11.5546 13.1923 11.1203 13.1221 10.6923 12.9837C10.2544 12.8423 9.89931 12.6859 9.63778 12.5189C9.33428 12.325 9.05962 12.148 8.82143 11.9928C8.44042 11.7445 8.24297 11.6608 8.03881 11.6608C7.51879 11.6608 7.03295 11.7488 6.59457 11.9225C6.15481 12.0966 5.77411 12.3357 5.46298 12.6334C5.16574 12.9178 4.90085 13.2631 4.67563 13.6597C4.45849 14.0419 4.28271 14.4406 4.15332 14.8448C4.02835 15.2356 3.92383 15.663 3.84265 16.1153C3.76208 16.5636 3.70761 16.9888 3.6806 17.3794C3.65405 17.7614 3.64062 18.1589 3.64062 18.5605C3.64062 19.6045 3.9725 20.4497 4.62695 21.073C5.27331 21.6881 6.12841 21.9999 7.1686 21.9999H16.7987C17.8386 21.9999 18.6937 21.6881 19.3402 21.073C19.9948 20.4501 20.3267 19.6046 20.3267 18.5603C20.3265 18.1573 20.313 17.7598 20.2863 17.379V17.379ZM18.5321 20.2238C18.105 20.6303 17.538 20.8279 16.7986 20.8279H7.1686C6.42901 20.8279 5.862 20.6303 5.43506 20.224C5.0162 19.8253 4.81265 19.281 4.81265 18.5605C4.81265 18.1857 4.82501 17.8157 4.84973 17.4605C4.87384 17.112 4.92312 16.7291 4.99621 16.3223C5.06839 15.9206 5.16025 15.5435 5.2695 15.2022C5.37433 14.8749 5.5173 14.5508 5.69461 14.2386C5.86383 13.941 6.05853 13.6858 6.27337 13.4801C6.47433 13.2877 6.72763 13.1302 7.02609 13.0121C7.30212 12.9028 7.61233 12.843 7.94909 12.834C7.99013 12.8558 8.06322 12.8975 8.18163 12.9747C8.42257 13.1317 8.70028 13.3108 9.00728 13.5069C9.35335 13.7276 9.79921 13.9268 10.3319 14.0988C10.8765 14.2749 11.4319 14.3643 11.9832 14.3643C12.5345 14.3643 13.0901 14.2749 13.6344 14.099C14.1675 13.9267 14.6132 13.7276 14.9597 13.5066C15.2739 13.3058 15.5438 13.1319 15.7848 12.9747C15.9032 12.8976 15.9763 12.8558 16.0173 12.834C16.3542 12.843 16.6644 12.9028 16.9406 13.0121C17.2389 13.1302 17.4922 13.2878 17.6932 13.4801C17.908 13.6856 18.1027 13.9409 18.2719 14.2387C18.4494 14.5508 18.5925 14.875 18.6972 15.202C18.8066 15.5438 18.8986 15.9207 18.9706 16.3222C19.0436 16.7297 19.093 17.1127 19.1171 17.4606V17.4609C19.142 17.8148 19.1545 18.1846 19.1547 18.5605C19.1545 19.2811 18.951 19.8253 18.5321 20.2238V20.2238Z" fill="white"></path>
                    </svg>
                </div>
            <?php } ?>
            
        </div>
    </div>
    <!-- ---------NAVI MOBILE-------------- -->
    <nav class="container_navigation_mobile">
        <div class="navigation_mobile">
            <div class="navmobile-top">
                <p class="navmobile-top-title font_s18 line_h24 font_w600">Danh mục</p>
                <span class="navmobile-top-close button-close-nav cursor_pt" onclick="buttonCloseNav(this)">
                    <svg width="18" height="18" viewBox="0 0 19 19" role="presentation">
                        <path d="M9.1923882 8.39339828l7.7781745-7.7781746 1.4142136 1.41421357-7.7781746 7.77817459 7.7781746 7.77817456L16.9705627 19l-7.7781745-7.7781746L1.41421356 19 0 17.5857864l7.7781746-7.77817456L0 2.02943725 1.41421356.61522369 9.1923882 8.39339828z" fill-rule="evenodd"></path>
                    </svg>
                </span>
            </div>
            <div class="navmobile-center">
                @foreach ($dataAll['Category'] as $key => $val)
                    <div class="navmobile-menu-show navmobile-menu-lvl0">
                        <div class="navmobile-menu-lv">
                            <a href="{{ $val['cat_alias'] }}" class="navmobile-menu-text font_w500">{{ $val['cat_name'] }}</a>
                            <div class="box-icon-showhide" onclick="ShowHideParents(this)" data-showhide="0">
                                <div class="icon-line-showhide line1-showhide"></div>
                                <div class="icon-line-showhide line2-showhide"></div>
                            </div>
                        </div>
                        <div class="navmobile-menu-show navmobile-menu-lvl1">
                            @foreach ($val['children'] as $key => $valchild)
                                <div class="navmobile-menu-child">
                                    <div class="navmobile-menu-lv">
                                        <a href="{{ $val['cat_alias'] . '/' . $valchild['cat_alias'] }}" class="navmobile-menu-text">{{ $valchild['cat_name'] }}</a>
                                        <div class="box-icon-showhide" onclick="ShowHideChilds(this)" data-showhide="0">
                                            <div class="icon-line-showhide line1-showhide"></div>
                                            <div class="icon-line-showhide line2-showhide"></div>
                                        </div>
                                    </div>
                                    <div class="navmobile-menu-show navmobile-menu-lvl2">
                                        @foreach ($valchild['children'] as $key => $valchild2)
                                            <div class="navmobile-menu-lv">
                                                <a href="{{ $val['cat_alias'] . '/' . $valchild['cat_alias'] . '/' . $valchild2['cat_alias']}}" class="navmobile-menu-text">{{ $valchild2['cat_name'] }}</a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                <div class="navmobile-menu-show navmobile-menu-lvl0">
                    <div class="navmobile-menu-lv">
                        <a href="/tin-tuc" class="navmobile-menu-text font_w500">Tin tức</a>
                        <div class="box-icon-showhide" onclick="ShowHideParents(this)" data-showhide="0">
                            <div class="icon-line-showhide line1-showhide"></div>
                            <div class="icon-line-showhide line2-showhide"></div>
                        </div>
                    </div>
                    <div class="navmobile-menu-show navmobile-menu-lvl1">
                        <div class="navmobile-menu-child">
                            <div class="navmobile-menu-lv">
                                <a href="/tin-tuc" class="navmobile-menu-text">Bài viết nổi bật</a>
                            </div>
                            <div class="navmobile-menu-lv">
                                <a href="/xu-huong-thoi-trang" class="navmobile-menu-text">Xu hướng thời trang</a>
                            </div>
                            <div class="navmobile-menu-lv">
                                <a href="/tin-tuc-tuyen-dung" class="navmobile-menu-text">Tuyển dụng</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="navmobile-menu-show navmobile-menu-lvl0">
                    <div class="navmobile-menu-lv">
                        <a href="/lien-he" class="navmobile-menu-text font_w500">Liên hệ</a>
                    </div>
                </div>
            </div>
            <div class="navmobile-bottom">
                
            </div>
        </div>
    </nav>
    <!-- ---------SEACH MOBILE-------------- -->
    <div class="SearchMobile-container">
        <div class="SearchMobile">
            <div class="SearchMobile-top">
                <p class="SearchMobile-top-title">Tìm kiếm</p>
                <button class="close-SearchMobile" onclick="closeSearchMobile(this)">x</button>
            </div>
            <div class="SearchMobile-content">
                <div class="SearchMobile-boxsearch">
                    <!-- loai san pham tim kiem -->
                    <div id="search_info_mobile" class="list_search_mobile">
                        <div class="container-select2">
                            <select class="select-type-fashion-mobile" id="select-type-fashion-mobile">
                                <option class="search_item" value="0" title="Tất cả">Tất cả</option>       
                                @foreach ($dataAll['Category'] as $key => $val)
                                    <option class="search_item" value="{{ $val['cat_code'] }}" datacode="{{ $val['cat_parent_code'] }}" title="{{ $val['cat_name'] }}">{{ $val['cat_name'] }}</option>
                                    @foreach ($val['children'] as $key => $valchild)
                                        <option class="search_item" value="{{ $valchild['cat_code'] }}" datacode="{{ $valchild['cat_parent_code'] }}" title="{{ $valchild['cat_name'] }}">{{ $valchild['cat_name'] }}</option>
                                        @foreach ($valchild['children'] as $key => $valchild2)
                                            <option class="search_item" value="{{ $valchild2['cat_code'] }}" datacode="{{ $valchild2['cat_parent_code'] }}" title="{{ $valchild2['cat_name'] }}">{{ $valchild2['cat_name'] }}</option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select>
                            <div class="box-append-select2 box-append-typefashion-mobile"></div>
                        </div>
                    </div>
                    <!-- input tim kiem -->
                    <input type="search" name="query" value="" id="search-text-mobile" placeholder="Tìm sản phẩm bạn mong muốn" class="search-text" autocomplete="off" onclick="openSuggestSearchMobile(this)">
                    <!-- button tim kiem -->
                    <div class="container_input_search_mobile">
                        <button class="btn_search_mobile cursor_pt">
                            <img src="{{ asset('images/header/icon-search-white.png') }}?v={{ time() }}" width="20" height="20" alt="icon">
                        </button>
                    </div>
                </div>
                <!-- Box goi y tim kiem -->
                <div class="collection-selector-mobile">
                    <div class="collection-selector-mobile-center">
                        <div class="box-show-colslectcenter">
                            <div class="show-colslectcenter-head">
                                <p class="txt-colslecttop-left">Sản phẩm</p>
                                <p class="txt-colslecttop-right">Xem tất cả</p>
                            </div>
                            <div class="show-colslectcenter-content">
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                <div class="colslectcenter-content-item">
                                    <div class="colslectcenter-content-item-img">
                                        <img src="{{ asset('images/product_sample/product.png') }}" class="item-img" alt="image">
                                    </div>
                                    <div class="colslectcenter-content-item-detail">
                                        <p class="item-detail-title font_s16 line_h20">Set Đồ Nam ICONDENIM Mind's Maze</p>
                                        <p class="item-detail-price font_s14 line_h16 cl_red">340,00 <sup>đ</sup></p>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ---------SHOW INFOR ACCOUNT-------------- -->
    <?php if($dataAll['data']['islogin'] == 1){ ?>
        <div class="ShowInforAccountMb-container">
            <div class="ShowInforAccountMb">
                <div class="ShowInforAccountMb-top">
                    <p class="ShowInforAccountMb-top-title">Thông tin tài khoản</p>
                    <button class="close-ShowInforAccountMb" onclick="closeShowInforAccountMb(this)">x</button>
                </div>
                <div class="ShowInforAccountMb-content">
                    <div class="account-content-header">
                        <div class="box-account-avatar">
                            <img onerror='this.onerror=null;this.src="/images/home/logoweberror.png";' src="/images/home/logoweberror.png" data-src="{{ asset($dataAll['data']['data']['us_logo']) }}?v={{ time() }}" class="lazyload account-avatar" alt="img">
                        </div>
                        <div class="box-account-name">
                            <p class="account-name-text font_s16 line_h20 w_500 cursor_pt color_000">
                                {{ getLastWord($dataAll['data']['data']['us_name']) }}
                            </p>
                            <p class="account-name-text font_s14 line_h18 w_400 cursor_pt color_000">
                                {{ $dataAll['data']['type'] == 1 ? "Tài khoản cá nhân" : "" }}
                            </p>
                        </div>
                    </div>
                    <div class="account-content-center">
                        <a href="/quan-ly-tai-khoan" class="account-content-item">
                            <div class="account-content-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.90219 17H18.0922C19.9922 17 20.9922 16 20.9922 14.1V2H2.99219V14.1C3.00219 16 4.00219 17 5.90219 17Z" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M2 2H22" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M8 22L12 20V17" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M16 22L12 20" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M7.5 11L10.65 8.37C10.9 8.16 11.23 8.22 11.4 8.5L12.6 10.5C12.77 10.78 13.1 10.83 13.35 10.63L16.5 8" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>                              
                            </div>
                            <div class="account-content-tex">Quản lý tài khoản</div>
                        </a>
                        <a href="/quan-ly-don-hang" class="account-content-item">
                            <div class="account-content-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.5 7.66952V6.69952C7.5 4.44952 9.31 2.23952 11.56 2.02952C14.24 1.76952 16.5 3.87952 16.5 6.50952V7.88952" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M8.99983 22H14.9998C19.0198 22 19.7398 20.39 19.9498 18.43L20.6998 12.43C20.9698 9.99 20.2698 8 15.9998 8H7.99983C3.72983 8 3.02983 9.99 3.29983 12.43L4.04983 18.43C4.25983 20.39 4.97983 22 8.99983 22Z" stroke="currentcolor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M15.4955 12H15.5045" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M8.49451 12H8.50349" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>                             
                            </div>
                            <div class="account-content-tex">Quản lý đơn hàng</div>
                        </a>
                        <a href="/san-pham-yeu-thich" class="account-content-item">
                            <div class="account-content-icon">
                                <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.62 18.8101C11.28 18.9301 10.72 18.9301 10.38 18.8101C7.48 17.8201 1 13.6901 1 6.6901C1 3.6001 3.49 1.1001 6.56 1.1001C8.38 1.1001 9.99 1.9801 11 3.3401C12.01 1.9801 13.63 1.1001 15.44 1.1001C18.51 1.1001 21 3.6001 21 6.6901C21 13.6901 14.52 17.8201 11.62 18.8101Z" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>                           
                            </div>
                            <div class="account-content-tex">Sản phẩm yêu thích</div>
                        </a>
                        <a href="/doi-mat-khau" class="account-content-item">
                            <div class="account-content-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="img_dmk">
                                    <path d="M6 10V8C6 4.69 7 2 12 2C17 2 18 4.69 18 8V10" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M17 22H7C3 22 2 21 2 17V15C2 11 3 10 7 10H17C21 10 22 11 22 15V17C22 21 21 22 17 22Z" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M15.9965 16H16.0054" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M11.9945 16H12.0035" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M7.99451 16H8.00349" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>                            
                            </div>
                            <div class="account-content-tex">Đổi mật khẩu</div>
                        </a>
                        <div class="account-content-item" onclick="LogOut(this)">
                            <div class="account-content-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.89844 7.56219C9.20844 3.96219 11.0584 2.49219 15.1084 2.49219H15.2384C19.7084 2.49219 21.4984 4.28219 21.4984 8.75219V15.2722C21.4984 19.7422 19.7084 21.5322 15.2384 21.5322H15.1084C11.0884 21.5322 9.23844 20.0822 8.90844 16.5422" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M14.9972 12H3.61719" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M5.85 8.64844L2.5 11.9984L5.85 15.3484" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>                                    
                            </div>
                            <div class="account-content-tex">Đăng xuất</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</header>
<!-- NAVIGATION MOBILE BOTTOM-->
<nav class="container-navbar-bottom">
    <div class="navbar-bottom">
        <div class="nav-bar-box <?= ($_SERVER['REQUEST_URI'] == '/') ? 'active-nav-bar' : '' ?>" data="1" onclick="ActiveNavBar(this)">
            <div class="nav-bar-cicle">
                <img src="{{ asset('images/home/nav_home.png') }}?v={{ time() }}"  class="icon-nav-bar icon-nav-home" width="20" height="20" alt="icon">
            </div>
            <p class="text-nav-bar">Trang chủ</p>
        </div>
        <div class="nav-bar-box" data="2" onclick="ActiveNavBar(this)">
            <div class="nav-bar-cicle">
                <img src="{{ asset('images/home/nav_cate.png') }}?v={{ time() }}"  class="icon-nav-bar icon-nav-cate" width="20" height="20" alt="icon">
            </div>
                <p class="text-nav-bar">Danh mục</p>
        </div>
        <div class="nav-bar-box <?= ($_SERVER['REQUEST_URI'] == '/gio-hang') ? 'active-nav-bar' : '' ?>" data="3" onclick="ActiveNavBar(this)">
            <div class="nav-bar-cicle">
                <img src="{{ asset('images/home/nav_cart.png') }}?v={{ time() }}"  class="icon-nav-bar icon-cart" width="24" height="24" alt="icon">
            </div>    
            <p class="text-nav-bar">Giỏ hàng</p>
        </div>
        <?php if($dataAll['data']['islogin'] == 0){ ?>
            <div class="nav-bar-box" data="4" onclick="ActiveNavBar(this)">
                <div class="nav-bar-cicle">
                    <img src="{{ asset('images/home/nav_user.png') }}?v={{ time() }}"  class="icon-nav-bar icon-nav-user" width="20" height="20" alt="icon">
                </div> 
                <p class="text-nav-bar">Tài khoản</p>
            </div>
        <?php } else { ?>
            <div class="nav-bar-box" data="5" onclick="ActiveNavBar(this)">
                <div class="nav-bar-cicle">
                    <img src="{{ asset('images/home/nav_user.png') }}?v={{ time() }}"  class="icon-nav-bar icon-nav-user" width="20" height="20" alt="icon">
                </div> 
                <p class="text-nav-bar">Tài khoản</p>
            </div>
        <?php } ?>
    </div>
</nav>
<!-- BACK TO TOP -->
<button onclick="BackToTop(this)" class="back_to_top" title="Lên đầu">
    <img class="ico_back" width="16" height="16" src="/images/icon/go-to-top.png" alt="icon">
</button>
<script src="{{ asset('js/layouts/header.js') }}?v={{ time() }}" defer></script>