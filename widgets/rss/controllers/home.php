<?php
include BUNDLE_PATH.'rss/libraries/rss_feed.php';

class Rss_Home_Controller extends Controller {

	public $restful = true;



	public function post_index()
	{
		$view_file = 'rss::'.Input::get('size', 'small');
		$config_key = Input::get('config');
		
		if (!empty($config_key))
		{
			$settings = Config::get('widgets.'.$config_key);
			if (!empty($settings)) {

          		$site = $settings['site'];
          		$rss_feed = $this->_get_rss_feed($settings['url'], $settings['feedcount']);			
			}
			else {
				$rss_feed = "No available settings";
			}	


		}
		$view = View::make($view_file)
			->with('rss_feed', $rss_feed)
			->with('site', $site)
			->with('css', File::get(BUNDLE_PATH.'rss/rss.css'));
		exit($view);	

	}

	private function _get_rss_feed($url, $feedcount)
	{
		$rf = new rss_feed();
		$data = $rf->get_rss_data($url, $feedcount);
		return $data;
	}
}
