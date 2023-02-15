<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('detalle_eventos', function (Blueprint $table) {
            $table->increments('id_detalle_evento');
            // LLaves foráneas
            $table->integer('id_cliente')->unsigned();
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes');
            $table->integer('id_evento')->unsigned();
            $table->foreign('id_evento')->references('id_evento')->on('eventos');

            // -----------------------------------
            $table->string('direccion');

            $table->integer('id_estado')->unsigned();
            $table->foreign('id_estado')->references('id_estado')->on('estados');

            $table->date('fecha_evento');

            $table->string('costo');
            $table->integer('cantidad_personas');
        
            $table->integer('id_admin')->unsigned();
            $table->foreign('id_admin')->references('id_admin')->on('admins');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_eventos');
    }
};
