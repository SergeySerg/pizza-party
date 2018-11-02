<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Article2 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category_id');
			$table->integer('article_id');
			$table->text('type');
			$table->text('name');
			$table->json('title');
			$table->json('short_description');
			$table->json('description');
			$table->json('attributes');
			$table->json('imgs');
			$table->json('files');
			$table->integer('priority')->default(0);
			$table->dateTime('date');
			$table->json('meta_title');
			$table->json('meta_description');
			$table->json('meta_keywords');
			$table->boolean('active')->default(false);
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
		Schema::drop('articles');
	}

}
