<!-- Thu vien su dung hoac cac muc dung chung -->
@include('layouts.common_library')
<style>
.d_none {
    display:none;
}
#m_chat88 {
    height: calc(100% - 62px);
    width: 100%;
    float: left;
}

footer {
    display: none !important;
}

div#liveChatContainer {
    display: none;
}

::-webkit-scrollbar {
    width: 5px;
    height: 5px;
}

/* Track */
::-webkit-scrollbar-track {
    background: #f1f1f1;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #007d7d;
}

.container_chat88 {
    display: flex;
    height: calc(100vh - 62px);
}

.main_left_chat {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 20px 0px;
    height: 100%;
}

.main_left {
    width: 100%;
    float: left;
    border-top: 1px solid #007d7d;
    border-bottom: 1px solid #007d7d;
    height: 100%;
    background: #efefefad;
}

.header_lchat {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 20px;
    padding: 0px 15px;
}

.search_chat {
    width: 97%;
    padding: 5px 10px;
    border: 1px solid #aaa;
    border-radius: 10px;
    background: #FFF;
    display: flex;
    justify-content: space-between;
    gap: 10px;
    margin: 0px 5px;
}

.psearch_chat {
    width: calc(100% - 35px);
    padding: 0px 5px;
    border-radius: 5px;
}

.navigation_chat {
    width: 100%;
    padding: 20px 0px 0px;
    border-top: 1px solid #007d7d;
    border-bottom: 1px solid #007d7d;
}

.box_tinhan88 {
    display: flex;
    gap: 10px;
}

.txt_tinhan {
    font-family: 'Roboto-Medium';
    font-size: 16px;
    line-height: 24px;
    color: #333;
    cursor: pointer;
}

.active_chat88 {
    border-bottom: 2px solid #007d7d;
    color: #007d7d;
    border-radius: 0;
}

.box_showchat {
    width: 100%;
    display: flex;
    padding: 10px;
    gap: 10px;
}

.title_showchat {
    width: 100%;
    display: flex;
    justify-content: space-between;
    gap: 5px;
}

.txt_ttshowchat {
    font-size: 15px;
    font-family: 'Roboto-Regular';
    width: calc(100% - 65px);
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}

.txt_timechat {
    font-size: 14px;
    font-family: 'Roboto-Regular';
    width: 65px;
    text-align: right;
}

.active_conv {
    background: #007d7d !important;
    border-radius: 20px !important;
}

.box_showchat.active_conv :is(.txt_ttshowchat, .txt_timechat, .content_showchat) {
    color: #fff !important;
}

.box_showchat.active_conv_noread :is(.txt_ttshowchat, .txt_timechat, .content_showchat) {
    font-family: 'Roboto-Bold';
}

.box_showchat:hover {
    background: #007d7d2e;
    border-radius: 10px;
}

.box_showchat:hover :is(.txt_ttshowchat, .txt_timechat, .content_showchat) {
    color: #333;

}

.content_showchat {
    width: 100%;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}

.content_lchat {
    display: flex;
    flex-direction: column;
    gap: 5px;
    padding: 0px 15px;
    overflow: auto;
}

.main_right_chat {
    width: 100%;
    display: flex;
    flex-direction: column;
    border: 1px solid #007d7d;
    height: 100%;
}

.wanring_notconversation {
    width: 100%;
    text-align: center;
    padding-top: 20%;
    font-size: 20px;
    font-family: 'Roboto-Bold';
    color: #007d7d;
}

.header_conversation {
    padding: 10px 20px 10px;
    background: #f4f4f4;
    border-bottom: 1px solid #007d7d;
    display: flex;
    align-items: center;
    height: 91px;
}

.frame_infor_use {
    padding: 5px 10px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.title_conversation {
    width: 100%;
    text-align: left;
    font-size: 25px;
    font-family: 'Roboto-Bold';
    color: #007d7d;
    line-height: 30px;
}

.informore_hd {
    width: 100%;
    display: flex;
    gap: 10px;
    align-items: center;
    justify-content: start;
}

.txt_more {
    font-size: 15px;
    font-family: 'Roboto-Medium';
}

.content_conversation {
    height: calc(100% - 91px);
}

.container_conversation {
    height: 100%;
}

.box_inforluse {
    width: calc(100% - 55px);
    display: flex;
    flex-direction: column;
}

.avatar_user_chat {
    width: 50px;
    height: 50px;
    filter: drop-shadow(0px 0px 6px rgba(0, 0, 0, 0.15));
    border-radius: 50%;
    float: left;
    margin: 0px;
    object-fit: cover;
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .5);
}

.avatar_user_right {
    width: 70px;
    height: 70px;
    filter: drop-shadow(0px 0px 6px rgba(0, 0, 0, 0.15));
    border-radius: 50%;
    float: left;
    margin: 0px;
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .5);
}

.box_show_conversation {
    display: flex;
    height: calc(100% - 82px);
    overflow: auto;
    margin-bottom: 10px;
}

.box_input_ctconversation {
    height: 70px;
    width: 100%;
    background: #f4f4f4;
    border-top: 1px solid #007d7d;
    display: flex;
    justify-content: center;
    padding: 0px 50px;
    position: relative;
}

.box_ip_sendchat {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    max-width: 100%;
    width: 100%;
}

#sendchat {
    width: calc(100% - 117px);
    padding: 5px 20px;
    border-radius: 30px;
    height: 40px;
    background: #FFF;
    border: 1px solid #aaa;
    resize: none;
}

.btnsendchat {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.btnsendchat img {
    width: 31px;
    height: 31px;
}

.content_show_conv {
    width: 100%;
    height: 100%;
    padding: 20px;
    float: left;
}

.box-timeline {
    display: flex;
    gap: 10px;
    justify-content: center;
    padding: 10px;
}

.box-timeline {
    display: flex;
    gap: 10px;
    justify-content: center;
    padding: 10px;
    align-items: center;
}

.line_time {
    height: 1px;
    width: 100%;
    background: #000;
}

.txt_time {
    max-width: 180px;
    width: 100%;
    text-align: center;
}

.avatar_user_khach {
    width: 50px;
    height: 50px;
    filter: drop-shadow(0px 0px 6px rgba(0, 0, 0, 0.15));
    border-radius: 50%;
    float: left;
    margin: 0px;
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .5);
}

.box_chat_user_khach {
    display: flex;
    gap: 5px;
    max-width: 700px;
    width: 100%;
}

.content_conv_khach {
    max-width: calc(100% - 60px);
}

.time_comment_khach {
    display: flex;
}

.txt_comment_first {
    padding: 10px 15px;
    background: #ccccccb8;
    border-radius: 10px;
}

.txt_comment_next {
    padding: 10px 15px;
    background: #ccccccb8;
    border-radius: 10px;
}

.txt_comment_khach,
.txt_comment_me {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.box_khach_comment {
    width: 100%;
    word-wrap: break-word;
    text-align: left;
    font-size: 16px;
    font-family: 'Roboto-Regular';
}

.content-chat {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.content_conv_me {
    display: flex;
    flex-direction: column;
}

.box_chat_user_me {
    width: 100%;
    display: flex;
    justify-content: end;
    float: left;
}

.txt_commentus_first {
    padding: 10px 15px;
    background: #ccccccb8;
    border-radius: 10px 10px 0px 0px;
}

.txt_commentus_next {
    padding: 10px 15px;
    background: #ccccccb8;
    border-radius: 10px;
}

.time_comment_me {
    display: flex;
    justify-content: end;
}

.box_me_comment {
    background: #007d7d;
    color: #fff;
    text-align: left;
    border-radius: 10px;
}

.letf_chat88 {
    display: block;
    max-width: 300px;
    width: 100%;
    height: 100%;
}

.right_chat88 {
    width: calc(100% - 300px);
    height: 100%;
}

.txt_return {
    text-align: center;
    border-radius: 5px;
    color: #007d7d;
    font-size: 16px;
    font-family: 'Roboto-Medium';
    text-decoration: underline;
    line-height: 24px;
}

.box_return_conv {
    width: 120px;
    padding: 10px;
    display: flex;
    gap: 5px;
}

.container_return_conv {
    display: none;
}

.container_return_conv {
    border-top: 1px solid #007d7d;
    width: 100%;
    background: #f4f4f4;
}

.icon_xemthemdh {
    width: 20px;
    cursor: pointer;
}

.box_more_nav {}

.more_navigation {
    height: 14px;
    display: flex;
    align-items: center;
    justify-content: end;
    cursor: pointer;
}

.box_more_nav {
    display: none;
}

.frame_comment_khach:hover .box_more_nav {
    display: block;
}

.frame_comment_me .more_navigation {
    justify-content: start;
}

.frame_comment_me:hover .box_more_nav {
    display: block;
}

.show_navigation {
    position: absolute;
    top: 15px;
    right: 50%;
    max-width: 200px;
    min-height: 100px;
    width: 200px;
    padding: 10px 20px;
    background: #fff;
    box-shadow: 0 0 20px #ccc;
    border-radius: 20px;
    z-index: 5;
    display: none;
}

.frame_comment_khach .show_navigation {
    position: absolute;
    top: 15px;
    right: 0px;
    left: unset;
    max-width: 200px;
    min-height: 100px;
    width: 100%;
    padding: 10px 20px;
    background: #fff;
    box-shadow: 0 0 20px #ccc;
    border-radius: 20px;
    z-index: 5;
}

.frame_comment_me,
.frame_comment_khach {
    position: relative;
}

.txt_nav_chung {
    padding: 5px;
}

img.box_khach_comment {
    /* width: 50%; */
}

/* ================================Box tim kiem================================ */
input#ipsearch_chat {
    width: calc(100% - 50px);
    background: #007d7d;
    color: #FFF;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    padding: 5px;
}

.frameinput_timkiem {
    width: 100%;
    padding: 10px 10px;
    background: #007d7d;
    display: flex;
    border: 5px solid #f4f4f4;
    border-radius: 10px;
    gap: 10px;
    justify-content: space-between;
}

input#ipsearch_chat::placeholder {
    color: #FFF;
}

