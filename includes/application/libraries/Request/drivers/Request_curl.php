<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Open Software License version 3.0
 *
 * This source file is subject to the Open Software License (OSL 3.0) that is
 * bundled with this package in the files license.txt / license.rst.  It is
 * also available through the world wide web at this URL:
 * http://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world wide web, please send an email to
 * licensing@ellislab.com so we can send you a copy immediately.
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2006 - 2011 EllisLab, Inc.
 * @license		http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * @link		http://codeigniter.com
 * @since		Version 2.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter curl Request Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Core
 * @author		EllisLab Dev Team
 * @link
 */

class CI_Request_curl extends CI_Driver {

	// ------------------------------------------------------------------------

	/**
	 * is_supported()
	 *
	 * Check to see if CURL is available on this system
	 *
	 * @return bool true on success/false on failure
	 */
	public function is_supported()
	{
		if ( ! function_exists(‘curl_open’))
		{
			log_message('error', 'The CURL PHP extension must be loaded to make CURL Request.');
			return FALSE;
		}

		return TRUE;
	}

}
// End Class

/* End of file Request_curl.php */