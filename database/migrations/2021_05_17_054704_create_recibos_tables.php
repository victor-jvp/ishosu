<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecibosTables extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('recibos_cab', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger("id_relacion")->nullable();

            $table->dateTime("FECHA");
            $table->string("TIPO_MONEDA", 6)->nullable();
            $table->string("TIPO_PAGO", 1)->nullable();
            $table->string("TIPO_DOC", 6);
            $table->string("NUMEDOCU", 9)->nullable();
            $table->string("TIPO_COBRO", 10)->nullable()->default(null);
            $table->double("PORC")->default(0);
            $table->double("MONTO_DOC")->default(0);
            $table->double("MONTO_RET")->default(0);
            $table->double("TASA_CAMB")->default(0);
            $table->double("VUELTO")->default(0);
            $table->boolean("VUELTO_ENT")->default(false);
            $table->double("SALDO_DOC")->default(0);


            $table->unsignedBigInteger("created_by");
            $table->unsignedBigInteger("updated_by");

            $table->foreign('id_relacion')->references('id')->on('relaciones');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('TIPO_DOC')->references('TIPO_DOC')->on('tipo_documento');

            $table->timestamps();
        });

        Schema::create('recibos_det', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("id_recibo");

            $table->double("CANTIDAD")->nullable();
            $table->double("DENOMINACION")->nullable();
            $table->string("REFERENCIA", 55)->nullable();
            $table->double("MONTO")->nullable();

            $table->foreign('id_recibo')->references('id')->on('recibos_cab')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recibos_det');
        Schema::dropIfExists('recibos_cab');
    }
}
