<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileMidiasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('file_midias', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('logo1',64);
			$table->string('logo2',64);
			$table->string('logo3',64);
			$table->string('img1',64);
			$table->string('img2',32);
			$table->string('img3',32);
			$table->integer('file_id')->unsigned();
			$table->foreign('file_id')->references('id')->on('files');
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
		Schema::drop('file_midias');
	}

}
