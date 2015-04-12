<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSoftwaresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('softwares', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name',50)->dafault('');
			$table->string('image')->dafault('');
	        $table->string('description')->dafault('');
	        $table->integer('filesize')->dafault(0);
	        $table->enum('language',['Tiếng anh','Tiếng Việt', 'Đa ngôn ngữ'])->default('Đa ngôn ngữ');
	        $table->enum('license',['Miễn phí','Dùng thử'])->default('Miễn phí');
	        $table->string('download')->dafault('');
	        $table->integer('id_category')->default(0);
	        $table->string('id_system')->default(0);
	        $table->integer('id_publisher')->default(0);
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
		Schema::drop('softwares');
	}

}
