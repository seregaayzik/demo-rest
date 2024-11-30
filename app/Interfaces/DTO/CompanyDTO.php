<?php

namespace App\Interfaces\DTO;

class CompanyDTO
{
    public string $title;
    public string $description;
    public string $phoneNumber;
    public int $userId;
    public function __construct(
        string $title,
        string $description,
        string $phoneNumber,
        int $userId
    )
    {
        $this->title = $title;
        $this->description = $description;
        $this->phoneNumber = $phoneNumber;
        $this->userId = $userId;
    }
}
