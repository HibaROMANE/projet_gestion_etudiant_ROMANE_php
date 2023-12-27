<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Ajouter un nouvel etudiant</title>
        <meta charset="utf-8">
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
    <div class="bg-image" 
     style="background-image: url('./ensakh.jpg');
      height: 100vh">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xs-12">
                    <div class="card">
                        <div class="card-header fw-bold text-center">
                            Ajouter un nouvel étudiant
                        </div>
                        <div class="card-body">
                            <?php
                                session_start();
                                if(isset($_SESSION['errors'])){
                                    echo '<div class="alert alert-danger">';
                                        echo '<ul>';
                                        foreach($_SESSION['errors'] as $field => $message){
                                            echo '<li>'.$message.'</li>';
                                        }
                                        echo '</ul>';
                                    echo '</div>';
                                }
                                unset($_SESSION['errors']);
                            ?>
                       
                            <form enctype="multipart/form-data" name="form_etudiant" action="enregistrer_compte.php" method = "post">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">NAME</label>
                                    <input type = "text" name="name" class="form-control" id="Name" placeholder="Name"/><br/>
                                </div>
                                <div class="form-group">
                                    <label for="login" class="col-form-label">LOGIN</label>
                                    <input type = "text" name="login" class="form-control" id="Login" placeholder="Login"/><br/>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="password" class="col-form-label">Password</label>
                                        <input type = "password" name="password" class="form-control" id="password" placeholder="Password"/><br/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="confirm_password" class="col-form-label">confirm Password</label>
                                        <input type = "password" name="confirm_password" class="form_control" id="confirm_password" placeholder="Confirm password"/><br/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="photo" class="col-form-label">Photo</label>
                                        <input type = "file" name="photo" class="form-control-file" id="Photo" placeholder="Photo"/><br/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="cv" class="col-form-label">CV</label>
                                        <input type = "file" name="cv" class="form-control-file" id="CV" placeholder="CV"/><br/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="date-naissance" class="col-form-label">date naissance</label>
                                    <input name="date_naissance" type="date" class="form-control" id="Date-naissance" placeholder="Date naissance">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-form-label">Email</label>
                                    <input name="email" type="email" class="form-control" id="Email" placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <label for="adresse">Adresse</label>
                                    <textarea class="form-control"name="adresse" id="Adresse" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="tel" class="col-form-label">Téléphone</label>
                                    <input name="telephone" type="tel" class="form-control" id="Tel" placeholder="Téléphone">
                                </div>
                                <div class="form-group m-5-10 p-t-5 ">
                                    <div class="g-recaptcha" class="mt-5 mb-5" data-sitekey="6LdPwkcgAAAAAMcBHHTku91LI9hw8kxwQ_5nhNtf"></div>
                                </div>
                                <button name="save" type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>

</html>