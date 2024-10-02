<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContaRequest;
use App\Models\Conta;
use App\Models\ContaSituacao;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpWord\PhpWord;

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
        })->with('contaSituacao')->orderByDesc('created_at')->paginate(10)->withQueryString();

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
        // Reculperar dados do Banco de Dados Situações
        $situacoesContas = ContaSituacao::orderBy('nome', 'asc')->get();

        // Carregar a View
        return view('contas.create', [
            'situacoesContas' => $situacoesContas
        ]);
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
                'vencimento' => $request->vencimento,
                'situacao_conta_id' => $request->situacao_conta_id
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
        // Reculperar dados do Banco de Dados Situações
        $situacoesContas = ContaSituacao::orderBy('nome', 'asc')->get();

        // Carregar a View
        return view('contas.edit', [
            'conta' => $conta,
            'situacoesContas' => $situacoesContas
        ]);
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
                'vencimento' => $request->vencimento,
                'situacao_conta_id' => $request->situacao_conta_id
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

    // Alterar  situação
    public function changeSituation(Conta $conta)
    {
        try {
            // Editar as Situação da Conta no  Banco de Dados
            $conta->update([
                'situacao_conta_id' => $conta->situacao_conta_id == 1 ? 2 : 1
            ]);

            // Registrando Log de Sucesso
            Log::info('Situação da Conta Editada Com Sucesso', ['conta' => $conta]);

            // Redirecionar Usuário e enviar mensagem de Sucesso
            return back()->with('Sucesso', 'Situação da Conta Editada com Sucesso!');
        } catch (Exception $error) {
            // Registrando Log de Erro
            Log::warning('Error Situação da Conta não Editada', ['error' => $error->getMessage()]);

            // Redirecioando o Usuário e exibindo a Mensagem de Erro
            return back()->with('Error', 'Situação da Conta não Editada Erro Interno!');
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

        // Carregar a String com o HTML/Conteúdo e determinar a orientação e o tamanho da folha
        $pdf = Pdf::loadView('contas.gerarpdf', [
            'contas' => $contas,
            'valorTotal' => $valorTotal
        ])->setPaper('a4', 'portrait');

        // Fazer o Download do Arquivo em PDF
        return $pdf->download('lista_de_contas.pdf');
    }

    // Gerar CSV
    public function gerarCsv(Request $request)
    {
        // Recuperar os registros do Banco de Dados
        $contas = Conta::when($request->has('nome'), function ($whenQuery) use ($request) {
            $whenQuery->where('nome', 'like', '%' . $request->nome . '%');
        })->when($request->filled('data_inicio'), function ($whenQuery) use ($request) {
            $whenQuery->where('vencimento', '>=', \Carbon\Carbon::parse($request->data_inicio)->format('Y-m-d'));
        })->when($request->filled('data_fim'), function ($whenQuery) use ($request) {
            $whenQuery->where('vencimento', '<=', \Carbon\Carbon::parse($request->data_fim)->format('Y-m-d'));
        })->with('contaSituacao')->orderBy('vencimento')->get();

        // Calcular os Valores da coluna Valor
        $valorTotal = $contas->sum('valor');

        // Gerar o Arquivo Temporário
        $csvNomeArquivo = tempnam(sys_get_temp_dir(), 'csv_' . Str::ulid());

        // Abrir o Arquivo na Forma de Escrita
        $arquivoAberto = fopen($csvNomeArquivo, 'w');

        // Criar a primeira linha para adicionar no arquivo CSV
        $cabecalho = ['id', 'Nome', 'Vencimento', mb_convert_encoding('Situação', 'ISO-8859-1', 'UTF-8'), 'Valor'];

        // Adicionando a linha no Arquivo
        fputcsv($arquivoAberto, $cabecalho, ';');

        // Ler od Registros Recuperados do Banco de Dados
        foreach ($contas as $conta) {
            // Criando um Array com os dados 
            $contaArray = [
                'id' => $conta->id,
                'nome' => mb_convert_encoding($conta->nome, 'ISO-8859-1', 'UTF-8'),
                'vencimento' => $conta->vencimento,
                'situacao' => mb_convert_encoding($conta->contaSituacao->nome, 'ISO-8859-1', 'UTF-8'),
                'valor' => number_format($conta->valor, 2, ',', '.')
            ];

            // Adicionando os dados no arquivo CSV
            fputcsv($arquivoAberto, $contaArray, ';');
        }

        // Criando Roda pé do Aquivo CSV
        $rodape = ['', '', '', 'Total', number_format($valorTotal, 2, ',', '.')];

        // Fechando o Arquivo após a manipulação
        fputcsv($arquivoAberto, $rodape, ';');

        fclose($arquivoAberto);

        // Realizando o Download do Arquivo CSV
        return response()->download($csvNomeArquivo, 'relatorio_contas_' . Str::ulid() . '.csv');
    }

    // Gerar DOC
    public function gerarDocx(Request $request)
    {
        // Recuperar os registros do Banco de Dados
        $contas = Conta::when($request->has('nome'), function ($whenQuery) use ($request) {
            $whenQuery->where('nome', 'like', '%' . $request->nome . '%');
        })->when($request->filled('data_inicio'), function ($whenQuery) use ($request) {
            $whenQuery->where('vencimento', '>=', \Carbon\Carbon::parse($request->data_inicio)->format('Y-m-d'));
        })->when($request->filled('data_fim'), function ($whenQuery) use ($request) {
            $whenQuery->where('vencimento', '<=', \Carbon\Carbon::parse($request->data_fim)->format('Y-m-d'));
        })->with('contaSituacao')->orderBy('vencimento')->get();

        // Calcular os Valores da coluna Valor
        $valorTotal = $contas->sum('valor');

        // Cria uma instância do PhpWord
        $phpWord = new PhpWord();

        // Adicianar conteúdo ao Documento
        $section = $phpWord->addSection();

        // Adicionando uma Tabela ao Documento
        $table = $section->addTable();

        // Definindo as Configurações da Borda do Documento
        $borderStyle = [
            'borderColor' => '000',
            'borderSize' => '6'
        ];

        // Adicionando o Cabeçalho no Documento
        $table->addRow();
        $table->addCell(2000, $borderStyle)->addText('Id');
        $table->addCell(2000, $borderStyle)->addText('Nome');
        $table->addCell(2000, $borderStyle)->addText('Vencimento');
        $table->addCell(2000, $borderStyle)->addText('Situação');
        $table->addCell(2000, $borderStyle)->addText('Valor');

        // Ler od Registros Recuperados do Banco de Dados
        foreach ($contas as $conta) {

            // Adicionando o Cabeçalho no Documento
            $table->addRow();
            $table->addCell(2000, $borderStyle)->addText($conta->id);
            $table->addCell(2000, $borderStyle)->addText($conta->nome);
            $table->addCell(2000, $borderStyle)->addText(Carbon::parse($conta->vencimento)->format('d/m/Y'));
            $table->addCell(2000, $borderStyle)->addText($conta->contaSituacao->nome);
            $table->addCell(2000, $borderStyle)->addText(number_format($conta->valor, 2, ',', '.'));
        }

        // Adicionando o Total no Documento
        $table->addRow();
        $table->addCell(2000)->addText('');
        $table->addCell(2000)->addText('');
        $table->addCell(2000)->addText('');
        $table->addCell(2000, $borderStyle)->addText('Total');
        $table->addCell(2000, $borderStyle)->addText(number_format($valorTotal, 2, ',', '.'));

        // Criar Nome do Documento DOCX
        $filename = 'relatorio_contas.docx';

        // Obtendo o caminho do gerado pelo PhpWord para salvar
        $savePath = storage_path($filename);

        // Salvar o Arquivo
        $phpWord->save($savePath);

        // Realizando o Download do Arquivo DOCX
        return response()->download($savePath)->deleteFileAfterSend(true);
    }
}
