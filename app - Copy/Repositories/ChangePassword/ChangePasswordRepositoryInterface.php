<?php

namespace App\Repositories\ChangePassword;

interface ChangePasswordRepositoryInterface
{
    public function checkPasswordOld($user, $emp_oldpassword);
    public function checkPasswordNew($user, $emp_password);
    public function changePassword($user, $emp_password);
}
