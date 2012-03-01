<?php
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

		return View::make($view_file)
			->with('checks', $pingdom_results->results())
			->with('css', File::get(path('bundle').'pingdom/pingdom.css'));
	}

	public function post_index()
	{
		$email = Input::get('email');
		$password = Input::get('password');
		$api_key = Input::get('key');
		$check_id = Input::get('checkid');
		$config_key = Input::get('config');

		if ( ! empty($config_key))
		{
			$settings = Config::get('widgets.'.$config_key);
			if ( ! empty($settings))
			{
				$email = $settings['email'];
				$password = $settings['password'];
				$api_key = $settings['key'];
				if ( ! empty($settings['check_id']))
				{
					$check_id = $settings['check_id'];
				}
			}
			else
			{
				echo "No available settings";
			}
		}

		$view_file = 'pingdom::'.Input::get('size', 'large');

		$pingdom_results = new Pingdom($email, $password, $api_key, $check_id);

		return View::make($view_file)
			->with('checks', $pingdom_results->results())
			->with('css', File::get(path('bundle').'pingdom/pingdom.css'));
	}
}