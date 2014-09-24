<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('myfiles', function(Blueprint $table)
            {
                $table->increments('id');
                
                //Adds a Foreign Key  to the user_id 
                $table->integer('user_id')->unsigned();
                $table->string('file_name');
                $table->string('file_type');
                $table->string('file_path',255);
                
                //Adds deleted_at column for soft deletes
                $table->softDeletes();
                $table->timestamps();
            });
            
            // Add foreign key for user id
            Schema::table('myfiles', function($table) {
                $table->foreign('user_id')->references('id')->on('users');
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::table('myfiles', function($table) {
                $table->dropForeign('myfiles_user_id_foreign');
            });
            
            Schema::drop('myfiles');
	}

}
