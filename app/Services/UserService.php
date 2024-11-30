<?php

namespace App\Services;

use App\Interfaces\DTO\UserDTO;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Models\User;

class UserService implements UserServiceInterface
{
    private UserRepositoryInterface $_userRepository;
    public function __construct(
        UserRepositoryInterface $userRepository
    )
    {
        $this->_userRepository = $userRepository;
    }
    public function registerUser(UserDTO $data):User
    {
        return $this->_userRepository->create($data);
    }
}
