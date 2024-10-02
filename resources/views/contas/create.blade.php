@extends('layouts.html')

@section('content')
    <div class="container">
        <div class="card my-4 border-light shadow">
            <div class="card-header d-flex justify-content-between">
                <span>Cadastrar Conta</span>
            </div>

            {{-- Exibir o Retorno de Erro --}}
            <x-alert />

            <form action="{{ route('conta.store') }}" method="POST" class="row g-3 px-4 pb-4">
                @csrf {{-- Indicando que a requisição esta vindo de uma pag interna --}}

                <div class="col-md-12 col-sm-12">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" placeholder="Nome da Conta"
                        value="{{ old('nome') }}" class="form-control" />
                </div>

                <div class="col-md-4 col-sm-12">
                    <label for="valor" class="form-label">Valor R$</label>
                    <input type="text" name="valor" id="valor" placeholder="Valor da Conta"
                        value="{{ old('valor') }}" class="form-control" />
                </div>

                <div class="col-md-4 col-sm-12">
                    <label for="vencimento" class="form-label">Vencimento</label>
                    <input type="date" name="vencimento" id="vencimento" value="{{ old('vencimento') }}"
                        class="form-control" />
                </div>

                <div class="col-md-4 col-sm-12">
                    <label for="situacao_conta_id" class="form-label">Situação da Conta</label>
                    <select name="situacao_conta_id" id="situacao_conta_id" class="form-select">
                        <option value="">Selecione</option>
                        @forelse ($situacoesContas as $situacaoConta)
                            <option value="{{ $situacaoConta->id }}"
                                {{ old('situacao_conta_id') == $situacaoConta->id ? 'selected' : '' }}>
                                {{ $situacaoConta->nome }}</option>
                        @empty
                            <option value="">Nenhuma Situação da Conta Encontrada</option>
                        @endforelse
                    </select>
                </div>

                <div class="col-md-4 col-sm-12">
                    <input type="submit" title="Cadastrar Conta" value="Cadastrar" class="btn btn-success btn-sm">
                </div>
            </form>
        </div>
    </div>
@endsection
