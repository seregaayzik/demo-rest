<?php

namespace App\Repositories;

use App\Interfaces\DTO\UserDTO;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function findByEmail(string $email): User
    {
        return User::where('email', $email)->first();
    }
    public function create(UserDTO $data): User
    {
        return User::create([
            'first_name' => $data->firstName,
            'last_name' => $data->lastName,
            'email' => $data->email,
            'password' => Hash::make($data->password),
            'phone_number' => $data->phoneNumber,
        ]);
    }
    public function updatePasswordByEmail(string $email, string $password): void
    {
        $user = User::where('email', $email)->firstOrFail();
        $user->password = Hash::make($password);
        $user->save();
    }
}
