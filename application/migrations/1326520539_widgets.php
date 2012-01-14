<?php

class Widgets {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('widgets', function($table)
		{
			$table->create();
			$table->increments('id');
			$table->string('name');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('widgets', function($table)
		{
			$table->drop();
		});
	}

}