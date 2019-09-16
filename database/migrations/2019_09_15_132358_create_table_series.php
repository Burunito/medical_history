<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateTableSeries extends Migration
{
    use SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serie', 15);
            $table->integer('categoria_id')->unsigned()->default(1);
            $table->integer('usuario_id')->unsigned();
            $table->integer('lote_id')->unsigned();
            $table->date('fecha_caducidad');
            $table->boolean('activo')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('series', function (Blueprint $table) {
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('lote_id')->references('id')->on('lotes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('series', function (Blueprint $table) {
            $table->dropForeign('series_usuario_id_foreign');
            $table->dropForeign('series_lote_id_foreign');
        });

        Schema::dropIfExists('series');
    }
}
