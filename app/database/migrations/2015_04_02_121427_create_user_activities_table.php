<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserActivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_activities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_user')->default(0);
			$table->enum('activity',['Thêm','Xóa', 'Chỉnh sửa', 'Xem thông tin', 'Tải về'])->default('Thêm');
			$table->enum('target',['Thành viên', 'Bài đăng', 'Bình luận', 'Phần mềm', 'Danh mục','Nhà phát hành','Hệ điều hành'])->default('Bình luận');
			$table->integer('id_target')->default(0);
			$table->string('infor')->default('')->nullable();
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
		Schema::drop('user_activities');
	}

}
