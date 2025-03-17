<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="robots" content="index,follow">
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
    <link rel="stylesheet" href="{{ asset('css/messenger.css') }}?v={{ time() }}">
    <!-- link js trang chủ -->
    <script src="{{ asset('js/messenger.js') }}?v={{ time() }}" defer></script>
</head>

<body>
    <div class="container_home">
        <!-- header -->
        @include('layouts.header')
        <!-- Banner -->
        <h1 hidden>Fashion Houses – Shop Quần Áo Thời Trang Cao Cấp</h1>
        <section id="messenger">
            <div class="container-messenger">
                <div class="sidebar-messenger">
                    <div class="sidebar-messenger__box">
                        <div class="sidebar-messenger__head">
                            <div class="sidebar-messenger__seach">
                                <div class="sidebar-messenger__seach__box d_flex al_ct gap_5">
                                    <img src="{{ asset("/images/messenger/search_new.svg") }}" width="25" height="25" class="iconSearch cursor_pt" alt="tìm kiếm">
                                    <p type="text" class="sidebar-messenger__seach__text font_s14 font_w400 cl_333 line_h18 cursor_pt">Nhập tên cần tìm kiếm</p>
                                </div>
                            </div>
                            <div class="sidebar-messenger__navigation d_flex al_ct gap_5 w100">
                                <span class="conversation-all active-conversation__nav font_s14 font_w400 cl_333 line_h18 cursor_pt">Tin nhắn</span>
                                <span class="conversation-unread font_s14 font_w400 cl_333 line_h18 cursor_pt">Chưa đọc</span>
                            </div>
                        </div>
                        <div class="sidebar-messenger__body">
                            <div class="sidebar-messenger__list">
                                @for ($i = 1; $i < 10; $i++)
                                    <div class="messenger__list d_flex al_st gap_5 cursor_pt {{ $i == 1 ? "active_conv" : "" }}" onclick="MessengerShow(this)" data-name="Fashion House">
                                        <div class="dataSendMessage" data-conversationid="2311413" data-isgroup="0" data-isonline="1,0" data-conversationname="ĐỖ XUÂN MẠNH" data-listmember="10087531,10384461" hidden></div>
                                        <img onerror='this.onerror=null;this.src="/images/home/logoweberror.png";' src="/images/home/logoweberror.png" data-src="{{ asset("") }}?v={{ time() }}" class="lazyload avatar-user" alt="ảnh người dùng">
                                        <div class="sidebar-messenger__user d_flex fl_cl gap_5">
                                            <div class="messenger__user">
                                                <p class="messenger__user-name font_15 font_w500 cl_000 line_h18">Fashion House</p>
                                                <p class="messenger__user-time font_s13 cl_333 line_h16">T 4</p>
                                            </div>
                                            <p class="messenger__user-content font_s14 font_w400 cl_333 line_h18">FashionHouse có thể giúp gì cho bạn</p>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-messenger">
                    <div class="main-messenger__conversation">
                        <div class="main-messenger__conversation__head d_flex jc_sb al_ct w100">
                            <div class="main-messenger__conversation__left d_flex al_ct gap_10">
                                <button type="button" class="main-messenger__conversation__return">
                                    <img src="{{ asset("/images/messenger/angle-left.png") }}" width="16" height="16" alt="icon">
                                </button>
                                <div class="main-messenger__conversation__avatar">
                                    <img onerror='this.onerror=null;this.src="/images/home/logoweberror.png";' src="/images/home/logoweberror.png" data-src="{{ asset("") }}?v={{ time() }}" class="lazyload avatarUserMain">
                                    <span class="main-messenger__conversation__online"></span>
                                </div>
                                <div class="main-messenger__conversation__user d_flex fl_cl gap_5">
                                    <p class="main-messenger__conversation__username font_s16 font_w600 cl_main line_h20">Fashion House</p>
                                    <span class="main-messenger__conversation__usertime font_s13 font_w400 cl_333 line_h16">Thường trả lời trong vòng 1 giờ</span>
                                </div>
                            </div>
                            <div class="main-messenger__conversation__right">
                                <button type="button" class="main-messenger__conversation__setting">
                                    <img src="{{ asset("/images/messenger/menu-dots.png") }}" width="16" height="16" alt="icon">
                                </button>
                            </div>
                        </div>
                        <div class="conversation-main">
                            <div class="conversation-main__messenger">
                                <div class="conversation-body">
                                    
                                </div>
                            </div>
                            <div class="conversation-main__action">
                                <div class="conversation-main__action__head">
                                    <div class="previewFile">
                                        <div class="boxPreviewFile d_flex">
                                            <label for="sendfile" class="addMoreFile cursor_pt">
                                                <img src="{{ asset('/images/messenger/icons_plus.png') }}" alt="icon plus">
                                            </label>
                                            <div class="containerBoxFile">
                                                <div class="BoxFileItem" data="" data-img="1">
                                                    <img src="blob:https://vieclam88.vn/9ef5df7d-e384-49ea-899c-cbf2da475526" class="FilePreview">
                                                    <img src="{{ asset('/images/messenger/xoaanh.svg') }}" width="25" height="25" class="iconDeleteFile cursor_pt" onclick="DeleteFile(this)">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="conversation-main__action__content">
                                    <input id="sendMessage" class="sendMessage" name="sendMessage" value="" autocomplete="off" placeholder="Nhập tin nhắn">
                                    <div class="conversation-more-action d_flex al_ct gap_10">
                                        <button type="button" class="buttonSendMessage" id="buttonSendMessage" onclick="ButtonSendMessage(this)">
                                            <img src="{{ asset('/images/messenger/iconSendMess.png') }}" width="24px" height="24px" alt="icon gửi tin nhắn">
                                        </button>
                                        <label for="buttonSendFile" class="buttonSendFile cursor_pt">
                                            <input type="file" id="buttonSendFile" style="display:none" name="buttonSendFile" onchange="loadVideo(this)" placeholder="Tải lên video">
                                            <img src="{{ asset('/images/messenger/iconSendFile.png') }}" width="24px" height="24px" class="iconSendFile" alt="icon gửi file">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- footer -->
        @include('layouts.footer')
        <!-- end footer -->
    </div>
</body>

</html>
