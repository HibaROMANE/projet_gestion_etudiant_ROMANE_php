<?php
  
    require_once('./ClassEtudiants.php');

    if(isset($_GET["id"])){
        $etudiantId = $_GET["id"]; 
        $etudiantClass = new Etudiant();
        $etudiant =  $etudiantClass->editer($etudiantId);
    }
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Modifier l'étudiant</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
         rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
          crossorigin="anonymous">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <style>
            body {
            background-image: url('./ensakh.jpg');
            }
        </style>

    </head>

    <body>
        <div class="container-fluid">
            
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xs-12">
                    <div class="card ">
                        <div class="card-header fw-bold text-center">
                            Ajouter un nouvel étudiant
                        </div>
                        <div class="card-body">
                            <?php
                                session_start();
                                if(isset($_SESSION['errors'])){
                                    echo '<div class="alert alert-danger" role="alert">';
                                        echo '<ul>';
                                        foreach($_SESSION['errors'] as $field => $message){
                                            echo '<li>'.$message.'</li>';
                                        }
                                        echo '</ul>';
                                    echo '</div>';
                                }
                                unset($_SESSION['errors']);
                            ?>
                       
                            <form enctype="multipart/form-data" name="form_etudiant" action="enregistrer_modifier_compte.php" method = "post">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">NAME</label>
                                    <input type="hidden" name="id" value="<?= $etudiant->id; ?>">
                                    <input type = "text" name="name" class="form-control" id="Name" placeholder="Name" value="<?= $etudiant->name; ?>"/><br/>
                                </div>
                                <div class="form-group">
                                    <label for="login" class="col-form-label">LOGIN</label>
                                    <input type = "text" name="login" class="form-control" id="Login" placeholder="Login" value="<?= $etudiant->login; ?>"/><br/>
                                </div>
                                
                                <div class="form-group">
                                    <label for="date-naissance" class="col-form-label">date naissance</label>
                                    <input name="date_naissance" type="date" class="form-control" id="Date-naissance" value="<?= $etudiant->date_naissance; ?>" placeholder="Date naissance">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-form-label">Email</label>
                                    <input name="email" type="email" class="form-control" id="Email" placeholder="Email" value="<?= $etudiant->email; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="adresse">Adresse</label>
                                    <textarea class="form-control"name="adresse" id="Adresse" rows="3"><?= $etudiant->adresse; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="tel" class="col-form-label">Téléphone</label>
                                    <input name="telephone" type="tel" class="form-control" id="Tel" placeholder="Téléphone" value="<?= $etudiant->telephone; ?>">
                                </div>
                                <div class="form-group m-5-10 p-t-5 ">
                                    <label for="g-recaptcha" class="col-form-label"></label>
                                    <div class="g-recaptcha" class="mt-5 mb-5" data-sitekey="6LdPwkcgAAAAAMcBHHTku91LI9hw8kxwQ_5nhNtf"></div>
                                </div>
                                <div class="form-group">
                                    <button name="modifier" type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    
    </body>

</html>