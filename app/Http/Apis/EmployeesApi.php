<?php

namespace App\Http\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeesFormRequest;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class EmployeesApi extends Controller
{
    public function index(): Collection
    {
        return Employee::all();
    }

    public function store(EmployeesFormRequest $request): JsonResponse
    {
        return response()
            ->json(Employee::create([
                'cpf' => $request->cpf,
                'name' => $request->name,
                'company_id' => $request->company_id,
            ]), 201);
    }

    public function show(int $employee): Employee|JsonResponse
    {
        $employeeModel = Employee::with('company')->find($employee);

        if ($employeeModel === null) {
            return response()->json(['message' => 'Funcionario não encontrado'], 404);
        }

        return $employeeModel;
    }

    public function update(Employee $employee, EmployeesFormRequest $request): Employee
    {
        $employee->fill($request->all());
        $employee->save();

        return $employee;
    }

    public function destroy(int $employee): Response
    {
        Employee::destroy($employee);

        return response()->noContent();
    }
}
