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
        Schema::create('emploi_filiere', function (Blueprint $table) {
            $table->string('filiere');
            $table->string('jour_semaine');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->unsignedBigInteger('id_salle');
            $table->unsignedBigInteger('id_enseignant');
            $table->string('matiere');

            $table->primary(['filiere','jour_semaine', 'heure_debut', 'heure_fin', 'id_salle']);

            $table->foreign('id_enseignant')->references('id')->on('enseignant');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emploi_filiere');
    }
};
