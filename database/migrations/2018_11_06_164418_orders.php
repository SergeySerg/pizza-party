<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function(Blueprint $table){
            $table->increments('id');
            $table->text('name');
            $table->text('address');
            $table->integer('phone');
            $table->integer('sum');
            $table->json('short_description');
            $table->json('attributes');
            $table->json('imgs');
            $table->json('other');
            $table->integer('priority')->default(0);
            $table->timestamp('date');
            $table->boolean('active')->default(true);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
