<?php
namespace App\Repositories\ComfirmOrder;

interface ConfirmOrderRepositoryInterface
{
    public function AddDataInforship(array $data);
    public function SetShipDefalt(array $data);
    public function PayMent(array $data);
}