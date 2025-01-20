<?php
class Categorie
{
    private $dbConnection;

    public function __construct()
    {
        // Initialise la connexion à la base de données
        $this->dbConnection = (new Connection)->getConnection();
        if (!$this->dbConnection) {
            die("Erreur de connexion à la base de données.");
        }
    }


    public function ajouterCategorie($nom_categorie)
    {
        $dbConnection = (new Connection)->getConnection();

        if (!$dbConnection) {
            die("Erreur de connexion à la base de données");
        }

        if (empty($nom_categorie)) {
            echo "Le nom de la catégorie ne peut pas être vide.";
            return;
        }

        $query = "INSERT INTO Categorie (nom) VALUES (?)";
        $stmt = $dbConnection->prepare($query);

        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $dbConnection->error);
        }

        $stmt->bind_param('s', $nom_categorie);

        if ($stmt->execute()) {
            echo "Catégorie ajoutée avec succès.";
            return true;
        } else {
            echo "Erreur lors de l'ajout de la catégorie : " . $stmt->error;
            error_log("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }

        $stmt->close();
    }

    public function afficherCategories()
    {
        $query = "SELECT * FROM categorie ";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function supprimerCategorie($id) {
        $query = "DELETE FROM categorie WHERE categorie_id=?";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bind_param('i',$id);

        $stmt->execute();
    }
}
