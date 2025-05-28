<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;




class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo',//LEMBRAR DE VALIDAR "in:" NOS CONTROLLERS
    ];

    public function solicitacoes(): HasMany{

       return $this->HasMany(Solicitacao::class, 'usuario_id');
    }

    public function agendas(): HasMany{

       return $this->HasMany(Agendamento::class, 'usuario_id');
    }

    public function solicitantes(): HasMany{

       return $this->HasMany(Solicitante::class, 'usuario_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function notificacaoEmail($token)
    {
        $this->notify(new \App\Notifications\ResetarSenha($token));
    }
}
