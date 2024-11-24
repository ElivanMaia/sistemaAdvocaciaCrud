<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    
    protected $table = 'agendamentos';

    protected $fillable = ['data', 'advogados_id', 'descricao', 'clientes_id'];

    public $timestamps = false;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'clientes_id');
    }

    public function advogado()
    {
        return $this->belongsTo(Advogado::class, 'advogados_id');
    }
}


