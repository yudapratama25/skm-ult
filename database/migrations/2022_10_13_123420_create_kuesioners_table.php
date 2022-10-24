<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKuesionersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuesioners', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jenis_kelamin', 10);
            $table->string('pendidikan', 100);
            $table->string('pekerjaan');
            $table->string('instansi');
            $table->string('jenis_layanan');
            $table->tinyInteger('p1');
            $table->tinyInteger('p2');
            $table->tinyInteger('p3');
            $table->tinyInteger('p4');
            $table->tinyInteger('p5');
            $table->tinyInteger('p6');
            $table->tinyInteger('p7');
            $table->tinyInteger('p8');
            $table->tinyInteger('p9');
            $table->text('saran');
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
        Schema::dropIfExists('kuesioners');
    }
}
