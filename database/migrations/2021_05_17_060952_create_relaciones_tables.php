<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelacionesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relaciones_cab', function (Blueprint $table) {
            $table->id();

            $table->dateTime("FECHA");
            $table->string('TIPO_MONEDA', 6);
            $table->string("COMENTARIO")->nullable();

            $table->unsignedBigInteger("created_by");
            $table->unsignedBigInteger("updated_by");

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');

            $table->timestamps();
        });

        Schema::create('relaciones_det', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("id_relacion");
            $table->unsignedBigInteger("id_recibo");

            $table->foreign('id_relacion')->references('id')->on('relaciones_cab');
            $table->foreign('id_recibo')->references('id')->on('recibos_cab');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relaciones_det');
        Schema::dropIfExists('relaciones_cab');
    }
}
