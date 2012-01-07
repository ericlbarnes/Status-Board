<?php
include BUNDLE_PATH.'authenticjobs/libraries/authjobs.php';

class Authenticjobs_Home_Controller extends Controller {

	public $restful = true;



	public function post_index()
	{
		$view_file = 'authenticjobs::'.Input::get('size', 'small');
		
		$search_criteria = array(			 
     		'category' 	=> '',
     		'type'		=> '',
     		'sort'		=> '',
     		'company'	=> '',
     		'location'=>Input::get('location', 'Australia'),
     		'telecommuting' => 1,
     		'keywords'	=> '',
     		'page'		=> '',
     		'perpage'	=> '',		
		);
		
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
