<?php

namespace App\Interfaces\Repositories;

use App\Interfaces\DTO\CompanyDTO;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

interface CompanyRepositoryInterface
{
    public function getCompaniesByUser(int $userId): Collection;
    public function create(CompanyDTO $data): Company;
}
