<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('name');
            $table->string('id_toestel')->unique();
            $table->string('location');
            $table->text('description')->nullable();
            $table->text('specificaties')->nullable();
            $table->integer('is_available')->default('1');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('name')->nullable()->nullable();
            $table->string('email')->unique();
            $table->string('card_number')->nullable();
            $table->boolean('is_blacklisted')->default('0');
            $table->string('password')->nullable();
            $table->boolean('is_admin')->default('0');
            $table->timestamps();
        });

        Schema::create('rentals', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('id_toestel');
            $table->string('id_ontlener');
            $table->string('email_ontlener');
            $table->date('start_datum');
            $table->date('eind_datum');
            $table->date('terug_datum');
            $table->boolean('is_active')->default('1');
            $table->text('opmerkingen')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('toestellen');
        Schema::dropIfExists('users');
        Schema::dropIfExists('rentals');
    }
}
