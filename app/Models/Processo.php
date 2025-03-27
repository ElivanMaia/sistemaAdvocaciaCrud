<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Processo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nome', 'descricao', 'cliente_email'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_email', 'email');
    }

    protected $dates = ['deleted_at'];
}
