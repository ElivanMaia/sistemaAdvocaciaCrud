<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = ['nome', 'email', 'telefone', 'cpf', 'data_nasc'];

    public $timestamps = false;

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class, 'clientes_id');
    }

}


