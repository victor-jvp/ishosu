<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estaciones', function (Blueprint $table) {
            $table->id();

            $table->string("codigo", 3)->unique();
            $table->string("name", 55)->nullable();
            $table->integer('recibo_num')->default(0);
            $table->integer('relacion_num')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger("estacion_id")->nullable();
            $table->foreign("estacion_id")->references('id')->on('estaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(["estacion_id"]);
        });
        Schema::dropIfExists('estaciones');
    }
}
