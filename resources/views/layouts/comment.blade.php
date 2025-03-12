<link rel="stylesheet" href="{{ asset('css/layouts/comment.css') }}?v={{ time() }}">
@php $DataEmoji = DataEmoji() @endphp
@php $emoji_active = $dataAll['interaction']['data-emoji'] ?? ''; @endphp
@php $total_emojis = $dataAll['interaction']['total-emojis'] ?? ''; @endphp
@php
    $DBComment = $dataAll['interaction']['dataComments']['DBComment'] ?? [];
    $totalComments = $dataAll['interaction']['dataComments']['totalComments'] ?? 0;
@endphp
<div class="comment-section" data-parents-id="" data-user="{{ $dataAll['data']['data']['us_id'] ?? 0 }}" data-id="{{ $dataAll['data-id'] ?? 0 }}" data-type="1">
    <!-- Header -->
    <div class="comment-header">
        <div class="comment-heade__statistic">
            <div class="statistic_icon">
                <div class="item_icon">
                    <img src="{{ asset('images/comment_icon/icon-like.svg') }}" width="20" height="20" alt="icon">
                </div>
                <div class="item_icon">
                    <img src="{{ asset('images/comment_icon/icon-love.svg') }}" width="20" height="20" alt="icon">
                </div>
            </div>
            <div class="statistic_userlike">
                @if ($emoji_active)
                    <span class="font_s14 font_w400 line_h16">Bạn và</span>
                @endif
                <span class="font_s14 font_w400 line_h16">{{ $total_emojis }} người</span>
            </div>
        </div>
        <div class="comment-heade__statistic">
            <div class="item_count_statistic">
                <span class="font_s14 font_w400 line_h16 comments_statistic">{{ $totalComments }}</span>
                <span class="font_s14 font_w400 line_h16">bình luận</span>
            </div>
            <span>•</span>
            <div class="item_count_statistic">
                <span class="font_s14 font_w400 line_h16 shares_statistic">10</span>
                <span class="font_s14 font_w400 line_h16">lượt chia sẻ</span>
            </div>
            <span>•</span>
            <div class="item_count_statistic">
                <span class="font_s14 font_w400 line_h16 views_statistic">10</span>
                <span class="font_s14 font_w400 line_h16">lượt xem</span>
            </div>
        </div>
    </div>

    <!-- Nút Thích, Bình luận, Chia sẻ -->
    <div class="comment-actions">
        <div class="like-box">
            @if ($emoji_active)
                @php 
                    $data_emoji_active = array_filter($DataEmoji, function ($DataEmoji) use ($emoji_active) {
                        return $DataEmoji['data'] === $emoji_active;
                    });
                    // Lấy phần tử đầu tiên
                    $first_emoji = reset($data_emoji_active);
                @endphp
                <button class="actions-button btn-like active-like">
                    <img class="btn-like-icon" src="{{ asset($first_emoji['url']) }}" width="20" height="20" alt="icon">
                    <span class="btn-like-text">{{ $first_emoji['text'] }}</span>
                </button>
            @else
                <button class="actions-button btn-like">
                    <img class="btn-like-icon" src="{{ asset('images/comment_icon/icon-like.svg') }}" width="20" height="20" alt="icon">
                    <span class="btn-like-text">Thích</span>
                </button>
            @endif
            <div class="like-options">
                @foreach ($DataEmoji as $Emoji)
                    <span class="emoji" data-id="{{ $Emoji['data'] }}" onclick="SubmitEmoji(this)" data-src="{{ asset($Emoji['url']) }}" data-text="{{ $Emoji['text'] }}">
                        <img src="{{ asset($Emoji['url']) }}" width="20" height="20" alt="icon">
                    </span>
                @endforeach
            </div>
        </div>
        <button class="actions-button btn-comment">
            <img src="{{ asset('images/comment_icon/icon-comment.svg') }}" width="20" height="20" alt="icon">
            <span>Bình luận</span>
        </button>
        <button class="actions-button btn-share">
            <img src="{{ asset('images/comment_icon/icon-share.svg') }}" width="20" height="20" alt="icon">
            <span>Chia sẻ</span>
        </button>
        <!-- Box chia sẻ -->
        <div class="share-box">
            <ul>
                <li class="font_s14 font_w400 line_h16">📘 Chia sẻ lên Facebook</li>
                <li class="font_s14 font_w400 line_h16">📱 Chia sẻ qua Zalo</li>
                <li class="font_s14 font_w400 line_h16">💬 Chia sẻ qua Messenger</li>
                <li class="font_s14 font_w400 line_h16">🔗 Sao chép liên kết</li>
            </ul>
        </div>
    </div>

    <!-- Ô nhập bình luận -->
    <div class="comment-box">
        <img onerror='this.onerror=null;this.src="/images/home/logoweberror.png";' src="/images/home/logoweberror.png" data-src="{{ asset($dataAll['data']['data']['us_logo'] ?? "") }}?v={{ time() }}" class="lazyload comment-avatar" alt="User Avatar">
        <div class="box-input-comment">
            <input type="text" id="comment-input" placeholder="Viết bình luận...">
            <div class="box-choose-more">
                <div class="box-choose-icon">
                    <img src="{{ asset('images/comment_icon/choose-icon.svg') }}" width="26" height="26" alt="icon">
                </div>
                <label for="choose-image" class="box-choose-image cursor_pt">
                    <img src="{{ asset('images/comment_icon/choose-camera.svg') }}" width="26" height="26" alt="icon">
                    <input type="file" id="choose-image" style="display:none" name="choose-image" onchange="loadVideo(event)" placeholder="Tải lên video">
                </label>
            </div>
        </div>
        <button id="add-comment" onclick="AddComment(this)">Gửi</button>
    </div>
    
    <!-- Danh sách bình luận -->
    <ul class="comment-list" id="comment-list">
        @if (!empty($DBComment))
            @foreach ($DBComment as $key => $comment)
                @php $use_logo = !empty($comment['use_logo']) ? geturlimageAvatar($comment['use_create_time']) . $comment['use_logo'] : ''  @endphp
                <li class="show-comment" comment-id="{{ $comment['comment_id'] }}">
                    <img onerror='this.onerror=null;this.src="/images/home/logoweberror.png";' src="/images/home/logoweberror.png" data-src="{{ asset($use_logo) }}?v={{ time() }}" class="lazyload show-comment-avatar" alt="User Avatar">
                    <div class="comment-content">
                        <div class="show-box-comment">
                            <p class="name-user-comment">{{ $comment['use_name'] }}</p>
                            <p class="name-user-text">{{ $comment['comment_content'] }}</p>
                        </div>
                        <div class="box-comment-actions">
                            <div class="actions">
                                <span class="actions-text actions-reply" onclick="replyComment(this)">Phản hồi</span>
                                <span class="actions-text actions-delete cl_red" onclick="DeleteComment(this)">Xóa</span>
                            </div>
                            <span class="comment-time">{{ timeAgo($comment['createdAt']) }}</span>
                        </div>
                        <ul class="reply-list"></ul>
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
</div>
<script src="{{ asset('js/layouts/comment.js') }}?v={{ time() }}" defer></script>