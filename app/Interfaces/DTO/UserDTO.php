<?php

namespace App\Interfaces\DTO;

class UserDTO
{
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $password;
    public string $phoneNumber;
    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $phoneNumber
    )
    {
        $this->phoneNumber = $phoneNumber;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
    }
}
