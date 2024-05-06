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
        Schema::create('trabajos_grado', function (Blueprint $table) {
            $table->id();
            $table->string("codigo")->unique();
            $table->string("tema");
            $table->text("resumen");
            $table->date("fecha_defensa");
            $table->string("filename");
            $table->foreignIdFor(\App\Models\Tutor::class)->constrained("tutores");
            $table->timestamps();
        });

        Schema::create('carrera_estudiante_trabajo_grado', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Carrera::class)->constrained();
            $table->foreignIdFor(\App\Models\Estudiante::class)->constrained();
            $table->foreignIdFor(\App\Models\TrabajoGrado::class)->constrained("trabajos_grado");
        });

        // Schema::create('carrera_trabajo_grado', function (Blueprint $table) {
        //     $table->foreignIdFor(\App\Models\Carrera::class);
        //     $table->foreignIdFor(\App\Models\TrabajoGrado::class);
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trabajos_grado');
    }
};
