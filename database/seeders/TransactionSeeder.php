<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = File::get(path: "database/json/transaction.json");
        $transactions = collect(json_decode($file));
        $transactions->each(function ($transaction) {
            Transaction::create([
                "product_id" => $transaction->product_id,
                "user_id" => $transaction->user_id,
                "quantity" => $transaction->quantity,
                "type" => $transaction->type
            ]);
        });
    }
}
