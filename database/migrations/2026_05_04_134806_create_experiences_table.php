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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('cargo');
            $table->string('empresa');
            $table->string('local')->nullable();
            $table->string('tipo')->nullable();
            $table->string('data_inicio');
            $table->string('data_fim')->nullable();
            $table->text('descricao')->nullable();
            $table->string('tecnologias')->nullable();
            $table->integer('ordem')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
