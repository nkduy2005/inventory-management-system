<?php

namespace App\services;

use App\Interfaces\ProductInterface;
use App\Interfaces\TransactionInterface;

class TransactionService
{
    private TransactionInterface $transactionInterface;
    private  ProductInterface $productInterface;
    public function __construct(TransactionInterface $transactionInterface, ProductInterface $productInterface)
    {
        $this->transactionInterface = $transactionInterface;
        $this->productInterface = $productInterface;
    }
    public function transactions()
    {
        $transactions = $this->transactionInterface->transactions();
        return [
            "status" => true,
            "transactions" => $transactions,
            "code" => 200
        ];
    }
    public function import($request)
    {
        $product = $this->transactionInterface->import($request);
        $this->productInterface->incrementProductQuantity($product);
        return [
            "status" => true,
            "message" => "Import created successfully",
            "product" => $product,
            "code" => 201
        ];
    }
    public function export($request)
    {
        $product = $this->productInterface->findProductById($request->product_id);
        if ($request->quantity > $product->quantity) {
            return [
                "status" => false,
                "message" => "Not enough stock",
                "code" => 400
            ];
        }
        $affect = $this->productInterface->decrementProductQuantity($request->product_id, $request->quantity);
        if ($affect == 0) {
            return [
                "status" => false,
                "message" => "Not enough stock",
                "code" => 400
            ];
        }
        $product = $this->transactionInterface->export($request);
        return [
            "status" => true,
            "message" => "Export created successfully",
            "product" => $product,
            "code" => 201
        ];
    }
}
