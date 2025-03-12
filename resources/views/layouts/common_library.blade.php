<!-- Jquery -->
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<!-- lazysize -->
<script type="text/javascript" src="{{asset('js/lazysizes.min.js')}}" defer></script>
<!-- Slick -->
<?php if (isset($dataversion['useslick']) && $dataversion['useslick'] == 1) { ?>
    <link rel="preload" media="all" href="{{asset('css/slick/slick-theme.css')}}" />
    <link rel="preload" media="all" href="{{asset('css/slick/slick.css')}}" />
    <link rel="stylesheet" media="all" href="{{asset('css/slick/slick-theme.css')}}" />
    <link rel="stylesheet" media="all" href="{{asset('css/slick/slick.css')}}" />
    <script type="text/javascript" src="{{asset('js/slick/slick.min.js')}}" defer></script>
<?php } ?>
<!-- select2 -->
<?php if (isset($dataversion['useselect2']) && $dataversion['useselect2'] == 1) { ?>
    <link rel="stylesheet" media="all" href="{{asset('css/select2/select2.min.css')}}">
    <link rel="preload" media="all" href="{{asset('css/select2/select2.min.css')}}" />
    <script type="text/javascript" src="{{asset('js/select2/select2.min.js')}}" defer></script>
    <script type="text/javascript" src="{{asset('js/select2/select2.js')}}" defer></script>
<?php } ?>
<!-- css chung -->
<link rel="preload" media="all" href="{{ asset('css/common.css') }}?v={{ time() }}" />
<link rel="stylesheet" href="{{ asset('css/common.css') }}?v={{ time() }}">
<!-- icon web -->
<link rel="icon" sizes="192x192" href="{{asset('images/home/logoweb.png')}}?v={{ time() }}">
<link rel="shortcut icon" href="{{asset('images/home/logoweb.png')}}?v={{ time() }}" type="image/x-icon" />
<!-- font awesome -->
<link rel="preload" href="{{ asset('css/font-awesome.min.css') }}" media="all"/>
<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />
<!-- link js chứa hàm chung -->
<script src="{{ asset('js/function_general.js') }}?v={{ time() }}" defer></script>
<!-- csrf token (bắt buộc thêm để thực hiện giao thức HTTP) -->
<!-- CSRF (Cross-Site Request Forgery) token là một cơ chế bảo mật bắt buộc trong Laravel 
để ngăn chặn các cuộc tấn công giả mạo request từ trang khác. -->
<meta name="csrf-token" content="{{ csrf_token() }}">