<?php

namespace App\Interfaces\Services;

interface RestorePasswordServiceInterface
{
    public function requestForNewPassword(string $email): string;
    public function setNewPassword(string $token, string $newPassword): void;
}
