<?php
  
    require_once('./ClassEtudiants.php');

    if(isset($_GET["id"])){
        $etudiantId = $_GET["id"]; 
        $etudiant = new Etudiant();
        $etudiant->supprimer($etudiantId);
    }