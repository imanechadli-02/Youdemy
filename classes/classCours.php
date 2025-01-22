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
        $dbConnection = (new Connection())->getConnection();
        $enseignant_id = $this->getEnseignantId();

        // Préparer la requête pour récupérer tous les cours
        $query = "SELECT * FROM cours 
                  join categorie on cours.categorie_id = categorie.categorie_id
                  join tags on cours.tag_id = tags.tag_id
                   WHERE user_id = ?";
        $stmt = $dbConnection->prepare($query);

        if ($stmt === false) {
            // Output the error if query preparation fails
            die('Error preparing the SQL statement: ' . $dbConnection->error);
        }

        $stmt->bind_param("i", $enseignant_id); // "i" means integer
        $stmt->execute();
        $result = $stmt->get_result();

        // Récupérer tous les résultats dans un tableau
        $cours = [];
        while ($row = $result->fetch_assoc()) {
            $cours[] = $row;
        }

        return $cours;
    }

    public function afficherToutCardCours(){
        $dbConnection = (new Connection())->getConnection();
        // $enseignant_id = $this->getEnseignantId();

        // Préparer la requête pour récupérer tous les cours
        $query = "SELECT * FROM cours 
                  join categorie on cours.categorie_id = categorie.categorie_id
                  join tags on cours.tag_id = tags.tag_id
                  join users on cours.user_id = users.user_id
                ";
        $stmt = $dbConnection->prepare($query);

        if ($stmt === false) {
            // Output the error if query preparation fails
            die('Error preparing the SQL statement: ' . $dbConnection->error);
        }

        // $stmt->bind_param("i", $enseignant_id); // "i" means integer
        $stmt->execute();
        $result = $stmt->get_result();

        // Récupérer tous les résultats dans un tableau
        $cours = [];
        while ($row = $result->fetch_assoc()) {
            $cours[] = $row;
        }

        return $cours;
    }


    public function getCourseById($id) {
        $dbConnection = (new Connection())->getConnection();

        $query = "SELECT * FROM cours WHERE cours_id = ?";
        $stmt = $dbConnection->prepare($query);
        $stmt->bind_param("i", $id); // "i" stands for integer
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }


    public function updateCourse($id, $title, $description, $image, $content, $category, $tags)
    {
        $dbConnection = (new Connection())->getConnection();

        $sql = "UPDATE cours
                SET titre = ?, description = ?, image = ?, content_text = ?, categorie_id = ?, tag_id = ? 
                WHERE cours_id = ?";

        // Prepare the statement
        $stmt = $dbConnection->prepare($sql);

        if ($stmt === false) {
            die('MySQL prepare error: ' . $dbConnection->error);
        }

        // Bind parameters (adjusting types)
        $bindResult = $stmt->bind_param("ssssiii", $title, $description, $image, $content, $category, $tags, $id);
        if ($bindResult === false) {
            die('Bind param error: ' . $stmt->error);
        }

        // Execute the query
        $executeResult = $stmt->execute();
        if ($executeResult === false) {
            die('Execute error: ' . $stmt->error);
        }

        return $executeResult;
    }

    public function DeleteCours($id){
        $dbConnection = (new Connection())->getConnection();
        $query = "DELETE FROM cours WHERE cours_id=?";
        $stmt = $dbConnection->prepare($query);
        $stmt->bind_param('i',$id);
        $stmt->execute();
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
