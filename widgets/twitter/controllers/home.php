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
				
				if(isset($settings['woeid'])) {
					$view_file = 'twitter::trends_'.Input::get('size', 'small');
				}

				$twitter_search = new Twittersearch($settings['search']);

				$view = View::make($view_file);
				if (isset($settings['search'])) {
					$view->with('search', $settings['search'])
						->with('messages', $twitter_search->results());
				}
				elseif (isset($settings['woeid'])) {
					$view->with('messages', $twitter_search->trends($settings['woeid']));
				}

				$view->with('css', File::get(BUNDLE_PATH.'twitter/twitter.css'));
				exit($view);
			}
			else {
				echo "No available settings";
			}
		}
		
	}
}
