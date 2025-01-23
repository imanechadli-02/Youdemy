<?php

require_once '../config/config.php';

class Tags {
    private $dbConnection;

    public function __construct() {
        $this->dbConnection = (new Connection)->getConnection();
        if (!$this->dbConnection) {
            die("Error de connection à la base de données");
        }
    }

    public function addTag() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_modify_tag'])) {
            $name_tags = trim($_POST['tag_name_input']);
            $tags = array_map('trim', explode(',', $name_tags));

            foreach ($tags as $tag) {
                if (!empty($tag)) {
                    $tagModel = new TagModel($this->dbConnection);
                    $tagModel->addTag($tag);
                }
            }
        }
        header('Location: /admin/tags');
        exit();
    }

    public function afficherTag() {
        $query = "SELECT * FROM tags";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}

?>
