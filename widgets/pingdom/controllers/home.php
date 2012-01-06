<?php
require_once BUNDLE_PATH.'pingdom/libraries/Pingdom.php';

class Pingdom_Home_Controller extends Controller {

	public $restful = true;

	public function get_index()
	{
		$email = Input::get('email');
		$password = Input::get('password');
		$api_key = Input::get('key');
		$check_id = Input::get('checkid');

		$view_file = 'pingdom::'.Input::get('size', 'large');

		$pingdom_results = new Pingdom($email, $password, $api_key, $check_id);

		$view = View::make($view_file)
			->with('checks', $pingdom_results->results())
			->with('css', File::get(BUNDLE_PATH.'pingdom/pingdom.css'));
		exit($view);
	}

	public function post_index()
	{
		$email = Input::get('email');
		$password = Input::get('password');
		$api_key = Input::get('key');
		$check_id = Input::get('checkid');

		$view_file = 'pingdom::'.Input::get('size', 'large');
		
		$pingdom_results = new Pingdom($email, $password, $api_key, $check_id);
		
		$view = View::make($view_file)
			->with('checks', $pingdom_results->results())
			->with('css', File::get(BUNDLE_PATH.'pingdom/pingdom.css'));
		exit($view);
	}
}