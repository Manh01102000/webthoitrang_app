<?php
namespace App\Repositories\ManagementOrder;
interface ManagementOrderRepositoryInterface
{
    public function getUserOrders($userId, $page, $limit, $offset);
    public function getOrderStatistics($userId);
    public function ChangeStatusOrder(array $data);
}