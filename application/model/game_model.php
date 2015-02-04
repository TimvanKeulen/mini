<?php

class gameModel
{
	public function loadPhoto($id)
    {
        $sql = "SELECT * FROM photo WHERE id=:id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);
        
        return $query->fetch()->pathname;
    }
}