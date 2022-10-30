<x-layout title="Editar Funcionário '{!! $employee->name !!}'">
    <x-employees.form :action="route('employees.update', $employee->id)"
        :name="$employee->name"
        :cpf="$employee->cpf"
        :companyid="$employee->company_id"
        :companies="$companies"
        :update="true"
    />
</x-layout>
