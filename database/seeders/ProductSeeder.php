<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = File::get(path: "database/json/product.json");
        $products = collect(json_decode($file));
        $products->each(function ($product) {
            Product::create([
                "name" => $product->name,
                "skud" => $product->skud,
                "quantity" => $product->quantity
            ]);
        });
    }
}
