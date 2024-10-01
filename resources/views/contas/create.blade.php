@extends('layouts.html')

@section('content')
    <div class="container">
        <div class="card my-4 border-light shadow">
            <div class="card-header d-flex justify-content-between">
                <span>Cadastrar Conta</span>
            </div>

            {{-- Exibir o Retorno de Erro --}}
            @if (session('Error'))
                <div class="alert alert-danger m-3" role="alert">
                    {{ session('Error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger m-3" role="alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('conta.store') }}" method="POST" class="row g-3 px-4 pb-4">
                @csrf {{-- Indicando que a requisição esta vindo de uma pag interna --}}

                <div class="col-12">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" placeholder="Nome da Conta"
                        value="{{ old('nome') }}" class="form-control" />
                </div>

                <div class="col-12">
                    <label for="valor" class="form-label">Valor R$</label>
                    <input type="text" name="valor" id="valor" placeholder="Valor da Conta"
                        value="{{ old('valor') }}" class="form-control" />
                </div>

                <div class="col-12">
                    <label for="vencimento" class="form-label">Vencimento</label>
                    <input type="date" name="vencimento" id="vencimento" value="{{ old('vencimento') }}"
                        class="form-control" />
                </div>
                <div class="col-12">
                    <input type="submit" title="Cadastrar Conta" value="Cadastrar" class="btn btn-success btn-sm">
                </div>
            </form>
        </div>
    </div>
@endsection
