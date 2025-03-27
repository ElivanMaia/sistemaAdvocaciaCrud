<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoProcesso extends Model
{
    use HasFactory;

    protected $fillable = ['processo_id', 'historico', 'processo_nome'];

    public function processo()
    {
        return $this->belongsTo(Processo::class);
    }
}



