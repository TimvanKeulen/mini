<?php

Class Game extends Controller
{

	public function index()
	{
		$this->game_model = $this->loadModel("game");

		$this->view->render("game/index");
	}

	public function play($id = null)
	{
		$this->game_model = $this->loadModel("game");

		if ($id !=null) {
			
			$this->view->photo = $this->game_model->loadPhoto($id);

		} else {
			// random photo
		}
		$this->view->render("game/play");
	}

	public function getlonlat ($id)
	{

	}
}