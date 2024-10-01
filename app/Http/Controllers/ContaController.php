<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContaRequest;
use App\Models\Conta;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContaController extends Controller
{
    // Lista as Contas
    public function index(Request $request)
    {
        // Recuperar os registros do Banco de Dados
        $contas = Conta::when($request->has('nome'), function ($whenQuery) use ($request) {
            $whenQuery->where('nome', 'like', '%' . $request->nome . '%');
        })->when($request->filled('data_inicio'), function ($whenQuery) use ($request) {
            $whenQuery->where('vencimento', '>=', \Carbon\Carbon::parse($request->data_inicio)->format('Y-m-d'));
        })->when($request->filled('data_fim'), function ($whenQuery) use ($request) {
            $whenQuery->where('vencimento', '<=', \Carbon\Carbon::parse($request->data_fim)->format('Y-m-d'));
        })->orderByDesc('created_at')->paginate(10)->withQueryString();

        // Carregar a View
        return view('contas.index', [
            'contas' => $contas,
            'nome' => $request->nome,
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim
        ]);
    }

    // Detalhes da Conta
    public function create()
    {
        // Carregar a View
        return view('contas.create');
    }

    // Carregar o Formulário Cadastrar Nova Conta
    public function store(ContaRequest $request)
    {
        // Validar o Formulário
        $request->validated();

        try {

            // Cadastrar no Banco de Dados na tabela contas os dados de todos os campos
            $conta = Conta::create([
                'nome' => $request->nome,
                'valor' => str_replace(',', '.', str_replace('.', '', $request->valor)),
                'vencimento' => $request->vencimento
            ]);

            // Registrando Log de Sucesso
            Log::info('Conta Cadastrada Com Sucesso', ['conta' => $conta]);

            // Redirecionando o Usuário e enviando uma mensagem de Sucesso
            return redirect()->route('conta.show', ['conta' => $conta->id])->with('Sucesso', 'Conta cadastrada com Sucesso!');
        } catch (Exception $error) {

            // Registrando Log de Erro
            Log::warning('Error ao tentar Cadastrar Conta', ['error' => $error->getMessage()]);

            // Redirecioando o Usuário e exibindo a Mensagem de Erro
            return back()->withInput()->with('Error', 'Conta não Cadastrada Erro Interno!');
        }
    }

    // Cadastrar no Banco de Dados Nova Conta
    public function show(Conta $conta)
    {
        // Carregar a View
        return view('contas.show', ['conta' => $conta]);
    }

    // Carregar Formulário Editar a Conta
    public function edit(Conta $conta)
    {
        // Carregar a View
        return view('contas.edit', ['conta' => $conta]);
    }

    // Editar Banco de Dados a Conta
    public function update(ContaRequest $request, Conta $conta)
    {
        // Validar o Formulário
        $request->validated();

        try {

            // Editando as Informações do Registro do Banco de Dados
            $conta->update([
                'nome' => $request->nome,
                'valor' => str_replace(',', '.', str_replace('.', '', $request->valor)),
                'vencimento' => $request->vencimento
            ]);

            // Registrando Log de Sucesso
            Log::info('Conta Editada Com Sucesso', ['conta' => $conta]);

            // Redirecionar Usuário e enviar mensagem de Sucesso
            return redirect()->route('conta.show', ['conta' => $conta->id])->with('Sucesso', 'Conta Editada com Sucesso!');
        } catch (Exception $error) {

            // Registrando Log de Erro
            Log::warning('Error ao tentar Editar Conta', ['error' => $error->getMessage()]);

            // Redirecioando o Usuário e exibindo a Mensagem de Erro
            return back()->withInput()->with('Error', 'Conta não Editada Erro Interno!');
        }
    }

    // Excluir a Conta do Banco de Dados
    public function destroy(Conta $conta)
    {
        // Excluir o Registro do Bnaco de Dados
        $conta->delete();

        // Redirecionar Usuário e enviar messagem de Sucesso
        return redirect()->route('conta.index')->with('Sucesso', 'Conta Excluida com Sucesso!');
    }

    // Gerar PDF
    public function gerarPdf(Request $request)
    {

        // Recuperar os registros do Banco de Dados
        $contas = Conta::when($request->has('nome'), function ($whenQuery) use ($request) {
            $whenQuery->where('nome', 'like', '%' . $request->nome . '%');
        })->when($request->filled('data_inicio'), function ($whenQuery) use ($request) {
            $whenQuery->where('vencimento', '>=', \Carbon\Carbon::parse($request->data_inicio)->format('Y-m-d'));
        })->when($request->filled('data_fim'), function ($whenQuery) use ($request) {
            $whenQuery->where('vencimento', '<=', \Carbon\Carbon::parse($request->data_fim)->format('Y-m-d'));
        })->orderByDesc('created_at')->get();

        // Calcular os Valores da coluna Valor
        $valorTotal = $contas->sum('valor');

        // Carregar a String com o HTML/Conteúdo e determinar a oração e o tamanho do arquivo
        $pdf = Pdf::loadView('contas.gerarpdf', [
            'contas' => $contas,
            'valorTotal' => $valorTotal
        ])->setPaper('a4', 'portrait');

        // Fazer o Download do Arquivo em PDF
        return $pdf->download('lista_de_contas.pdf');
    }
}
