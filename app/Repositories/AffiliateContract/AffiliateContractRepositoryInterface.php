<?php

namespace App\Repositories\AffiliateContract;

interface AffiliateContractRepositoryInterface
{
    public function createContract(array $data);
    public function deleteContract($id);
}
