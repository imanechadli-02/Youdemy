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

    public function afficherCours()
    {
        $dbConnection = (new Connection())->getConnection();

        if (!$dbConnection) {
            die("Erreur de connexion à la base de données.");
        }

        $query = "
        SELECT * FROM cours 
                join categorie on cours.categorie_id = categorie.categorie_id
                join tags on cours.tag_id = tags.tag_id
                join users on cours.user_id = users.user_id 
        WHERE 
            cours_id = ? AND type = 'text'
    ";

        $stmt = $dbConnection->prepare($query);

        if (!$stmt) {
            die("Erreur lors de la préparation de la requête : " . $dbConnection->error);
        }

        $stmt->bind_param("i", $_SESSION['cours_id']); // "i" pour un entier
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            echo "<script>alert('Aucun cours trouvé pour cet ID.');</script>";
            return null;
        }
    }
}
