<?php

namespace App\Http\Controllers;

use App\Services\EmployeesExport;
use App\Http\Requests\EmployeesFormRequest;
use App\Services\EmployeesImport;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        $mensagemSucesso = session('mensagem.sucesso');

        return view('employees.index')->with('employees', $employees)
            ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create(): View
    {
        $companies = Company::all();

        return view('employees.create')->with('companies', $companies);
    }

    public function store(EmployeesFormRequest $request): RedirectResponse
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

    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();

        return to_route('employees.index')
            ->with('mensagem.sucesso', "Empresa '{$employee->name}' removida com sucesso");
    }

    public function edit(Employee $employee): View
    {
        $companies = Company::all();

        return view('employees.edit')
            ->with('employee', $employee)
            ->with('companies', $companies);
    }

    public function update(Employee $employee, EmployeesFormRequest $request): RedirectResponse
    {
        $employee->fill($request->all());
        $employee->save();

        return to_route('employees.index')
            ->with('mensagem.sucesso', "Empresa '{$employee->name}' atualizada com sucesso");
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    // public function export(object $employees)
    public function export(): BinaryFileResponse
    {
        // return Excel::download(new EmployeesExport, 'employees.xlsx', null, $employees);
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(): RedirectResponse
    {
        $file = request()->file('file');

        if ($file) {
            Excel::import(new EmployeesImport(), $file);

            return back();
        }

        return to_route('employees.index')
            ->with('mensagem.sucesso', "Nenhum arquivo encontrado");
    }
}
