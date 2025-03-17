<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Log;
use App\Repositories\Cart\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{
    public function getCartByUser($user_id): array
    {
        try {
            $dbcart = Cart::leftJoin('products', 'products.product_code', '=', 'carts.cart_product_code')
                ->leftJoin('manage_discounts', 'products.product_code', '=', 'manage_discounts.discount_product_code')
                ->where('carts.cart_user_id', $user_id)
                ->select(
                    'products.product_id',
                    'products.product_alias',
                    'products.product_code',
                    'products.product_name',
                    'products.product_create_time',
                    'products.product_brand',
                    'products.product_sizes',
                    'products.product_colors',
                    'products.product_classification',
                    'products.product_stock',
                    'products.product_price',
                    'products.product_images',
                    'products.product_ship',
                    'products.product_feeship',
                    'products.product_sold',
                    'manage_discounts.discount_product_code',
                    'manage_discounts.discount_active',
                    'manage_discounts.discount_type',
                    'manage_discounts.discount_start_time',
                    'manage_discounts.discount_end_time',
                    'manage_discounts.discount_price',
                    'carts.cart_product_amount',
                    'carts.cart_product_classification',
                    'carts.cart_product_code',
                    'carts.cart_id',
                )
                ->get();

            return [
                'success' => true,
                'message' => 'Lấy danh sách giỏ hàng thành công!',
                'httpCode' => 200,
                'data' => $dbcart,
            ];
        } catch (\Exception $e) {
            Log::error("Lỗi khi lấy giỏ hàng cho user ID: $user_id - " . $e->getMessage());

            return [
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi lấy giỏ hàng!',
                'httpCode' => 500,
                'data' => null,
            ];
        }
    }

    public function addToCart($user_id, $product_code, $product_amount, $product_classification): array
    {
        try {
            $cart = Cart::where([
                ['cart_product_code', $product_code],
                ['cart_user_id', $user_id],
                ['cart_product_classification', $product_classification]
            ])->first();

            if ($cart) {
                $cart->update([
                    'cart_product_amount' => $cart->cart_product_amount + $product_amount,
                    'cart_update_time' => time()
                ]);

                return [
                    'success' => true,
                    'message' => 'Cập nhật số lượng sản phẩm trong giỏ hàng thành công!',
                    'httpCode' => 200,
                    'data' => $cart,
                ];
            }

            $newCart = Cart::create([
                'cart_user_id' => $user_id,
                'cart_product_code' => $product_code,
                'cart_product_amount' => $product_amount,
                'cart_product_classification' => $product_classification,
                'cart_create_time' => time(),
                'cart_update_time' => time()
            ]);

            return [
                'success' => true,
                'message' => 'Thêm sản phẩm vào giỏ hàng thành công!',
                'httpCode' => 201,
                'data' => $newCart,
            ];
        } catch (\Exception $e) {
            Log::error("Lỗi khi thêm sản phẩm vào giỏ hàng - " . $e->getMessage());

            return [
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi thêm sản phẩm vào giỏ hàng!',
                'httpCode' => 500,
                'data' => null,
            ];
        }
    }

    public function updateCartAmount($user_id, $cart_id, $cart_product_amount): array
    {
        try {
            $cart = Cart::where('cart_id', $cart_id)
                ->where('cart_user_id', $user_id)
                ->first();

            if (!$cart) {
                return [
                    'success' => false,
                    'message' => 'Sản phẩm trong giỏ hàng không tồn tại!',
                    'httpCode' => 404,
                    'data' => null,
                ];
            }

            $cart->update([
                'cart_product_amount' => $cart_product_amount,
                'cart_update_time' => time()
            ]);

            return [
                'success' => true,
                'message' => 'Cập nhật số lượng sản phẩm thành công!',
                'httpCode' => 200,
                'data' => $cart,
            ];
        } catch (\Exception $e) {
            Log::error("Lỗi khi cập nhật số lượng giỏ hàng ID: $cart_id - " . $e->getMessage());

            return [
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi cập nhật giỏ hàng!',
                'httpCode' => 500,
                'data' => null,
            ];
        }
    }

    public function getCartItemsByIds($user_id, $cart_ids): array
    {
        try {
            $cartItems = Cart::whereIn('cart_id', $cart_ids)
                ->where('cart_user_id', $user_id)
                ->get();

            return [
                'success' => true,
                'message' => 'Lấy danh sách sản phẩm trong giỏ hàng thành công!',
                'httpCode' => 200,
                'data' => $cartItems,
            ];
        } catch (\Exception $e) {
            Log::error("Lỗi khi lấy danh sách giỏ hàng cho user ID: $user_id - " . $e->getMessage());

            return [
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi lấy danh sách sản phẩm trong giỏ hàng!',
                'httpCode' => 500,
                'data' => null,
            ];
        }
    }
}
