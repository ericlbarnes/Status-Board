<?php
require_once BUNDLE_PATH.'analytics/lib/googleanalytics.class.php';

class Analytics_Home_Controller extends Controller {

	public $restful = true;

	public function get_index()
	{
		$view_file = 'analytics::'.Input::get('size', 'small');
		$email = Input::get('email');
		$password = Input::get('password');
		$profile_id = Input::get('profile_id');

		$dimensions = array('date');
		$metrics    = array('visits');

		$ga = new GoogleAnalytics($email,$password);
		$ga->setProfile('ga:'.$profile_id);

		$from_date = date('Y-m-d', strtotime(" -1 week"));
		$to_date = date('Y-m-d');
		$ga->setDateRange($from_date , $to_date);

		$report = $ga->getReport(
			array('dimensions' => urlencode('ga:date'),
				'metrics' => urlencode('ga:pageviews,ga:visits,ga:bounces'),
				'sort' => '-ga:pageviews'
			)
		);

		ksort($report);

		$i = 0;
		foreach($report as $date => $data)
		{
			$visits[] = $data['ga:visits'];
			if ($i == 0)
			{
				$labels[] = '';
			}
			else
			{
				$labels[] = date("M j", strtotime($date));
			}
			$pageviews[] = $data['ga:pageviews'];
			$bounces[] = $data['ga:bounces'];
			$i++;
		}

		$visits_string = implode(',', $visits);
		$labels_string = implode('|', $labels);

		// Calculate the progress
		$current_month_visits = array_pop($visits);
		$avg_visits = floor(array_sum($visits) / count($visits));
		$last_complete_month = array_pop($visits);
		$change = floor(($last_complete_month / $avg_visits) * 100);

		$size = 'small';
		$view = View::make('analytics::medium')
			->with('visits', $visits_string)
			->with('labels', $labels_string)
			->with('yesterday', $last_complete_month)
			->with('today', $current_month_visits)
			->with('max', max($visits))
			->with('change', $change)
			->with('avg_visits', $avg_visits > 1000 ? floor($avg_visits/1000) . 'K' : $avg_visits)
			->with('current_month_visits', $current_month_visits);
		echo $view;
	}

	public function post_index()
	{
		$view_file = 'analytics::'.Input::get('size', 'medium');
		$config_key = Input::get('config');
		$report = 'visitors';
		
		if (!empty($config_key))
		{
			$settings = Config::get('widgets.'.$config_key);
			if (!empty($settings)) {
				if (isset($settings['report'])) {
					$report_name = $settings['report'];
				}
			}
		}

		if (!empty($report_name)) {
			$report_settings = Config::get('analytics::reports.'.$report_name);

			if (method_exists($this, $report_name."_report")) {
				call_user_func_array(array($this, $report_name."_report"), array($settings, $report_settings));
			}
		}

	}
	
	private function visitors_report($widget_settings, $report_settings)
	{
		$report = $this->retrieve_data($widget_settings, $report_settings);
		
		$i = 0;
		foreach($report as $date => $data)
		{
			$visits[] = $data['ga:visits'];
			if ($i == 0)
			{
				$labels[] = '';
			}
			else
			{
				$labels[] = date("M j", strtotime($date));
			}
			$pageviews[] = $data['ga:pageviews'];
			$bounces[] = $data['ga:bounces'];
			$i++;
		}

		$visits_string = implode(',', $visits);
		$labels_string = implode('|', $labels);

		// Calculate the progress
		$current_month_visits = array_pop($visits);
		$avg_visits = floor(array_sum($visits) / count($visits));
		$last_complete_month = array_pop($visits);
		$change = floor(($last_complete_month / $avg_visits) * 100);

		$view = View::make('analytics::visitors_medium')
			->with('visits', $visits_string)
			->with('labels', $labels_string)
			->with('yesterday', $last_complete_month)
			->with('today', $current_month_visits)
			->with('max', max($visits))
			->with('change', $change)
			->with('avg_visits', $avg_visits > 1000 ? floor($avg_visits/1000) . 'K' : $avg_visits)
			->with('current_month_visits', $current_month_visits)
			->with('report_settings', $report_settings)
			->with('widget_settings', $widget_settings)
			->with('css', File::get(BUNDLE_PATH.'analytics/analytics.css'));
		exit($view);
	}

	private function top_content_report($widget_settings, $report_settings)
	{
		$report = $this->retrieve_data($widget_settings, $report_settings);
		
		$view = View::make('analytics::top_content_medium')
			->with('content', $report)
			->with('report_settings', $report_settings)
			->with('widget_settings', $widget_settings)
			->with('css', File::get(BUNDLE_PATH.'analytics/analytics.css'));
		exit($view);
	}

	private function top_sections_report($widget_settings, $report_settings)
	{
		$report = $this->retrieve_data($widget_settings, $report_settings);

		$view = View::make('analytics::top_content_medium')
			->with('content', $report)
			->with('report_settings', $report_settings)
			->with('widget_settings', $widget_settings)
			->with('css', File::get(BUNDLE_PATH.'analytics/analytics.css'));
		exit($view);
	}

	private function search_report($widget_settings, $report_settings)
	{
		$report = $this->retrieve_data($widget_settings, $report_settings);

		$remove = array('(not set)', '(other)', '(not provided)');
		foreach($remove as $keyword) {
			unset($report[$keyword]);
		}

		$view = View::make('analytics::search_medium')
			->with('content', $report)
			->with('report_settings', $report_settings)
			->with('widget_settings', $widget_settings)
			->with('css', File::get(BUNDLE_PATH.'analytics/analytics.css'));
		exit($view);
	}

	private function retrieve_data($settings, $report_settings)
	{
		$dimensions = array('date');
		$metrics    = array('visits');
		
		$ga = new GoogleAnalytics($settings['email'], $settings['password']);
		$ga->setProfile('ga:'.$settings['profile_id']);

		$from_date = date('Y-m-d', strtotime(" -".$report_settings['start']));
		$to_date = date('Y-m-d');
		$ga->setDateRange($from_date , $to_date);
		
		$properties = array();
		foreach($report_settings['properties'] as $key => $value) {
			$properties[$key] = urlencode($value);
		}
		if (isset($settings['filters'])) {
			foreach($settings['filters'] as $filter => $options) {
				if (is_array($options)) {
					foreach ($options as $option) {
						if ($properties['filters'] != '') {
							$properties['filters'] .= ";";	// AND setting
						}
						$properties['filters'] .= $filter.$option;
					}
				}
				else {
					$properties['filters'] .= $filter.$options;
				}
			}
			$properties['filters'] = urlencode($properties['filters']);
		}

		return $ga->getReport($properties);
		
	}
}
