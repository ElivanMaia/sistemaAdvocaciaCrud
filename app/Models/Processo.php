<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'descricao', 'cliente_email'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_email', 'email');
    }
}
