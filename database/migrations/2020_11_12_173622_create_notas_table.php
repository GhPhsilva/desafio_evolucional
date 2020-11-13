<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aluno_id')->index('aluno_idx');
            $table->unsignedBigInteger('disciplina_id')->index('disciplina_idx');
            $table->decimal('nota', 8, 2);

            $table->foreign('aluno_id')->references('id')->on('alunos')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notas');
    }
}
