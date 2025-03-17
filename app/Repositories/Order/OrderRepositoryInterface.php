<?php
namespace App\Repositories\Order;
interface OrderRepositoryInterface
{
    public function confirmOrder($user_id, $arr_cart_id, $arr_unitprice, $arr_total_price, $arr_feeship);
    public function confirmOrderBuyNow($user_id, $unitprice, $total_price, $feeship, $product_code, $product_amount, $product_classification);
}
