<?php

namespace Database\Seeders;

use App\Models\ContaSituacao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContaSituacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $situacoes = [
            ['nome' => 'Paga', 'cor' => 'success'],
            ['nome' => 'Pendente', 'cor' => 'danger'],
            ['nome' => 'Cancelada', 'cor' => 'warning'],
        ];

        foreach ($situacoes as $situacao) {
            if (!ContaSituacao::where('nome', $situacao['nome'])->exists()) {
                ContaSituacao::create($situacao);
            }
        }
    }
}
