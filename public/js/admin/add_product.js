
$(document).ready(function () {
    // Nhúng ckeditor
    CKEDITOR.replace('product_description');
    // Nhúng select2
    $("#category").select2({
        dropdownParent: $('.box-append-category')
    });

    $("#category_code").select2({
        dropdownParent: $('.box-append-category_code')
    });

    $("#category_children_code ").select2({
        dropdownParent: $('.box-append-category_children_code ')
    });

    $("#discount_type").select2({
        dropdownParent: $('.box-append-discount_type')
    });

    $("#product_sizes").select2({
        dropdownParent: $('.box-append-product_sizes'),
        placeholder: "Chọn kích thước",
        allowClear: false,
    });
    // end nhúng select2

    // Lấy dữ liệu danh mục con cấp 1
    $("#category").on("change", function () {
        let val = $(this).val();
        console.log(val);
        if (val) {
            $.ajax({
                'type': "POST",
                'url': "/api/getCategoryByID",
                'data': {
                    id: val
                },
                dataType: "JSON",
                success: function (data) {
                    if (data) {
                        console.log(data);
                        let dataCate = data.data;
                        html = '<option value="0">Chọn danh mục</option>';
                        dataCate.forEach((element, index) => {
                            html += `<option value=" ${element['cat_code']}"> ${element['cat_name']}</option>`;
                        });
                        $("#category_code").html(html);
                    }
                }
            });
        }
    });

    // Lấy dữ liệu danh mục con cấp 2
    $("#category_code").on("change", function () {
        let val = $(this).val();
        console.log(val);
        if (val) {
            $.ajax({
                'type': "POST",
                'url': "/api/getCategoryByID",
                'data': {
                    id: val
                },
                dataType: "JSON",
                success: function (data) {
                    if (data) {
                        console.log(data);
                        let dataCate = data.data;
                        html = '<option value="0">Chọn danh mục</option>';
                        dataCate.forEach((element, index) => {
                            html += `<option value=" ${element['cat_code']}"> ${element['cat_name']}</option>`;
                        });
                        $("#category_children_code").html(html);
                    }
                }
            });
        }
    });

});

//===================Luồng thông tin sản phẩm======================
function cartesian(...value) {
    // ...value gom tất cả tham số thành một mảng
    // (...valude): cartesian([6, 8], ['c', 'e'], ['X', 'Y']) =>  [[6, 8], ['c', 'e'], ['X', 'Y']]
    // ví dụ về cách hoạt động của cartesian
    // [[6, 8], ['c', 'e'], ['X', 'Y']]
    // Vòng 1 duyệt mảng [[]] với [6, 8]
    // tem0 => [[6],[8]] 
    // vòng 2 lấy kết quả temp0 [[6],[8]] với ['c','e']
    // tem1 => [[6,'c'],[6,'e'],[8,'c'],[8,'e']] 
    // vòng 3 lấy kết quả temp1 [[6,'c'],[6,'e'],[8,'c'],[8,'e']]  với ['X', 'Y']
    // tem2 => [
    //         [6,'c','X'],
    //         [6,'c','Y'],
    //         [6,'e,'X'],
    //         [6,'e,'Y'],
    //         [8,'c','X'],
    //         [8,'c','Y'],
    //         [8,'e,'X'],
    //         [8,'e,'Y'],
    //        ]
    let result = [[]];  // Bắt đầu với một mảng chứa mảng rỗng
    value.forEach((arr, index) => {  // Duyệt qua từng mảng con
        let temp = [];  // Mảng tạm để chứa kết quả mới
        result.forEach(r => {  // Duyệt qua từng tổ hợp đã có trước đó
            arr.forEach((item, idx) => {  // Duyệt qua từng phần tử trong mảng con hiện tại
                temp.push([...r, item.trim()]);  // Thêm phần tử mới vào tổ hợp
                // [...r, item] sẽ đẩy item vào cuối của [] giống với r.concat(item) (lưu ý r là mảng ví dụ [6])
                // ví dụ [...[6],5] => [6,5]; giống với [6].concat(5) => [6,5]
            });
        });
        result = temp;  // Cập nhật lại result với tổ hợp mới
    });

    return result;
}

function UpdateTTSP(e) {
    var product_sizes = $("#product_sizes");
    var product_colors = $("#product_colors");
    let validate1 = validate2 = true;

    if (product_sizes.val() == '' || product_sizes.val().length == 0) {
        if (product_sizes.parent().hasClass("error-mess") == false) {
            product_sizes.parent().addClass("error-mess");
            product_sizes.parent().after("<label class='error-mess' id='product_sizes_error'>Vui lòng chọn kích thước sản phẩm</label>");
        }
        $('#product_sizes').focus();
        validate1 = false;
    } else {
        product_sizes.parent().removeClass("error-mess");
        $("#product_sizes_error").remove();
    }

    if (product_colors.val().trim() == '') {
        if (product_colors.parent().hasClass("error-mess") == false) {
            product_colors.parent().addClass("error-mess");
            product_colors.parent().append("<label class='error-mess' id='product_colors_error'>Vui lòng nhập màu sắc sản phẩm</label>");
        }
        $('#product_colors').focus();
        validate2 = false;
    } else {
        product_colors.parent().removeClass("error-mess");
        $("#product_colors_error").remove();
    }

    if (validate1 == true && validate2 == true) {
        $("#loading").show();
        var product_sizes = $("#product_sizes").val();
        var product_colors = $("#product_colors").val();
        product_colors = product_colors.split(',');
        let array = cartesian(product_sizes, product_colors);
        let html = ``;
        array.forEach((element, index) => {
            html += `<div class="footer_bangphanloai bangphanloai_item d_flex al_ct">
            <div class="footer_bpl_loai font_s13 line_h16 font_w400 cl_000 product_classification">${element.join()}</div>
            <div class="footer_bpl_soluongkho">
                <input type="number" min="0" name="product_stock" id="product_stock_${index + 1}" class="product_stock" placeholder="Nhập số lượng kho">
            </div>
            <div class="footer_bpl_giaban">
                <input type="text" onkeyup="format_gtri(this)" name="product_price" id="product_price_${index + 1}" class="product_price" placeholder="Nhập giá sản phẩm" autocomplete="off">
            </div>
            <div class="footer_bpl_xoa">
                <img src="/images/icon/icon_delete.png" width="18px" height="19px" class="icon_delete_loai cursor_pt" onclick="delete_bangplsp(this)">
            </div>
        </div>`;
        });
        $(".m_bangphanloai .container_ft_bpl").html(html);

        setInterval(() => {
            $("#loading").hide();
        }, 500);
        $(".m_bangphanloai").show();
    }

}

