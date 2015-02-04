<?php

class BlogsModel
{
	
	public function getAllBlogs()
    {
        $sql = "SELECT id, author, content, title FROM blog";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    public function addBlog($author, $content, $title)
    {
        $sql = "INSERT INTO blog (author, content, title) VALUES (:author, :content, :title)";
        $query = $this->db->prepare($sql);
        $parameters = array(':author' => $author, ':content' => $content, ':title' => $title);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    public function deleteBlog($blog_id)
    {
        $sql = "DELETE FROM blog WHERE id = :blog_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':blog_id' => $blog_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    public function getBlog($blog_id)
    {
        $sql = "SELECT id, author, content, title FROM blog WHERE id = :blog_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':blog_id' => $blog_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    public function updateBlog($author, $content, $title, $blog_id)
    {
        $sql = "UPDATE blog SET author = :author, content = :content, title = :title WHERE id = :blog_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':author' => $author, ':content' => $content, ':title' => $title, ':blog_id' => $blog_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    public function getAmountOfBlogs()
    {
        $sql = "SELECT COUNT(id) AS amount_of_blogs FROM blog";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_blogs;
    }

}

?>