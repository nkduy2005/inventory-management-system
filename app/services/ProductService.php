<?php

namespace App\services;

use App\Interfaces\ProductInterface;

class ProductService
{
    private ProductInterface $productInterface;
    public function __construct(ProductInterface $productInterface)
    {
        $this->productInterface = $productInterface;
    }
    public function products($request)
    {
        $products = $this->productInterface->products($request);
        return [
            "status" => true,
            "products" => $products,
            "code" => 200
        ];
    }
    public function createProduct($request)
    {
        $product = $this->productInterface->createProduct($request);
        return [
            "status" => true,
            "message" => "create product successfully",
            "product" => $product,
            "code" => 201
        ];
    }
    public function updateProduct($request, $id)
    {
        $product = $this->productInterface->findProductById($id);
        if (!$product) {
            return [
                "status" => false,
                "message" => "Product not found",
                "code" => 404
            ];
        }
        $updateProduct = $this->productInterface->updateProduct($request, $id);
        return [
            "status" => true,
            "message" => "update product successfully",
            "code" => 200
        ];
    }
    public function deleteProduct($id)
    {
        $product = $this->productInterface->findProductById($id);
        if (!$product) {
            return [
                "status" => false,
                "message" => "Product not found",
                "code" => 404
            ];
        }
        $exists = $this->productInterface->findProductExistsTransaction($id);
        if ($exists) {
            return [
                "status" => false,
                "message" => "You can delete product has transactions",
                "code" => 403
            ];
        }
        $deleteProduct = $this->productInterface->deleteProduct($id);
        return [
            "status" => true,
            "message" => "Delete product successfully",
            "code" => 200
        ];
    }
    public function getProductById($id)
    {
        $product = $this->productInterface->getProductById($id);
        if (!$product) {
            return [
                "status" => false,
                "message" => "Product Not Found",
                "code" => 404
            ];
        }
        return [
            "status" => true,
            "product" => $product,
            "code" => 200
        ];
    }
}
