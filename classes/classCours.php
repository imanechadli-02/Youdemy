<?php

require_once "../config/config.php";

class Cours
{
    private $dbConnection;
    protected $id;
    protected $titre;
    protected $description;
    protected $image;
    protected $content_text;
    protected $content_video;
    protected $tag_id;
    protected $categorie_id;
    protected $enseignant_id;



    public function __construct()
    {
        $this->dbConnection = (new Connection)->getConnection();
        if (!$this->dbConnection) {
            die("Erreur de connexion à la base de données.");
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getContentText()
    {
        return $this->content_text;
    }

    public function setContentText($content_text)
    {
        $this->content_text = $content_text;
    }

    public function getContentVideo()
    {
        return $this->content_video;
    }

    public function setContentVideo($content_video)
    {
        $this->content_video = $content_video;
    }

    public function getTagId()
    {
        return $this->tag_id;
    }

    public function setTagId($tag_id)
    {
        $this->tag_id = $tag_id;
    }

    public function getCategorieId()
    {
        return $this->categorie_id;
    }

    public function setCategorieId($categorie_id)
    {
        $this->categorie_id = $categorie_id;
    }

    public function getEnseignantId()
    {
        return $this->enseignant_id;
    }

    public function setEnseignantId($enseignant_id)
    {
        $this->enseignant_id = $enseignant_id;
    }

    public function ajouterCours() {}

    public function afficherCardCours()
    {
        $enseignant_id = $this->getEnseignantId();
        $dbConnection = (new Connection())->getConnection();

        if ($dbConnection) {
            $query = "SELECT *
                      FROM cours 
                      JOIN categorie ON cours.categorie_id = categorie.categorie_id
                      WHERE cours.user_id = ?";

            $stmt = $dbConnection->prepare($query);
            $stmt->bind_param('i', $enseignant_id);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $courses = $result->fetch_all(MYSQLI_ASSOC); // Fetch all courses as an associative array
                return $courses;
            } else {
                echo "Error: " . $stmt->error;
                return [];
            }
        }
        return [];
    }

    public function getCoursById($id) {
        $dbConnection = (new Connection())->getConnection();
        $sql = "SELECT * FROM cours WHERE id = ?";
        $stmt = $dbConnection->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    


    public function modifierCours($id, $titre, $description, $image, $content_text, $categorie_id, $tag_id)
    {
        // Connexion à la base de données
        $dbConnection = (new Connection())->getConnection();

        // Requête SQL avec des placeholders
        $query = "UPDATE cours 
                  SET titre = ?, description = ?, image = ?, 
                      content_text = ?, categorie_id = ?, tag_id = ?
                  WHERE id = ?";

        // Préparer la requête
        $stmt = $dbConnection->prepare($query);

        if (!$stmt) {
            die("Erreur lors de la préparation de la requête : " . $dbConnection->error);
        }

        // Lier les paramètres (types : s = string, i = integer, b = blob)
        $stmt->bind_param(
            'sssiiii', // Types des variables : string (s), integer (i)
            $titre,
            $description,
            $image,
            $content_text,
            $categorie_id,
            $tag_id,
            $id
        );

        // Exécuter la requête
        $result = $stmt->execute();

        if (!$result) {
            die("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }

        // Fermer la requête et la connexion
        $stmt->close();
        $dbConnection->close();

        return $result;
    }




    public function afficherDetailCoursProf()
    {
        $enseignant_id = $this->getEnseignantId();
        $dbConnection = (new Connection())->getConnection();
        if ($dbConnection) {
            $query = "SELECT titre.cours, description.cours, image.cours FROM cours 
                       join categorie on cours.categorie_id= categorie.categorie_id
                       where user_id = ?
                    ";

            $stmt = $dbConnection->prepare($query);
            $stmt->bind_param('i', $enseignant_id);
            if ($stmt->execute()) {
                echo "operation reussite";
            } else {
                echo "error" . $stmt->error;
            }
        }
    }
}
