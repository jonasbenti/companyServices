<form action="{{ $action }}" method="post">
    @csrf

    @if($update)
    @method('PUT')
    @endif
    <div class="row mb-3">
        <label for="company" class="form-label">Empresa:</label>
        <select name="company_id">
            <option value="">Selecione</option>
            @foreach ($companies as $company)
                <option value="{{ $company?->id }}" @selected($companyid == $company?->id)>
                    {{ $company?->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="cpf" class="form-label">Cpf:</label>
        <input type="text"
               id="cpf"
               name="cpf"
               class="form-control"
               @isset($cpf)value="{{ $cpf }}"@endisset>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Nome:</label>
        <input type="text"
               id="name"
               name="name"
               class="form-control"
               @isset($name)value="{{ $name }}"@endisset>
    </div>

    <button type="submit" class="btn btn-primary">
        @if ($update) Alterar @else Adicionar @endif
    </button>
</form>
