<?php

Class Photos extends Controller
{

	public function index()
	{
		$this->photos_model = $this->loadModel("photos");

		$this->view->photos = $this->photos_model->getAllPhotos();

		$this->view->render("photos/index");
	}

	public function addPhoto()
	{
		$this->photos_model = $this->loadModel("photos");

		$echo = $this->photos_model->uploadPhoto($_FILES['file'], sha1($_FILES['file']['name']));

		if ($echo == 'error') {

			$this->view->render('photos/upload_fail');
		}
		elseif ($echo == 'succes') {
		 	$this->view->render('photos/upload_succes');
		}  	
	}
}