function delete_bangplsp(e) {
    $(e).parents('.footer_bangphanloai').remove();
    var count_nplsp = $('.footer_bangphanloai').length;
    console.log(count_nplsp)
    if (count_nplsp == 0) {
        $('.m_bangphanloai').hide();
    }
}

//===================Luồng khuyến mãi sản phẩm======================
function format_gtri(id) {
    if (event.which >= 37 && event.which <= 40) return;
    // format number
    $(id).val(function (index, value) {
        return value
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    });
}

function addKhuyenMai(e) {
    var html = `<div class="container_km_bangkm d_flex fl_cl gap_10">
        <div class="bkm_xoa_km w100 d_flex jc_end">
            <img src="/images/icon/icon_delete.png" width="18px" height="19px" class="icon_xoa_km cursor_pt" onclick="DeleteDiscount(this)">
        </div>
        <div class="bkm_loai_giatri_km d_flex gap_10">
            <div class="box_loai_km box_input_infor">
                <label class="form-label font_s13 line_h16 font_w500 cl_000">Loại giảm giá <span style="color:red">*</span></label>
                <div class="container-select">
                    <select class="discount_type select_100" id="discount_type" onchange="ChangeDiscType(this)">
                        <option value="">Chọn</option>
                        <option value="1">Giảm %</option>
                        <option value="2">Giảm số tiền</option>
                    </select>
                    <div class="box-append-select box-append-discount_type"></div>
                </div>
            </div>
            <div class="box_giatri_km box_input_infor">
                <label class="form-label font_s13 line_h16 font_w500 cl_000">Giá trị <span style="color:red">*</span></label>
                <div class="giatri_km d_flex al_ct">
                    <input type="text" name="discount_price" id="discount_price" class="discount_price font_s13 line_h16 font_w400 cl_000" onkeyup="format_gtri(this)" placeholder="Nhập giá trị giảm giá">
                    <p class="show_dv_km font_s13 line_h16 font_w400 cl_000">%</p>
                </div>
            </div>
        </div>
        <div class="bkm_ngaybd_ngaykt_km d_flex gap_10">
            <div class="box_bkm_ngaybd box_input_infor">
                <label class="form-label font_s13 line_h16 font_w500 cl_000">Ngày bắt đầu <span style="color:red">*</span></label>
                <input type="date" name="discount_start_time" class="discount_start_time" id="discount_start_time">
            </div>
            <div class="box_bkm_ngaykt box_input_infor">
                <label class="form-label font_s13 line_h16 font_w500 cl_000">Ngày kết thúc <span style="color:red">*</span></label>
                <input type="date" name="discount_end_time" class="discount_end_time" id="discount_end_time">
            </div>
        </div>
    </div>`;
    $('.khuyenmai_bangkm').html(html);
    $('.khuyenmai_bangkm').show();
    $('.khuyemai_add_khuyemmai').hide();
}

function ChangeDiscType(e) {
    var loai_km = $(e).val();
    var txt1 = `đ`;
    var txt2 = `%`;
    if (loai_km == 1) {
        $('.box_giatri_km .discount_price').prop("disabled", false);
        $('.box_giatri_km .show_dv_km').text(txt2);
        $('.box_giatri_km .discount_price').attr("placeholder", "0");
        $('.box_giatri_km .discount_price').attr("maxlength", "3");
        $('.box_giatri_km .discount_price').attr("min", "0");
        $('.box_giatri_km .discount_price').attr("max", "100");
    } else if (loai_km == 2) {
        $('.box_giatri_km .discount_price').prop("disabled", false);
        $('.box_giatri_km .show_dv_km').text(txt1);
        $('.box_giatri_km .discount_price').attr("placeholder", "Nhập giá trị giảm");
        $('.box_giatri_km .discount_price').removeAttr("maxlength");
        $('.box_giatri_km .discount_price').removeAttr("min");
        $('.box_giatri_km .discount_price').removeAttr("max");
    } else {
        $('.box_giatri_km .discount_price').prop("disabled", true);
    }
}

function DeleteDiscount(e) {
    $(e).parents('.khuyenmai_bangkm').html('');
    $(e).parents('.khuyenmai_bangkm').hide();
    $('.khuyemai_add_khuyemmai').show();
}

//==================== Luồng ảnh =====================
$(document).ready(function () {
    var count = $('.frame_imgvideo .box_img_video').length;
    if (count > 0) {
        $('.icon_addimgvideo').show();
    } else {
        $('.icon_addimgvideo').hide();
    }
});

