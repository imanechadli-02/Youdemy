<?php

class TagModel {
    private $dbConnection;

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function addTag($tag) {
        $query = "INSERT INTO tags (name) VALUES (?)";  
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bind_param("s", $tag);  
        $stmt->execute();
    }

}

?>
