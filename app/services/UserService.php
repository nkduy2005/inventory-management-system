<?php

namespace App\services;

use App\Interfaces\ProductInterface;
use App\interfaces\UserInterface;
use Illuminate\Support\Facades\Auth;

class UserService
{
    private $userInterface;
   
    public function __construct(UserInterface $userInterface, ProductInterface $productInterface)
    {
        $this->userInterface = $userInterface;
     
    }
    public function login($request)
    {

        if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {
            return [
                "status" => true,
                "message" => "Login Successfully",
                "code" => 200,
                "token" => Auth::user()->createToken("API Token")->plainTextToken,
                "user" => $request->user()
            ];
        } else {
            return [
                "status" => false,
                "message" => "Login failed",
                "code" => 401,
            ];
        }
    }
    public function logout($request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return [
            "status" => true,
            "message" => "Logout successfully",
            "code" => 200
        ];
    }
    public function createUser($request)
    {
        $user = $this->userInterface->createUser($request);
        return [
            "status" => true,
            "code" => 201,
            "message" => "create user successfully",
            "user" => $user
        ];
    }
    public function updateStatusUser($request, $id)
    {
        $user = $this->userInterface->findUserById($id);
        if (!$user) {
            return [
                "status" => false,
                "message" => "User not found",
                "code" => 404
            ];
        }
        if ($user->role == "admin") {
            return [
                "status" => false,
                "message" => "You can not change admin's status ",
                "code" => 400
            ];
        }
        $this->userInterface->updateStatusUser($id, $user->is_active == "active" ? "inactive" : "active");
        return [
            "status" => true,
            "message" => "You updated user's status sucessfully ",
            "code" => 200
        ];
    }
    public function deleteUser($request, $id)
    {
        $user = $this->userInterface->findUserById($id);
        if (!$user) {
            return [
                "status" => false,
                "message" => "User not found",
                "code" => 404
            ];
        }
        if ($user->role == "admin") {
            return [
                "status" => false,
                "message" => "You can not delete role admin ",
                "code" => 400
            ];
        }
        $exists = $this->userInterface->existsUserHaveTransaction($id);
        if ($exists) {
            return [
                "status" => false,
                "message" => "You can not delete user had transaction",
                "code" => 400
            ];
        }
        $this->userInterface->deleteUser($id);
        return [
            "status" => true,
            "message" => "You deleted user sucessfully ",
            "code" => 200
        ];
    }
    public function users($request)
    {
        $users = $this->userInterface->users($request);
        return [
            "status" => true,
            "users" => $users,
            "code" => 200
        ];
    }
   
}
