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
		$email = Input::get('email');
		$password = Input::get('password');
		$profile_id = Input::get('profile_id');
		$config_key = Input::get('config');
		
		if (!empty($config_key))
		{
			$settings = Config::get('widgets.'.$config_key);
			if (!empty($settings)) {
				$email      = $settings['email'];
				$password   = $settings['password'];
				$profile_id = $settings['profile_id'];
				$config_key = $settings['config'];
			}
			else {
				echo "No available settings";
			}
		}

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
			->with('current_month_visits', $current_month_visits)
			->with('css', File::get(BUNDLE_PATH.'analytics/analytics.css'));
		exit($view);
	}
}
