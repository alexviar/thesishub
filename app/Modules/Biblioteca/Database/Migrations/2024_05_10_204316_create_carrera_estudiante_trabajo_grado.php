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
        Schema::create('carrera_estudiante_trabajo_grado', function (Blueprint $table) {
            $table->foreignIdFor(\App\Modules\Biblioteca\Models\Carrera::class)->constrained();
            $table->foreignIdFor(\App\Modules\Biblioteca\Models\Estudiante::class)->constrained();
            $table->foreignIdFor(\App\Modules\Biblioteca\Models\TrabajoGrado::class)->constrained("trabajos_grado");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrera_estudiante_trabajo_grado');
    }
};
