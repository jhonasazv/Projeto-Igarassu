<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agendamento extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    use SoftDeletes;

    protected $fillable = [
        'data_agendamento',
        'situacao',
        'descricao',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}