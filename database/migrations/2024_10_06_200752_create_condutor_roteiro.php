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
        Schema::create('condutor_roteiro', function (Blueprint $table) {
            $table->id();
            $table->foreignId('condutor_id')->constrained('condutores')->onDelete('cascade');
            $table->foreignId('roteiro_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('condutor_roteiro');
    }
};
