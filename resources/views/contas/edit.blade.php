@extends('layouts.html')

@section('content')
    <div class="container">
        <div class="card my-4 border-light shadow">
            <div class="card-header d-flex justify-content-between">
                <span>Editar Conta</span>
                <a href="{{ route('conta.show', ['conta' => $conta->id]) }}" class="btn btn-primary btn-sm">Visualizar</a>
            </div>

            {{-- Exibir o Retorno de Erro --}}
            <x-alert />

            <form action="{{ route('conta.update', ['conta' => $conta->id]) }}" method="POST" class="row g-3 px-4 pb-4">
                @csrf {{-- Indicando que a requisição esta vindo de uma pag interna --}}
                @method('PUT')

                <div class="col-12">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" placeholder="Nome da Conta"
                        value="{{ old('nome', $conta->nome) }}" class="form-control" />
                </div>

                <div class="col-12">
                    <label for="valor" class="form-label">Valor R$</label>
                    <input type="text" name="valor" id="valor" placeholder="Valor da Conta"
                        value="{{ old('valor', isset($conta->valor) ? number_format($conta->valor, '2', ',', '.') : '') }}"
                        class="form-control" />
                </div>

                <div class="col-12">
                    <label for="vencimento" class="form-label">Vencimento</label>
                    <input type="date" name="vencimento" id="vencimento"
                        value="{{ old('vencimento', $conta->vencimento) }}" class="form-control" />
                </div>
                <div class="col-12">
                    <input type="submit" title="Editar Conta" value="Editar" class="btn btn-warning btn-sm">
                </div>
            </form>
        </div>
    </div>
@endsection