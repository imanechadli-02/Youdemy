<?php

require_once '../config/config.php';

class Tags{
    private $dbConnection;
    
    public function __construct()
    {
        $this->dbConnection = (new Connection)->getConnection();
        if(!$this->dbConnection){
            die ("error de connection a la base de donnes"); 
        }
    }

    public function ajouterTags($data){

        
        $lines = explode("\n", trim($data)); // Divise les données en lignes
        $values = [];

        foreach ($lines as $line) {
            // Divise chaque ligne par des virgules
            $fields = explode(",", trim($line));

            if (count($fields) === 1) {
                $name = $this->dbConnection->real_escape_string(trim($fields[0]));
             
                $values[] = "('$name')";
            }
        }

        if (!empty($values)) {
            // Crée et exécute la requête d'insertion en masse
            $query = "INSERT INTO tags (name) VALUES " . implode(", ", $values);
            if ($this->dbConnection->query($query) === TRUE) {
                return "Produits insérés avec succès !";
            } else {
                return "Erreur lors de l'insertion : " . $this->dbConnection->error;
            }
        }

        return "Aucune donnée valide à insérer.";
    }

    public function afficherTag()
    {
        $query = "SELECT * FROM tags ";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }









    }

























?>