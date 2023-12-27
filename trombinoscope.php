<?php
  
    require_once('./ClassEtudiants.php');

    $etudiantClass = new Etudiant();
    $result =  $etudiantClass->trombinoscope();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Trombinoscope</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
         rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
          crossorigin="anonymous">
          <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
          <style>
            .card-box {
                padding: 20px;
                border-radius: 3px;
                margin-bottom: 30px;
                background-color: #fff;
            }

            .thumb-lg {
                height: 100px;
                width: 100px;
            }
            .img-thumbnail {
                padding: .25rem;
                background-color: #fff;
                border: 1px solid #dee2e6;
                border-radius: .25rem;
                max-width: 100%;
                height: auto;
            }
            .text-pink {
                color: #ff679b!important;
            }

            .text-muted {
                color: #98a6ad!important;
            }
            h4 {
                line-height: 22px;
                font-size: 18px;
            }
          </style>
    </head>

    <body>
    <div class="bg-image" 
     style="background-image: url('./ensakh.jpg');
      height: 100vh">
        <div class="content">
            <div class="container">

            
                <div class="row">
                    <?php
                    if ($result->num_rows > 0) {
                        while($etudiant = $result->fetch_assoc()) {
                    ?>
                    <div class="col-lg-4">
                        <div class="text-center card-box">
                            <div class="member-card pt-2 pb-2">
                                <div class="thumb-lg member-thumb mx-auto">
                                    <img 
                                        src="<?=$etudiant['photo']?>" 
                                        class="rounded-circle img-thumbnail" alt="profile-image"
                                        width="500" height="600"
                                    >
                                </div>
                                <div class="">
                                    <h4><?=$etudiant['name']?></h4>
                                    <p class="text-muted"><?= $etudiant['login']?>
                                     <span>| </span><span><a href="#" class="text-pink"><?= $etudiant['email']?></a></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                        }
                    }
                ?>
                </div>
            </div>
        </div>
        <div class="text-center">
                <a href="comptes.php" class="text-center btn btn-primary btn-lg active" role="button" aria-pressed="true">Retour à la liste des étudiants</a>
            </div>
    </div>
    </body>
</html>