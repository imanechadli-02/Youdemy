<?php

require_once "../config/config.php";

class Cours {
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
        if(!$this->dbConnection){
            die("Erreur de connexion à la base de données.");
        }
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getContentText() {
        return $this->content_text;
    }

    public function setContentText($content_text) {
        $this->content_text = $content_text;
    }

    public function getContentVideo() {
        return $this->content_video;
    }

    public function setContentVideo($content_video) {
        $this->content_video = $content_video;
    }

    public function getTagId() {
        return $this->tag_id;
    }

    public function setTagId($tag_id) {
        $this->tag_id = $tag_id;
    }

    public function getCategorieId() {
        return $this->categorie_id;
    }

    public function setCategorieId($categorie_id) {
        $this->categorie_id = $categorie_id;
    }

    public function getEnseignantId() {
        return $this->enseignant_id;
    }

    public function setEnseignantId($enseignant_id) {
        $this->enseignant_id = $enseignant_id;
    }

    public function ajouterCours()
    {
        
    }
}

?>
