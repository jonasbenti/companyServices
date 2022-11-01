<x-layout title="Novo funcionario ">
    <x-employees.form :action="route('employees.store')"
        :companyid="false"
        :companies="$companies"
        :update="false"
    />
</x-layout>
