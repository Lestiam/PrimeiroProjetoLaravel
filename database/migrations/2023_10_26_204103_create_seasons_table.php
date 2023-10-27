<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('number'); //inteiro pequeno positivo
            $table->foreignId('series_id')->constrained()->onDelete('cascade'); //crio a chave estrangeira (foreign key) para a tabela series. E quando eu deletar uma série, também vou deletar todas as suas tempordas. Faz o relacionamento entre a temporada e a série. Só essa linha faz o mesmo que as duas linhas comentadas abaixo

//            $table->unsignedBigInteger('series_id');
//            $table->foreign('series_id')->references('id')->on('series'); //crio a chave estrangeira (foreign key) para a tabela series. Faz o relacionamento entre a temporada e a série

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seasons');
    }
};
