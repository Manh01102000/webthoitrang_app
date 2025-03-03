function DeleteProduct(e) {
    product_id = $(e).attr('product-id');
    if (product_id && confirm("Bạn có chắc muốn xóa sản phẩm này")) {
        $.ajax({
            type: "POST",
            url: "/admin/DeleteProduct",
            dataType: "JSON",
            async: false,
            // contentType: false,
            // processData: false,
            data: { product_id },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('#loading').hide();
                if (data.result) {
                    alert(data.message);
                    if (data.result) window.location.href = '/admin/danh-sach-san-pham';
                } else {
                    alert(data.message);
                    console.log(data);
                }
            }
        });
    }
}

function ActiveProduct(e) {
    product_id = $(e).attr('product-id');
    if (product_id) {
        $.ajax({
            type: "POST",
            url: "/admin/ActiveProduct",
            dataType: "JSON",
            async: false,
            // contentType: false,
            // processData: false,
            data: { product_id },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                console.log(data);
                $('#loading').hide();
                if (data.result) {
                    alert(data.message);
                    if (data.result) window.location.href = '/admin/danh-sach-san-pham';
                } else {
                    alert(data.message);
                    console.log(data);
                }
            }
        });
    }
}