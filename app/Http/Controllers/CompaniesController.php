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
        $mensagemSucesso = session('mensagem.sucesso');

        return view('companies.index')->with('companies', $companies)
            ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create(): View
    {
        return view('companies.create');
    }

    public function store(CompaniesFormRequest $request): RedirectResponse
    {
        // $company = $this->repository->add($request);
        Company::create([
            'cnpj' => $request->cnpj,
            'name' => $request->name
        ]);

        return to_route('companies.index')
            ->with('mensagem.sucesso', "Empresa '{$request->name}' adicionada com sucesso");
    }

    public function destroy(Company $company): RedirectResponse
    {
        EventsCompanyDeleted::dispatch($company->id);

        return to_route('companies.index')
            ->with('mensagem.sucesso', "Empresa '{$company->name}' na fila de serviços para ser excluida, aguarde por favor");
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
            ->with('mensagem.sucesso', "Empresa '{$company->name}' atualizada com sucesso");
    }
}
