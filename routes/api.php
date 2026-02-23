<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRoleAdmin;
use App\Http\Middleware\CheckStaffRole;
use App\Http\Middleware\CheckStatus;
use Illuminate\Support\Facades\Route;


Route::post('/login', [UserController::class, "login"]);

Route::middleware("auth:sanctum")->group(function () {
    Route::get("/logout", [UserController::class, "logout"]);
});

Route::middleware(["auth:sanctum", CheckRoleAdmin::class])->group(function () {
    Route::get("/users", [UserController::class, "users"]);
    Route::post("/create-user", [UserController::class, "createUser"]);
    Route::put("/update-status-user/{id}", [UserController::class, "updateStatusUser"]);
    Route::delete('/delete-user/{id}', [UserController::class, "deleteUser"]);
    Route::post("/product", [ProductController::class, "createProduct"]);
    Route::get("/products", [ProductController::class, "products"]);
    Route::get("/product/{id}", [ProductController::class, "getProductById"]);
    Route::put("/product/{id}", [ProductController::class, "updateProduct"]);
    Route::delete('/product/{id}', [ProductController::class, "deleteProduct"]);
    Route::get("/transactions", [TransactionController::class, "transactions"]);
});

Route::middleware(["auth:sanctum", CheckStaffRole::class, CheckStatus::class])->group(function () {
    Route::post("/transaction/import", [TransactionController::class, "import"]);
    Route::post("/transaction/export", [TransactionController::class, "export"]);
    Route::get("/products-staff", [ProductController::class, "productsStaff"]);
});
