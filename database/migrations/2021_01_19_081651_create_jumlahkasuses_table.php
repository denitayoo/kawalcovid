<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJumlahkasusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jumlahkasuses', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('id_rw')->unsigned();
            $table->integer('reaktif'); 
            $table->integer('jumlah_positif'); 
            $table->integer('jumlah_meninggal');
            $table->integer('jumlah_sembuh');
            $table->date('tanggal');
           
            $table->foreign('id_rw')->references('id')->on('rws')
            ->onDelete('cascade')->onUpdate('cascade');
           
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
        Schema::dropIfExists('jumlahkasuses');
    }
}
