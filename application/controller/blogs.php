<?php

class Blogs extends Controller
{

    public function index()
    {
    	$this->blogs = $this->loadModel('blogs');
        // getting all blogs and amount of blogs
        $this->view->blogs = $this->blogs->getAllBlogs();
        $this->view->amount_of_blogs = $this->blogs->getAmountOfBlogs();
        $this->view->render('blogs/index');
    }

    public function addBlog()
    {
        $this->blogs_model = $this->loadModel('blogs');

        // if we have POST data to create a new blog entry
        if (isset($_POST["submit_add_blog"])) {
            // do addSong() in model/model.php
            $this->blogs_model->addBlog($_POST["author"], $_POST["content"],  $_POST["title"]);
        }

        // where to go after song has been added
        header('location: ' . URL . 'blogs/index');
    }

    public function deleteBlog($blog_id)
    {
        $this->blogs_model = $this->loadModel('blogs');

        // if we have an id of a song that should be deleted
        if (isset($blog_id)) {
            // do deleteSong() in model/model.php
            $this->blogs_model->deleteBlog($blog_id);
        }

        // where to go after song has been deleted
        header('location: ' . URL . 'blogs/index');
    }

    public function editBlog($blog_id)
    {
        $this->blogs_model = $this->loadModel('blogs');

        // if we have an id of a song that should be edited
        if (isset($blog_id)) {
            // do getSong() in model/model.php
            $this->view->blog = $this->blogs_model->getBlog($blog_id);

            // in a real application we would also check if this db entry exists and therefore show the result or
            // redirect the user to an error page or similar

            // load views. within the views we can echo out $song easily
            $this->view->render('blogs/edit');
        } else {
            // redirect user to songs index page (as we don't have a song_id)
            header('location: ' . URL . 'blogs/index');
        }
    }

    public function updateBlog()
    {
        $this->blogs_model = $this->loadModel('blogs');

        // if we have POST data to create a new song entry
        if (isset($_POST["submit_update_blog"])) {
            // do updateSong() from model/model.php
            $this->blogs_model->updateBlog($_POST["author"], $_POST["content"],  $_POST["title"], $_POST["blog_id"]);
        }

        // where to go after song has been added
        header('location: ' . URL . 'blogs/index');
    }

}