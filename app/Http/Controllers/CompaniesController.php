<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompaniesFormRequest;
use App\Models\Company;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        $mensagemSucesso = session('mensagem.sucesso');

        return view('companies.index')->with('companies', $companies)
            ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(CompaniesFormRequest $request)
    {
        // $company = $this->repository->add($request);
        Company::create([
            'cnpj' => $request->cnpj,
            'name' => $request->name
        ]);

        return to_route('companies.index')
            ->with('mensagem.sucesso', "Empresa '{$request->name}' adicionada com sucesso");
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return to_route('companies.index')
            ->with('mensagem.sucesso', "Empresa '{$company->name}' removida com sucesso");
    }

    public function edit(Company $company)
    {
        return view('companies.edit')->with('company', $company);
    }

    public function update(Company $company, CompaniesFormRequest $request)
    {
        $company->fill($request->all());
        $company->save();

        return to_route('companies.index')
            ->with('mensagem.sucesso', "Empresa '{$company->name}' atualizada com sucesso");
    }
}
