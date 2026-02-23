<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductService $productService;
    public function __construct(ProductService $producrService)
    {
        $this->productService = $producrService;
    }
    public function products(Request $request)
    {
        $result = $this->productService->products($request);
        return response()->json([
            "status" => $result["status"],
            "products" => $result["products"]
        ], $result["code"]);
    }
    public function createProduct(ProductRequest $request)
    {
        $result = $this->productService->createProduct($request);
        return response()->json([
            "status" => $result["status"],
            "message" => $result["message"],
            "product" => $result["code"]
        ], $result["code"]);
    }
    public function updateProduct(ProductRequest $request, string $id)
    {
        $result = $this->productService->updateProduct($request, $id);
        if ($result["code"] == false) {
            return response()->json([
                "status" => $result["status"],
                "message" => $result["message"]
            ], $result["code"]);
        }
        return response()->json([
            "status" => $result["status"],
            "message" => $result["message"]
        ], $result["code"]);
    }
    public function deleteProduct(string $id)
    {
        $result = $this->productService->deleteProduct($id);
        if ($result["code"] == false) {
            return response()->json([
                "status" => $result["status"],
                "message" => $result["message"]
            ], $result["code"]);
        }
        return response()->json([
            "status" => $result["status"],
            "message" => $result["message"]
        ], $result["code"]);
    }
    public function getProductById($id)
    {
        $result = $this->productService->getProductById($id);
        if ($result == false) {
            return response()->json([
                "status" => $result["status"],
                "message" => $result["message"]
            ], $result["code"]);
        }
        return response()->json([
            "status" => $result["status"],
            "product" => $result["product"]
        ], $result["code"]);
    }
    public function productsStaff(Request $request)
    {
        $result = $this->productService->products($request);
        return response()->json([
            "status" => $result["status"],
            "products" => $result["products"]
        ], $result["code"]);
    }
}
