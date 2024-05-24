<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->string('email')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->boolean('estado')->default(1);
            
            $table->unique('username');
            $table->unique('email');
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
            $table->dropUnique(['username']);
            $table->dropUnique(['email']);
            $table->dropColumn('email');
            $table->dropColumn('is_admin');
            $table->dropColumn('estado');
        });
    }
};
