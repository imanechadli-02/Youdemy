<?php


require_once "../config/config.php";
require_once "classCours.php";

class CoursText extends Cours
{

    public function ajouterCours()
    {
        $titre = $this->getTitre();
        $description = $this->getDescription();
        $image = $this->getImage();
        $content_text = $this->getContentText();
        $tag_id = $this->getTagId();
        $categorie_id = $this->getCategorieId();
        $enseignant_id = $this->getEnseignantId();
        $type = 'text';

        $dbConnection = (new Connection())->getConnection();

        if ($dbConnection) {

            $query = "INSERT INTO Cours (titre, description, image, content_text, tag_id, categorie_id, user_id, type) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $dbConnection->prepare($query);
            $stmt->bind_param("ssssiiis", $titre, $description, $image, $content_text, $tag_id, $categorie_id, $enseignant_id, $type);

            if ($stmt->execute()) {
                echo "<script>alert('Course added successfully')</script>";
            } else {
                echo "<script>alert('Error during insertion.')</script>" . $stmt->error;
            }
        }
    }
}
