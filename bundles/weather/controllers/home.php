<?php
// include path('bundle').'weather/libraries/gweather.php';

class Weather_Home_Controller extends Controller {

	public $restful = true;

	public function get_index()
	{
		$size = 'small';
		$zip = Input::get('zip', '28056');
		$weather = $this->_get_weather($zip);
		print_r($weather);
		$view = View::make('weather::'.$size)
			->with('weather', $weather);
		exit($view);
	}

	public function post_index()
	{
		$view_file = 'weather::'.Input::get('size', 'small');

		$zip = Input::get('zip', '28056');
		$config_key = Input::get('config');

		if ( ! empty($config_key))
		{
			$settings = Config::get('widgets.'.$config_key);
			if ( ! empty($settings))
			{
				$zip = $settings['zip'];
			}
			else
			{
				echo "No available settings";
			}
		}

		$weather = $this->_get_weather($zip);

		return View::make($view_file)
			->with('weather', $weather)
			->with('css', File::get(path('bundle').'weather/weather.css'));
	}

	private function _get_weather($zip)
	{
		$w = new googleWeather();
		$w->enable_cache = 0;
		$data = $w->get_weather_data($zip);
		$data['location'] = 'Charlotte';
		return $data;
	}
}