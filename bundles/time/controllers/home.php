<?php

class Time_Home_Controller extends Controller {

	public function action_index()
	{
		$size = Input::get('size', 'small');

		$view_file = 'time::'.$size;

		return View::make($view_file)
			->with('css', File::get(path('bundle').'time/time.css'));
	}
}
