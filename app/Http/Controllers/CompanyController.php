<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompanyResource;
use App\Interfaces\DTO\CompanyDTO;
use App\Interfaces\Services\CompanyServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller;

class CompanyController extends Controller
{
    private CompanyServiceInterface $_companyService;
    public function __construct(
        CompanyServiceInterface $companyService
    )
    {
        $this->_companyService = $companyService;
    }
    public function getCompanies(): ResourceCollection
    {
        $companies = $this->_companyService->findAllByUserId(Auth()->id());
        return CompanyResource::collection($companies);
    }

    public function addCompany(Request $request): JsonResponse
    {
        try {
            $data = $this->validate($request, [
                'title' => 'required|string|max:64|min:3',
                'phone_number' => 'required|string|regex:/^\+?[0-9]{7,15}$/',
                'description' => 'nullable|string|max:512|min:10',
            ]);
            $companyDto = new CompanyDTO($data['title'], $data['description'], $data['phone_number'], Auth()->id());
            $company = $this->_companyService->create($companyDto);
            return (new CompanyResource($company))->response()->setStatusCode(Response::HTTP_CREATED);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e){
            return response()->json(['errors' => 'Please contact to the support'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
