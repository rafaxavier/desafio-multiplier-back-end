<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::dropIfExists('users');                                                  
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('cargo', ['admin', 'cozinheiro', 'garcom']);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::insert('insert into users (name, cargo, email, password) values (?,?,?,?)',['Admin', 'admin', 'admin@', Hash::make('1234')]);

        DB::insert('insert into users (name, cargo, email, password) values (?,?,?,?)',['Pedro', 'cozinheiro', 'pedro@', Hash::make('1234')]);

        DB::insert('insert into users (name, cargo, email, password) values (?,?,?,?)',['Luiz', 'garcom', 'luiz@', Hash::make('1234')]);

        DB::insert('insert into users (name, cargo, email, password) values (?,?,?,?)',['Deleon', 'garcom', 'deleon@', Hash::make('1234')]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
