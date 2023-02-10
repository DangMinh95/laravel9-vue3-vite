<?php

namespace App\Repositories\Product;

interface ProductRepositoryInterface
{
    public function search($params);

    public function getProduct($id);

    public function createProduct($params);

    public function updateProduct($params, $id);

    public function deleteProduct($id);

    public function getAllProduct();
}
