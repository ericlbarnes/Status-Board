<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * migration controller
 *
 * Description
 *
 * @license		Copyright Xulon Press, Inc. All Rights Reserved.
 * @author		Xulon Press
 * @link		http://xulonpress.com
 * @email		info@xulonpress.com
 *
 * @file		migration_controller.php
 * @version		1.0
 * @date		11/29/2011
 *
 * Copyright (c) 2011
 */

// --------------------------------------------------------------------------

/**
 * migration_controller class.
 *
 * @extends CI_Controller
 */
class Migration extends CI_Controller
{
	// --------------------------------------------------------------------------

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo 'test';
	}
	// --------------------------------------------------------------------------

	/**
	 * migrate function.
	 *
	 * @access public
	 * @return void
	 */
	public function migrate()
	{
		// simplified version
		$this->load->library('migration');
		$this->migration->latest();
	}

	// --------------------------------------------------------------------------
}
/* End of file migration_controller.php */
/* Location: .igration_controller.php */