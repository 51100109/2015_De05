<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user-accounts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username',50)->unique()->dafault('');
	        $table->string('password', 50)->dafault('');
	        $table->integer('admin')->default(0);
	        $table->string('fullname', 100)->dafault('');
	        $table->string('creenname', 50)->dafault('');
	        $table->enum('gender',['Nam','Nữ'])->default('Nam');
	        $table->string('email')->unique()->dafault('');
	        $table->date('birthday')->dafault(date('1993-1-5'));
	        $table->string('address')->dafault('');
	        $table->string('phone')->dafault('');
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
		Schema::drop('user-accounts');
	}

}
