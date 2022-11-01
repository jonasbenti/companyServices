<?php

namespace App\Http\Apis;

use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompaniesFormRequest;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CompaniesApi extends Controller
{
    public function index(): Collection
    {
        return Company::all();
    }

    public function store(CompaniesFormRequest $request): JsonResponse
    {
        return response()
            ->json(Company::create([
                'cnpj' => $request->cnpj,
                'name' => $request->name,
            ]), 201);
    }

    public function show(int $company): Company|JsonResponse
    {
        $companyModel = Company::with('employees')->find($company);

        if ($companyModel === null) {
            return response()->json(['message' => 'Funcionario não encontrado'], 404);
        }

        return $companyModel;
    }

    public function update(Company $company, CompaniesFormRequest $request): Company
    {
        $company->fill($request->all());
        $company->save();

        return $company;
    }

    public function destroy(int $companyId): Response
    {
        Company::destroy($companyId);
        Employee::where('company_id', $companyId)->delete();

        return response()->noContent();
    }
}
