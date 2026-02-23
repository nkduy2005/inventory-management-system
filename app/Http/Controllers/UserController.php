<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserFillterRequest;
use App\Http\Requests\UserRequest;
use App\services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function login(LoginRequest $request)
    {
        $result = $this->userService->login($request);
        if ($result["status"] == false) {
            return response()->json([
                "status" => $result["status"],
                "message" => $result["message"],
            ], $result["code"]);
        }
        return response()->json([
            "status" => true,
            "message" => $result["message"],
            "token" => $result["token"],
            "user" => $result["user"]
        ], $result["code"]);
    }
    public function logout(Request $request)
    {
        $result = $this->userService->logout($request);
        return response()->json([
            "status" => $result["status"],
            "message" => $result["message"]
        ], $result["code"]);
    }
    public function createUser(UserRequest $request)
    {
        $result = $this->userService->createUser($request);
        return response()->json([
            "status" => $result["status"],
            "message" => $result["message"],
            "user" => $result["user"]
        ], $result["code"]);
    }
    public function updateStatusUser(Request $request, string $id)
    {
        $result = $this->userService->updateStatusUser($request, $id);
        if ($result["status"] == false) {
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
    public function deleteUser(Request $request, string $id)
    {
        $result = $this->userService->deleteUser($request, $id);
        if ($result["status"] == false) {
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
    public function users(UserFillterRequest $request)
    {
        $result = $this->userService->users($request);
        return response()->json([
            "status" => $result["status"],
            "users" => $result["users"]
        ], $result["code"]);
    }
   
}
