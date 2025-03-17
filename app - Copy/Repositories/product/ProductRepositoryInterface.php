<?php
namespace App\Repositories\product;
// Định nghĩa các phương thức CRUD mà mọi Repository phải tuân theo.
interface ProductRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function create(array $data);
    public function update(array $data);
    public function delete($id);
    public function active($id);
}