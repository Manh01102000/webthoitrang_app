<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('product_id');
            // id admin nhập
            $table->integer('product_admin_id')->default('0');
            // mã sản phẩm
            $table->string('product_code')->nullable();
            // Tên sản phẩm
            $table->string('product_name')->nullable();
            // Mô tả sản phẩm
            $table->string('product_description')->nullable();
            // đơn vị tiền
            $table->integer('product_unit')->default('0');
            // 1: hiển thị / 0: ẩn sản phẩm
            $table->integer('product_active')->default('0');
            // Loại sản phẩm (thời trang nam, nữ, bé trai, bé gái)
            $table->int('category')->default('0');
            // Loại sản phẩm (danh mục cha Áo, Quần, Giày, Túi xách, v.v.)
            $table->int('category_code')->default('0');
            // Loại sản phẩm (danh mục con áo sơ mi nam, áo sơ mi nữ, ....)
            $table->int('category_children_code')->default('0');
            // Thương hiệu
            $table->string('product_brand')->nullable();
            // Giá bán
            $table->text('product_price')->nullable();
            // Các kích cỡ có sẵn
            $table->text('product_sizes')->nullable();
            // Số lượng tồn kho
            $table->text('product_stock')->nullable();
            // phân loại sản phẩm
            $table->text('product_classification')->nullable();
            // Các màu có sẵn 
            $table->text('product_colors')->nullable();
            // Các mã màu có sẵn 
            $table->string('product_code_colors')->nullable();
            // Danh sách ảnh sản phẩm
            $table->text('product_images')->nullable();
            // Danh sách video sản phẩm
            $table->text('product_videos')->nullable();
            // 1: miễn phí vận chuyển, 2: phí vận chuyển
            $table->integer('product_ship')->default('0');
            // phí vận chuyển
            $table->string('product_feeship')->nullable();
            // thống kê số lượt bán của sản phẩm
            $table->integer('product_sold')->default('0');
            // Ngày tạo
            $table->integer('product_create_time')->default('0');
            // Ngày cập nhật
            $table->integer('product_update_time')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
;
