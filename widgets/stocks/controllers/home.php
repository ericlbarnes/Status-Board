<?php

class Stocks_Home_Controller extends Controller {

	public $restful = true;

	public function get_index()
	{
		$view_file = 'stocks::'.Input::get('size', 'small');
		$exchange = 'NASDAQ';
		$symbol = 'GOOG';

		$stock_data = $this->_get_data($exchange, $symbol);

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

	public function post_index()
	{
		$view_file = 'stocks::'.Input::get('size', 'small');
		$exchange = Input::get('exchange', 'NASDAQ');
		$symbol = Input::get('symbol', 'GOOG');

		$stock_data = $this->_get_data($exchange, $symbol);

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
		
		$quote = file_get_contents($url);

		// Remove CR's from ouput - make it one line
		$json = str_replace('\n', '', $quote);

		// Remove //, [, and ] to build qualified string
		$data = substr($json, 4, strlen($json) - 5);

		// Decode JSON data
		$json_output = json_decode($data, true);

		return $json_output;
	}
}
