<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>Hệ thống bình luận</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
body {
    font-family: Arial, sans-serif;
    background: #f4f4f4;
    margin: 20px;
}

.comment-container {
    max-width: 600px;
    background: white;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: auto;
}

/* Header */
.comment-header {
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    color: #555;
    margin-bottom: 10px;
}

/* Hàng nút tương tác */
.comment-actions {
    display: flex;
    gap: 20px;
    margin-bottom: 15px;
    position: relative;
}

.comment-actions button {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 14px;
    color: #007bff;
}

.comment-actions button:hover {
    text-decoration: underline;
}

/* Thích - Hover hiển thị icon */
.like-box {
    position: relative;
}

.like-options {
    display: none;
    position: absolute;
    bottom: 30px;
    left: 0;
    background: white;
    padding: 5px;
    border-radius: 8px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    white-space: nowrap;
}

.like-options .emoji {
    font-size: 20px;
    padding: 5px;
    cursor: pointer;
}

.like-box:hover .like-options {
    display: flex;
}

/* Box chia sẻ */
.share-box {
    display: none;
    position: absolute;
    top: 30px;
    left: 120px;
    background: white;
    border-radius: 8px;
    padding: 10px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}

.share-box ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.share-box li {
    padding: 5px;
    cursor: pointer;
}

.share-box li:hover {
    background: #f0f0f0;
}

/* Ô nhập bình luận */
.comment-box {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
}

.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

.comment-box input {
    flex: 1;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 20px;
    outline: none;
}

.comment-box button {
    padding: 8px 15px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 20px;
    cursor: pointer;
}

.comment-box button:hover {
    background: #0056b3;
}

</style>
<body>

<div class="comment-container">
    <!-- Header -->
    <div class="comment-header">
        <span>👍❤️ Bạn và 120K</span>
        <span>• <span id="comment-count">26</span> bình luận • 10 lượt chia sẻ • 10 lượt xem</span>
    </div>

    <!-- Nút Thích, Bình luận, Chia sẻ -->
    <div class="comment-actions">
        <div class="like-box">
            <button class="btn-like">👍 Thích</button>
            <div class="like-options">
                <span class="emoji">👍</span>
                <span class="emoji">❤️</span>
                <span class="emoji">😂</span>
                <span class="emoji">😮</span>
                <span class="emoji">😢</span>
                <span class="emoji">😡</span>
            </div>
        </div>
        <button class="btn-comment">💬 Bình luận</button>
        <button class="btn-share">🔗 Chia sẻ</button>

        <!-- Box chia sẻ -->
        <div class="share-box">
            <ul>
                <li>📘 Chia sẻ lên Facebook</li>
                <li>📱 Chia sẻ qua Zalo</li>
                <li>💬 Chia sẻ qua Messenger</li>
                <li>🔗 Sao chép liên kết</li>
            </ul>
        </div>
    </div>

    <!-- Ô nhập bình luận -->
    <div class="comment-box">
        <img src="avatar.jpg" class="avatar" alt="User Avatar">
        <input type="text" id="comment-input" placeholder="Viết bình luận...">
        <button id="add-comment">Gửi</button>
    </div>
    
    <!-- Danh sách bình luận -->
    <ul class="comment-list" id="comment-list"></ul>
</div>

<script>
$(document).ready(function () {
    let commentCount = 26; // Số bình luận ban đầu

    // Thêm bình luận mới
    $("#add-comment").click(function () {
        let commentText = $("#comment-input").val().trim();
        if (commentText !== "") {
            commentCount++;
            $("#comment-count").text(commentCount);

            let newComment = `
                <li class="comment">
                    <img src="avatar.jpg" class="avatar" alt="User Avatar">
                    <div class="comment-content">
                        <p>${commentText}</p>
                        <div class="actions">
                            <span class="like">👍 Thích</span>
                            <span class="reply">💬 Phản hồi</span>
                            <span class="delete">❌ Xóa</span>
                        </div>
                        <small class="comment-time">${getCurrentTime()}</small>
                        <ul class="reply-list"></ul>
                    </div>
                </li>`;
            
            $("#comment-list").append(newComment);
            $("#comment-input").val("");
        }
    });

    // Xóa bình luận
    $(document).on("click", ".delete", function () {
        $(this).closest(".comment").remove();
        commentCount--;
        $("#comment-count").text(commentCount);
    });

    // Thích bình luận
    $(document).on("click", ".like", function () {
        let likeBtn = $(this);
        if (likeBtn.text().includes("👍")) {
            likeBtn.text("❤️ Đã thích");
        } else {
            likeBtn.text("👍 Thích");
        }
    });

    // Hiển thị box chia sẻ
    $(".btn-share").click(function () {
        $(".share-box").toggle();
    });

    // Khi chọn một tùy chọn trong box chia sẻ
    $(".share-box li").click(function () {
        alert("Bạn đã chọn: " + $(this).text());
        $(".share-box").hide();
    });

    // Lấy thời gian hiện tại
    function getCurrentTime() {
        let now = new Date();
        return now.getHours() + ":" + now.getMinutes();
    }
});

</script>
</body>
</html>
