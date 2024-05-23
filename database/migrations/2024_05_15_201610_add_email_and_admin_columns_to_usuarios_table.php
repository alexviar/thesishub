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
        //modifica una tabla usuarios en la base de datos
        Schema::table('usuarios',function (Blueprint $table) {
            
           // $table->string('nombre')->nullable(false);
         //  $table->unique('username');
            $table->string('email')->nullable(false);
            $table->string('rol')->nullable(false)->defaultValue(false);
            $table->string('estado')->default('activo');
        });
    } 
        
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios',function (Blueprint $table) {
            
            $table->dropColumn('email');
            $table->dropColumn('rol');
            $table->dropColumn('estado');
        });
    }
};
