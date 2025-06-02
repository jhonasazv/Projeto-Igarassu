<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitante extends Model
{

   /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    use SoftDeletes;

    protected $fillable = [
        'nis',
        'cpf',
        'nome',
        'sexo',
        'endereco',
        'cep',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function solicitacoes(): HasMany{

       return $this->HasMany(solicitacao::class);
    }
}