<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileTextosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('file_textos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nome_empresa',128);
			$table->string('atividade',64);
			$table->string('nome',128);
			$table->string('cargo',64);
			$table->string('cel1',32);
			$table->string('cel2',32);
			$table->string('fone1',32);
			$table->string('fone2',32);
			$table->string('end',128);
			$table->string('cep',32);
			$table->email('email');
			$table->string('site',64);
			$table->string('obs',128);
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
		Schema::drop('file_textos');
	}

}
