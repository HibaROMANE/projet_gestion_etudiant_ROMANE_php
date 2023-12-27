<?php
    
    require_once('./ClassEtudiants.php');

    if(isset($_POST["save"])){
        unset($_POST["save"]);
        $formData = $_POST; 
       $etudiant = new Etudiant();
       $etudiant->ajouter($formData);
    }
   
?>
