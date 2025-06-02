<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitacao extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    use SoftDeletes;

    protected $fillable = [
        'data_solicitacao',
        'data_deferido',
        'resultado',
        'texto',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'solicitacoes';

    

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function solicitante(): BelongsTo
    {
        return $this->belongsTo(solicitante::class);
    }

    public function entrega(): HasMany{

       return $this->HasMany(Entrega::class, 'solicitacao_id');
    }
}