function loadVideo(e) {
    var file_data = $('#product_images').prop('files')[0];
    if (file_data != undefined) {
        $("#loading").show();
        var size = (file_data.size / (1024 * 1024)).toFixed(2);
        var type = file_data.type;
        var name = file_data.name;
        var image = new Image();
        image.src = URL.createObjectURL(file_data);
        var match = ["video/m4v", "video/mp4", "video/ogm", "video/wmv", "video/mpg", "video/ogv", "video/webm", "video/mov", "video/asx", "video/mpeg", 'image/gif', 'image/png', 'image/jpg', 'image/jpeg', 'image/jfif', 'image/PNG'];
        if (type == match[0] || type == match[1] || type == match[2] || type == match[3] || type == match[4] || type == match[5] || type == match[6] || type == match[7] || type == match[8] || type == match[9] || type == match[10] || type == match[11] || type == match[12] || type == match[13] || type == match[14] || type == match[15]) {
            if (type == match[0] || type == match[1] || type == match[2] || type == match[3] || type == match[4] || type == match[5] || type == match[6] || type == match[7] || type == match[8] || type == match[9] || type == match[10]) {
                var html = '';
                if (size <= 20) {
                    var checkslvideo = '';
                    $('.box_img_video[data-video="1"]').each(function () {
                        checkslvideo = $(this).length;
                    })
                    if (checkslvideo.length < 1) {
                        $('.list_imgvideo').show();
                        $('.icon_addimgvideo').show();
                        html += `<div class="box_img_video" data-new-video="1" data=${file_data} data-video="1">
                                  <video src="${URL.createObjectURL(file_data)}" controls class="imgvideo_preview"></video>
                                  <img src="/images/icon/xoaanh.svg" class="icon_delete" onclick="icon_delete_img(this)">
                                </div>`;
                        $('.box_listimgvideo .frame_imgvideo').append(html);
                        $('.box_listimgvideo .frame_imgvideo .box_img_video[data-new-video="1"]').data("file", file_data).removeAttr('data-new-video', 1);
                        $("#loading").hide();
                        // Xóa error cho list_img_video
                        $(".list_imgvideo").removeClass("error-mess");
                        $("#list_imgvideo_error").remove();
                    } else {
                        alert(name + " Tối đa 1 video");
                    }
                } else {
                    alert(name + " Video tải lên vượt quá 20 MB");
                }
            } else {
                var html = '';
                if (size <= 2) {
                    if ($('.box_img_video[data-img="1"]').length < 10) {
                        $('.list_imgvideo').show();
                        $('.icon_addimgvideo').show();
                        html += `<div class="box_img_video" data-new-img="1" data=${file_data} data-img="1">
                                <img src="${URL.createObjectURL(file_data)}" class="imgvideo_preview">
                                <img src="/images/icon/xoaanh.svg" class="icon_delete" onclick="icon_delete_img(this)">
                              </div>`;
                        $('.box_listimgvideo .frame_imgvideo').append(html);
                        $('.box_listimgvideo .frame_imgvideo .box_img_video[data-new-img="1"]').data("file", file_data).removeAttr('data-new-img', 1);
                        $("#loading").hide();
                        // Xóa error cho list_img_video
                        $(".list_imgvideo").removeClass("error-mess");
                        $("#list_imgvideo_error").remove();
                    } else {
                        alert(name + " Tối đa 10 ảnh");
                    }
                } else {
                    alert(name + " Ảnh tải lên vượt quá 2 MB");
                }
            }
        } else {
            alert(name + " sai định dạng ảnh hoặc video vui lòng chọn ảnh hoặc video hợp lệ có định dạng: png, jpg, jpeg, gif, jfif, mp4, m4v, ogm, wmv, mpg, ogv, webm");
        }
    };
};

