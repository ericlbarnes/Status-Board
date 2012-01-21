<?php

class Time_Home_Controller extends Controller {

	public function action_index()
	{
		$size = Input::get('size', 'small');
		
		$view_file = 'time::'.$size;

		$view = View::make($view_file)
			->with('css', File::get(BUNDLE_PATH.'time/time.css'));
		exit($view);
	}
}
