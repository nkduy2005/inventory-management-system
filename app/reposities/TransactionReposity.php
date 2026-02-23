<?php

namespace App\reposities;

use App\Interfaces\TransactionInterface;
use App\Models\Transaction;

class TransactionReposity implements TransactionInterface
{

    public function transactions()
    {
        return Transaction::with("product")->with("user")->orderBy("id", "desc")->paginate(15);
    }
     public function import($request)
    {
        return $request->user()->transactions()->create([
            "product_id" => $request->product_id,
            "quantity" => $request->quantity,
            "type" => "import"
        ]);
    }
    public function export($request)
    {
        return $request->user()->transactions()->create([
            "product_id" => $request->product_id,
            "quantity" => $request->quantity,
            "type" => "export"
        ]);
    }
}