.box_type_timkiem {
    padding: 10px 15px 0px;
    border-bottom: 2px solid #aaa;
    display: flex;
    gap: 20px;
    align-items: center;
}

.select_tkiem {
    padding: 5px 0px;
}

.select_tkiem.active_typetimkiem {
    border-bottom: 2px solid #000;
}

.avatar_user_showtk {
    width: 50px;
    height: 50px;
    filter: drop-shadow(0px 0px 6px rgba(0, 0, 0, 0.15));
    border-radius: 50%;
    float: left;
    margin: 0px;
    object-fit: cover;
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .5);
}

.frame_showall,
.frame_shownormal {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
}

.showall_congty.showall {
    padding: 10px;
    height: 100%;
}

.title_showall,
.title_shownormal {
    padding: 10px;
    font-size: 20px;
    color: #333;
    font-family: 'Roboto-Medium';
    border-top: 1px solid #aaa;
}

.txt_nameshowall,
.txt_nameshownormal {
    font-size: 18px;
    font-family: 'Roboto-Medium';
    width: calc(100% - 60px);
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}

.container_showall {
    display: flex;
    gap: 5px;
    width: 100%;
    flex-direction: column;
}

.box_show_timkiem {
    width: 100%;
    height: calc(100% - 115px);
    overflow: scroll;
}

.box_show_all {
    float: left;
    width: 100%;
}

.box_show_normal {
    width: 100%;
    float: left;
}

.showall_moinguoi,
.show_normal_moinguoi {
    width: 100%;
}

.container_shownormal {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.box_text_all {
    width: calc(100% - 60px);
}

#btnsendfile img {
    width: 31px;
    height: 28px;
    cursor: pointer;
}

.box_preview_file {
    width: 100%;
    height: 100%;
    display: flex;
    gap: 5px;
    align-items: center;
    justify-content: center;
}

label.addmorefile {
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 10px;
    width: 40px;
    background: #aaa;
    border-radius: 5px;
    float: left;
}

.container_boxfile {
    width: calc(100% - 40px);
    float: left;
    display: flex;
    gap: 5px;
    height: 100%;
    flex-wrap: wrap;
    align-items: center;
}

.anhvideo_preview {
    width: 80px;
    height: 80px;
}

.boxfile_img_video {
    position: relative;
}

.icon_delete {
    position: absolute;
    z-index: 2;
    right: 0;
}

.preview_file {
    position: absolute;
    width: 100%;
    top: -175px;
    background: #f4f4f4;
    height: 174px;
}

.show_navigation,
.more_navigation {
    display: none !important;
}

.classtaicv {
    font-size: 16px;
    font-family: 'ROBOTO-BOLD';
    width: 100%;
    display: flex;
    justify-content: center;
    color: red;
}

#btnsendfile {
    margin-bottom: 0px;
}

.container_boxsentimg {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: start;
    gap: 10px;
    flex-wrap: wrap;
}

.img_sent {
    max-width: 260px;
    width: 100%;
}

.messageTypelink {
    text-decoration: underline;
    color: #007d7d;
    font-family: 'Roboto-Medium';
}

.messageTypelink:hover {
    text-decoration: underline !important;
}

.messageTypeText {
    max-width: 500px;
    word-break: break-all;
}

.boxmessageTypeSendfile {
    width: 200px;
}

.messageTypeSendfile {
    display: flex;
    flex-direction: column;
    gap: 10px;
    align-items: center;
}

.linesendfile {
    width: 100%;
    height: 2px;
    background: #FFF;
}

.box_khach_comment :is(.namefile, .filesize, .downfile) {
    font-family: 'Roboto-Medium';
    font-size: 16px;
}

.box_me_comment :is(.namefile, .filesize, .downfile) {
    font-family: 'Roboto-Medium';
    font-size: 16px;
    color: #FFF;
}

#sendchat::-webkit-scrollbar {
    background: none;
}

/* Track */
#sendchat::-webkit-scrollbar-track {
    background: none;
}

/* Handle */
#sendchat::-webkit-scrollbar-thumb {
    background: none;
}

.txt_name_khach {
    max-width: 80%;
    overflow: hidden;
    white-space: nowrap;
    padding-right: 5px;
    text-overflow: ellipsis;
}

.topmesssendfile {
    width: 100%;
}

.title_typeadscc {
    padding: 15px 0px;
    font-family: 'Roboto-Bold';
    font-size: 17px;
}

.des_typeadscc {
    font-size: 15px;
    font-family: 'Roboto-Regular';
}

.boxtypenotification {
    width: 100%;
    display: flex;
    justify-content: center;
    padding: 5px;
}

.texttypenotification {
    font-size: 15px;
    font-family: 'Roboto-Regular';
    color: #666;
}

.textOfferReceive {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    font-family: 'Roboto-Medium';
}

.viewOfferReceive {
    text-align: center;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid;
    border-radius: 10px;
    padding: 5px;
}

.title_typelink {
    font-size: 18px;
    padding: 0px 0px 10px;
    font-family: 'Roboto-Bold';
}

@media screen and(min-width:1366px) {
    .box_show_conversation {
        display: flex;
        height: calc(100% - 72px);
    }
}

