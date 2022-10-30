<x-layout title="Novo funcionario ">
    <x-employees.form :action="route('employees.store')"
        :companyid="false"
        :companies="$companies"
        :update="false"
    />
</x-layout>

{{-- <x-layout title="Novo funcionario">
    <form action="{{ route('employees.store') }}" method="post">
        @csrf

        <div class="row mb-3">
            <label for="company" class="form-label">Empresa:</label>
            <select name="company_id">
                <option value="">Selecione</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" @selected(old('company_id') == $company->id)>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="row mb-3">
            <div class="col-2">
                <label for="cpf" class="form-label">Cpf:</label>
                <input type="text"
                       id="cpf"
                       name="cpf"
                       class="form-control"
                       value="{{ old('cpf') }}">
            </div>
            <div class="col-6">
                <label for="name" class="form-label">Nome:</label>
                <input type="text"
                       autofocus
                       id="name"
                       name="name"
                       class="form-control"
                       value="{{ old('name') }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
</x-layout> --}}
