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
		Schema::create('user_accounts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username',50)->unique()->default('');
	        $table->string('password', 64)->default('');
	        $table->integer('admin')->default(0);
	        $table->string('fullname', 100)->default('');
	        $table->string('creenname', 50)->default('');
	        $table->enum('gender',['Nam','Nữ'])->default('Nam');
	        $table->string('email')->unique()->default('');
	        $table->date('birthday')->default(date('1993-1-5'));
	        $table->string('address')->default('');
	        $table->string('phone')->default('');
	        $table->rememberToken();
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
		Schema::drop('user_accounts');
	}

}
