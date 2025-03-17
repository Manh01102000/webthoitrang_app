<?php

namespace App\Repositories\Cart;

interface CartRepositoryInterface
{
    public function getCartByUser($user_id);
    public function addToCart($user_id, $product_code, $product_amount, $product_classification);
    public function updateCartAmount($user_id, $cart_id, $cart_product_amount);
    public function getCartItemsByIds($user_id, $cart_ids);
}
