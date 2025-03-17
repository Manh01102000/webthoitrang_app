<?php
namespace App\Repositories\Register;

use Illuminate\Http\Request;

interface RegisterRepositoryInterface
{
    public function checkAccountRegister(string $account);
    public function accountRegister(array $data);
}
