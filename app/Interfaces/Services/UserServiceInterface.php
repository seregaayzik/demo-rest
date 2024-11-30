<?php

namespace App\Interfaces\Services;

use App\Interfaces\DTO\UserDTO;
use App\Models\User;

interface UserServiceInterface
{
    public function registerUser(UserDTO $data): User;
}
