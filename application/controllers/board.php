<?php

class Board_Controller extends Controller {

	private $default_title = 'Status Board';

	private $default_theme = 'wood';

	public function action_index()
	{
		// Get default values
		$board_key = Request::uri() === '/' ? 'default' : Request::uri();
		$board_data = Config::get('boards.'.$board_key);

		$view = View::make('board.index');

		// Bind default values to view
		$view->data['page_title'] = $this->default_title;
		$view->data['theme'] = $this->default_theme;
		$view->data['widgets'] = array();

		// Bind custom values to view
		if (is_array($board_data)) {

			if (isset($board_data['name']) && !empty($board_data['name'])) {
				$view->data['page_title'] = $board_data['name'];
			}

			if (isset($board_data['theme']) && !empty($board_data['theme'])) {
				$view->data['theme'] = $board_data['theme'];
			}

			// Bind widgets to view
			// TODO: Is there a better way to do this?
			$widgets = Config::get('widgets');
			if (is_array($board_data['widgets'])) {

				foreach ($board_data['widgets'] as $widget) {

					if (isset($widgets[$widget]) && !empty($widgets[$widget])) {
						$view->data['widgets'][$widget] = $widgets[$widget];
					}

				}

			}

		}

		return $view;
	}

}