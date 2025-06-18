<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [
        'usuario_id',
        'solicitante_id'
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

    public function entrega(): HasOne{// AS ENTREGAS SAO 1,1??

       return $this->hasOne(Entrega::class, 'solicitacao_id');
    }

    public function auxilio(): HasOne{

       return $this->hasOne(Auxilio::class, 'solicitacao_id');
    }
}