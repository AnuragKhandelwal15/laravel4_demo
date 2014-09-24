<?php

use Illuminate\Database\Migrations\Migration;

class UpdateUsersTableAddImage extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::table('users', function($table)
            {
                $table->string('image', 255);
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::table('users', function($table)
            {
                $table->dropColumn('image');
            });
	}

}