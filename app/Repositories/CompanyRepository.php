<?php

namespace App\Repositories;

use App\Interfaces\DTO\CompanyDTO;
use App\Interfaces\Repositories\CompanyRepositoryInterface;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function getCompaniesByUser(int $userId): Collection
    {
        return Company::where('user_id', $userId)->get();
    }
    public function create(CompanyDTO $data): Company
    {
        return Company::create([
            'title' => $data->title,
            'description' => $data->description,
            'phone_number' => $data->phoneNumber,
            'user_id' => $data->userId
        ]);
    }
}
