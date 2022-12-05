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
		Schema::create('mahasiswa_matakuliah', function (Blueprint $table) {
			$table->id();
			$table->string('mhsNim')->nullable('false');
			$table->unsignedBigInteger('mkId')->nullable('false');
			$table->foreign('mhsNim')->references('nim')->on('mahasiswas')->onDelete('cascade');
			$table->foreign('mkId')->references('id')->on('matakuliahs')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('mahasiswa_matakuliah');
	}
};
