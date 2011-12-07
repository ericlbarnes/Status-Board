<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Initial Setup
 *
 * Description
 *
 * @license		Copyright Xulon Press, Inc. All Rights Reserved.
 * @author		Xulon Press
 * @link		http://xulonpress.com
 * @email		info@xulonpress.com
 *
 * @file		001_initial_setup.php
 * @version		1.0
 * @date		11/22/2011
 *
 * Copyright (c) 2011
 */

// --------------------------------------------------------------------------

/**
 * Migration_Initial_setup class.
 *
 * @extends CI_Migration
 */
class Migration_Initial_setup extends CI_Migration
{

	/**
	 * up function.
	 *
	 * @access public
	 * @return void
	 */
	public function up()
	{
		// --------------------------------------------------------------------------
		// accounts

		$fields = array(
                        'blog_id' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 5,
                                                 'unsigned' => TRUE,
                                                 'auto_increment' => TRUE
                                          ),
                        'blog_title' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100',
                                                 'null' => TRUE,
                                          ),
                        'blog_author' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '100',
                                                 'default' => 'King of Town',
                                          ),
                        'blog_description' => array(
                                                 'type' => 'TEXT',
                                                 'null' => TRUE,
                                          ),
                );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('blog_id', TRUE);

        $this->dbforge->create_table('test');
        $this->dbforge->add_field('id');
		$this->dbforge->add_field(array(
			'prefix' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE
			),
			'first_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '300',
				'null' => TRUE
			),
			'middle_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '300',
				'null' => TRUE
			),
			'last_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '300',
				'null' => TRUE
			),
			'suffix' => array(
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => TRUE
			),
			'email_address' => array(
				'type' => 'VARCHAR',
				'constraint' => '300',
				'null' => TRUE
			),
			'phone_number' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => TRUE
			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => '300',
				'null' => TRUE
			)
		));
		$this->dbforge->create_table('ci_accounts');

	}

	// --------------------------------------------------------------------------

	/**
	 * down function.
	 *
	 * @access public
	 * @return void
	 */
	public function down()
	{
		$this->dbforge->drop_table('ci_accounts');
	}

	// --------------------------------------------------------------------------
}
/* End of file 001_initial_setup.php */
/* Location: ./booktrack/application/migrations/001_initial_setup.php */