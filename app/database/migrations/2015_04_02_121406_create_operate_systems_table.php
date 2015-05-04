<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOperateSystemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('operate_systems', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('image')->default('');
			$table->string('name')->unique()->default('');
			$table->string('id_category')->default('');
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
		Schema::drop('operate_systems');
	}

}
