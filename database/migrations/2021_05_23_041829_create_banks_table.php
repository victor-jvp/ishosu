<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('banks');

        Schema::create('banks', function (Blueprint $table) {
            $table->id();

            $table->string("code", 10);
            $table->string("name", 55);
            $table->string("tipo", 1); // E = Emisor, R = Receptor, A = Ambos

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('recibos_det', function (Blueprint $table) {
            $table->date("FECHA_PAGO")->nullable()->after("REFERENCIA");
            $table->unsignedBigInteger("bank_id_e")->nullable()->after("FECHA_PAGO");
            $table->unsignedBigInteger("bank_id_r")->nullable()->after("bank_id_e");


            $table->foreign('bank_id_e')->references('id')->on('banks');
            $table->foreign('bank_id_r')->references('id')->on('banks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns("recibos_det", "bank_id_e");
        Schema::dropColumns("recibos_det", "bank_id_r");
        Schema::dropColumns("recibos_det", "FECHA_PAGO");

        Schema::dropIfExists('banks');
    }
}
