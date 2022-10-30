<x-layout title="Empresas" :mensagem-sucesso="$mensagemSucesso">
    <a href="{{ route('companies.create') }}" class="btn btn-dark mb-2">Adicionar</a>

    <div class="container">
        <table class="table table-striped table-hover caption-top rounded">
            <caption class="text-center"><h3>Lista de Empresas</h3></caption>
            <thead class="table-primary" style="border-radius: 5px;">
                <tr>
                    <td class="text-center">Ações</td>
                    <td><b>Id</b></td>
                    <td><b>Cnpj</b></td>
                    <td><b>Nome</b></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span class="d-flex">
                                <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-primary btn-sm">
                                    Editar
                                </a>
                                <form action="{{ route('companies.destroy', $company->id) }}" method="post" class="ms-2">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        Excluir
                                    </button>
                                </form>
                            </span>
                        </td>
                        <td class="col-xs-1 col-sm-1 col-md-1 col-lg-1">{{ $company->id }}</td>
                        <td class="col-xs-2 col-sm-2 col-md-2 col-lg-2">{{ $company->cnpj }}</td>
                        <td class="col-xs-5 col-sm-5 col-md-5 col-lg-5">{{ $company->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</x-layout>
