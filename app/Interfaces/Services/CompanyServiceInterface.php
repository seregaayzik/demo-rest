<?php

namespace App\Interfaces\Services;

use App\Interfaces\DTO\CompanyDTO;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

interface CompanyServiceInterface
{
    public function create(CompanyDTO $data): Company;
    public function findAllByUserId(int $userId): Collection;
}
