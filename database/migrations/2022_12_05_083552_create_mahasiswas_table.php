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
        Schema::create('mahasiswas', function (Blueprint $table) {
						$table->string('nim')->primary();
						$table->string('nama');
						$table->integer('angkatan');
						$table->string('password');
						$table->unsignedBigInteger('id_prodi');
						$table->foreign('id_prodi')->references('id')->on('prodis')->onDelete('cascade');
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
        Schema::dropIfExists('mahasiswas');
    }
};
