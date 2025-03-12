
$(document).ready(function () {
    // Khi hover vào nút "Thích"
    $(".comment-actions .btn-like").hover(function () {
        $(".like-options").css({
            'display': "flex",
        });
    });

    $(window).click(function (e) {
        if (!$(".comment-actions .btn-like").is(e.target) && $(".comment-actions .btn-like").has(e.target).length == 0 && !$(".like-options").is(e.target) && $(".like-options").has(e.target).length == 0) {
            $(".like-options").fadeOut(200);
        }
    });

    // Khi chọn icon
    $(".comment-actions .emoji").click(function () {
        let selectedEmoji = $(this).attr("data-src");
        let selectedTextEmoji = $(this).attr("data-text");
        $(".comment-actions .btn-like").addClass('active-like');
        $(".comment-actions .btn-like").find('.btn-like-icon').attr("src", selectedEmoji);
        $(".comment-actions .btn-like").find('.btn-like-text').html(selectedTextEmoji);
        $(".like-options").fadeOut(200);
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

// upload ảnh video
function loadVideo(e) {
    var file_data = $('#choose-image').prop('files')[0];
    if (file_data != undefined) {
        var size = (file_data.size / (1024 * 1024)).toFixed(2);
        var type = file_data.type;
        var name = file_data.name;
        var image = new Image();
        image.src = URL.createObjectURL(file_data);
        var match = ["video/m4v", "video/mp4", "video/ogm", "video/wmv", "video/mpg", "video/ogv", "video/webm", "video/mov", "video/asx", "video/mpeg", 'image/gif', 'image/png', 'image/jpg', 'image/jpeg', 'image/jfif', 'image/PNG'];
        if (type == match[0] || type == match[1] || type == match[2] || type == match[3] || type == match[4] || type == match[5] || type == match[6] || type == match[7] || type == match[8] || type == match[9] || type == match[10] || type == match[11] || type == match[12] || type == match[13] || type == match[14] || type == match[15]) {
            if (type == match[0] || type == match[1] || type == match[2] || type == match[3] || type == match[4] || type == match[5] || type == match[6] || type == match[7] || type == match[8] || type == match[9] || type == match[10]) {
                if (size > 20) {
                    alert(name + " Video tải lên vượt quá 20 MB");
                }
            } else {
                if (size > 2) {
                    alert(name + " Ảnh tải lên vượt quá 2 MB");
                }
            }
        } else {
            alert(name + " sai định dạng ảnh hoặc video vui lòng chọn ảnh hoặc video hợp lệ có định dạng: png, jpg, jpeg, gif, jfif, mp4, m4v, ogm, wmv, mpg, ogv, webm");
        }
    };
};

// Gửi emoji
function SubmitEmoji(e) {
    let data_user = $(e).parents(".comment-section").attr("data-user");
    if (!data_user) {
        alert("Bạn cần đăng nhập để thực hiện chức năng này");
        return;
    }
    let dataemoji = $(e).attr("data-id");
    // id của sản phẩm hoặc tin tức bình luận
    let data_id = $(e).parents(".comment-section").attr("data-id");
    // 1:sản phẩm, 2: tin tức
    let data_type = $(e).parents(".comment-section").attr("data-type");
    if (dataemoji && data_id && data_type) {
        $.ajax({
            type: "POST",
            url: "/api/SubmitEmoji",
            data: {
                data_id,
                data_type,
                dataemoji,
            },
            success: function (data) {

            }
        });
    }
}

function commentHtml(data, data_parents_id) {
    let commentData = data.comment;
    let userData = data.user;
    // Cập nhật số lượt bình luận
    let commentCount = $(".comment-section .comments_statistic").text().trim(); // Số bình luận ban đầu
    console.log(commentCount);
    $(".comment-section .comments_statistic").text(Number(commentCount) + 1);
    // Thêm comment phía dưới
    let newComment =
        `<li class="show-comment" comment-id="${commentData.comment_id}">
        <img onerror='this.onerror=null;this.src="/images/home/logoweberror.png";' src="/images/home/logoweberror.png" data-src="${userData.use_logo_full + "?v=" + (Date.now() / 1000)}" class="lazyload show-comment-avatar" alt="User Avatar">
        <div class="comment-content">
            <div class="show-box-comment">
                <p class="name-user-comment">${userData.use_name}</p>
                <p class="name-user-text">${commentData.comment_content}</p>
            </div>
            <div class="box-comment-actions">
                <div class="actions">
                    <span class="actions-text actions-reply" onclick="replyComment(this)">Phản hồi</span>
                    <span class="actions-text actions-delete cl_red" onclick="DeleteComment(this)">Xóa</span>
                </div>
                <span class="comment-time">${timeAgo(commentData.createdAt)}</span>
            </div>
            <ul class="reply-list"></ul>
        </div>
    </li>`;
    console.log(data_parents_id);
    if (data_parents_id) {
        $(`.show-comment[comment-id="${data_parents_id}"]`).find('.reply-list').append(newComment);
    } else {
        $("#comment-list").prepend(newComment);
    }
    $("#comment-input").val("");
}

// Thêm bình luận
function AddComment(e) {
    let $commentSection = $(e).closest(".comment-section");
    let data_user = $commentSection.attr("data-user");

    if (!data_user) {
        alert("Bạn cần đăng nhập để thực hiện chức năng này");
        return;
    }

    // Lấy nội dung bình luận
    let data_comment_text = $("#comment-input").val().trim();
    if (!data_comment_text) {
        alert("Bạn chưa nhập bình luận");
        $("#comment-input").focus();
        return;
    }

    // Lấy thông tin ảnh
    let data_file = $('#choose-image').prop('files')[0] || "";

    // Lấy ID nội dung & loại nội dung (sản phẩm/tin tức)
    let data_id = $commentSection.attr("data-id");
    let data_type = $commentSection.attr("data-type");
    let data_parents_id = $commentSection.attr("data-parents-id") || 0;

    if (data_id && data_type) {
        $("#loading").show();
        $(e).prop("disabled", true).text("Đang gửi..."); // Vô hiệu hóa nút gửi

        let formData = new FormData();
        formData.append('data_id', data_id);
        formData.append('data_type', data_type);
        formData.append('data_comment_text', data_comment_text);
        if (data_file) formData.append('data_file', data_file); // Chỉ thêm nếu có ảnh
        if (data_parents_id) formData.append('data_parents_id', data_parents_id); // Chỉ thêm nếu có ảnh
        console.log('data_id', data_id);
        console.log('data_type', data_type);
        console.log('data_comment_text', data_comment_text);
        console.log('data_file', data_file); // Chỉ thêm nếu có ảnh
        $.ajax({
            type: "POST",
            url: "/api/AddComment",
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function (response) {
                $("#loading").hide();
                $(e).prop("disabled", false).text("Gửi"); // Bật lại nút
                $("#comment-input").val(""); // Xóa input sau khi gửi
                commentHtml(response.data, data_parents_id)
                alert(response.message || "Bình luận đã được gửi!");
            },
            error: function (xhr) {
                $("#loading").hide();
                $(e).prop("disabled", false).text("Gửi"); // Bật lại nút
                alert("Có lỗi xảy ra: " + (xhr.responseJSON?.message || "Vui lòng thử lại!"));
            }
        });
    }
}

// Xóa bình luận
$(document).on("click", ".delete", function () {
    $(this).closest(".comment").remove();
    commentCount--;
    $("#comment-count").text(commentCount);
});

// Phản hồi bình luận
function replyComment(e) {
    let $commentSection = $(e).closest(".comment-section");
    let comment_id = $(e).closest(".show-comment").attr("comment-id") || 0;
    $(e).closest(".comment-section").find("#comment-input").focus();
    $commentSection.attr("data-parents-id", comment_id)
}