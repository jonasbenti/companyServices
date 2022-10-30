<x-layout title="Nova Empresa">
    <x-companies.form :action="route('companies.store')"
        :update="false"
    />
</x-layout>
