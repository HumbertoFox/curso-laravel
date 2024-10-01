@extends('layouts.pdf')

@section('pdfcontent')
    <section style="font-family: sans-serif">
        <h2 style="text-align: center">Contas</h2>

        <table style="width: 100%; border-collapse: collapse; font-size: 12px">
            <thead>
                <tr style="background-color: #F0F0F0">
                    <th style="border: 1px solid #C0C0C0">ID</th>
                    <th style="border: 1px solid #C0C0C0">Nome</th>
                    <th style="border: 1px solid #C0C0C0">Velor R$</th>
                    <th style="border: 1px solid #C0C0C0">Vencimento</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contas as $conta)
                    <tr style="text-align: center">
                        <td style="border: 1px solid #C0C0C0; border-top: none">{{ $conta->id }}</td>
                        <td style="border: 1px solid #C0C0C0; border-top: none">{{ $conta->nome }}</td>
                        <td style="border: 1px solid #C0C0C0; border-top: none">
                            {{ 'R$ ' . number_format($conta->valor, 2, ',', '.') }}</td>
                        <td style="border: 1px solid #C0C0C0; border-top: none">
                            {{ \Carbon\Carbon::parse($conta->vencimento)->tz('America/Recife')->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Nenhuma Conta Encontrada!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
