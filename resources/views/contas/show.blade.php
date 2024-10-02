@extends('layouts.html')

@section('content')
    <div class="container">
        <div class="card my-4 border-light shadow">
            <div class="card-header d-flex justify-content-between">
                <span>Detalhes da Conta</span>
                <a href="{{ route('conta.edit', ['conta' => $conta->id]) }}" class="btn btn-warning btn-sm">Editar</a>
            </div>

            {{-- Exibir o Retorno de Sucesso --}}
            <x-alert />

            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">ID</dt>
                    <dd class="col-sm-9">{{ $conta->id }}</dd>

                    <dt class="col-sm-3">Nome</dt>
                    <dd class="col-sm-9">{{ $conta->nome }}</dd>

                    <dt class="col-sm-3">Valor</dt>
                    <dd class="col-sm-9">{{ 'R$ ' . number_format($conta->valor, 2, ',', '.') }}</dd>

                    <dt class="col-sm-3">Vencimento</dt>
                    <dd class="col-sm-9">
                        {{ \Carbon\Carbon::parse($conta->vencimento)->tz('America/Recife')->format('d/m/Y') }}</dd>

                    <dt class="col-sm-3">Situação</dt>
                    <dd class="col-sm-9">{!! '<span class="badge text-bg-' . $conta->contaSituacao->cor . '">' . $conta->contaSituacao->nome . '</span>' !!}</dd>

                    <dt class="col-sm-3">Cadastro</dt>
                    <dd class="col-sm-9">
                        {{ \Carbon\Carbon::parse($conta->created_at)->tz('America/Recife')->format('d/m/Y H:i:s') }}</dd>
                        

                    <dt class="col-sm-3">Editado</dt>
                    <dd class="col-sm-9">
                        {{ \Carbon\Carbon::parse($conta->updated_at)->tz('America/Recife')->format('d/m/Y H:i:s') }}</dd>
                </dl>
            </div>

        </div>
    </div>
@endsection
