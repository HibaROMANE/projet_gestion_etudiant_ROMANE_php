<?php
    
    require_once('./ClassEtudiants.php');

    if(isset($_POST["modifier"])){
        unset($_POST["modifier"]);
        $formData = $_POST; 
        $etudiant = new Etudiant();
        $etudiant->modifier($formData);
    }
   
?>