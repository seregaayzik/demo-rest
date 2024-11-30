<?php

namespace App\Interfaces\Repositories;

use App\Interfaces\DTO\UserDTO;
use App\Models\User;

interface UserRepositoryInterface
{
    public function findByEmail(string $email):User;
    public function create(UserDTO $data): User;
    public function updatePasswordByEmail(string $email, string $password): void;
}
