<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('parent_id');
			$table->integer('article_parent');
			$table->string('link');
			$table->json('title');
			$table->json('short_description');
			$table->json('description');
			$table->json('imgs');
			$table->json('fields');
			$table->json('meta_title');
			$table->json('meta_description');
			$table->json('meta_keywords');
			$table->dateTime('date');
			$table->boolean('active')->default(false);
			$table->integer('priority')->default(0);
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
		Schema::drop('categories');
	}

}
