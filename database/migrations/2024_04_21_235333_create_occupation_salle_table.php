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
        Schema::create('occupation_salle', function (Blueprint $table) {
            $table->unsignedBigInteger('id_salle');
            $table->string('jour_semaine');
            $table->time('heure_debut');
            $table->time('heure_fin');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('occupation_salle');
    }
};
