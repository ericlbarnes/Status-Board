<?php

class Home_Controller extends Base_Controller {

	/*
	|--------------------------------------------------------------------------
	| The Default Controller
	|--------------------------------------------------------------------------
	|
	| Instead of using RESTful routes and anonymous functions, you might wish
	| to use controllers to organize your application API. You'll love them.
	|
	| This controller responds to URIs beginning with "home", and it also
	| serves as the default controller for the application, meaning it
	| handles requests to the root of the application.
	|
	| You can respond to GET requests to "/home/profile" like so:
	|
	|		public function action_profile()
	|		{
	|			return "This is your profile!";
	|		}
	|
	| Any extra segments are passed to the method as parameters:
	|
	|		public function action_profile($id)
	|		{
	|			return "This is the profile for user {$id}.";
	|		}
	|
	*/

	public function action_index()
	{
		// Get default values
		$board_key = Request::uri() === '/' ? 'default' : Request::uri();
		$board_data = Config::get('boards.'.$board_key);

		$view = View::make('layouts.common');

		// Bind default values to view
		$view->data['page_title'] = $this->default_title;
		$view->data['theme'] = $this->default_theme;
		$view->data['widgets'] = array();

		// Bind custom values to view
		if (is_array($board_data))
		{

			if (isset($board_data['name']) && ! empty($board_data['name']))
			{
				$view->data['page_title'] = $board_data['name'];
			}

			if (isset($board_data['theme']) && ! empty($board_data['theme']))
			{
				$view->data['theme'] = $board_data['theme'];
			}

			// Bind widgets to view
			// TODO: Is there a better way to do this?
			$widgets = Config::get('widgets');
			if (is_array($board_data['widgets']))
			{

				foreach ($board_data['widgets'] as $widget)
				{

					if (isset($widgets[$widget]) && !empty($widgets[$widget]))
					{
						$view->data['widgets'][$widget] = $widgets[$widget];
					}

				}

			}

		}

		return $view;
	}

}