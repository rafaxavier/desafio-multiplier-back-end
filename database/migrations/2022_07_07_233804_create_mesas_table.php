<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::dropIfExists('mesas'); 
        Schema::create('mesas', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
        });

        DB::insert('insert into mesas (numero) values (?)',['1']);
        DB::insert('insert into mesas (numero) values (?)',['2']);
        DB::insert('insert into mesas (numero) values (?)',['3']);
        DB::insert('insert into mesas (numero) values (?)',['4']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mesas');
    }
}
