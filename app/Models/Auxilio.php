<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Auxilio extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    use SoftDeletes;

        /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [
        'solicitacao_id',
    ];

    protected $fillable = [
        'nome',
        'descricao',
        'valor',
        'quantidade',
    ];

    public function solicitacao(): BelongsTo
    {
        return $this->belongsTo(Solicitacao::class);
    }
}