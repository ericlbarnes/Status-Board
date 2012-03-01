<?php
/**
 * Grabs weather data from Google.com's weather API and return a nicely formatted array
 *
 * @author Ashwin Surajbali
 * @package Redink Design
 * @version 0.9.2
 *
 * @example
 * $w = new googleWeather();
 * $w->enable_cache = 1;
 * $w->cache_path = '/var/www/mysite.com/cache';
 * $ar_data = $w->get_weather_data(10027);
 * print_r($ar_data);
 * echo $ar_data['forecast'][0]['day_of_week'];
 *
 * Requires PHP 5 or greater
 *
 */

class googleWeather{

	/**
	 * Zipcode
	 *
	 * @var int
	 */
	public $zip;

	/**
	 * Disable or enable caching
	 *
	 * @var boolean
	 */
	public $enable_cache = 0;

	/**
	 * Path to your cache directory
	 * eg. /www/website.com/cache
	 *
	 * @var string
	 */
	public $cache_path = '';

	/**
	 * Cache expiration time in seconds
	 * Default: 3600 = 1 Hour
	 * If the cached file is older than 1 hour, new data is fetched
	 *
	 * @var int
	 */
	public $cache_time = 3600; // 1 hour

	/**
	 * Full location of the cache file
	 *
	 * @var string
	 */
	private $cache_file;

	/**
	 * Location of the google weather api
	 *
	 * @var string
	 */
	private $gweather_api_url = 'http://www.google.com/ig/api?hl=en&weather=';

	/**
	 * Storage var for data returned from curl request to the google api
	 *
	 * @var string
	 */
	private $raw_data;

	/**
	 * Pull weather information for 'Zipcode' passed in
	 * If enable_cache = true, data is cached and refreshed every hour
	 * Weather data is returned in an associative array
	 *
	 * @param int $zip
	 * @return array
	 */
	public function get_weather_data($zip = 0){
		$this->zip = $zip;

		if ($this->enable_cache && !empty($this->cache_path)){
			$this->cache_file = $this->cache_path . '/' . $this->zip;
			return $this->load_from_cache();
		}

		// build the url
		$this->gweather_api_url = trim($this->gweather_api_url . rawurlencode($this->zip));

		if ($this->make_request()){

			$xml = new SimpleXMLElement($this->raw_data);

			$return_array = array();

			$return_array['forecast_info']['city'] = $xml->weather->forecast_information->city['data'];
			$return_array['forecast_info']['zip'] = $xml->weather->forecast_information->postal_code['data'];
			$return_array['forecast_info']['date'] = $xml->weather->forecast_information->forecast_date['data'];
			$return_array['forecast_info']['date_time'] = $xml->weather->forecast_information->current_date_time['data'];

			$return_array['current_conditions']['condition'] = $xml->weather->current_conditions->condition['data'];
			$return_array['current_conditions']['temp_f'] = $xml->weather->current_conditions->temp_f['data'];
			$return_array['current_conditions']['temp_c'] = $xml->weather->current_conditions->temp_c['data'];
			$return_array['current_conditions']['humidity'] = $xml->weather->current_conditions->humidity['data'];
			$return_array['current_conditions']['icon'] = 'http://www.google.com' . $xml->weather->current_conditions->icon['data'];
			$return_array['current_conditions']['wind'] = $xml->weather->current_conditions->wind_condition['data'];

			for ($i = 0; $i < count($xml->weather->forecast_conditions); $i++){
				$data = $xml->weather->forecast_conditions[$i];
				$return_array['forecast'][$i]['day_of_week'] = $data->day_of_week['data'];
				$return_array['forecast'][$i]['low'] = $data->low['data'];
				$return_array['forecast'][$i]['high'] = $data->high['data'];
				$return_array['forecast'][$i]['icon'] = 'http://img0.gmodules.com/' . $data->icon['data'];
				$return_array['forecast'][$i]['condition'] = $data->condition['data'];
			}

		}

		if ($this->enable_cache && !empty($this->cache_path)){
			$this->write_to_cache();
		}

		return $return_array;

	}

	private function load_from_cache(){

		if (file_exists($this->cache_file)){

			$file_time = filectime($this->cache_file);
			$now = time();
			$diff = ($now-$file_time);

			if ($diff <= 3600){
				return unserialize(file_get_contents($this->cache_file));
			}
		}

	}

	private function write_to_cache(){

		if (!file_exists($this->cache_path)){
			// attempt to make the dir
			mkdir($this->cache_path, 0777);
		}

		if (!file_put_contents($this->cache_file, serialize($return_array))){
			echo "<br />Could not save data to cache. Please make sure your cache directory exists and is writable.<br />";
		}
	}

	private function make_request(){

		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_URL, $this->gweather_api_url);
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		$this->raw_data = curl_exec ($ch);
		curl_close ($ch);
		if (empty($this->raw_data)){
			return false;
		}else{
			return true;
		}

	}

}