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
        Schema::create('telefones', function (Blueprint $table) {
            $table->id();
            $table->string('descricao')->nullable();
            $table->string('numero');
            $table->foreignId('agendamento_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('condutor_id')->nullable()->constrained('condutores')->onDelete('cascade');
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
        Schema::dropIfExists('telefones');
    }

    /**
     * Get the dependencies for this migration.
     *
     * @return array
     */
    public function dependencies()
    {
        return [
            '2024_09_24_213737_create_agendamento',
        ];
    }
};
