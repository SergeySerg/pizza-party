<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('texts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('page_id')->default(0);
			$table->text('name');
			$table->string('type', 55);
			$table->string('title', 255);
			$table->json('description');
			$table->integer('priority')->default(0);
			$table->integer('lang_active')->default(1);
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
		Schema::drop('texts');
	}

}
