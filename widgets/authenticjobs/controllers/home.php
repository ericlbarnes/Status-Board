<?php
include BUNDLE_PATH.'authenticjobs/libraries/authjobs.php';

class Authenticjobs_Home_Controller extends Controller {

	public $restful = true;



	public function post_index()
	{
		$view_file = 'authenticjobs::'.Input::get('size', 'small');
		
		$search_criteria = array(			 
     		'category' 	    => Input::get('category'),
     		'type'		    => Input::get('type'),
     		'sort'		    => Input::get('sort'),
     		'company'	    => Input::get('company'),
     		'location'      => Input::get('location', 'Australia'),
     		'telecommuting' => Input::get('telecommuting', 1),
     		'keywords'	    => Input::get('keywords'),
     		'page'		    => Input::get('page'),
     		'perpage'	    => Input::get('perpage'),		
		);
		$config_key = Input::get('config');
		
		if (!empty($config_key))
		{
			$settings = Config::get('widgets.'.$config_key);
			if (!empty($settings)) {
				$search_criteria['category']      = isset($settings['category']) ? $settings['category'] : $search_criteria['category'];
				$search_criteria['type']          = isset($settings['type']) ? $settings['type'] : $search_criteria['type'];
				$search_criteria['sort']          = isset($settings['sort']) ? $settings['sort'] : $search_criteria['sort'];
				$search_criteria['company']       = isset($settings['company']) ? $settings['company'] : $search_criteria['company'];
				$search_criteria['location']      = isset($settings['location']) ? $settings['location'] : $search_criteria['location'];
				$search_criteria['telecommuting'] = isset($settings['telecommuting']) ? $settings['telecommuting'] : $search_criteria['telecommuting'];
				$search_criteria['keywords']      = isset($settings['keywords']) ? $settings['keywords'] : $search_criteria['keywords'];
				$search_criteria['page']          = isset($settings['page']) ? $settings['page'] : $search_criteria['page'];
				$search_criteria['perpage']       = isset($settings['perpage']) ? $settings['perpage'] : $search_criteria['perpage'];
			}
			else {
				echo "No available settings";
			}
		}

		
		$authjobs = $this->_get_jobs($search_criteria);

		$view = View::make($view_file)
			->with('authenticjobs', $authjobs)
			->with('css', File::get(BUNDLE_PATH.'authenticjobs/authenticjobs.css'));
		exit($view);
	}

	private function _get_jobs($search_criteria)
	{
		$w = new authjobs();
		$data = $w->get_jobs_data($search_criteria);
		return $data;
	}
}
