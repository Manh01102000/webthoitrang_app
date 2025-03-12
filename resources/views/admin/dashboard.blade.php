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
    <!-- link js trang chủ -->
    <script src="{{ asset('js/admin/home.js') }}?v={{ time() }}"></script>
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
                    <h1 class="header__title">Thống kê</h1>
                </header>

                <!-- Dashboard Cards -->
                <section class="dashboard-cards">
                    <div class="card card--sales">
                        <h3>Tổng doanh thu</h3>
                        <p>$192,922</p>
                    </div>
                    <div class="card card--expenses">
                        <h3>Tổng chi phí</h3>
                        <p>$35,174</p>
                    </div>
                    <div class="card card--orders">
                        <h3>Đơn hàng mới</h3>
                        <p>92</p>
                    </div>
                    <div class="card card--customers">
                        <h3>Khách hàng mới</h3>
                        <p>12</p>
                    </div>
                </section>

                <!-- Sales Dynamic Chart -->
                <section class="chart">
                    <h2>Sales Dynamic</h2>
                    <div class="chart__container">
                        <!-- Biểu đồ sẽ được vẽ bằng CSS hoặc thư viện JS -->
                    </div>
                </section>

                <!-- Orders List -->
                <section class="orders">
                    <h2>Danh sách đơn hàng mới</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Order</th>
                                <th>Cost</th>
                                <th>Due Date</th>
                                <th>Delivery Status</th>
                                <th>Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>NFK1928</td>
                                <td>Olaf Bobyrk</td>
                                <td>Web Design</td>
                                <td>$837.90</td>
                                <td>02 Feb 2025</td>
                                <td class="table__cell table__cell--status-pending">Pending</td>
                                <td>Credit Card</td>
                            </tr>
                            <tr>
                                <td>JGK2502</td>
                                <td>Pierre Decic</td>
                                <td>Logo</td>
                                <td>$200.90</td>
                                <td>15 Jan 2025</td>
                                <td class="table__cell table__cell--status-completed">Completed</td>
                                <td>Revolut</td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </main>
        </div>
    </div>
</body>

</html>
