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

    public function afficherCours() {}

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

    public function afficherToutCardCours()
    {
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


    public function getCourseById($id)
    {
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

    public function DeleteCours($id)
    {
        $dbConnection = (new Connection())->getConnection();
        $query = "DELETE FROM cours WHERE cours_id=?";
        $stmt = $dbConnection->prepare($query);
        $stmt->bind_param('i', $id);
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

    public function AjoutermesCours($userId, $coursId)
    {
        // Create the database connection
        $dbConnection = (new Connection())->getConnection();

        // Check if the connection is established
        if ($dbConnection->connect_error) {
            die("Connection failed: " . $dbConnection->connect_error);
        }

        // Check if the course is already added to the user's courses to prevent duplicate entries
        $checkQuery = "SELECT 1 FROM mesCourses WHERE cours_id = ? AND user_id = ?";
        $checkStmt = $dbConnection->prepare($checkQuery);
        if ($checkStmt === false) {
            die('MySQL prepare error: ' . $dbConnection->error);
        }

        // Bind the parameters and execute
        $checkStmt->bind_param('ii', $coursId, $userId);
        $checkStmt->execute();
        $checkStmt->store_result();

        // If the course already exists for the student, return an error message
        if ($checkStmt->num_rows > 0) {
            echo "You are already enrolled in this course!";
            $checkStmt->close();
            return;
        }

        // Insert the course into the student's courses
        $query = "INSERT INTO mesCourses (cours_id, user_id) VALUES (?, ?)";
        $stmt = $dbConnection->prepare($query);

        // Check if the statement preparation is successful
        if ($stmt === false) {
            die('MySQL prepare error: ' . $dbConnection->error);
        }

        // Bind the parameters and execute the query
        $stmt->bind_param('ii', $coursId, $userId);
        if ($stmt->execute()) {
            echo "<script>alert('Course added successfully!')</script>";
        } else {
            // echo "<script>alert('Course nooooo added successfully!')</script>";
            die("Error: " . $stmt->error);
        }

        // Close the statement and connection
        $stmt->close();
        $dbConnection->close();
    }

    public function getMescourses()
{
    $dbConnection = (new Connection())->getConnection();

    $query = "SELECT 
                Categorie.nom AS categorie_name,
                cours.cours_id,
                cours.titre,
                cours.description,
                cours.image,
                users.username AS course_instructor
              FROM 
                Categorie
              JOIN 
                cours ON Categorie.categorie_id = cours.categorie_id
              JOIN 
                users ON cours.user_id = users.user_id
              ORDER BY 
                Categorie.nom, cours.titre";

    // Use query() if there are no parameters to bind
    $result = $dbConnection->query($query);

    // Check if query was successful
    if ($result) {
        // Fetch all rows as an associative array
        $courses = $result->fetch_all(MYSQLI_ASSOC);

        return $courses; // Return the result
    } else {
        // Handle query error
        return "Error: " . $dbConnection->error;
    }
}

}
