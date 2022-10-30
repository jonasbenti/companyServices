<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeesFormRequest;
use App\Models\Company;
use App\Models\Employee;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        // dd($employees->company());
        $mensagemSucesso = session('mensagem.sucesso');

        return view('employees.index')->with('employees', $employees)
            ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        $companies = Company::all();

        return view('employees.create')->with('companies', $companies);
    }

    public function store(EmployeesFormRequest $request)
    {
        // $employee = $this->repository->add($request);
        Employee::create([
            'cpf' => $request->cpf,
            'name' => $request->name,
            'company_id' => $request->company_id,
        ]);

        return to_route('employees.index')
            ->with('mensagem.sucesso', "Empresa '{$request->name}' adicionada com sucesso");
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return to_route('employees.index')
            ->with('mensagem.sucesso', "Empresa '{$employee->name}' removida com sucesso");
    }

    public function edit(Employee $employee)
    {
        $companies = Company::all();

        return view('employees.edit')
            ->with('employee', $employee)
            ->with('companies', $companies);
    }

    public function update(Employee $employee, EmployeesFormRequest $request)
    {
        $employee->fill($request->all());
        $employee->save();

        return to_route('employees.index')
            ->with('mensagem.sucesso', "Empresa '{$employee->name}' atualizada com sucesso");
    }
}
