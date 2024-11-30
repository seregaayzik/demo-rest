<?php

namespace App\Interfaces\Repositories;

use App\Models\PasswordReset;

interface PasswordResetRepositoryInterface
{
    public function addPasswordReset(string $email, string $token):PasswordReset;
    public function removeOldResetsByEmail(string $email):void;
    public function getPasswordResetByToken(string $token): PasswordReset;
    public function getEmailByToken(string $token): string;
}
