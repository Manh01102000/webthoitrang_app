<?php

namespace Database\Factories;

use App\Models\product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class ProductFactory extends Factory
{
    protected $model = product::class;
    public function definition(): array
    {
        $product_sizes = implode(',', $this->faker->randomElements(['S', 'M', 'L', 'XL'], rand(1, 4)));
        $product_colors = implode(',', $this->faker->randomElements(['Red', 'Blue', 'Green', 'Black', 'White'], rand(1, 3)));
        $product_images = implode(',', [
            $this->faker->imageUrl(640, 480, 'fashion'),
            $this->faker->imageUrl(640, 480, 'fashion')
        ]);

        return [
            'product_admin_id' => $this->faker->numberBetween(1, 100), // ID admin ngẫu nhiên từ 1 - 100
            'product_name' => $this->faker->words(3, true), // Tạo tên sản phẩm ngẫu nhiên
            'product_description' => $this->faker->sentence(), // Sinh mô tả ngẫu nhiên
            'product_price' => $this->faker->randomFloat(2, 10, 1000), // Giá từ 10 - 1000
            'product_category' => $this->faker->numberBetween(1, 100), // ID danh mục từ 1 - 100
            'product_brand' => $this->faker->word(), // Tạo tên thương hiệu ngẫu nhiên
            'product_sizes' => $product_sizes,
            'product_colors' => $product_colors,
            'product_images' => $product_images, // Mảng URL ảnh giả
            'product_stock' => $this->faker->numberBetween(0, 100), // Số lượng tồn kho từ 0 - 100
            'product_create_time' => $this->faker->unixTime(), // Thời gian tạo (timestamp)
            'product_update_time' => $this->faker->unixTime(), // Thời gian cập nhật (timestamp)
        ];
    }
}
