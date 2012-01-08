<?php
require_once BUNDLE_PATH.'twitter/libraries/Twittersearch.php';

class Twitter_Home_Controller extends Controller {

	public $restful = true;

	public function get_index()
	{
		$view_file = 'twitter::'.Input::get('size', 'small');
		$search = 'laravel';
		$twitter_search = new Twittersearch($search);

		$size = 'small';
		$view = View::make($view_file)
			->with('search', $search)
			->with('messages', $twitter_search->results())
			->with('css', File::get(BUNDLE_PATH.'twitter/twitter.css'));
		exit($view);
	}

	public function post_index()
	{
		$view_file = 'twitter::'.Input::get('size', 'small');
		$search = Input::get('search', 'laravel');
		$config_key = Input::get('config');
		
		if (!empty($config_key))
		{
			$settings = Config::get('widgets.'.$config_key);
			if (!empty($settings)) {
				$search = $settings['search'];
			}
			else {
				echo "No available settings";
			}
		}
		
		$twitter_search = new Twittersearch($search);
		
		$view = View::make($view_file)
			->with('search', $search)
			->with('messages', $twitter_search->results())
			->with('css', File::get(BUNDLE_PATH.'twitter/twitter.css'));
		exit($view);
	}
}
