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
        Schema::create('core_stacks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('icon'); // base64 icon
            $table->boolean('invert')->default(false); // for inversion on light theme/dark themes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core_stacks');
    }
};
