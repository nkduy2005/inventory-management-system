<?php

namespace App\reposities;

use App\interfaces\UserInterface;
use App\Models\User;

class UserReposity implements UserInterface
{
    public function createUser($data)
    {
        return User::create([
            "email" => $data->email,
            "password" => $data->password,
            "name" => $data->name
        ]);
    }
    public function updateStatusUser($id, $status)
    {
        return User::find($id)->update([
            "is_active" => $status
        ]);
    }
    public function existsUserHaveTransaction($id)
    {
        return User::find($id)->transactions()->exists();
    }
    public function findUserById($id)
    {
        return User::find($id);
    }
    public function deleteUser($id)
    {
        return User::find($id)->delete();
    }
    public function users($request)
    {
        return User::when($request->search, function ($query, $value) {
            $query->where(function ($q) use ($value) {
                $q->where("name", "like", "%{$value}%")
                    ->orWhere("email", "like", "%{$value}%");
            });
        })
            ->when($request->status, function ($query, $value) {
                $query->where("is_active", $value);
            })
            ->orderBy("created_at", "desc")
            ->paginate(15);
    }
   
}
