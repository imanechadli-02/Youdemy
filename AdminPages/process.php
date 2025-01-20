<?php
require_once '../config/config.php';
require_once '../classes/classCategorie.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom_categorie = isset($_POST['categorie']) ? trim($_POST['categorie']) : '';
    
    if (!empty($nom_categorie)) {
        $categorie = new Categorie();
        if($categorie->ajouterCategorie($nom_categorie)){
            header('location: categories.php');
        }
        
    } else {
        // Optionally add an error message here for empty category name
        echo "<p class='text-red-500'>Category name cannot be empty</p>";
    }
}
?>