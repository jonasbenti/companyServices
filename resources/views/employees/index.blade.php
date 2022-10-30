<x-layout title="Funcionários" :mensagem-sucesso="$mensagemSucesso">
    <a href="{{ route('employees.create') }}" class="btn btn-dark mb-2">Adicionar</a>

    <div class="container">
        <table class="table table-striped table-hover caption-top rounded">
            <caption class="text-center"><h3>Lista de Funcionários</h3></caption>
            <thead class="table-primary" style="border-radius: 5px;">
                <tr>
                    <td class="text-center">Ações</td>
                    <td><b>Id</b></td>
                    <td><b>Cpf</b></td>
                    <td><b>Nome</b></td>
                    <td><b>Empresa</b></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <span class="d-flex">
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary btn-sm">
                                    Editar
                                </a>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="post" class="ms-2">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        Excluir
                                    </button>
                                </form>
                            </span>
                        </td>
                        <td class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            {{ $employee->id }}
                        </td>
                        <td class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            {{ $employee->cpf }}
                        </td>
                        <td class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                            {{ $employee->name }}
                        </td>
                        <td class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                            {{ $employee?->company?->name }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</x-layout>
