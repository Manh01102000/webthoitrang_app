function CancelOrder(e) {
    if (confirm("Bạn có chắc muốn hủy đơn hàng này?")) {
        let ordercode = $(e).parents(".order-content-item").attr("data-ordercode");
        let status = $(e).attr("data-status");
        if (!ordercode) {
            return alert("Có lỗi xảy ra. Vui lòng tải lại trang!");
        }
        $.ajax({
            url: "/api/ChangeStatusOrder",
            type: "POST",
            data: {
                ordercode,
                status,
            },
            dataTpye: "JSON",
            success: function (data) {

            }
        });
    }
}