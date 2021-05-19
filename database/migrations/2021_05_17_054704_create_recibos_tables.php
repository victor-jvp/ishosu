<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecibosTables extends Migration
{
    /**
     * Run the migrations.
     *
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
            $table->string("TIPO_DOC", 6)->nullable();
            $table->string("NUMEDOCU", 10)->nullable();
            $table->double("MONTO_DOC_VEF")->nullable()->default(null);
            $table->double("MONTO_DOC_USD")->nullable()->default(null);
            $table->double("TASA_CAMB")->nullable()->default(null);
            $table->double("VUELTO")->nullable()->default(null);
            $table->double("SALDO_CLI")->nullable()->default(null);


            $table->unsignedBigInteger("created_by");
            $table->unsignedBigInteger("updated_by");

            $table->foreign('id_relacion')->references('id')->on('relaciones');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');

            $table->timestamps();
        });

        Schema::create('recibos_det', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("id_recibo");

            $table->integer("CANTIDAD")->nullable();
            $table->double("DENOMINACION")->nullable();
            $table->string("REFERENCIA", 55)->nullable();
            $table->double("MONTO")->nullable();

            $table->foreign('id_recibo')->references('id')->on('recibos_cab')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recibos_det');
        Schema::dropIfExists('recibos_cab');
    }
}
