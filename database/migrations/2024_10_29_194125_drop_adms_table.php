<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropAdmsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('adms');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Caso precise recriar a tabela no rollback, adicione a estrutura aqui
        Schema::create('adms', function (Blueprint $table) {
            $table->id();
            $table->string('usuario', 45);
            $table->string('senha', 45);
            $table->timestamps();
        });
    }
}
