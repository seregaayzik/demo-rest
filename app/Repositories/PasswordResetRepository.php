<?php

namespace App\Repositories;

use App\Interfaces\Repositories\PasswordResetRepositoryInterface;
use App\Models\PasswordReset;

class PasswordResetRepository implements PasswordResetRepositoryInterface
{
    public function addPasswordReset(string $email, string $token): PasswordReset
    {
        return PasswordReset::create([
            'email' => $email,
            'token' => $token
        ]);
    }

    public function getPasswordResetByToken(string $token): PasswordReset
    {
        return PasswordReset::where('token', $token)->first();
    }

    public function removeOldResetsByEmail(string $email): void
    {
        PasswordReset::where('email', $email)->delete();
    }

    public function getEmailByToken(string $token): string
    {
        return PasswordReset::where('token', $token)->firstOrFail()->email;
    }
}
