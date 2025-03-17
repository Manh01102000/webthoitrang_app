<?php

namespace App\Repositories\product;
use Illuminate\Http\Request;
use App\Models\Admin; // Import model Admin
use App\Models\product; // Import model product
use App\Models\manage_discount; // Import model manage_discount

// Implement interface và xử lý CRUD.

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll()
    {
        return Product::all();
    }

    public function findById($id)
    {
        return Product::findOrFail($id);
    }

    public function create(array $data)
    {
        try {
            $admin_id = session('admin_id');
            if (!isset($admin_id) || $admin_id == 0) {
                return [
                    'success' => false,
                    'message' => 'Đăng nhập tài khoản đi',
                    'httpCode' => 400,
                ];
            }

            $dataadmin = Admin::where('admin_id', $admin_id)->first();
            if (!$dataadmin) {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy tài khoản quản trị',
                    'httpCode' => 404,
                ];
            }

            // Lấy dữ liệu từ mảng `$data`
            $product_code = $data["product_code"] ?? null;
            $product_name = $data["product_name"] ?? null;
            $product_alias = $data["product_name"] ? replaceTitle($data["product_name"])  : null;
            $product_description = $data["product_description"] ?? null;
            $category = $data["category"] ?? null;
            $category_code = $data["category_code"] ?? null;
            $category_children_code = $data["category_children_code"] ?? null;
            $product_brand = $data["product_brand"] ?? null;
            $product_sizes = $data["product_sizes"] ?? null;
            $product_colors = $data["product_colors"] ?? null;
            $product_code_colors = $data["product_code_colors"] ?? null;
            $product_ship = $data["product_ship"] ?? null;
            $product_feeship = $data["product_feeship"] ?? null;
            $discount_type = $data["discount_type"] ?? null;
            $discount_price = $data["discount_price"] ?? null;
            $discount_start_time = isset($data["discount_start_time"]) ? strtotime($data["discount_start_time"]) : null;
            $discount_end_time = isset($data["discount_end_time"]) ? strtotime($data["discount_end_time"]) : null;
            $product_classification = $data["product_classification"] ?? null;
            $product_stock = $data["product_stock"] ?? null;
            $product_price = $data["product_price"] ?? null;

            // Xử lý ảnh và video
            $time = time();
            $str_new_img = isset($data['arr_img']) ? $this->handleImages($data['arr_img'], $time) : '';
            $str_new_video = isset($data['arr_video']) ? $this->handleVideos($data['arr_video'], $time) : '';

            // Lưu vào database
            product::create([
                'product_code' => $product_code,
                'product_admin_id' => $admin_id,
                'product_name' => $product_name,
                'product_alias' => $product_alias,
                'product_active' => 0,
                'product_description' => $product_description,
                'product_unit' => '',
                'category' => $category,
                'category_code' => $category_code,
                'category_children_code' => $category_children_code,
                'product_brand' => $product_brand,
                'product_sizes' => $product_sizes,
                'product_price' => $product_price,
                'product_stock' => $product_stock,
                'product_classification' => $product_classification,
                'product_colors' => $product_colors,
                'product_code_colors' => $product_code_colors,
                'product_images' => $str_new_img,
                'product_videos' => $str_new_video,
                'product_ship' => $product_ship,
                'product_feeship' => $product_feeship,
                'product_create_time' => time(),
                'product_update_time' => time(),
            ]);

            // Bảng quản lý khuyến mãi
            manage_discount::create([
                'discount_admin_id' => $admin_id,
                'discount_product_code' => $product_code,
                'discount_name' => "",
                'discount_description' => "",
                'discount_active' => 1,
                'discount_type' => $discount_type,
                'discount_price' => $discount_price,
                'discount_start_time' => $discount_start_time,
                'discount_end_time' => $discount_end_time,
                'discount_create_time' => time(),
                'discount_update_time' => time(),
            ]);

            return [
                'success' => true,
                'message' => 'Thêm dữ liệu sản phẩm thành công',
                'httpCode' => 200,
            ];
        } catch (\Exception $e) {
            \Log::error("Lỗi khi Thêm dữ liệu sản phẩm - " . $e->getMessage()); // Ghi log lỗi
            return [
                'success' => false,
                'message' => 'Lỗi khi Thêm dữ liệu sản phẩm ID!',
                'httpCode' => 500,
            ];
        }
    }

    public function update(array $data)
    {
        try {
            // var_dump($data);
            $admin_id = session('admin_id');
            if (!isset($admin_id) || $admin_id == 0) {
                return [
                    'success' => false,
                    'message' => 'Đăng nhập tài khoản đi',
                    'httpCode' => 400,
                ];
            }

            $dataadmin = Admin::where('admin_id', $admin_id)->first();
            if (!$dataadmin) {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy tài khoản quản trị',
                    'httpCode' => 404,
                ];
            }

            // Lấy dữ liệu từ mảng `$data`
            $product_id = $data["product_id"];
            $product_name = $data["product_name"] ?? null;
            $product_alias = $data["product_name"] ? replaceTitle($data["product_name"])  : null;
            $product_description = $data["product_description"] ?? null;
            $category = $data["category"] ?? null;
            $category_code = $data["category_code"] ?? null;
            $category_children_code = $data["category_children_code"] ?? null;
            $product_brand = $data["product_brand"] ?? null;
            $product_sizes = $data["product_sizes"] ?? null;
            $product_colors = $data["product_colors"] ?? null;
            $product_code_colors = $data["product_code_colors"] ?? null;
            $product_ship = $data["product_ship"] ?? null;
            $product_feeship = $data["product_feeship"] ?? null;
            $discount_type = $data["discount_type"] ?? null;
            $discount_price = $data["discount_price"] ?? null;
            $discount_start_time = isset($data["discount_start_time"]) ? strtotime($data["discount_start_time"]) : null;
            $discount_end_time = isset($data["discount_end_time"]) ? strtotime($data["discount_end_time"]) : null;
            $product_classification = $data["product_classification"] ?? null;
            $product_stock = $data["product_stock"] ?? null;
            $product_price = $data["product_price"] ?? null;
            // Ảnh đã bị xóa bên font-end
            $arr_img_del = $data["arr_img_del"] ?? null;
            // Video đã bị xóa bên font-end
            $arr_video_del = $data["arr_video_del"] ?? null;
            // Ảnh cũ không bị xóa bên font-end
            $arr_img_old = $data["arr_img_old"] ?? null;
            // Video cũ không bị xóa bên font-end
            $arr_video_old = $data["arr_video_old"] ?? null;
            // Lấy dữ liệu của product
            $dataproduct = product::where('product_id', $product_id)->first();

            if (!$dataproduct) {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy sản phẩm',
                    'httpCode' => 404,
                ];
            }

            $time = $dataproduct->toArray()['product_create_time'];
            $product_code = $dataproduct->toArray()["product_code"] ?? null;
            // Xử lý unlink những ảnh bị xóa
            if (!empty($arr_img_del)) {
                $this->deleteFiles($arr_img_del, $time);
            }
            // Xử lý unlink những video bị xóa
            if (!empty($arr_video_del)) {
                $this->deleteFiles($arr_video_del, $time);
            }

            // Xử lý ảnh mới + ảnh cũ được giữ lại
            $arr_img_old_list = isset($arr_img_old) ? explode(',', $arr_img_old) : [];
            $arr_img_new_list = isset($data['arr_img']) ? explode(',', $this->handleImages($data['arr_img'], $time)) : [];
            $result_img_array = array_unique(array_merge($arr_img_old_list, $arr_img_new_list));
            $result_img_str = implode(',', $result_img_array);

            // Xử lý video + video cũ được giữ lại
            $arr_video_old_list = isset($arr_video_old) ? explode(',', $arr_video_old) : [];
            $arr_video_new_list = isset($data['arr_video']) ? explode(',', $this->handleVideos($data['arr_video'], $time)) : [];
            $result_video_array = array_unique(array_merge($arr_video_old_list, $arr_video_new_list));
            $result_video_str = implode(',', $result_video_array);

            // // Lưu vào database
            product::where("product_id", $product_id)->update([
                'product_admin_id' => $admin_id,
                'product_name' => $product_name,
                'product_alias' => $product_alias,
                'product_description' => $product_description,
                'product_unit' => '',
                'category' => $category,
                'category_code' => $category_code,
                'category_children_code' => $category_children_code,
                'product_brand' => $product_brand,
                'product_sizes' => $product_sizes,
                'product_price' => $product_price,
                'product_stock' => $product_stock,
                'product_classification' => $product_classification,
                'product_colors' => $product_colors,
                'product_code_colors' => $product_code_colors,
                'product_images' => $result_img_str,
                'product_videos' => $result_video_str,
                'product_ship' => $product_ship,
                'product_feeship' => $product_feeship,
                'product_update_time' => time(),
            ]);

            // Bảng quản lý khuyến mãi
            manage_discount::where('discount_product_code', $product_code)->update([
                'discount_admin_id' => $admin_id,
                'discount_name' => "",
                'discount_description' => "",
                'discount_active' => 1,
                'discount_type' => $discount_type,
                'discount_price' => $discount_price,
                'discount_start_time' => $discount_start_time,
                'discount_end_time' => $discount_end_time,
                'discount_update_time' => time(),
            ]);
            return [
                'success' => true,
                'message' => 'Cập nhật dữ liệu sản phẩm thành công',
                'httpCode' => 200,
            ];
        } catch (\Exception $e) {
            \Log::error("Lỗi khi Cập nhật dữ liệu sản phẩm ID: $product_id - " . $e->getMessage()); // Ghi log lỗi
            return [
                'success' => false,
                'message' => 'Lỗi khi Cập nhật dữ liệu sản phẩm ID!',
                'httpCode' => 500,
            ];
        }
    }

    // Xóa sản phẩm
    public function delete($id)
    {
        try {
            $data = Product::find($id); // Tìm sản phẩm theo ID

            if (!$data) {
                return [
                    'success' => false,
                    'message' => 'Sản phẩm không tồn tại!',
                    'httpCode' => 404,
                ];
            }

            $product_code = $data->product_code; // Lấy mã sản phẩm
            $data->delete(); // Xóa sản phẩm
            manage_discount::where('discount_product_code', $product_code)->delete(); // Xóa giảm giá liên quan

            return [
                'success' => true,
                'message' => 'Xóa sản phẩm thành công!',
                'httpCode' => 200,
            ];
        } catch (\Exception $e) {
            \Log::error("Lỗi khi xóa sản phẩm ID: $id - " . $e->getMessage()); // Ghi log lỗi
            return [
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi xóa sản phẩm!',
                'httpCode' => 500,
            ];
        }
    }

    // active sản phẩm
    public function active($id)
    {
        try {
            $data = product::where('product_id', $id)->first();
            if (!$data) {
                return [
                    'success' => false,
                    'message' => 'Sản phẩm không tồn tại!',
                    'httpCode' => 404,
                ];
            }
            $dataprod = $data->toArray()['product_active'];
            $dataprod == 0 ? $active = 1 : $active = 0;
            product::where('product_id', $id)->update([
                'product_active' => $active,
            ]);
            return [
                'success' => true,
                'message' => $active == 1 ? "Hiện sản phẩm thành công!" : "Ẩn sản phẩm thành công!",
                'httpCode' => 200,
            ];
        } catch (\Exception $e) {
            \Log::error("Lỗi khi active sản phẩm ID: $id - " . $e->getMessage()); // Ghi log lỗi
            return [
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi active sản phẩm!',
                'httpCode' => 500,
            ];
        }
    }

    // Hàm xử lý ảnh
    private function handleImages($images, $time)
    {
        if (!$images)
            return '';

        $list_arr_image = [];
        foreach ($images as $uploadedFile) {
            if ($uploadedFile instanceof \Illuminate\Http\UploadedFile) {
                $name = 'image_prod_' . md5($uploadedFile->getClientOriginalName() . time()) . '.' . $uploadedFile->getClientOriginalExtension();
                $dir = getUrlImageVideoProduct($time, 1);
                $uploadedFile->move($dir, $name);
                $list_arr_image[] = $name;
            }
        }
        return implode(",", $list_arr_image);
    }

    // Hàm xử lý video
    private function handleVideos($videos, $time)
    {
        if (!$videos)
            return '';

        $list_arr_video = [];
        foreach ($videos as $uploadedFile) {
            if ($uploadedFile instanceof \Illuminate\Http\UploadedFile) {
                $name = 'video_prod_' . md5($uploadedFile->getClientOriginalName() . time()) . '.' . $uploadedFile->getClientOriginalExtension();
                $dir = getUrlImageVideoProduct($time, 2);
                $uploadedFile->move($dir, $name);
                $list_arr_video[] = $name;
            }
        }
        return implode(",", $list_arr_video);
    }

    // hàm xử lý xóa file
    private function deleteFiles($fileList, $time)
    {
        if (empty($fileList))
            return;

        $fileArray = explode(',', $fileList);
        foreach ($fileArray as $file) {
            $url = getUrlImageVideoProduct($time, 1) . $file;
            if (is_file($url)) {
                unlink($url);
            } else {
                error_log("File không tồn tại: " . $url);
            }
        }
    }
}
