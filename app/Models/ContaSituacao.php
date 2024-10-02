<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaSituacao extends Model
{
    use HasFactory;

    // Indicar Nome da Tabela
    protected $table = 'contas_situacao';

    // Indicar quais colunas podem ser cadastrada
    protected $fillable = ['nome', 'cor'];

    // Relacionamento com Conta
    public function conta()
    {
        return $this->hasMany(Conta::class, 'situacao_conta_id');
    }
}