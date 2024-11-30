<?php

namespace App\Services;

use App\Interfaces\Repositories\PasswordResetRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\RestorePasswordServiceInterface;
use Illuminate\Support\Str;

class RestorePasswordService implements RestorePasswordServiceInterface
{
    private PasswordResetRepositoryInterface $_passwordResetRepositoryInterface;
    private UserRepositoryInterface $_userRepositoryInterface;
    public function __construct(
        PasswordResetRepositoryInterface $passwordResetRepositoryInterface,
        UserRepositoryInterface $userRepositoryInterface
    )
    {
        $this->_passwordResetRepositoryInterface = $passwordResetRepositoryInterface;
        $this->_userRepositoryInterface = $userRepositoryInterface;
    }
    public function requestForNewPassword(string $email): string
    {
        $token = Str::random(64);
        $this->_passwordResetRepositoryInterface->removeOldResetsByEmail($email);
        return $this->_passwordResetRepositoryInterface->addPasswordReset($email, $token);
    }

    public function setNewPassword(string $token, string $newPassword): void
    {
        $email = $this->_passwordResetRepositoryInterface->getEmailByToken($token);
        $this->_userRepositoryInterface->updatePasswordByEmail($email,$newPassword);
        $this->_passwordResetRepositoryInterface->removeOldResetsByEmail($email);
    }
}
