
<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" 
        crossorigin="anonymous">
        <style>
            body {
                background-image: url('./ensakh.jpg');
                height: 900px;
            }

            footer{ 
                color:white;
                position: fixed;     
                text-align: center;    
                bottom: 0px; 
                width: 100%;
            } 
        </style>
    </head>

<body>
    <div class="container">
    <div class="row">
    <h1 class="text-center" >Liste des comptes étudiants</h1>
    <?php

        session_start();
        if(isset($_SESSION['succes_insert'])){
            echo '<div class="alert alert-success" role="alert">';
                echo $_SESSION['succes_insert'];
            echo '</div>';
        }elseif(isset($_SESSION['success_delete'])){
            echo '<div class="alert alert-success" role="alert">';
                echo $_SESSION['success_delete'];
            echo '</div>';
        }elseif(isset($_SESSION['succes_update'])){
            echo '<div class="alert alert-success" role="alert">';
                echo $_SESSION['succes_update'];
            echo '</div>';
        }elseif(isset($_SESSION['fail_delete'])){
            echo '<div class="alert alert-success" role="alert">';
                echo $_SESSION['fail_delete'];
            echo '</div>';
        }
        unset($_SESSION['succes_insert'], $_SESSION['success_delete'], $_SESSION['succes_update'], $_SESSION['fail_delete']);
    ?>
    <?php
        $dns = 'mysql:host=localhost; dbname=compte_etudiants';
        $user = 'root';
        $password = ''; 
        try
        {
            $my_con = new PDO($dns, $user, $password);
            $sql = 'SELECT * FROM etudiants'; 
            $res = $my_con->query($sql);
            //$etudiant =$res->fetch(PDO::FETCH_OBJ);
        
           
                echo '<table class="table table-bordered table-dark table-striped" align="center">';
                echo '<thead>';
                echo '<tr>
                <th>ID</th>
                <th>NAME</th>
                <th>LOGIN</th>
                <th>email</th>
                <th>photo</th>
                <th>CV</th>
                <th>adresse</th>
                <th>Date naissance</th>
                <th>tel</th>
                <th>ACTIONS</th>
                </tr>';
                echo '</thead>';
                echo '<tbody>';
                while($etudiant =$res->fetch(PDO::FETCH_OBJ)){ 
                    echo '<tr>
                    <td>'.$etudiant->id .'</td>
                    <td>'.$etudiant->name .'</td>
                    <td>'.$etudiant->login .'</td>
                    <td>'.$etudiant->email.'</td>
                    <td><img  src="'.$etudiant->photo.'" width="90" height="90"></td>
                    <td><img  src="'.$etudiant->cv.'" width="90" height="90"></td>
                    <td>'.$etudiant->adresse.'</td>
                    <td>'.$etudiant->date_naissance.'</td>
                    <td>'.$etudiant->telephone.'</td>
                    <td>
                        <a href="./modifier_compte.php?id='.$etudiant->id.'">Modifier</a>
                        <a href="./supprimer_compte.php?id='.$etudiant->id.'" class="link-danger">Supprimer</a>
                    </td>
                    </tr>';
                } 
                echo '</tbody>';    
                echo '</table>';
                
            
            echo '<div class="text-center">
                <a href="ajouter_compte.php" class="text-center btn btn-primary btn-lg active" role="button" aria-pressed="true">+ Ajouter un nouvel étudiant</a><br/>
                <br/>
                <a href="trombinoscope.php" class="text-center btn btn-primary btn-lg active" role="button" aria-pressed="true">Voir le trombinoscope des étudiants</a>
            </div>';
        }
        catch(PDOException $excep)
        {
            echo 'Erreur : ' . $excep->getMessage();
        }
    ?>
    </div>
    </div>
    <footer >réalisé par Hiba ROMANE et Assia DARHOUANE</footer>    
</body>
</html>