<?php

namespace App\reposities;

use App\Interfaces\ProductInterface;
use App\Models\Product;

class ProductReposity implements ProductInterface
{
    public function products($request)
    {
        return Product::orderBy("id", "desc")->paginate(15);
    }
    public function createProduct($request)
    {
        return Product::create([
            "name" => $request->name,
            "skud" => $request->skud
        ]);
    }
    public function updateProduct($request, $id)
    {
        return Product::find($id)->update([
            "name" => $request->name,
            "skud" => $request->skud
        ]);
    }
    public function deleteProduct($id)
    {
        return Product::find($id)->delete();
    }
    public function findProductById($id)
    {
        return Product::find($id);
    }
    public function findProductExistsTransaction($id)
    {
        return Product::find($id)->transactions()->exists();
    }
    public function incrementProductQuantity($data)
    {
        return Product::find($data->product_id)->increment("quantity", $data->quantity);
    }
    public function decrementProductQuantity($productId, $productQuantity)
    {
        return Product::where("id", $productId)->where("quantity", ">=", $productQuantity)->decrement("quantity", $productQuantity);
    }
    public function getProductById($id)
    {
        return Product::find($id);
    }
}
