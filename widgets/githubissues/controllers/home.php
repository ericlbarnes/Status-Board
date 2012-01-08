<?php
require_once BUNDLE_PATH.'githubissues/php-github-api/lib/Github/Autoloader.php';

class Githubissues_Home_Controller extends Controller {

	public $restful = true;

	public function __construct()
	{
		Github_Autoloader::register();
		$this->github = new Github_Client();
	}

	public function get_index()
	{
		$issues = $this->github->getIssueApi()->getList('ellislab', 'codeigniter', 'open');
		print_r($issues);
		$size = 'small';
		$view = View::make('githubissues::small')
			->with('project', 'php-github-api')
			->with('issues', $issues)
			->with('css', File::get(BUNDLE_PATH.'github/github.css'));
		echo $view;
	}

	public function post_index()
	{
		$view_file = 'githubissues::'.Input::get('size', 'small');
		$user = Input::get('user');
		$project = Input::get('project');
		$label = Input::get('label', 'closed');
		$config_key = Input::get('config');
		
		if (!empty($config_key))
		{
			$settings = Config::get('widgets.'.$config_key);
			if (!empty($settings)) {
				$user    = $settings['user'];
				$project = $settings['project'];
				$label   = $settings['label'];
			}
			else {
				echo "No available settings";
			}
		}

		$issues = $this->github->getIssueApi()->getList($user, $project, $label);
		
		$view = View::make($view_file)
			->with('project', $project)
			->with('issues', $issues)
			->with('css', File::get(BUNDLE_PATH.'githubissues/github.css'));
		exit($view);
	}
}