<?php

namespace App\Http\Controllers;

use App\Events\EventsCompanyDeleted;
use App\Http\Requests\CompaniesFormRequest;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CompaniesController extends Controller
{
    public function index(): View
    {
        $companies = Company::all();
        $successMessage = session('success.message');

        return view('companies.index')->with('companies', $companies)
            ->with('successMessage', $successMessage);
    }

    public function create(): View
    {
        return view('companies.create');
    }

    public function store(CompaniesFormRequest $request): RedirectResponse
    {
        Company::create([
            'cnpj' => $request->cnpj,
            'name' => $request->name
        ]);

        return to_route('companies.index')
            ->with('success.message', "Empresa '{$request->name}' adicionada com sucesso");
    }

    public function destroy(Company $company): RedirectResponse
    {
        EventsCompanyDeleted::dispatch($company->id);

        return to_route('companies.index')
            ->with('success.message', "Empresa '{$company->name}' na fila de serviços para ser excluida, aguarde por favor");
    }

    public function edit(Company $company): View
    {
        return view('companies.edit')->with('company', $company);
    }

    public function update(Company $company, CompaniesFormRequest $request): RedirectResponse
    {
        $company->fill($request->all());
        $company->save();

        return to_route('companies.index')
            ->with('success.message', "Empresa '{$company->name}' atualizada com sucesso");
    }
}
