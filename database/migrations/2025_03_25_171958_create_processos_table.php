<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('processos', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->text('descricao')->nullable();
        
        $table->string('cliente_email');
        $table->foreign('cliente_email')->references('email')->on('clientes')->onDelete('cascade');

        $table->timestamps();
        $table->softDeletes();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('processos', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