function icon_delete_img(e) {
    var data_del = $(e).parents('.box_img_video').attr("data_name");
    if (!data_del) {
        $(e).parents('.box_img_video').remove();
    } else {
        $(e).parents('.box_img_video').hide();
        $(e).parents('.box_img_video').attr("data_del", data_del);

        $(e).parents('.box_img_video[data-new-img="0"]').attr("data-img", 0);
        $(e).parents('.box_img_video[data-new-video="0"]').attr("data-video", 0);

        $(e).parents('.box_img_video[data-new-img="0"]').attr("data_name", "");
        $(e).parents('.box_img_video[data-new-video="0"]').attr("data_name", "");
    }
    if ($('.box_img_video').length) {
        $('.icon_addimgvideo').show();
    } else {
        $('.icon_addimgvideo').hide();
    }
}
//==================== Luồng validate =====================
// Kiểm tra đã nhập
function validatenew(valuecheck, content, text) {
    let validate = true;
    const value = valuecheck.val().trim();
    if (value === "") {
        if (!valuecheck.parent().hasClass("error-mess")) {
            valuecheck.parent().addClass("error-mess");
            valuecheck.parent().append(
                `<label id='${text}_error' class='error-mess'>${content}</label>`
            );
        }
        valuecheck.focus();
        validate = false;
    } else {
        valuecheck.parent().removeClass("error-mess");
        $(`#${text}_error`).remove();
    }
    return validate;
}
// kiểm tra nhập cho select2
function validateSelect2(valuecheck, content, text) {
    let validate = true;
    const selectedValues = $(valuecheck).val();
    if (!selectedValues) {
        if (!valuecheck.parent().hasClass("error-mess")) {
            valuecheck.parent().addClass("error-mess");
            valuecheck.parent().append(
                `<label id='${text}_error' class='error-mess'>${content}</label>`
            );
        }
        valuecheck.focus();
        validate = false;
    } else {
        valuecheck.parent().removeClass("error-mess");
        $(`#${text}_error`).remove();
    }
    return validate;
}
// 
function isPositiveInteger(value) {
    let validate = true;
    // Kiểm tra nếu nhập số âm, số thập phân hoặc không phải số
    if (isNaN(value) || value < 0 || !Number.isInteger(Number(value))) {
        validate = false;
    }
    return validate;
}
// Kiểm tra nhập
$(document).ready(function () {
    // validate mã sp
    $(document).on("keyup", "#product_code", function () {
        var product_code = $(this);
        if (product_code.val().trim() == '') {
            if (product_code.parent().hasClass("error-mess") == false) {
                product_code.parent().addClass("error-mess");
                product_code.parent().append("<label class='error-mess' id='product_code_error'>Vui lòng nhập mã sản phẩm</label>");
            }
            $('#product_code').focus();
        } else {
            product_code.parent().removeClass("error-mess");
            $("#product_code_error").remove();
        }
    });
    // validate tên sp
    $(document).on("keyup", "#product_name", function () {
        var product_name = $(this);
        if (product_name.val().trim() == '') {
            if (product_name.parent().hasClass("error-mess") == false) {
                product_name.parent().addClass("error-mess");
                product_name.parent().append("<label class='error-mess' id='product_name_error'>Vui lòng nhập tên sản phẩm</label>");
            }
            $('#product_name').focus();
        } else {
            product_name.parent().removeClass("error-mess");
            $("#product_name_error").remove();
        }
    });

    // validate mô tả sp
    CKEDITOR.instances["product_description"].on("change", function () {
        let product_description_val = this.getData().trim(); // Lấy nội dung CKEditor
        if (product_description_val === '') {
            if (!$("#product_description").parent().hasClass("error-mess")) {
                $("#product_description").parent().addClass("error-mess");
                $("#product_description").parent().append("<label class='error-mess' id='product_description_error'>Vui lòng nhập mô tả sản phẩm</label>");
            }
        } else {
            $("#product_description").parent().removeClass("error-mess");
            $("#product_description_error").remove();
        }
    });

    // validate danh mục
    $(document).on("change", "#category", function () {
        var category = $(this);
        if (category.val().trim() == 0) {
            if (category.parent().hasClass("error-mess") == false) {
                category.parent().addClass("error-mess");
                category.parent().after("<label class='error-mess' id='category_error'>Vui lòng chọn danh mục sản phẩm</label>");
            }
            $('#category').focus();
        } else {
            category.parent().removeClass("error-mess");
            $("#category_error").remove();
        }
    });
    // validate danh mục
    $(document).on("change", "#category_code", function () {
        var category_code = $(this);
        if (category_code.val().trim() == 0) {
            if (category_code.parent().hasClass("error-mess") == false) {
                category_code.parent().addClass("error-mess");
                category_code.parent().after("<label class='error-mess' id='category_code_error'>Vui lòng chọn danh mục sản phẩm</label>");
            }
            $('#category_code').focus();
        } else {
            category_code.parent().removeClass("error-mess");
            $("#category_code_error").remove();
        }
    });
    // validate danh mục
    $(document).on("change", "#category_children_code", function () {
        var category_children_code = $(this);
        if (category_children_code.val().trim() == 0) {
            if (category_children_code.parent().hasClass("error-mess") == false) {
                category_children_code.parent().addClass("error-mess");
                category_children_code.parent().after("<label class='error-mess' id='category_children_code_error'>Vui lòng chọn danh mục sản phẩm</label>");
            }
            $('#category_children_code').focus();
        } else {
            category_children_code.parent().removeClass("error-mess");
            $("#category_children_code_error").remove();
        }
    });
    // validate tên thương hiệu
    $(document).on("keyup", "#product_brand", function () {
        var product_brand = $(this);
        if (product_brand.val().trim() == '') {
            if (product_brand.parent().hasClass("error-mess") == false) {
                product_brand.parent().addClass("error-mess");
                product_brand.parent().append("<label class='error-mess' id='product_brand_error'>Vui lòng nhập tên thương hiệu</label>");
            }
            $('#product_brand').focus();
        } else {
            product_brand.parent().removeClass("error-mess");
            $("#product_brand_error").remove();
        }
    });
    // validate kích thước
    $(document).on("change", "#product_sizes", function () {
        var product_sizes = $(this);
        if (product_sizes.val() == '' || product_sizes.val().length == 0) {
            if (product_sizes.parent().hasClass("error-mess") == false) {
                product_sizes.parent().addClass("error-mess");
                product_sizes.parent().after("<label class='error-mess' id='product_sizes_error'>Vui lòng chọn kích thước sản phẩm</label>");
            }
            $('#product_sizes').focus();
        } else {
            product_sizes.parent().removeClass("error-mess");
            $("#product_sizes_error").remove();
        }
    });
    // validate màu sắc
    $(document).on("change", "#product_colors", function () {
        var product_colors = $(this);
        if (product_colors.val().trim() == '') {
            if (product_colors.parent().hasClass("error-mess") == false) {
                product_colors.parent().addClass("error-mess");
                product_colors.parent().append("<label class='error-mess' id='product_colors_error'>Vui lòng nhập màu sắc sản phẩm</label>");
            }
            $('#product_colors').focus();
            validate2 = false;
        } else {
            product_colors.parent().removeClass("error-mess");
            $("#product_colors_error").remove();
        }
    });
    // validate mã màu sắc
    $(document).on("change", "#product_code_colors", function () {
        var product_code_colors = $(this);
        if (product_code_colors.val().trim() == '') {
            if (product_code_colors.parent().hasClass("error-mess") == false) {
                product_code_colors.parent().addClass("error-mess");
                product_code_colors.parent().append("<label class='error-mess' id='product_code_colors_error'>Vui lòng nhập mã màu sắc sản phẩm</label>");
            }
            $('#product_code_colors').focus();
            validate2 = false;
        } else {
            product_code_colors.parent().removeClass("error-mess");
            $("#product_code_colors_error").remove();
        }
    });
    // validate giá sp
    $(document).on("keyup", ".product_price", function () {
        var product_price = $(this);
        var product_id = product_price.attr("id"); // Lấy ID của input

        if (product_price.val().trim() == '' || product_price.val().trim() == 0) {
            if (!product_price.parent().hasClass("error-mess")) {
                product_price.parent().addClass("error-mess");
                product_price.parent().append(`<label class='error-mess' id='${product_id}_error'>Vui lòng nhập giá sản phẩm</label>`);
            }
            $("#" + product_id).focus();
        } else {
            product_price.parent().removeClass("error-mess");
            $("#" + product_id + "_error").remove();
        }
    });
    // validate số lượng kho
    $(document).on("keyup", ".product_stock", function () {
        var product_stock = $(this);
        var stock_id = product_stock.attr("id"); // Lấy ID của input
        if (product_stock.val().trim() == '' || product_stock.val().trim() == 0) {
            if (!product_stock.parent().hasClass("error-mess")) {
                product_stock.parent().addClass("error-mess");
                product_stock.parent().append(`<label class='error-mess' id='${stock_id}_error'>Vui lòng nhập số lượng kho</label>`);
            }
            $("#" + stock_id).focus();
        } else {
            product_stock.parent().removeClass("error-mess");
            $("#" + stock_id + "_error").remove();
            if (!isPositiveInteger(product_stock.val().trim())) {
                if (!product_stock.parent().hasClass("error-mess")) {
                    product_stock.parent().addClass("error-mess");
                    product_stock.parent().append(`<label class='error-mess' id='${stock_id}_error'>Vui lòng nhập số lượng kho lớn hơn 0</label>`);
                }
                $("#" + stock_id).focus();
            } else {
                product_stock.parent().removeClass("error-mess");
                $("#" + stock_id + "_error").remove();
            }
        }
    });

});
// VALIDATE PRODUCT
function validateProduct() {
    var product_code = $("#product_code");
    var product_name = $("#product_name");
    var product_description = $("#product_description");
    var product_price = $(".product_price");
    var category = $("#category");
    var category_code = $("#category_code");
    var category_children_code = $("#category_children_code");
    var product_brand = $("#product_brand");
    var product_sizes = $("#product_sizes");
    var product_colors = $("#product_colors");
    var product_code_colors = $("#product_code_colors");
    var product_stock = $(".product_stock");
    var product_feeship = $("#product_feeship");

    let validate1 = validate2 = validate3 = validate4 = validate5 = validate6 = validate7 = validate8 = validate9 = validate10 = validate11 = validate12 = validate13 = validate14 = validate15 = validate16 = validate17 = validate18 = true;

    if (product_code.val().trim() == '') {
        if (product_code.parent().hasClass("error-mess") == false) {
            product_code.parent().addClass("error-mess");
            product_code.parent().append("<label class='error-mess' id='product_code_error'>Vui lòng nhập mã sản phẩm</label>");
        }
        $('#product_code').focus();
        validate1 = false;
    } else {
        product_code.parent().removeClass("error-mess");
        $("#product_code_error").remove();
    }

    if (product_name.val().trim() == '') {
        if (product_name.parent().hasClass("error-mess") == false) {
            product_name.parent().addClass("error-mess");
            product_name.parent().append("<label class='error-mess' id='product_name_error'>Vui lòng nhập tên sản phẩm</label>");
        }
        $('#product_name').focus();
        validate2 = false;
    } else {
        product_name.parent().removeClass("error-mess");
        $("#product_name_error").remove();
    }

    let product_description_val = CKEDITOR.instances["product_description"].getData();
    if (product_description_val.trim() == '') {
        if (product_description.parent().hasClass("error-mess") == false) {
            product_description.parent().addClass("error-mess");
            product_description.parent().append("<label class='error-mess' id='product_description_error'>Vui lòng nhập mô tả sản phẩm</label>");
        }
        $('#product_description').focus();
        validate3 = false;
    } else {
        product_description.parent().removeClass("error-mess");
        $("#product_description_error").remove();
    }

    if (category.val().trim() == 0) {
        if (category.parent().hasClass("error-mess") == false) {
            category.parent().addClass("error-mess");
            category.parent().after("<label class='error-mess' id='category_error'>Vui lòng chọn danh mục sản phẩm</label>");
        }
        $('#category').focus();
        validate4 = false;
    } else {
        category.parent().removeClass("error-mess");
        $("#category_error").remove();
    }

    if (category_code.val().trim() == 0) {
        if (category_code.parent().hasClass("error-mess") == false) {
            category_code.parent().addClass("error-mess");
            category_code.parent().after("<label class='error-mess' id='category_code_error'>Vui lòng chọn danh mục sản phẩm</label>");
        }
        $('#category_code').focus();
        validate5 = false;
    } else {
        category_code.parent().removeClass("error-mess");
        $("#category_code_error").remove();
    }

    if (category_children_code.val().trim() == 0) {
        if (category_children_code.parent().hasClass("error-mess") == false) {
            category_children_code.parent().addClass("error-mess");
            category_children_code.parent().after("<label class='error-mess' id='category_children_code_error'>Vui lòng chọn danh mục sản phẩm</label>");
        }
        $('#category_children_code').focus();
        validate6 = false;
    } else {
        category_children_code.parent().removeClass("error-mess");
        $("#category_children_code_error").remove();
    }

    if (product_brand.val().trim() == '') {
        if (product_brand.parent().hasClass("error-mess") == false) {
            product_brand.parent().addClass("error-mess");
            product_brand.parent().append("<label class='error-mess' id='product_brand_error'>Vui lòng nhập tên thương hiệu</label>");
        }
        $('#product_brand').focus();
        validate7 = false;
    } else {
        product_brand.parent().removeClass("error-mess");
        $("#product_brand_error").remove();
    }

    if (product_sizes.val() == '' || product_sizes.val().length == 0) {
        if (product_sizes.parent().hasClass("error-mess") == false) {
            product_sizes.parent().addClass("error-mess");
            product_sizes.parent().after("<label class='error-mess' id='product_sizes_error'>Vui lòng chọn kích thước sản phẩm</label>");
        }
        $('#product_sizes').focus();
        validate8 = false;
    } else {
        product_sizes.parent().removeClass("error-mess");
        $("#product_sizes_error").remove();
    }

    if (product_colors.val().trim() == '') {
        if (product_colors.parent().hasClass("error-mess") == false) {
            product_colors.parent().addClass("error-mess");
            product_colors.parent().append("<label class='error-mess' id='product_colors_error'>Vui lòng nhập màu sắc sản phẩm</label>");
        }
        $('#product_colors').focus();
        validate9 = false;
    } else {
        product_colors.parent().removeClass("error-mess");
        $("#product_colors_error").remove();
    }

    if (product_code_colors.val().trim() == '') {
        if (product_code_colors.parent().hasClass("error-mess") == false) {
            product_code_colors.parent().addClass("error-mess");
            product_code_colors.parent().append("<label class='error-mess' id='product_code_colors_error'>Vui lòng nhập mã màu sắc sản phẩm</label>");
        }
        $('#product_code_colors').focus();
        validate10 = false;
    } else {
        product_code_colors.parent().removeClass("error-mess");
        $("#product_code_colors_error").remove();
    }

    product_stock.each(function () {
        var product_stock = $(this);
        var stock_id = product_stock.attr("id"); // Lấy ID của input

        if (product_stock.val().trim() == '' || product_stock.val().trim() == 0) {
            if (!product_stock.parent().hasClass("error-mess")) {
                product_stock.parent().addClass("error-mess");
                product_stock.parent().append(`<label class='error-mess' id='${stock_id}_error'>Vui lòng nhập số lượng kho</label>`);
            }
            validate11 = false;
            $("#" + stock_id).focus();
        } else {
            product_stock.parent().removeClass("error-mess");
            $("#" + stock_id + "_error").remove();
            if (!isPositiveInteger(product_stock.val().trim())) {
                if (!product_stock.parent().hasClass("error-mess")) {
                    product_stock.parent().addClass("error-mess");
                    product_stock.parent().append(`<label class='error-mess' id='${stock_id}_error'>Vui lòng nhập số lượng kho lớn hơn 0</label>`);
                }
                validate11 = false;
                $("#" + stock_id).focus();
            } else {
                product_stock.parent().removeClass("error-mess");
                $("#" + stock_id + "_error").remove();
            }
        }
    });

    product_price.each(function () {
        var product_price = $(this);
        var product_id = product_price.attr("id"); // Lấy ID của input

        if (product_price.val().trim() == '' || product_price.val().trim() == 0) {
            if (!product_price.parent().hasClass("error-mess")) {
                product_price.parent().addClass("error-mess");
                product_price.parent().append(`<label class='error-mess' id='${product_id}_error'>Vui lòng nhập giá sản phẩm</label>`);
            }
            validate12 = false;
            $("#" + product_id).focus();
        } else {
            product_price.parent().removeClass("error-mess");
            $("#" + product_id + "_error").remove();
        }
    });

    if ($("input[name='shipping']:checked").val().trim() == "2") {
        if (product_feeship.val().trim() == '') {
            if (product_feeship.parent().hasClass("error-mess") == false) {
                product_feeship.parent().addClass("error-mess");
                product_feeship.parent().append("<label class='error-mess' id='product_feeship_error'>Vui lòng nhập phí vận chuyển</label>");
            }
            $('#product_feeship').focus();
            validate13 = false;
        } else {
            product_feeship.parent().removeClass("error-mess");
            $("#product_feeship_error").remove();
        }
    }

    if ($(".khuyenmai_bangkm").is(":visible")) {
        var discount_type = $("#discount_type");
        var discount_price = $("#discount_price");
        var discount_start_time = $("#discount_start_time");
        var discount_end_time = $("#discount_end_time");
        if (discount_type.val().trim() == '') {
            if (discount_type.parent().hasClass("error-mess") == false) {
                discount_type.parent().addClass("error-mess");
                discount_type.parent().append("<label class='error-mess' id='discount_type_error'>Vui lòng chọn loại giảm giá</label>");
            }
            $('#discount_type').focus();
            validate14 = false;
        } else {
            discount_type.parent().removeClass("error-mess");
            $("#discount_type_error").remove();
        }

        if (discount_price.val().trim() == '') {
            if (discount_price.parent().hasClass("error-mess") == false) {
                discount_price.parent().addClass("error-mess");
                discount_price.parent().after("<label class='error-mess' id='discount_price_error'>Vui lòng nhập giá trị giảm giá</label>");
            }
            $('#discount_price').focus();
            validate15 = false;
        } else {
            discount_price.parent().removeClass("error-mess");
            $("#discount_price_error").remove();
        }

        if (discount_start_time.val().trim() == '') {
            if (discount_start_time.parent().hasClass("error-mess") == false) {
                discount_start_time.parent().addClass("error-mess");
                discount_start_time.parent().append("<label class='error-mess' id='discount_start_time_error'>Vui lòng nhập thời gian bắt đầu khuyến mãi</label>");
            }
            $('#discount_start_time').focus();
            validate16 = false;
        } else {
            discount_start_time.parent().removeClass("error-mess");
            $("#discount_start_time_error").remove();
        }

        if (discount_end_time.val().trim() == '') {
            if (discount_end_time.parent().hasClass("error-mess") == false) {
                discount_end_time.parent().addClass("error-mess");
                discount_end_time.parent().append("<label class='error-mess' id='discount_end_time_error'>Vui lòng nhập thời gian kết thúc khuyến mãi</label>");
            }
            $('#discount_end_time').focus();
            validate17 = false;
        } else {
            discount_end_time.parent().removeClass("error-mess");
            $("#discount_end_time_error").remove();
            if (discount_end_time.val().trim() < discount_start_time.val().trim()) {
                if (discount_end_time.parent().hasClass("error-mess") == false) {
                    discount_end_time.parent().addClass("error-mess");
                    discount_end_time.parent().append("<label class='error-mess' id='discount_end_time_error'>Vui lòng nhập thời gian kết thúc lớn hơn thời gian bắt đầu</label>");
                }
                $('#discount_end_time').focus();
                validate17 = false;
            } else {
                discount_end_time.parent().removeClass("error-mess");
                $("#discount_end_time_error").remove();
            }
        }
    }

    if ($(`.box_img_video[data-img="1"]`).length === 0) {
        var list_imgvideo = $(".list_imgvideo");
        if (list_imgvideo.hasClass("error-mess") == false) {
            list_imgvideo.addClass("error-mess");
            list_imgvideo.after("<label class='error-mess' id='list_imgvideo_error'>Bạn phải đăng ít nhất 1 ảnh</label>");
        }
        $('#product_images').focus();
        validate18 = false;
    } else {
        var list_imgvideo = $(".list_imgvideo");
        list_imgvideo.removeClass("error-mess");
        $("#list_imgvideo_error").remove();
    }

    if (
        validate1 == false ||
        validate2 == false ||
        validate3 == false ||
        validate4 == false ||
        validate5 == false ||
        validate6 == false ||
        validate7 == false ||
        validate8 == false ||
        validate9 == false ||
        validate10 == false ||
        validate11 == false ||
        validate12 == false ||
        validate13 == false ||
        validate14 == false ||
        validate15 == false ||
        validate16 == false ||
        validate17 == false ||
        validate18 == false
    ) {
        return false;
    }
    return true;
}
// 
function CreateProduct(e) {
    let validate = validateProduct();
    if (validate) {
        $('#loading').show();
        var product_code = $("#product_code").val().trim() || "";
        var product_name = $("#product_name").val().trim() || "";
        let product_description = CKEDITOR.instances["product_description"].getData() || "";
        var category = $("#category").val().trim() || 0;
        var category_code = $("#category_code").val().trim() || 0;
        var category_children_code = $("#category_children_code").val().trim() || 0;
        var product_brand = $("#product_brand").val().trim() || "";
        var product_sizes = $("#product_sizes").val().join(',') || "";
        var product_colors = $("#product_colors").val() || "";
        var product_code_colors = $("#product_code_colors").val() || "";
        var product_ship = $("input[name='shipping']:checked").val().trim() || 0;
        var product_feeship = $("#product_feeship").val().trim().replace(',', '') || 0;
        var discount_type = 0;
        var discount_price = 0;
        var discount_start_time = 0;
        var discount_end_time = 0;
        if ($(".khuyenmai_bangkm").is(":visible")) {
            // Loại giảm giá % / tiền mặt
            discount_type = $("#discount_type").val().trim();
            // số tiền giảm
            discount_price = $("#discount_price").val().trim().replace(',', '');
            // Ngày bắt đầu giảm giá
            discount_start_time = $("#discount_start_time").val();
            // Ngày kết thúc giảm giá
            discount_end_time = $("#discount_end_time").val();
        }
        let formdata = new FormData();
        formdata.append('product_code', product_code);
        formdata.append('product_name', product_name);
        formdata.append('product_description', product_description);
        formdata.append('category', category);
        formdata.append('category_code', category_code);
        formdata.append('category_children_code', category_children_code);
        formdata.append('product_brand', product_brand);
        formdata.append('product_sizes', product_sizes);
        formdata.append('product_colors', product_colors);
        formdata.append('product_code_colors', product_code_colors);
        formdata.append('product_ship', product_ship);
        formdata.append('product_feeship', product_feeship);
        formdata.append('discount_type', discount_type);
        formdata.append('discount_price', discount_price);
        formdata.append('discount_start_time', discount_start_time);
        formdata.append('discount_end_time', discount_end_time);
        // ===============hàm getArrayValues====================
        let getArrayValues = (selector, isText = false) => {
            let values = $(selector).map(function () {
                return isText ? $(this).text().trim() : $(this).val().trim().replace(',', '');
            }).get();
            return values.join(';');
        };
        // Nhóm phân loại product_classification
        formdata.append('product_classification', getArrayValues('.product_classification', true));
        // số lượng kho
        formdata.append('product_stock', getArrayValues('.product_stock'));
        // giá tiền sản phẩm
        formdata.append('product_price', getArrayValues('.product_price'));
        // ==========hàm appendMedia xử lý ảnh===============
        let appendMedia = (selector, key) => {
            $(selector).each(function () {
                let file = $(this).data('file');
                if (file) formdata.append(key, file);
            });
        };
        // Ảnh mới
        appendMedia('.box_img_video[data-img="1"]', 'arr_img[]');
        // Video mới
        appendMedia('.box_img_video[data-video="1"]', 'arr_video[]');

        $.ajax({
            type: "POST",
            url: "/admin/CreateProduct",
            dataType: "JSON",
            async: false,
            contentType: false,
            processData: false,
            data: formdata,
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
//
function UpdateProduct(e) {
    let validate = validateProduct();
    if (validate) {
        $('#loading').show();
        var product_id = $(e).attr("product-id");
        var product_code = $("#product_code").val().trim() || "";
        var product_name = $("#product_name").val().trim() || "";
        let product_description = CKEDITOR.instances["product_description"].getData() || "";
        var category = $("#category").val().trim() || 0;
        var category_code = $("#category_code").val().trim() || 0;
        var category_children_code = $("#category_children_code").val().trim() || 0;
        var product_brand = $("#product_brand").val().trim() || "";
        var product_sizes = $("#product_sizes").val().join(',') || "";
        var product_colors = $("#product_colors").val() || "";
        var product_code_colors = $("#product_code_colors").val() || "";
        var product_ship = $("input[name='shipping']:checked").val().trim() || 0;
        var product_feeship = $("#product_feeship").val().trim().replace(',', '') || 0;
        var discount_type = 0;
        var discount_price = 0;
        var discount_start_time = 0;
        var discount_end_time = 0;
        if ($(".khuyenmai_bangkm").is(":visible")) {
            // Loại giảm giá % / tiền mặt
            discount_type = $("#discount_type").val().trim();
            // số tiền giảm
            discount_price = $("#discount_price").val().trim().replace(',', '');
            // Ngày bắt đầu giảm giá
            discount_start_time = $("#discount_start_time").val();
            // Ngày kết thúc giảm giá
            discount_end_time = $("#discount_end_time").val();
        }
        let formdata = new FormData();
        formdata.append('product_id', product_id);
        formdata.append('product_code', product_code);
        formdata.append('product_name', product_name);
        formdata.append('product_description', product_description);
        formdata.append('category', category);
        formdata.append('category_code', category_code);
        formdata.append('category_children_code', category_children_code);
        formdata.append('product_brand', product_brand);
        formdata.append('product_sizes', product_sizes);
        formdata.append('product_colors', product_colors);
        formdata.append('product_code_colors', product_code_colors);
        formdata.append('product_ship', product_ship);
        formdata.append('product_feeship', product_feeship);
        formdata.append('discount_type', discount_type);
        formdata.append('discount_price', discount_price);
        formdata.append('discount_start_time', discount_start_time);
        formdata.append('discount_end_time', discount_end_time);
        // ===============hàm getArrayValues====================
        let getArrayValues = (selector, isText = false) => {
            let values = $(selector).map(function () {
                return isText ? $(this).text().trim() : $(this).val().trim().replace(',', '');
            }).get();
            return values.join(';');
        };
        // Nhóm phân loại product_classification
        formdata.append('product_classification', getArrayValues('.product_classification', true));
        // số lượng kho
        formdata.append('product_stock', getArrayValues('.product_stock'));
        // giá tiền sản phẩm
        formdata.append('product_price', getArrayValues('.product_price'));
        // ==========hàm appendMedia xử lý ảnh mới ===============
        let appendMedia = (selector, key) => {
            $(selector).each(function () {
                let file = $(this).data('file');
                if (file) formdata.append(key, file);
            });
        };
        // ==========hàm appendMedia xử lý ảnh xóa ===============
        let appendMediaDel = (selector, key) => {
            var arrayMediaDel = [];
            $(selector).each(function () {
                var file = $(this).attr("data_del");
                if (file != "" && file != undefined) {
                    arrayMediaDel.push(file);
                    if (file) formdata.append(key, arrayMediaDel);
                }
            });
        };
        // ==========hàm appendMedia xử lý ảnh xóa ===============
        let appendMediaOld = (selector, key) => {
            var arrayMediaOld = [];
            $(selector).each(function () {
                var file = $(this).attr("data_name");
                if (file != "" && file != undefined) {
                    arrayMediaOld.push(file);
                    if (file) formdata.append(key, arrayMediaOld);
                }
            });
        };
        // Ảnh mới
        appendMedia('.box_img_video[data-img="1"]', 'arr_img[]');
        // Video mới
        appendMedia('.box_img_video[data-video="1"]', 'arr_video[]');
        // Ảnh xóa
        appendMediaDel('.box_img_video[data-img="0"]', 'arr_img_del');
        // Video xóa
        appendMediaDel('.box_img_video[data-video="0"]', 'arr_video_del');
        // Ảnh cũ
        appendMediaOld('.box_img_video[data-new-img="0"]', 'arr_img_old');
        // Video cũ
        appendMediaOld('.box_img_video[data-new-video="0"]', 'arr_video_old');

        $.ajax({
            type: "POST",
            url: "/admin/UpdateProduct",
            dataType: "JSON",
            async: false,
            contentType: false,
            processData: false,
            data: formdata,
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

//
// khi click vao phi van chuyen thi box nhap phi van chuyen show
$(document).on('click', '.product_fee_ship', function () {
    if ($('.product_fee_ship').is(":checked")) {
        $('.box_feeshipping .enter_fee_shipping').show();
    }
})
// khi click vao mien phi van chuyen thi box nhap phi van chuyen hide
$(document).on('click', '.product_free_ship', function () {
    if ($('.product_free_ship').is(":checked")) {
        $('.box_feeshipping .enter_fee_shipping').hide();
        $('.box_feeshipping .product_feeship').val("");
    }
})
