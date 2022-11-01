<?php

namespace App\Services;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Employee|null
    */
    public function model(array $row): ?Employee
    {
        return new Employee([
            'cpf'     => $row['cpf'],
            'name'    => $row['nome'],
            'company_id' => $row['cod_empresa']
        ]);
    }
}