@media screen and (max-width:900px) {
    .title_conversation {
        width: 100%;
        text-align: left;
        font-size: 20px;
        font-family: 'Roboto-Bold';
        color: #007d7d;
        line-height: 20px;
    }

    .frame_infor_use {
        padding: 5px 10px;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
}

@media screen and (max-width:820px) {
    .letf_chat88 {
        display: block;
        max-width: 350px;
        width: 100%;
        height: 100%;
    }

    .right_chat88 {
        width: calc(100% - 350px);
        height: 100%;
    }


}

@media screen and (min-width:768px) {
    .letf_chat88 {
        display: block !important;
    }
}

@media screen and (max-width:767px) {
    .container_return_conv {
        display: block;
    }

    .right_chat88 {
        display: none;
    }

    .letf_chat88 {
        max-width: 100%;
        width: 100%;
        display: block;
    }

    .right_chat88 {
        max-width: 100%;
        width: 100%;
    }

    .container_chat88 .right_chat88 {
        height: calc(100vh - 107px);
    }

}

@media screen and (max-width:500px) {
    .box_input_ctconversation {
        padding: 10px;
    }
}
</style>
<section id="m_chat88">
   <div class="container_chat88">
      <div class="letf_chat88" style="display: none;">
         <div class="main_left box_chat">
            <div class="main_left_chat">
               <div class="header_lchat">
                  <div class="search_chat">
                     <p type="text" class="psearch_chat cursor_pt">Nhập tên cần tìm kiếm</p>
                     <img src="/images/icon_new/search_new.svg" class="icon_searchchat88 cursor_pt" alt="tìm kiếm">
                  </div>
                  <div class="navigation_chat">
                     <div class="box_tinhan88">
                        <p class="txt_tinhan txt_tinhan_tatcatin active_chat88">Tin Nhắn</p>
                        <p class="txt_tinhan txt_tinhan_chuadoc">Chưa đọc</p>
                     </div>
                  </div>
               </div>
               <!-- ---------------------------Toàn bộ tin nhắn----------------------- -->
               <div class="content_lchat tatcatinnhan">
                  <div class="box_showchat conver_id_2311413 cursor_pt active_conv" onclick="box_showchat(this)" data-name="ĐỖ XUÂN MẠNH" senderid="10384461" conver_id="2311413">
                     <div class="data-sendchat" data-conversationid="2311413" data-isgroup="0" data-isonline="1,0" data-conversationname="ĐỖ XUÂN MẠNH" data-listmember="10087531,10384461" hidden=""></div>
                     <!--  -->
                     <img data-src="https://storage.timviec365.vn/timviec365/pictures/uv/2024/12/18/ava_1734541140_1111456608.jpg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="https://storage.timviec365.vn/timviec365/pictures/uv/2024/12/18/ava_1734541140_1111456608.jpg" class="avatar_user_chat lazyloaded" alt="anh người dùng">
                     <div class="box_inforluse">
                        <div class="title_showchat">
                           <p class="txt_ttshowchat">ĐỖ XUÂN MẠNH</p>
                           <p class="txt_timechat">T 4</p>
                        </div>
                        <p class="content_showchat">Link</p>
                     </div>
                  </div>
                  <div class="box_showchat conver_id_1848011 cursor_pt active_conv_noread" onclick="box_showchat(this)" data-name="XM Pay Company" senderid="10201534" conver_id="1848011">
                     <div class="data-sendchat" data-conversationid="1848011" data-isgroup="0" data-isonline="1" data-conversationname="XM Pay Company" data-listmember="10087531" hidden=""></div>
                     <!--  -->
                     <img data-src="https://storage.timviec365.vn/timviec365/pictures/2019/10/10/1705395580_0.jpeg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="https://storage.timviec365.vn/timviec365/pictures/2019/10/10/1705395580_0.jpeg" class="avatar_user_chat lazyloaded" alt="anh người dùng">
                     <div class="box_inforluse">
                        <div class="title_showchat">
                           <p class="txt_ttshowchat">XM Pay Company</p>
                           <p class="txt_timechat">T 7</p>
                        </div>
                        <p class="content_showchat">.</p>
                     </div>
                  </div>
                  <div class="box_showchat conver_id_1963540 cursor_pt" onclick="box_showchat(this)" data-name="CAO THỊ HIỀN" senderid="10200918" conver_id="1963540">
                     <div class="data-sendchat" data-conversationid="1963540" data-isgroup="1" data-isonline="1,0" data-conversationname="CAO THỊ HIỀN" data-listmember="10087531,10269223" hidden=""></div>
                     <!--  -->
                     <img data-src="https://ht.timviec365.vn:9002/avatar/C_1.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="https://ht.timviec365.vn:9002/avatar/C_1.png" class="avatar_user_chat lazyloaded" alt="anh người dùng">
                     <div class="box_inforluse">
                        <div class="title_showchat">
                           <p class="txt_ttshowchat">CAO THỊ HIỀN</p>
                           <p class="txt_timechat">T 4</p>
                        </div>
                        <p class="content_showchat">@HHP hỗ trợ bạn giúp em ạ</p>
                     </div>
                  </div>
                  <div class="box_showchat conver_id_1553968 cursor_pt active_conv_noread" onclick="box_showchat(this)" data-name="XM Pay Company" senderid="10026149" conver_id="1553968">
                     <div class="data-sendchat" data-conversationid="1553968" data-isgroup="0" data-isonline="1" data-conversationname="XM Pay Company" data-listmember="10087531" hidden=""></div>
                     <!--  -->
                     <img data-src="https://storage.timviec365.vn/timviec365/pictures/2019/10/10/1705395580_0.jpeg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="https://storage.timviec365.vn/timviec365/pictures/2019/10/10/1705395580_0.jpeg" class="avatar_user_chat lazyloaded" alt="anh người dùng">
                     <div class="box_inforluse">
                        <div class="title_showchat">
                           <p class="txt_ttshowchat">XM Pay Company</p>
                           <p class="txt_timechat">T 3</p>
                        </div>
                        <p class="content_showchat">ccc</p>
                     </div>
                  </div>
                  <div class="box_showchat conver_id_1824816 cursor_pt" onclick="box_showchat(this)" data-name="Cao Thị Huyền Ly - HHP (vieclam88.vn)_10024364" senderid="10024364" conver_id="1824816">
                     <div class="data-sendchat" data-conversationid="1824816" data-isgroup="1" data-isonline="0,1" data-conversationname="Cao Thị Huyền Ly - HHP (vieclam88.vn)_10024364" data-listmember="10024364,10087531" hidden=""></div>
                     <!--  -->
                     <img data-src="https://ht.timviec365.vn:9002/avatar/C_4.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="https://ht.timviec365.vn:9002/avatar/C_4.png" class="avatar_user_chat lazyloaded" alt="anh người dùng">
                     <div class="box_inforluse">
                        <div class="title_showchat">
                           <p class="txt_ttshowchat">Cao Thị Huyền Ly - HHP (vieclam88.vn)_10024364</p>
                           <p class="txt_timechat">T 5</p>
                        </div>
                        <p class="content_showchat">.</p>
                     </div>
                  </div>
                  <div class="box_showchat conver_id_1754210 cursor_pt" onclick="box_showchat(this)" data-name="XM Pay Company" senderid="10083552" conver_id="1754210">
                     <div class="data-sendchat" data-conversationid="1754210" data-isgroup="0" data-isonline="1" data-conversationname="XM Pay Company" data-listmember="10087531" hidden=""></div>
                     <!--  -->
                     <img data-src="https://storage.timviec365.vn/timviec365/pictures/2019/10/10/1705395580_0.jpeg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="https://storage.timviec365.vn/timviec365/pictures/2019/10/10/1705395580_0.jpeg" class="avatar_user_chat lazyloaded" alt="anh người dùng">
                     <div class="box_inforluse">
                        <div class="title_showchat">
                           <p class="txt_ttshowchat">XM Pay Company</p>
                           <p class="txt_timechat">T 3</p>
                        </div>
                        <p class="content_showchat">hú</p>
                     </div>
                  </div>
                  <div class="box_showchat conver_id_1689215 cursor_pt" onclick="box_showchat(this)" data-name="XM Pay Company" senderid="10087531" conver_id="1689215">
                     <div class="data-sendchat" data-conversationid="1689215" data-isgroup="0" data-isonline="1" data-conversationname="XM Pay Company" data-listmember="10087531" hidden=""></div>
                     <!--  -->
                     <img data-src="https://storage.timviec365.vn/timviec365/pictures/2019/10/10/1705395580_0.jpeg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="https://storage.timviec365.vn/timviec365/pictures/2019/10/10/1705395580_0.jpeg" class="avatar_user_chat lazyloaded" alt="anh người dùng">
                     <div class="box_inforluse">
                        <div class="title_showchat">
                           <p class="txt_ttshowchat">XM Pay Company</p>
                           <p class="txt_timechat">T 3</p>
                        </div>
                        <p class="content_showchat">fe008700f25cb28940ca8ed91b23b354</p>
                     </div>
                  </div>
                  <div class="box_showchat conver_id_1582328 cursor_pt" onclick="box_showchat(this)" data-name="Hoàng Thùy Linh" senderid="10087531" conver_id="1582328">
                     <div class="data-sendchat" data-conversationid="1582328" data-isgroup="0" data-isonline="0,1" data-conversationname="Hoàng Thùy Linh" data-listmember="10022406,10087531" hidden=""></div>
                     <!--  -->
                     <img data-src="http://210.245.108.202:9002/avatar/H_4.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" class="avatar_user_chat lazyloaded" alt="anh người dùng">
                     <div class="box_inforluse">
                        <div class="title_showchat">
                           <p class="txt_ttshowchat">Hoàng Thùy Linh</p>
                           <p class="txt_timechat">T 7</p>
                        </div>
                        <p class="content_showchat">0869819306</p>
                     </div>
                  </div>
                  <div class="box_showchat conver_id_1581719 cursor_pt" onclick="box_showchat(this)" data-name="NGUYỄN NGỌC THANH THANH" senderid="10022641" conver_id="1581719">
                     <div class="data-sendchat" data-conversationid="1581719" data-isgroup="0" data-isonline="0,1" data-conversationname="NGUYỄN NGỌC THANH THANH" data-listmember="10022641,10087531" hidden=""></div>
                     <!--  -->
                     <img data-src="http://210.245.108.202:9002/avatar/N_4.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" class="avatar_user_chat lazyloaded" alt="anh người dùng">
                     <div class="box_inforluse">
                        <div class="title_showchat">
                           <p class="txt_ttshowchat">NGUYỄN NGỌC THANH THANH</p>
                           <p class="txt_timechat">T 5</p>
                        </div>
                        <p class="content_showchat">11111</p>
                     </div>
                  </div>
                  <div class="box_showchat conver_id_1712244 cursor_pt" onclick="box_showchat(this)" data-name="Nguyễn Thị Bình (Cũ)" senderid="10027506" conver_id="1712244">
                     <div class="data-sendchat" data-conversationid="1712244" data-isgroup="0" data-isonline="0,1" data-conversationname="Nguyễn Thị Bình (Cũ)" data-listmember="10027506,10087531" hidden=""></div>
                     <!--  -->
                     <img data-src="http://210.245.108.202:9002/avatar/N_2.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" class="avatar_user_chat lazyloaded" alt="anh người dùng">
                     <div class="box_inforluse">
                        <div class="title_showchat">
                           <p class="txt_ttshowchat">Nguyễn Thị Bình (Cũ)</p>
                           <p class="txt_timechat">T 5</p>
                        </div>
                        <p class="content_showchat">dcs</p>
                     </div>
                  </div>
                  <div class="box_showchat conver_id_1602543 cursor_pt" onclick="box_showchat(this)" data-name="Cao Sơn Bách" senderid="10059951" conver_id="1602543">
                     <div class="data-sendchat" data-conversationid="1602543" data-isgroup="0" data-isonline="0,1" data-conversationname="Cao Sơn Bách" data-listmember="10059951,10087531" hidden=""></div>
                     <!--  -->
                     <img data-src="https://storage.timviec365.vn/timviec365/pictures/uv/2023/11/27/ava_1701048715_1111164852.jpg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" class="avatar_user_chat lazyloaded" alt="anh người dùng">
                     <div class="box_inforluse">
                        <div class="title_showchat">
                           <p class="txt_ttshowchat">Cao Sơn Bách</p>
                           <p class="txt_timechat">T 2</p>
                        </div>
                        <p class="content_showchat">tôi muốn ứng tuyển</p>
                     </div>
                  </div>
                  <div class="box_showchat conver_id_1583539 cursor_pt" onclick="box_showchat(this)" data-name="test" senderid="10026149" conver_id="1583539">
                     <div class="data-sendchat" data-conversationid="1583539" data-isgroup="1" data-isonline="1" data-conversationname="test" data-listmember="10087531" hidden=""></div>
                     <!--  -->
                     <img data-src="https://ht.timviec365.vn:9002/avatar/T_2.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="https://ht.timviec365.vn:9002/avatar/T_2.png" class="avatar_user_chat lazyloaded" alt="anh người dùng">
                     <div class="box_inforluse">
                        <div class="title_showchat">
                           <p class="txt_ttshowchat">test</p>
                           <p class="txt_timechat">T 4</p>
                        </div>
                        <p class="content_showchat">c</p>
                     </div>
                  </div>
                  <div class="box_showchat conver_id_1583871 cursor_pt" onclick="box_showchat(this)" data-name="TRẦN VĂN " senderid="10103270" conver_id="1583871">
                     <div class="data-sendchat" data-conversationid="1583871" data-isgroup="0" data-isonline="1,0" data-conversationname="TRẦN VĂN " data-listmember="10087531,10103270" hidden=""></div>
                     <!--  -->
                     <img data-src="https://storage.timviec365.vn/timviec365/pictures/uv/2023/11/10/ava_1699610711_1111195608.jpg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="https://storage.timviec365.vn/timviec365/pictures/uv/2023/11/10/ava_1699610711_1111195608.jpg" class="avatar_user_chat lazyloaded" alt="anh người dùng">
                     <div class="box_inforluse">
                        <div class="title_showchat">
                           <p class="txt_ttshowchat">TRẦN VĂN </p>
                           <p class="txt_timechat">T 7</p>
                        </div>
                        <p class="content_showchat">nhận được không b ơi</p>
                     </div>
                  </div>
                  <div class="box_showchat conver_id_1581715 cursor_pt" onclick="box_showchat(this)" data-name="Nguyễn Thị Bình" senderid="10087531" conver_id="1581715">
                     <div class="data-sendchat" data-conversationid="1581715" data-isgroup="0" data-isonline="0,1" data-conversationname="Nguyễn Thị Bình" data-listmember="10085745,10087531" hidden=""></div>
                     <!--  -->
                     <img data-src="https://storage.timviec365.vn/timviec365/pictures/uv/2023/12/15/ava_1702636755_1111180117.jpg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="https://storage.timviec365.vn/timviec365/pictures/uv/2023/12/15/ava_1702636755_1111180117.jpg" class="avatar_user_chat lazyloaded" alt="anh người dùng">
                     <div class="box_inforluse">
                        <div class="title_showchat">
                           <p class="txt_ttshowchat">Nguyễn Thị Bình</p>
                           <p class="txt_timechat">T 6</p>
                        </div>
                        <p class="content_showchat">đ.c nhận được k</p>
                     </div>
                  </div>
               </div>
               <!-- ---------------------------Box tin nhắn chưa đọc----------------------- -->
               <div class="content_lchat tinnhanchuadoc d_none">
                  <div class="box_showchat conver_id_1848011 cursor_pt active_conv_noread" onclick="box_showchat(this)" data-name="XM Pay Company" senderid="10201534" conver_id="1848011">
                     <div class="data-sendchat" data-conversationid="1848011" data-isgroup="0" data-isonline="1" data-conversationname="XM Pay Company" data-listmember="10087531" hidden=""></div>
                     <!--  -->
                     <img data-src="https://storage.timviec365.vn/timviec365/pictures/2019/10/10/1705395580_0.jpeg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" class="lazyload avatar_user_chat" alt="anh người dùng">
                     <div class="box_inforluse">
                        <div class="title_showchat">
                           <p class="txt_ttshowchat">XM Pay Company</p>
                           <p class="txt_timechat">T 7</p>
                        </div>
                        <p class="content_showchat">.</p>
                     </div>
                  </div>
                  <div class="box_showchat conver_id_1553968 cursor_pt active_conv_noread" onclick="box_showchat(this)" data-name="XM Pay Company" senderid="10026149" conver_id="1553968">
                     <div class="data-sendchat" data-conversationid="1553968" data-isgroup="0" data-isonline="1" data-conversationname="XM Pay Company" data-listmember="10087531" hidden=""></div>
                     <!--  -->
                     <img data-src="https://storage.timviec365.vn/timviec365/pictures/2019/10/10/1705395580_0.jpeg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" class="lazyload avatar_user_chat" alt="anh người dùng">
                     <div class="box_inforluse">
                        <div class="title_showchat">
                           <p class="txt_ttshowchat">XM Pay Company</p>
                           <p class="txt_timechat">T 3</p>
                        </div>
                        <p class="content_showchat">ccc</p>
                     </div>
                  </div>
               </div>
               <!-- ----------------------------------End------------------------------------- -->
            </div>
         </div>
         <!-- ====================================================Luồng tìm kiếm============================================================= -->
         <div class="main_left box_timkiem d_none">
            <div class="box_input_timkiem">
               <div class="frameinput_timkiem">
                  <input type="text" name="timkiemchat" id="ipsearch_chat" autocomplete="off" placeholder="Nhập tên, số điện thoại, email tìm kiếm" value="Nhập tên, số điện thoại, email tìm kiếm">
                  <img src="../images/icon_new/icon_close.png" class="thoattimkiemchat cursor_pt" alt="thoát tìm kiếm">
               </div>
               <div class="box_type_timkiem">
                  <p class="select_tkiem_all select_tkiem active_typetimkiem cursor_pt" data-type="all">Tất cả</p>
                  <p class="select_tkiem_user select_tkiem cursor_pt" data-type="normal">Mọi người</p>
               </div>
            </div>
            <div class="box_show_timkiem">
               <!-- ==========================Type là all============================ -->
               <div class="box_show_all">
                  <!-- ==========================Dữ liệu của nhóm=========================== -->
                  <div class="showall_nhom showall">
                     <p class="title_showall">Nhóm</p>
                     <div class="container_showall">
                        <div class="frame_showall frame_show_group frame_showall_1963540 cursor_pt" data-name="CAO THỊ HIỀN" senderid="10200918" conver_id="1963540">
                           <div class="data-sendchat" data-conversationid="1963540" data-conversationname="CAO THỊ HIỀN" hidden=""></div>
                           <img src="/images/icon_new/img_error.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                           <div class="box_text_all">
                              <p class="txt_nameshowall">CAO THỊ HIỀN</p>
                              <p class="txt_textshowall">3 người</p>
                           </div>
                        </div>
                        <div class="frame_showall frame_show_group frame_showall_1824816 cursor_pt" data-name="Cao Thị Huyền Ly - HHP (vieclam88.vn)_10024364" senderid="10024364" conver_id="1824816">
                           <div class="data-sendchat" data-conversationid="1824816" data-conversationname="Cao Thị Huyền Ly - HHP (vieclam88.vn)_10024364" hidden=""></div>
                           <img src="/images/icon_new/img_error.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                           <div class="box_text_all">
                              <p class="txt_nameshowall">Cao Thị Huyền Ly - HHP (vieclam88.vn)_10024364</p>
                              <p class="txt_textshowall">2 người</p>
                           </div>
                        </div>
                        <div class="frame_showall frame_show_group frame_showall_1583539 cursor_pt" data-name="test" senderid="10026149" conver_id="1583539">
                           <div class="data-sendchat" data-conversationid="1583539" data-conversationname="test" hidden=""></div>
                           <img src="/images/icon_new/img_error.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                           <div class="box_text_all">
                              <p class="txt_nameshowall">test</p>
                              <p class="txt_textshowall">2 người</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="showall_moinguoi showall">
                     <p class="title_showall">Mọi người</p>
                     <div class="container_showall">
                        <!-- ==========================Dữ liệu của người=========================== -->
                        <div class="frame_showall frame_show_people frame_showall_2311413 cursor_pt" data-name="ĐỖ XUÂN MẠNH" senderid="10087531" conver_id="2311413">
                           <div class="data-sendchat" data-conversationid="2311413" data-conversationname="ĐỖ XUÂN MẠNH" hidden=""></div>
                           <img data-src="http://210.245.108.202:9002/avatarUserSmall/10384461/ava_1734541140_1111456608.jpg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                           <p class="txt_nameshowall">ĐỖ XUÂN MẠNH</p>
                        </div>
                        <div class="frame_showall frame_show_people frame_showall_1582328 cursor_pt" data-name="Hoàng Thùy Linh" senderid="10087531" conver_id="1582328">
                           <div class="data-sendchat" data-conversationid="1582328" data-conversationname="Hoàng Thùy Linh" hidden=""></div>
                           <img data-src="http://210.245.108.202:9002/avatar/H_2.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                           <p class="txt_nameshowall">Hoàng Thùy Linh</p>
                        </div>
                        <div class="frame_showall frame_show_people frame_showall_1581719 cursor_pt" data-name="NGUYỄN NGỌC THANH THANH" senderid="10087531" conver_id="1581719">
                           <div class="data-sendchat" data-conversationid="1581719" data-conversationname="NGUYỄN NGỌC THANH THANH" hidden=""></div>
                           <img data-src="http://210.245.108.202:9002/avatar/N_3.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                           <p class="txt_nameshowall">NGUYỄN NGỌC THANH THANH</p>
                        </div>
                        <div class="frame_showall frame_show_people frame_showall_1712244 cursor_pt" data-name="Nguyễn Thị Bình (Cũ)" senderid="10087531" conver_id="1712244">
                           <div class="data-sendchat" data-conversationid="1712244" data-conversationname="Nguyễn Thị Bình (Cũ)" hidden=""></div>
                           <img data-src="http://210.245.108.202:9002/avatar/N_4.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                           <p class="txt_nameshowall">Nguyễn Thị Bình (Cũ)</p>
                        </div>
                        <div class="frame_showall frame_show_people frame_showall_1602543 cursor_pt" data-name="Cao Sơn Bách" senderid="10087531" conver_id="1602543">
                           <div class="data-sendchat" data-conversationid="1602543" data-conversationname="Cao Sơn Bách" hidden=""></div>
                           <img data-src="http://210.245.108.202:9002/avatarUserSmall/10059951/ava_1701048715_1111164852.jpg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                           <p class="txt_nameshowall">Cao Sơn Bách</p>
                        </div>
                        <div class="frame_showall frame_show_people frame_showall_1583871 cursor_pt" data-name="TRẦN VĂN " senderid="10087531" conver_id="1583871">
                           <div class="data-sendchat" data-conversationid="1583871" data-conversationname="TRẦN VĂN " hidden=""></div>
                           <img data-src="http://210.245.108.202:9002/avatarUserSmall/10103270/ava_1699610711_1111195608.jpg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                           <p class="txt_nameshowall">TRẦN VĂN </p>
                        </div>
                        <div class="frame_showall frame_show_people frame_showall_1581715 cursor_pt" data-name="Nguyễn Thị Bình" senderid="10087531" conver_id="1581715">
                           <div class="data-sendchat" data-conversationid="1581715" data-conversationname="Nguyễn Thị Bình" hidden=""></div>
                           <img data-src="http://210.245.108.202:9002/avatarUserSmall/10085745/ava_1702636755_1111180117.jpg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                           <p class="txt_nameshowall">Nguyễn Thị Bình</p>
                        </div>
                        <div class="frame_showall frame_show_people frame_showall_2417706 cursor_pt" data-name="VÕ THỊ THANH XUÂN" senderid="10087531" conver_id="2417706">
                           <div class="data-sendchat" data-conversationid="2417706" data-conversationname="VÕ THỊ THANH XUÂN" hidden=""></div>
                           <img data-src="http://210.245.108.202:9002/avatarUserSmall/1143527/ava_1754041269_782666.jpg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                           <p class="txt_nameshowall">VÕ THỊ THANH XUÂN</p>
                        </div>
                        <div class="frame_showall frame_show_people frame_showall_2417707 cursor_pt" data-name="NGUYỄN NGỌC HOÀNG LAN" senderid="10087531" conver_id="2417707">
                           <div class="data-sendchat" data-conversationid="2417707" data-conversationname="NGUYỄN NGỌC HOÀNG LAN" hidden=""></div>
                           <img data-src="http://210.245.108.202:9002/avatar/N_3.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                           <p class="txt_nameshowall">NGUYỄN NGỌC HOÀNG LAN</p>
                        </div>
                        <div class="frame_showall frame_show_people frame_showall_2417708 cursor_pt" data-name="TRẦN VĂN THỊNH" senderid="10087531" conver_id="2417708">
                           <div class="data-sendchat" data-conversationid="2417708" data-conversationname="TRẦN VĂN THỊNH" hidden=""></div>
                           <img data-src="http://210.245.108.202:9002/avatarUserSmall/10506716/ava_1736472111_1111573423.jpg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                           <p class="txt_nameshowall">TRẦN VĂN THỊNH</p>
                        </div>
                        <div class="frame_showall frame_show_people frame_showall_2417709 cursor_pt" data-name="Bartender-BARISTA" senderid="10087531" conver_id="2417709">
                           <div class="data-sendchat" data-conversationid="2417709" data-conversationname="Bartender-BARISTA" hidden=""></div>
                           <img data-src="http://210.245.108.202:9002/avatarUserSmall/10570250/tmp_cv_57168301-1a17-4c8a-8c43-146e0773ee66_1742103659.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                           <p class="txt_nameshowall">Bartender-BARISTA</p>
                        </div>
                        <div class="frame_showall frame_show_people frame_showall_2417710 cursor_pt" data-name="Ông Lâm Quốc Khiêm" senderid="10087531" conver_id="2417710">
                           <div class="data-sendchat" data-conversationid="2417710" data-conversationname="Ông Lâm Quốc Khiêm" hidden=""></div>
                           <img data-src="http://210.245.108.202:9002/avatar/Ô_2.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                           <p class="txt_nameshowall">Ông Lâm Quốc Khiêm</p>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- ==========================Type là nomal============================ -->
               <div class="box_show_normal d_none">
                  <div class="frame_show_nomal">
                     <div class="show_normal_moinguoi show_normal">
                        <p class="title_shownormal">Mọi người</p>
                        <div class="container_shownormal">
                           <div class="frame_shownormal frame_show_people frame_shownormal_2417706 cursor_pt" data-name="VÕ THỊ THANH XUÂN" senderid="10087531" conver_id="2417706">
                              <div class="data-sendchat" data-conversationid="2417706" data-conversationname="VÕ THỊ THANH XUÂN" hidden=""></div>
                              <img data-src="http://210.245.108.202:9002/avatarUserSmall/1143527/ava_1754041269_782666.jpg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                              <p class="txt_nameshownormal">VÕ THỊ THANH XUÂN</p>
                           </div>
                           <div class="frame_shownormal frame_show_people frame_shownormal_1582328 cursor_pt" data-name="Hoàng Thùy Linh" senderid="10087531" conver_id="1582328">
                              <div class="data-sendchat" data-conversationid="1582328" data-conversationname="Hoàng Thùy Linh" hidden=""></div>
                              <img data-src="http://210.245.108.202:9002/avatar/H_3.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                              <p class="txt_nameshownormal">Hoàng Thùy Linh</p>
                           </div>
                           <div class="frame_shownormal frame_show_people frame_shownormal_1581719 cursor_pt" data-name="NGUYỄN NGỌC THANH THANH" senderid="10087531" conver_id="1581719">
                              <div class="data-sendchat" data-conversationid="1581719" data-conversationname="NGUYỄN NGỌC THANH THANH" hidden=""></div>
                              <img data-src="http://210.245.108.202:9002/avatar/N_1.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                              <p class="txt_nameshownormal">NGUYỄN NGỌC THANH THANH</p>
                           </div>
                           <div class="frame_shownormal frame_show_people frame_shownormal_1712244 cursor_pt" data-name="Nguyễn Thị Bình (Cũ)" senderid="10087531" conver_id="1712244">
                              <div class="data-sendchat" data-conversationid="1712244" data-conversationname="Nguyễn Thị Bình (Cũ)" hidden=""></div>
                              <img data-src="http://210.245.108.202:9002/avatar/N_1.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                              <p class="txt_nameshownormal">Nguyễn Thị Bình (Cũ)</p>
                           </div>
                           <div class="frame_shownormal frame_show_people frame_shownormal_1602543 cursor_pt" data-name="Cao Sơn Bách" senderid="10087531" conver_id="1602543">
                              <div class="data-sendchat" data-conversationid="1602543" data-conversationname="Cao Sơn Bách" hidden=""></div>
                              <img data-src="http://210.245.108.202:9002/avatarUserSmall/10059951/ava_1701048715_1111164852.jpg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                              <p class="txt_nameshownormal">Cao Sơn Bách</p>
                           </div>
                           <div class="frame_shownormal frame_show_people frame_shownormal_1581715 cursor_pt" data-name="Nguyễn Thị Bình" senderid="10087531" conver_id="1581715">
                              <div class="data-sendchat" data-conversationid="1581715" data-conversationname="Nguyễn Thị Bình" hidden=""></div>
                              <img data-src="http://210.245.108.202:9002/avatarUserSmall/10085745/ava_1702636755_1111180117.jpg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                              <p class="txt_nameshownormal">Nguyễn Thị Bình</p>
                           </div>
                           <div class="frame_shownormal frame_show_people frame_shownormal_1583871 cursor_pt" data-name="TRẦN VĂN " senderid="10087531" conver_id="1583871">
                              <div class="data-sendchat" data-conversationid="1583871" data-conversationname="TRẦN VĂN " hidden=""></div>
                              <img data-src="http://210.245.108.202:9002/avatarUserSmall/10103270/ava_1699610711_1111195608.jpg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                              <p class="txt_nameshownormal">TRẦN VĂN </p>
                           </div>
                           <div class="frame_shownormal frame_show_people frame_shownormal_2311413 cursor_pt" data-name="ĐỖ XUÂN MẠNH" senderid="10087531" conver_id="2311413">
                              <div class="data-sendchat" data-conversationid="2311413" data-conversationname="ĐỖ XUÂN MẠNH" hidden=""></div>
                              <img data-src="http://210.245.108.202:9002/avatarUserSmall/10384461/ava_1734541140_1111456608.jpg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                              <p class="txt_nameshownormal">ĐỖ XUÂN MẠNH</p>
                           </div>
                           <div class="frame_shownormal frame_show_people frame_shownormal_2417707 cursor_pt" data-name="NGUYỄN NGỌC HOÀNG LAN" senderid="10087531" conver_id="2417707">
                              <div class="data-sendchat" data-conversationid="2417707" data-conversationname="NGUYỄN NGỌC HOÀNG LAN" hidden=""></div>
                              <img data-src="http://210.245.108.202:9002/avatar/N_3.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                              <p class="txt_nameshownormal">NGUYỄN NGỌC HOÀNG LAN</p>
                           </div>
                           <div class="frame_shownormal frame_show_people frame_shownormal_2417708 cursor_pt" data-name="TRẦN VĂN THỊNH" senderid="10087531" conver_id="2417708">
                              <div class="data-sendchat" data-conversationid="2417708" data-conversationname="TRẦN VĂN THỊNH" hidden=""></div>
                              <img data-src="http://210.245.108.202:9002/avatarUserSmall/10506716/ava_1736472111_1111573423.jpg" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                              <p class="txt_nameshownormal">TRẦN VĂN THỊNH</p>
                           </div>
                           <div class="frame_shownormal frame_show_people frame_shownormal_2417709 cursor_pt" data-name="Bartender-BARISTA" senderid="10087531" conver_id="2417709">
                              <div class="data-sendchat" data-conversationid="2417709" data-conversationname="Bartender-BARISTA" hidden=""></div>
                              <img data-src="http://210.245.108.202:9002/avatarUserSmall/10570250/tmp_cv_57168301-1a17-4c8a-8c43-146e0773ee66_1742103659.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                              <p class="txt_nameshownormal">Bartender-BARISTA</p>
                           </div>
                           <div class="frame_shownormal frame_show_people frame_shownormal_2417710 cursor_pt" data-name="Ông Lâm Quốc Khiêm" senderid="10087531" conver_id="2417710">
                              <div class="data-sendchat" data-conversationid="2417710" data-conversationname="Ông Lâm Quốc Khiêm" hidden=""></div>
                              <img data-src="http://210.245.108.202:9002/avatar/Ô_2.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                              <p class="txt_nameshownormal">Ông Lâm Quốc Khiêm</p>
                           </div>
                           <div class="frame_shownormal frame_show_people frame_shownormal_2417711 cursor_pt" data-name="Nguyễn Quang Thắng" senderid="10087531" conver_id="2417711">
                              <div class="data-sendchat" data-conversationid="2417711" data-conversationname="Nguyễn Quang Thắng" hidden=""></div>
                              <img data-src="http://210.245.108.202:9002/avatar/N_3.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                              <p class="txt_nameshownormal">Nguyễn Quang Thắng</p>
                           </div>
                           <div class="frame_shownormal frame_show_people frame_shownormal_2417712 cursor_pt" data-name="Nguyễn Thảo Huyền" senderid="10087531" conver_id="2417712">
                              <div class="data-sendchat" data-conversationid="2417712" data-conversationname="Nguyễn Thảo Huyền" hidden=""></div>
                              <img data-src="http://210.245.108.202:9002/avatar/N_2.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                              <p class="txt_nameshownormal">Nguyễn Thảo Huyền</p>
                           </div>
                           <div class="frame_shownormal frame_show_people frame_shownormal_2417713 cursor_pt" data-name="CTY TNHH SX TM DV N.T.V" senderid="10087531" conver_id="2417713">
                              <div class="data-sendchat" data-conversationid="2417713" data-conversationname="CTY TNHH SX TM DV N.T.V" hidden=""></div>
                              <img data-src="http://210.245.108.202:9002/avatar/C_1.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                              <p class="txt_nameshownormal">CTY TNHH SX TM DV N.T.V</p>
                           </div>
                           <div class="frame_shownormal frame_show_people frame_shownormal_2417714 cursor_pt" data-name="Trần Thị Diệu Linh" senderid="10087531" conver_id="2417714">
                              <div class="data-sendchat" data-conversationid="2417714" data-conversationname="Trần Thị Diệu Linh" hidden=""></div>
                              <img data-src="http://210.245.108.202:9002/avatarUserSmall/10570248/tmp_cv_8b0532d1-7824-476c-8ce9-1d3862a9931d_1742105868.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                              <p class="txt_nameshownormal">Trần Thị Diệu Linh</p>
                           </div>
                           <div class="frame_shownormal frame_show_people frame_shownormal_2417715 cursor_pt" data-name="Võ Trần Quế Anh" senderid="10087531" conver_id="2417715">
                              <div class="data-sendchat" data-conversationid="2417715" data-conversationname="Võ Trần Quế Anh" hidden=""></div>
                              <img data-src="http://210.245.108.202:9002/avatarUserSmall/10570249/tmp_cv_7183eb96-17b7-4fe1-8e58-c1b67ef2019b_1742102316.png" onerror="this.onerror=null;this.src=&quot;/images/icon_new/img_error.png&quot;;" src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="lazyload avatar_user_showtk">
                              <p class="txt_nameshownormal">Võ Trần Quế Anh</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- =============================================================Box hiển thị cuộc trò chuyện====================================================================== -->
      <div class="right_chat88">
         <div class="container_return_conv">
            <div class="box_return_conv">
               <img src="/images/imagedknew/quaylai.png" alt="quay lại" class="icreturn_page">
               <p class="txt_return">Quay lại</p>
            </div>
         </div>
         <div class="main_right_chat">
            <div class="container_conversation d_none" data-conversationx="2311413" style="display: block;">
               <div class="header_conversation">
                  <img src="https://storage.timviec365.vn/timviec365/pictures/uv/2024/12/18/ava_1734541140_1111456608.jpg" alt="Ảnh người dùng" class="avatar_user_right">
                  <div class="frame_infor_use">
                     <p class="title_conversation">ĐỖ XUÂN MẠNH</p>
                     <div class="informore_hd">
                        <p class="txt_more">Người lạ</p>
                     </div>
                  </div>
               </div>
               <div class="content_conversation">
                  <div class="box_show_conversation" data-total-messages="10">
                     <div class="content_show_conv">
                        <div class="box-timeline">
                           <p class="line_time"></p>
                           <div class="txt_time">Lúc 15:40:03, 16-03-2025</div>
                           <p class="line_time"></p>
                        </div>
                        <div class="content-chat">
                           <div class="box_chat_user box_chat_user_khach">
                              <div class="box_img_khach">
                                 <img src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="avatar_user_khach">
                              </div>
                              <div class="content_conv_khach">
                                 <div class="time_comment_khach">
                                    <p class="txt_name_khach">ĐỖ XUÂN MẠNH, </p>
                                    <p class="txt_time_khach">9:16:02</p>
                                 </div>
                                 <div class="txt_comment_khach">
                                    <div class="frame_comment_khach frame_comment">
                                       <div class="more_navigation">
                                          <div class="box_more_nav"><img src="/images/icon_new/more_nav_new.svg" class="icon_xemthemdh" alt="thêm điều hướng"></div>
                                       </div>
                                       <div class="show_navigation">
                                          <p class="txt_nav_rep txt_nav_chung cursor_pt">Trả lời</p>
                                          <p class="txt_nav_coppy txt_nav_chung cursor_pt">Sao chép</p>
                                       </div>
                                       <p class="box_khach_comment messageTypeText txt_comment_first"><br>Xin chào NTD, Tôi là Đậu Xuân Mạnh tôi vừa ứng tuyển việc làm Nhân viên kinh doanh nước hoa của bạn với ID tin tuyển dụng: 179392.</p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="box_chat_user box_chat_user_khach">
                              <div class="box_img_khach">
                                 <img src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="avatar_user_khach">
                              </div>
                              <div class="content_conv_khach">
                                 <div class="time_comment_khach">
                                    <p class="txt_name_khach">ĐỖ XUÂN MẠNH, </p>
                                    <p class="txt_time_khach">9:16:02</p>
                                 </div>
                                 <div class="txt_comment_khach">
                                    <div class="frame_comment_khach frame_comment">
                                       <div class="more_navigation">
                                          <div class="box_more_nav"><img src="/images/icon_new/more_nav_new.svg" class="icon_xemthemdh" alt="thêm điều hướng"></div>
                                       </div>
                                       <div class="show_navigation">
                                          <p class="txt_nav_rep txt_nav_chung cursor_pt">Trả lời</p>
                                          <p class="txt_nav_coppy txt_nav_chung cursor_pt">Sao chép</p>
                                       </div>
                                       <div class="messageTypeText box_khach_comment txt_comment_first">
                                          <p class="title_typelink">Nhân viên kinh doanh nước hoa tại Xm Pay Company</p>
                                          <img width="100%" src="https://topcvai.com/images/bg_fb_2.jpg">
                                          <p class="">Cập nhật chi tiết bản tin tuyển dụng Nhân viên kinh doanh nước hoa tại Xm Pay Company. Thông tin mô tả việc làm Nhân viên kinh doanh nước hoa rõ ràng giúp ứng viên dễ dàng đưa ra quyết định ứng tuyển hiệu quả, nắm bắt cơ hội nghề nghiệp hấp dẫn nhất.</p>
                                          <a class="messageTypelink" target="_blank" rel="nofollow" href="https://topcvai.com/nhan-vien-kinh-doanh-nuoc-hoa-job179392">https://topcvai.com/nhan-vien-kinh-doanh-nuoc-hoa-job179392</a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="box_chat_user box_chat_user_khach">
                              <div class="box_img_khach">
                                 <img src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="avatar_user_khach">
                              </div>
                              <div class="content_conv_khach">
                                 <div class="time_comment_khach">
                                    <p class="txt_name_khach">ĐỖ XUÂN MẠNH, </p>
                                    <p class="txt_time_khach">9:16:02</p>
                                 </div>
                                 <div class="txt_comment_khach">
                                    <div class="frame_comment_khach frame_comment">
                                       <div class="more_navigation">
                                          <div class="box_more_nav"><img src="/images/icon_new/more_nav_new.svg" class="icon_xemthemdh" alt="thêm điều hướng"></div>
                                       </div>
                                       <div class="show_navigation">
                                          <p class="txt_nav_rep txt_nav_chung cursor_pt">Trả lời</p>
                                          <p class="txt_nav_coppy txt_nav_chung cursor_pt">Sao chép</p>
                                       </div>
                                       <p class="box_khach_comment messageTypeText txt_comment_first"><br>Xin chào NTD, Tôi là Đậu Xuân Mạnh tôi vừa ứng tuyển việc làm Nhân viên kinh doanh nước hoa của bạn với ID tin tuyển dụng: 179392.</p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="box_chat_user box_chat_user_khach">
                              <div class="box_img_khach">
                                 <img src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="avatar_user_khach">
                              </div>
                              <div class="content_conv_khach">
                                 <div class="time_comment_khach">
                                    <p class="txt_name_khach">ĐỖ XUÂN MẠNH, </p>
                                    <p class="txt_time_khach">9:16:02</p>
                                 </div>
                                 <div class="txt_comment_khach">
                                    <div class="frame_comment_khach frame_comment">
                                       <div class="more_navigation">
                                          <div class="box_more_nav"><img src="/images/icon_new/more_nav_new.svg" class="icon_xemthemdh" alt="thêm điều hướng"></div>
                                       </div>
                                       <div class="show_navigation">
                                          <p class="txt_nav_rep txt_nav_chung cursor_pt">Trả lời</p>
                                          <p class="txt_nav_coppy txt_nav_chung cursor_pt">Sao chép</p>
                                       </div>
                                       <div class="messageTypeText box_khach_comment txt_comment_first">
                                          <p class="title_typelink">Nhân viên kinh doanh nước hoa tại Xm Pay Company</p>
                                          <img width="100%" src="https://topcvai.com/images/bg_fb_2.jpg">
                                          <p class="">Cập nhật chi tiết bản tin tuyển dụng Nhân viên kinh doanh nước hoa tại Xm Pay Company. Thông tin mô tả việc làm Nhân viên kinh doanh nước hoa rõ ràng giúp ứng viên dễ dàng đưa ra quyết định ứng tuyển hiệu quả, nắm bắt cơ hội nghề nghiệp hấp dẫn nhất.</p>
                                          <a class="messageTypelink" target="_blank" rel="nofollow" href="https://topcvai.com/nhan-vien-kinh-doanh-nuoc-hoa-job179392">https://topcvai.com/nhan-vien-kinh-doanh-nuoc-hoa-job179392</a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="box_chat_user box_chat_user_khach">
                              <div class="box_img_khach">
                                 <img src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="avatar_user_khach">
                              </div>
                              <div class="content_conv_khach">
                                 <div class="time_comment_khach">
                                    <p class="txt_name_khach">ĐỖ XUÂN MẠNH, </p>
                                    <p class="txt_time_khach">9:17:02</p>
                                 </div>
                                 <div class="txt_comment_khach">
                                    <div class="frame_comment_khach frame_comment">
                                       <div class="more_navigation">
                                          <div class="box_more_nav"><img src="/images/icon_new/more_nav_new.svg" class="icon_xemthemdh" alt="thêm điều hướng"></div>
                                       </div>
                                       <div class="show_navigation">
                                          <p class="txt_nav_rep txt_nav_chung cursor_pt">Trả lời</p>
                                          <p class="txt_nav_coppy txt_nav_chung cursor_pt">Sao chép</p>
                                       </div>
                                       <p class="box_khach_comment messageTypeText txt_comment_first"><br>Xin chào NTD, Tôi là Đậu Xuân Mạnh tôi vừa ứng tuyển việc làm Nhân viên kinh doanh nước hoa của bạn với ID tin tuyển dụng: 179392.</p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="box_chat_user box_chat_user_khach">
                              <div class="box_img_khach">
                                 <img src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="avatar_user_khach">
                              </div>
                              <div class="content_conv_khach">
                                 <div class="time_comment_khach">
                                    <p class="txt_name_khach">ĐỖ XUÂN MẠNH, </p>
                                    <p class="txt_time_khach">9:17:02</p>
                                 </div>
                                 <div class="txt_comment_khach">
                                    <div class="frame_comment_khach frame_comment">
                                       <div class="more_navigation">
                                          <div class="box_more_nav"><img src="/images/icon_new/more_nav_new.svg" class="icon_xemthemdh" alt="thêm điều hướng"></div>
                                       </div>
                                       <div class="show_navigation">
                                          <p class="txt_nav_rep txt_nav_chung cursor_pt">Trả lời</p>
                                          <p class="txt_nav_coppy txt_nav_chung cursor_pt">Sao chép</p>
                                       </div>
                                       <div class="messageTypeText box_khach_comment txt_comment_first">
                                          <p class="title_typelink">Nhân viên kinh doanh nước hoa tại Xm Pay Company</p>
                                          <img width="100%" src="https://topcvai.com/images/bg_fb_2.jpg">
                                          <p class="">Cập nhật chi tiết bản tin tuyển dụng Nhân viên kinh doanh nước hoa tại Xm Pay Company. Thông tin mô tả việc làm Nhân viên kinh doanh nước hoa rõ ràng giúp ứng viên dễ dàng đưa ra quyết định ứng tuyển hiệu quả, nắm bắt cơ hội nghề nghiệp hấp dẫn nhất.</p>
                                          <a class="messageTypelink" target="_blank" rel="nofollow" href="https://topcvai.com/nhan-vien-kinh-doanh-nuoc-hoa-job179392">https://topcvai.com/nhan-vien-kinh-doanh-nuoc-hoa-job179392</a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="box_chat_user box_chat_user_khach">
                              <div class="box_img_khach">
                                 <img src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="avatar_user_khach">
                              </div>
                              <div class="content_conv_khach">
                                 <div class="time_comment_khach">
                                    <p class="txt_name_khach">ĐỖ XUÂN MẠNH, </p>
                                    <p class="txt_time_khach">9:53:02</p>
                                 </div>
                                 <div class="txt_comment_khach">
                                    <div class="frame_comment_khach frame_comment">
                                       <div class="more_navigation">
                                          <div class="box_more_nav"><img src="/images/icon_new/more_nav_new.svg" class="icon_xemthemdh" alt="thêm điều hướng"></div>
                                       </div>
                                       <div class="show_navigation">
                                          <p class="txt_nav_rep txt_nav_chung cursor_pt">Trả lời</p>
                                          <p class="txt_nav_coppy txt_nav_chung cursor_pt">Sao chép</p>
                                       </div>
                                       <p class="box_khach_comment messageTypeText txt_comment_first"><br>Xin chào NTD, Tôi là Đậu Xuân Mạnh tôi vừa ứng tuyển việc làm Nhân viên kinh doanh nước hoa của bạn với ID tin tuyển dụng: 179392.</p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="box_chat_user box_chat_user_khach">
                              <div class="box_img_khach">
                                 <img src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="avatar_user_khach">
                              </div>
                              <div class="content_conv_khach">
                                 <div class="time_comment_khach">
                                    <p class="txt_name_khach">ĐỖ XUÂN MẠNH, </p>
                                    <p class="txt_time_khach">9:53:02</p>
                                 </div>
                                 <div class="txt_comment_khach">
                                    <div class="frame_comment_khach frame_comment">
                                       <div class="more_navigation">
                                          <div class="box_more_nav"><img src="/images/icon_new/more_nav_new.svg" class="icon_xemthemdh" alt="thêm điều hướng"></div>
                                       </div>
                                       <div class="show_navigation">
                                          <p class="txt_nav_rep txt_nav_chung cursor_pt">Trả lời</p>
                                          <p class="txt_nav_coppy txt_nav_chung cursor_pt">Sao chép</p>
                                       </div>
                                       <div class="messageTypeText box_khach_comment txt_comment_first">
                                          <p class="title_typelink">Nhân viên kinh doanh nước hoa tại Xm Pay Company</p>
                                          <img width="100%" src="https://topcvai.com/images/bg_fb_2.jpg">
                                          <p class="">Cập nhật chi tiết bản tin tuyển dụng Nhân viên kinh doanh nước hoa tại Xm Pay Company. Thông tin mô tả việc làm Nhân viên kinh doanh nước hoa rõ ràng giúp ứng viên dễ dàng đưa ra quyết định ứng tuyển hiệu quả, nắm bắt cơ hội nghề nghiệp hấp dẫn nhất.</p>
                                          <a class="messageTypelink" target="_blank" rel="nofollow" href="https://topcvai.com/nhan-vien-kinh-doanh-nuoc-hoa-job179392">https://topcvai.com/nhan-vien-kinh-doanh-nuoc-hoa-job179392</a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="box_chat_user box_chat_user_khach">
                              <div class="box_img_khach">
                                 <img src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="avatar_user_khach">
                              </div>
                              <div class="content_conv_khach">
                                 <div class="time_comment_khach">
                                    <p class="txt_name_khach">ĐỖ XUÂN MẠNH, </p>
                                    <p class="txt_time_khach">10:25:02</p>
                                 </div>
                                 <div class="txt_comment_khach">
                                    <div class="frame_comment_khach frame_comment">
                                       <div class="more_navigation">
                                          <div class="box_more_nav"><img src="/images/icon_new/more_nav_new.svg" class="icon_xemthemdh" alt="thêm điều hướng"></div>
                                       </div>
                                       <div class="show_navigation">
                                          <p class="txt_nav_rep txt_nav_chung cursor_pt">Trả lời</p>
                                          <p class="txt_nav_coppy txt_nav_chung cursor_pt">Sao chép</p>
                                       </div>
                                       <p class="box_khach_comment messageTypeText txt_comment_first"><br>Xin chào NTD, Tôi là Đậu Xuân Mạnh tôi vừa ứng tuyển việc làm Nhân viên kinh doanh nước hoa của bạn với ID tin tuyển dụng: 179392.</p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="box_chat_user box_chat_user_khach">
                              <div class="box_img_khach">
                                 <img src="/images/icon_new/img_error.png" alt="Ảnh người dùng" class="avatar_user_khach">
                              </div>
                              <div class="content_conv_khach">
                                 <div class="time_comment_khach">
                                    <p class="txt_name_khach">ĐỖ XUÂN MẠNH, </p>
                                    <p class="txt_time_khach">10:25:02</p>
                                 </div>
                                 <div class="txt_comment_khach">
                                    <div class="frame_comment_khach frame_comment">
                                       <div class="more_navigation">
                                          <div class="box_more_nav"><img src="/images/icon_new/more_nav_new.svg" class="icon_xemthemdh" alt="thêm điều hướng"></div>
                                       </div>
                                       <div class="show_navigation">
                                          <p class="txt_nav_rep txt_nav_chung cursor_pt">Trả lời</p>
                                          <p class="txt_nav_coppy txt_nav_chung cursor_pt">Sao chép</p>
                                       </div>
                                       <div class="messageTypeText box_khach_comment txt_comment_first">
                                          <p class="title_typelink">Nhân viên kinh doanh nước hoa tại Xm Pay Company</p>
                                          <img width="100%" src="https://topcvai.com/images/bg_fb_2.jpg">
                                          <p class="">Cập nhật chi tiết bản tin tuyển dụng Nhân viên kinh doanh nước hoa tại Xm Pay Company. Thông tin mô tả việc làm Nhân viên kinh doanh nước hoa rõ ràng giúp ứng viên dễ dàng đưa ra quyết định ứng tuyển hiệu quả, nắm bắt cơ hội nghề nghiệp hấp dẫn nhất.</p>
                                          <a class="messageTypelink" target="_blank" rel="nofollow" href="https://topcvai.com/nhan-vien-kinh-doanh-nuoc-hoa-job179392">https://topcvai.com/nhan-vien-kinh-doanh-nuoc-hoa-job179392</a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="box_input_ctconversation">
                     <div class="preview_file d_none">
                        <div class="box_preview_file">
                           <label for="sendfile" class="addmorefile cursor_pt"><img src="../images/icon_new/icons_plus_file.png" alt=""></label>
                           <div class="container_boxfile">
                           </div>
                        </div>
                     </div>
                     <div class="box_ip_sendchat">
                        <div id="data-sendchat-right" data-messagetype="text" data-conversationid="2311413" data-name-sender="XM Pay Company" data-isgroup="0" data-isonline="1,0" data-conversationname="ĐỖ XUÂN MẠNH" data-listmember="10087531,10384461" hidden=""></div>
                        <textarea id="sendchat" style="overflow-y: scroll;" name="sendmess" value="Nhập tin nhắn" autocomplete="off" placeholder="Nhập tin nhắn"></textarea>
                        <div class="btnsendchat" id="btnsendchat">
                           <img src="/images/icon_new/iconsendchat.jpg" alt="icon gửi tin nhắn">
                        </div>
                        <label for="sendfile" class="btnsendfile" id="btnsendfile">
                        <input type="file" id="sendfile" style="display:none" name="sendfile" onchange="loadVideo(this)" placeholder="Tải lên video">
                        <img src="/images/icon_new/send-file-chat.jpg" class="iconsendfile" alt="icon gửi file">
                        </label>
                     </div>
                  </div>
               </div>
            </div>
            <p class="wanring_notconversation" style="display: none;">BẠN CHƯA HIỂN THỊ CUỘC TRÒ CHUYỆN !!!</p>
         </div>
      </div>
   </div>
</section>