function Message(text) {
    if (!text) {
        return alert("Bạn chưa nhập dữ liệu tin nhắn");
    }
}

$(document).on("keydown", "#sendMessage", function (event) {
    if (event.key === "Enter") {
        var text = $(this).val().trim();
        Message(text);
    }
});

function ButtonSendMessage(e) {
    var text = $(e).parents(".conversation-main__action__content").find("#sendMessage").val().trim();
    Message(text);
}