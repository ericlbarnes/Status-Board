<?php

class Boards {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('boards', function($table)
		{
			$table->create();
			$table->increments('id');
			$table->string('name');
			$table->string('theme');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('boards', function($table)
		{
			$table->drop();
		});
	}

}