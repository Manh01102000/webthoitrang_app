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
    <link rel="stylesheet" href="{{ asset('css/manager_account/affiliate.css') }}?v={{ time() }}">
    <!-- link js trang chủ -->
    <script src="{{ asset('js/manager_account/affiliate.js') }}?v={{ time() }}"></script>
</head>

<body>
    <div class="container_home">
        <!-- header -->
        @include('layouts.header')
        <h1 hidden>Fashion Houses – Shop Quần Áo Thời Trang Cao Cấp</h1>
        <!-- content -->
        <div class="container-page">
            <div class="container-affiliate container-general-allpage">
                <!-- breadcrumb -->
                {!! renderBreadcrumb($dataAll['breadcrumbItems']) !!}
                <!-- end breadcrumb -->
                <section class="section-affiliate frame-manageraccount-all">
                    @include('layouts.manager_account.sidebar')
                    <main class="affiliate-container main-container">
                        <div class="affiliate-wrapper">
                            <div class="affiliate">
                                <div class="affiliate-header">
                                    <h1 class="affiliate-title font_s24 font_w500 line_h30">Hợp đồng tiếp thị liên kết</h1>
                                </div>
                                <div class="affiliate-body">
                                    <div class="affiliate-content">
                                        <div class="affiliate-status">
                                            <p class="affiliate-status-label font_s15 font_w500 cl_000">Trạng thái: </p>
                                            <p class="affiliate-status-value font_s15 font_w500 cl_000 {{ $dataAll['dataAffiliate']['contracts_id'] != 0 ? "" : "affiliate-error" }}">
                                                {{ $dataAll['dataAffiliate']['contracts_id'] != 0 ? "Đã liên kết" : "Chưa cập nhật" }}
                                            </p>
                                        </div>
                                        <div class="affiliate-license">
                                            <div class="affiliate-text">
                                                <div class="contract-container">
                                                    <h2 class="font_s20 line_h26 font_w500 mbt_20 contract-title">
                                                        Giữa <span class="affiliate-company-name">{{ $dataAll['dataAffiliate']['companyName'] }}</span> và 
                                                        <span class="affiliate-partner-name">{{ $dataAll['dataAffiliate']['partnerName'] }}</span>
                                                    </h2>
                                                    
                                                    <div class="contract-section">
                                                        <h3>1. Giới thiệu</h3>
                                                        <p>Hợp đồng này xác lập mối quan hệ giữa <span class="company-name">{{ $dataAll['dataAffiliate']['companyName'] }}</span> 
                                                            (sau đây gọi là "Công ty") và <span class="partner-name">{{ $dataAll['dataAffiliate']['partnerName'] }}</span> 
                                                            (sau đây gọi là "Đối tác") trong chương trình tiếp thị liên kết.</p>
                                                    </div>

                                                    <div class="contract-section">
                                                        <h3>2. Quyền lợi và Trách nhiệm</h3>
                                                        <p class="contract-benefit">- Đối tác sẽ nhận được hoa hồng trên mỗi giao dịch hợp lệ được thực hiện qua liên kết của mình.</p>
                                                        <p class="contract-policy">- Đối tác cam kết tuân thủ các chính sách và quy định của chương trình.</p>
                                                        <p class="contract-fraud-policy">- Công ty có quyền thay đổi chính sách hoa hồng hoặc chấm dứt hợp tác nếu phát hiện gian lận.</p>
                                                    </div>

                                                    <div class="contract-section">
                                                        <h3>3. Thanh toán</h3>
                                                        <p>- Hoa hồng được thanh toán vào ngày <span class="payment-date">{{ $dataAll['dataAffiliate']['paymentDate'] }}</span> hàng tháng.</p>
                                                        <p>- Số tiền thanh toán tối thiểu là <span class="payment-minimum">{{ $dataAll['dataAffiliate']['paymentMinimum'] }}</span> VND.</p>
                                                        <p>- Thanh toán được thực hiện qua <span class="payment-method">{{ $dataAll['dataAffiliate']['paymentMethod'] }}</span>.</p>
                                                    </div>

                                                    <div class="contract-section">
                                                        <h3>4. Điều khoản chấm dứt</h3>
                                                        <p>- Mỗi bên có quyền chấm dứt hợp đồng với thông báo trước 
                                                            <span class="contract-terminate-days">{{ $dataAll['dataAffiliate']['TerminateDateMin'] }}</span> ngày.</p>
                                                        <p>- Nếu có dấu hiệu gian lận, hợp đồng sẽ bị chấm dứt ngay lập tức.</p>
                                                    </div>

                                                    <div class="signature">
                                                        <div class="company-signature">
                                                            <p><strong>Đại diện Công ty</strong></p>
                                                            <input type="text" class="company-sign-name" name="company-sign-name" value="{{ $dataAll['dataAffiliate']['company_sign_name'] }}">
                                                            <p>Ngày ký: <span class="company-sign-date">{{ $dataAll['dataAffiliate']['companySignDate'] }}</span></p>
                                                        </div>
                                                        <div class="partner-signature">
                                                            <p><strong>Đối tác</strong></p>
                                                            <input type="text" class="partner-sign-name" name="partner-sign-name" value="{{ $dataAll['dataAffiliate']['partner_sign_name'] }}">
                                                            <p>Ngày ký: <span class="partner-sign-date">{{$dataAll['dataAffiliate']['partnerSignDate']}}</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <p class="affiliate-note">
                                                <span class="font_s13 font_w500 cl_red" style="color:red;font-style: italic;">Lưu ý:</span><br>
                                                <span class="font_s13 font_w400" style="color:#23527c">
                                                    Bằng cách nhấn <span class="accept-highlight" style="color:red;font-style: italic;">"Đồng ý"</span>, bạn chấp nhận tuân theo các điều khoản.
                                                </span>
                                            </p>
                                        </div>

                                        <div class="affiliate-actions">
                                            <button rel="nofollow" class="affiliate-cancel" data-contracts-id="{{$dataAll['dataAffiliate']['contracts_id']}}" onclick="CancelContract(this)">Hủy hợp đồng</button>
                                            <button type="button" class="affiliate-update {{ $dataAll['dataAffiliate']['contracts_id'] != 0 ? "button-disabled" : "" }}" {{ $dataAll['dataAffiliate']['contracts_id'] != 0 ? "disabled" : "" }} onclick="SaveContract(this)">Đồng ý</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </section>
            </div>
        </div>
        <!-- footer -->
        @include('layouts.footer')
        <!-- end footer -->
    </div>
</body>

</html>
