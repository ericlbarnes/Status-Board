<?php
require_once BUNDLE_PATH.'githubissues/php-github-api/lib/Github/Autoloader.php';

class Githubcommits_Home_Controller extends Controller {

	public $restful = true;

	public function __construct()
	{
		Github_Autoloader::register();
		$this->github = new Github_Client();
	}

	public function get_index()
	{
		$commits = $this->github->getCommitApi()->getBranchCommits('laravel', 'laravel', 'master');
		print_r($commits);
		$size = 'small';
		$view = View::make('githubcommits::small')
			->with('project', 'laravel')
			->with('commits', $commits)
			->with('css', File::get(BUNDLE_PATH.'github/github.css'));
		echo $view;
	}

	public function post_index()
	{
		$view_file = 'githubcommits::'.Input::get('size', 'small');
		$user = Input::get('user', 'laravel');
		$project = Input::get('project', 'laravel');
		$branch = Input::get('branch', 'master');
		$config_key = Input::get('config');
		
		if (!empty($config_key))
		{
			$settings = Config::get('widgets.'.$config_key);
			if (!empty($settings)) {
				$user    = $settings['user'];
				$project = $settings['project'];
				$branch   = $settings['branch'];
			}
			else {
				echo "No available settings";
			}
		}

		$commits = $this->github->getCommitApi()->getBranchCommits($user, $project, $branch);
		
		$view = View::make($view_file)
			->with('project', $project)
			->with('commits', $commits)
			->with('branch', $branch)
			->with('css', File::get(BUNDLE_PATH.'githubissues/github.css'));
		exit($view);
	}
}
