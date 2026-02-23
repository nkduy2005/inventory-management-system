<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private TransactionService $transactionService;
    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }
    public function transactions()
    {
        $result = $this->transactionService->transactions();
        return response()->json([
            "status" => $result["status"],
            "transactions" => $result["transactions"]
        ], $result["code"]);
    }
    public function import(ImportRequest $request)
    {
        $result = $this->transactionService->import($request);
        return response()->json([
            "status" => $result["status"],
            "message" => $result["message"],
            "product" => $result["product"]
        ], $result["code"]);
    }
    public function export(ImportRequest $request)
    {
        $result = $this->transactionService->export($request);
        if ($result["status"] == false) {
            return response()->json([
                "status" => $result["status"],
                "message" => $result["message"]
            ], $result["code"]);
        }
        return response()->json([
            "status" => $result["status"],
            "message" => $result["message"],
            "product" => $result["product"]
        ], $result["code"]);
    }
}
