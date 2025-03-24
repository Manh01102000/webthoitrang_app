// Kết nối WebSocket (Thêm log khi lỗi)
const socket = io("http://localhost:5000", { //Kết nối tới server WebSocket đang chạy ở cổng 5000.
    reconnection: true, // Tự động kết nối lại nếu mất kết nối
    reconnectionAttempts: 2, // Số lần thử lại
    timeout: 5000 // Thời gian timeout
});


// Kiểm tra kết nối thành công
socket.on("connect", () => {
    console.log("✅ Kết nối WebSocket thành công!");
});

// Xử lý lỗi khi kết nối thất bại
socket.on("connect_error", (error) => {
    console.error("❌ WebSocket bị lỗi:", error);
});

// Khi user login, gửi sự kiện "join"
async function fetchUserIdAndJoinChat() {
    try {
        const response = await fetch("/api/get-user-id-online", {
            method: "POST",
            credentials: "include" // Gửi cookie để xác thực user
        });

        if (!response.ok) {
            throw new Error(`Lỗi HTTP: ${response.status}`);
        }

        const data = await response.json();
        if (data.user_id) {
            joinChat(data.user_id);
        } else {
            console.warn("⚠️ Không tìm thấy userId!");
        }
    } catch (error) {
        console.error("🚨 Lỗi khi lấy userId:", error);
    }
}

// Khi trang load, tự động lấy userId và tham gia chat
fetchUserIdAndJoinChat();

// Khi user login, gửi sự kiện "join"
function joinChat(userId) {
    if (!userId) return console.warn("⚠️ User ID không hợp lệ!");
    console.log(`🟢 Đăng nhập vào chat: ${userId}`);
    socket.emit('join', userId);
}

// Lắng nghe tin nhắn mới
socket.on('newMessage', (data) => {
    console.log("📩 Tin nhắn mới:", data);
    // Hiển thị tin nhắn trong giao diện (nếu có)
});

// Lắng nghe danh sách user online
socket.on('updateOnlineUsers', (users) => {
    console.log("🟢 Danh sách user online:", users);
    // Cập nhật danh sách online trong giao diện
});

// Khi user mất kết nối
socket.on('disconnect', () => {
    console.warn("⚠️ Đã mất kết nối với WebSocket.");
});

// Khi user offline
socket.on('userOffline', (data) => {
    console.log(`🔴 User ${data.use_id} đã offline.`);
});

// Khi gửi tin nhắn
window.sendMessage = function (sender_id, receiver_id, message) {
    if (!sender_id || !receiver_id || !message) {
        return console.warn("⚠️ Gửi tin nhắn thất bại: Dữ liệu không hợp lệ!");
    }
    console.log(`📤 Gửi tin nhắn từ ${sender_id} đến ${receiver_id}`);
    socket.emit('sendMessage', { sender_id, receiver_id, message });
};
