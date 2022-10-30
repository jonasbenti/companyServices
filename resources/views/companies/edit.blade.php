<x-layout title="Editar Empresa '{!! $company->name !!}'">
    <x-companies.form :action="route('companies.update', $company->id)"
        :name="$company->name"
        :cnpj="$company->cnpj"
        :update="true"
    />
</x-layout>
