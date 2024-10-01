@extends('layouts.html')

@section('content')
    <div class="container">
        <div class="card mt-3 mb-4 border-light shadow">
            <div class="card-header d-flex justify-content-between">
                <span>Pesquisar</span>
            </div>
            <div class="card-body">
                <form action="{{ route('conta.index') }}">
                    <div class="row align-items-end">

                        <div class="col-md-3 col-sm-12">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" name="nome" id="nome" value="{{ $nome }}"
                                placeholder="Nome da Conta" class="form-control" />
                        </div>

                        <div class="col-md-3 col-sm-12">
                            <label for="data_inicio" class="form-label">Início</label>
                            <input type="date" name="data_inicio" id="data_inicio" value="{{ $data_inicio }}"
                                class="form-control" />
                        </div>

                        <div class="col-md-3 col-sm-12">
                            <label for="data_fim" class="form-label">Fim</label>
                            <input type="date" name="data_fim" id="data_fim" value="{{ $data_fim }}"
                                class="form-control" />
                        </div>

                        <div class="col-md-3 col-sm-12 pb-1">
                            <input type="submit" value="Pesquisar" class="btn btn-info btn-sm">
                            <a href="{{ route('conta.index') }}" class="btn btn-warning btn-sm">Limpar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card my-4 border-light shadow">
            <div class="card-header d-flex justify-content-between">
                <span>Listar Contas</span>
                <div>
                    <a href="{{ route('conta.create') }}" class="btn btn-primary btn-sm">Cadastrar</a>
                    <a href="{{ url('gerar-pdf-conta?' . request()->getQueryString()) }}"
                        class="btn btn-warning btn-sm">Gerar PDF</a>
                </div>
            </div>
            {{-- Exibir o Retorno de Sucesso --}}
            @if (session('Sucesso'))
                <div class="alert alert-success m-3" role="alert">
                    {{ session('Sucesso') }}
                </div>
            @endif
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Vencimento</th>
                            <th scope="col" class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contas as $conta)
                            <tr>
                                <th>{{ $conta->id }}</th>
                                <td>{{ $conta->nome }}</td>
                                <td>{{ 'R$ ' . number_format($conta->valor, 2, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($conta->vencimento)->tz('America/Recife')->format('d/m/Y') }}
                                </td>
                                <td class="d-md-flex justify-content-center gap-3">
                                    <a href="{{ route('conta.show', ['conta' => $conta->id]) }}"
                                        class="btn btn-primary btn-sm">Visualizar</a>

                                    <a href="{{ route('conta.edit', ['conta' => $conta->id]) }}"
                                        class="btn btn-warning btn-sm">Editar</a>

                                    <form action="{{ route('conta.destroy', ['conta' => $conta->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Excluir"
                                            onclick="return confirm('Tem Certeza que deseja Excluir esta Conta?')"
                                            class="btn btn-danger btn-sm">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <span style="color: #F00">
                                Nenhuma Conta Encontrada!
                            </span>
                        @endforelse
                    </tbody>
                </table>
                {{ $contas->onEachSide(0)->links() }}
            </div>
        </div>

    </div>
@endsection
