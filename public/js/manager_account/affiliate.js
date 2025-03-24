function SaveContract(e) {
    let contractData = {
        companyName: $(".affiliate-company-name").text().trim(),
        partnerName: $(".affiliate-partner-name").text().trim(),
        paymentDate: $(".payment-date").text().trim(),
        paymentMinimum: $(".payment-minimum").text().trim(),
        paymentMethod: $(".payment-method").text().trim(),
        TerminateDateMin: $(".contract-terminate-days").text().trim(),
        companySignDate: $(".company-sign-date").text().trim(),
        partnerSignDate: $(".partner-sign-date").text().trim(),
        company_sign_name: $(".company-sign-name").val().trim(),
        partner_sign_name: $(".partner-sign-name").val().trim(),
    };
    // console.log("Dữ liệu hợp đồng:", contractData);
    $.ajax({
        url: "/api/save-contract",
        method: "POST",
        data: contractData,
        success: function (response) {
            alert("Hợp đồng đã được lưu thành công!");
            location.reload();
        },
        error: function (error) {
            alert("Lỗi khi lưu hợp đồng. Vui lòng thử lại!");
            console.error("Lỗi:", error);
        },
    });
};

function CancelContract(e) {
    if (confirm("Bạn có chắc chắn muốn hủy hợp đồng?")) {
        if ($(e).attr("data-contracts-id") == 0) {
            return alert("Bạn chưa có hợp đồng!!!");
        }
        let contractData = {
            contracts_id: $(e).attr("data-contracts-id"),
        };
        console.log("Dữ liệu hợp đồng:", contractData);
        $.ajax({
            url: "/api/cancel-contract",
            method: "POST",
            data: contractData,
            success: function (response) {
                alert("Hợp đồng đã được hủy thành công!");
                // location.reload();
            },
            error: function (error) {
                alert("Lỗi khi hủy hợp đồng. Vui lòng thử lại!");
                console.error("Lỗi:", error);
            },
        });
    }
};