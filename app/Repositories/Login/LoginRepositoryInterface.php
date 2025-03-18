<?php
namespace App\Repositories\Login;

interface LoginRepositoryInterface
{
    public function login($emp_account, $emp_password);
}