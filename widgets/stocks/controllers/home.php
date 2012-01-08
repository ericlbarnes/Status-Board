<?php

class Stocks_Home_Controller extends Controller {

	public function action_index()
	{
		$size = Input::get('size', 'small');
		$exchange = Input::get('exchange', 'NASDAQ');
		$symbol = Input::get('symbol', 'GOOG');
		$config_key = Input::get('config');
		
		if (!empty($config_key))
		{
			$settings = Config::get('widgets.'.$config_key);
			if (!empty($settings)) {
				$exchange = $settings['exchange'];
				$symbol = $settings['symbol'];
			}
			else {
				echo "No available settings";
			}
		}

		$stock_data = $this->_get_data($exchange, $symbol);

		$view_file = 'stocks::'.$size;

		$view = View::make($view_file)
			->with('exchange', $exchange)
			->with('symbol', $symbol)
			->with('price', $stock_data[0]['l'])
			->with('change', $stock_data[0]['c'])
			->with('change_class', $stock_data[0]['c'] > 0 ? 'up' : 'down')
			->with('time', $stock_data[0]['lt'])
			->with('css', File::get(BUNDLE_PATH.'stocks/stocks.css'));
		exit($view);
	}

	private function _get_data($exchange, $symbol)
	{
		$url = "http://finance.google.com/finance/info?client=ig&q={$exchange}:{$symbol}";

		$quote = @file_get_contents($url);

		// Remove CR's from ouput - make it one line
		$json = str_replace('\n', '', $quote);

		// Remove //, [, and ] to build qualified string
		$data = substr($json, 4, strlen($json) - 5);

		// Decode JSON data
		$json_output = json_decode($data, true);

		return $json_output;
	}
}
