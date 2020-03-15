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
        Schema::create('toestellen', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('name');
            $table->string('id_toestel');
            $table->string('location');
            $table->text('description')->nullable();
            $table->integer('is_available')->default('1');
            $table->integer('max_duration_days');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('card_number');
            $table->boolean('is_blacklisted')->default('0');
            $table->string('password')->nullable();
            $table->boolean('is_admin')->default('0');
            $table->string('email')->unique()->nullable();
        });

        Schema::create('rentals', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('id_toestel');
            $table->string('id_ontlener');
            $table->date('start_datum');
            $table->date('eind_datum');
            $table->boolean('is_active')->default('0');
            $table->text('opmerkingen')->nullable();
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
