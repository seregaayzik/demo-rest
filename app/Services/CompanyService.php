<?php

namespace App\Services;

use App\Interfaces\DTO\CompanyDTO;
use App\Interfaces\Repositories\CompanyRepositoryInterface;
use App\Interfaces\Services\CompanyServiceInterface;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanyService implements CompanyServiceInterface
{

    private CompanyRepositoryInterface $_companyRepository;
    public function __construct(
        CompanyRepositoryInterface $companyRepository
    )
    {
        $this->_companyRepository = $companyRepository;
    }
    public function create(CompanyDTO $data): Company
    {
        return $this->_companyRepository->create($data);
    }

    public function findAllByUserId(int $userId): Collection
    {
        return $this->_companyRepository->getCompaniesByUser($userId);
    }
}
