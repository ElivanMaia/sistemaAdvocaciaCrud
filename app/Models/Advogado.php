<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advogado extends Model
{
    protected $table = 'advogados';

    protected $fillable = ['nome', 'cpf', 'telefone', 'email', 'area_atuacao'];

    public $timestamps = false;

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class, 'advogados_id');
    }


}

