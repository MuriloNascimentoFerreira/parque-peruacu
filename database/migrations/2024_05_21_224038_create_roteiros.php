<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roteiros', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->unsignedTinyInteger('lotacao')->description('Quantidade máxima de pessoas');
            $table->unsignedInteger('duracao')->description('Duração em minutos');
            $table->tinyInteger('nivel');
            $table->unsignedDecimal('distancia');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roteiros');
    }
};
