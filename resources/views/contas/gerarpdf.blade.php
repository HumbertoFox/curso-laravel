@extends('layouts.pdf')

@section('pdfcontent')
    <section style="font-family: sans-serif">
        <h2 style="text-align: center">Contas</h2>

        <table style="width: 100%; border-collapse: collapse; font-size: 12px">
            <thead>
                <tr style="background-color: #F0F0F0">
                    <th style="border: 1px solid #C0C0C0">ID</th>
                    <th style="border: 1px solid #C0C0C0">Nome</th>
                    <th style="border: 1px solid #C0C0C0">Vencimento</th>
                    <th style="border: 1px solid #C0C0C0">Velor R$</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contas as $conta)
                    <tr style="text-align: center">
                        <td style="border: 1px solid #C0C0C0; border-top: none">{{ $conta->id }}</td>
                        <td style="border: 1px solid #C0C0C0; border-top: none">{{ $conta->nome }}</td>
                        <td style="border: 1px solid #C0C0C0; border-top: none">
                            {{ \Carbon\Carbon::parse($conta->vencimento)->tz('America/Recife')->format('d/m/Y') }}</td>
                        <td style="border: 1px solid #C0C0C0; border-top: none">
                            {{ 'R$ ' . number_format($conta->valor, 2, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr style="text-align: center">
                        <td colspan="4">Nenhuma Conta Encontrada!</td>
                    </tr>
                @endforelse
                <tr style="text-align: center; font-weight: bold; background-color: #F0F0F0; margin-top: 10px">
                    <td colspan="3" style="border: 1px solid #C0C0C0; border-top: none">Total</td>
                    <td style="border: 1px solid #C0C0C0; border-top: none">
                        {{ 'R$ ' . number_format($valorTotal, 2, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </section>
@endsection