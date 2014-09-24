<?php

use Illuminate\Database\Migrations\Migration;

class UpdateMyfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::table('myfiles', function($table)
            {
                $table->string('thumbnail_path');
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}