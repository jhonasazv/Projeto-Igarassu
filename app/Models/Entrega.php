<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entrega extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    use SoftDeletes;

    protected $fillable = [
        'numero',
        'data_entrega',
        'descricao',
        'situacao',
    ];

    public function solicitacao(): BelongsTo
    {
        return $this->belongsTo(solicitacao::class, 'solicitacao_id');
    }
}