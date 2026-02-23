<?php

namespace App\Interfaces;

interface ProductInterface
{
    public function products($request);
    public function createProduct($request);
    public function updateProduct($request, $id);
    public function deleteProduct($id);
    public function findProductById($id);
    public function findProductExistsTransaction($id);
    public function incrementProductQuantity($data);
    public function decrementProductQuantity($productId, $productQuantity);
    public function getProductById($id);
}
