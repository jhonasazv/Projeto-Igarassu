<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Auxilio extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    use SoftDeletes;

    protected $fillable = [
        'nome',
        'descricao',
        'valor',
        'quantidade',
    ];
}