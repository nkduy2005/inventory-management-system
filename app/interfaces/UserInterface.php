<?php

namespace App\interfaces;

interface UserInterface
{
    public function createUser($data);
    public function updateStatusUser($id, $status);
    public function existsUserHaveTransaction($id);
    public function findUserById($id);
    public function deleteUser($id);
    public function users($request);
   
}
