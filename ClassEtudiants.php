<?php

class Etudiant{

//declaration d'un tableau des noms champs de notre formulaire  
    private $fields = [
        'name', 'login', 'password', 
        'confirm_password', 'photo', 
        'cv', 'date_naissance', 'email', 
        'adresse', 'telephone', 
        'g-recaptcha-response'
    ];
//le path du dossier ou les fichiers de notre formulaire seront stockes
    public $pathToStoreFiles = "./uploads-files";






//la fonction ajouter qui ajoute un les donnees dans la BD si le formulaire est valider
    public function ajouter($formData){
        //si le methode d'envoi est post alors
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //valider le formulaire
            //declaration de la variable errorValidation qui contiendra 
            //le tableau des messages erreurs sur chaque champs envoye par une methode prive de notre class qui s'appelle validate formulaire
            $errorValidation = $this->validateFormulaire($formData);
            //si le tableau n'est pas vide cad il existe un erreur dans un champs du formulaire
            if(!empty($errorValidation)){
                session_start();
                //alors creation d'une case dans la variable globale qui s'appelle session et lui affecte le tableau des messages d'erreur
                $_SESSION['errors'] = $errorValidation;
                //redirection vers la page d'ajout avec une session qui contient les erreurs
                header('Location: ./ajouter_compte.php');
                exit;
            }
            // sinon on ajoute enregistre l'etudiant dans la base de donnees a l'aide d'une methode prive de notre class qui s'appelle saveEtudiant
            $isSaved = $this->saveEtudiant($formData);
            //si la methode est effectue avec succes cad l'etudiant est bien enregistre
            if($isSaved){
                session_start();
                 //alors creation d'une case dans la variable globale qui s'appelle session et lui affecte un message de succes
                $_SESSION['succes_insert'] = "l'étudiant est enregistré avec succès ";
                //redirection vers la page comptes
                header('Location: ./comptes.php');
                exit;
            }
        }
    }





//lors du remplissement du formulaire les fichiers se stockent dans des variables temporaires qui seront supprimer lorsqu'on clique sur save
//alors on ajoute une fonction qui sera capable d'enregistrer ces fichiers dans notre disque dur 
    private function storeFile($file){
        //declaration une variable qui contient le path ou on veut poser notre fichier 
        $uploadfile = $this->pathToStoreFiles .'/'. $file['name'];
        //si le fichier a bien change de place du fichier temporaire vers notre path
        if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
            //retourner le path
            return $uploadfile;
        } 
    }





//fonction de l'enregistrement d'un etudiant dans la BD
    private function saveEtudiant($formData){
// c'est deux variables contiennent le chemin ou les fichiers du formulaires stockes
        $pathFilePhoto = $this->storeFile($_FILES['photo']);
        $pathFileCV    = $this->storeFile($_FILES['cv']);
        //les donnees de la connexion
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "compte_etudiants";

        try {
            //connexion vers la BD
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // requette d'insertion
            $sql = "INSERT INTO etudiants (
                    name, 
                    login, 
                    password, 
                    photo, 
                    cv, 
                    date_naissance, 
                    email, 
                    adresse, 
                    telephone
                )
                VALUES (
                    :name,
                    :login,
                    :password,
                    :photo,
                    :cv,
                    :date_naissance,
                    :email,
                    :adresse,
                    :telephone
                )
            ";
            $stmt= $conn->prepare($sql);
            $stmt->execute([
                ':name' => $formData['name'],
                ':login' => $formData['login'],
                ':password' => $formData['password'],
                ':photo' => $pathFilePhoto,
                ':cv' => $pathFileCV,
                ':date_naissance' => $formData['date_naissance'],
                ':email' => $formData['email'],
                ':adresse' => $formData['adresse'],
                ':telephone' => $formData['telephone']
            ]);
            
            return true;
            
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
            return false;
        }

        $conn = null;
    }







//methode de validation du formulaire dans laquel on appel la methode du validation d'un champs
//elle prend en parametre les donnees du formulaire et en general $_POST pour notre cas
    private function validateFormulaire($formData = null){
//declaration d'un tableau qui va contenir les messages d'erreur retourner par la methode validateField
        $errorFieldValidate = array();
// si il n'ya pas des donnees dans notre formulaire (pas de champs) retourner false
        if(empty($formData)){
            return false;
        }
//iterer sur chaque element du tableau associatif champs => valeur
        foreach($formData as $fieldName => $fieldValue){
            //appelle de la methode de la validation d'un champs qui retourne un tableau de deux valeurs : 
            //une boolean qui recoit false si le champs est vide ou n'existe pas
            // et une autre qui contient le message d'erreur
            $reponseValidation = $this->validateField($fieldName, $fieldValue);
            // si la valeur boolean du tableau est false
            if(!$reponseValidation['status']){
                //declaration d'un tableau associatif qui va contenir le message
                $errorFieldValidate[$fieldName] = $reponseValidation['message'];
            }
        }
        //si le formulaire contient les champs password et confirm password
        if(isset($formData['password']) && isset($formData['confirm_password'])){
            //si les valeurs de ces champs sont egaux
            if($formData['password'] != $formData['confirm_password']){
                //le message d'erreur du champs password sera comme suite :
                $errorFieldValidate['password'] = "Le mot de passe et la confirmation ne sont pas identiques";
            }
        }
        // la fonction retourne le tableau des messages
        return $errorFieldValidate;
    }





// fonction de validation de chaque champs qui recoit le nom du champs et sa valeur
    private function validateField($fieldName, $fieldValue){
        //declaration du tableau reponse
        $response = [
            "status" => true,
            "message" => ""
        ];
//si le champs est different du champs de l'id
        if($fieldName != 'id'){
            //tester si le nom du champs existe
            //tester si le champs de trouve dans l'attribut de la class declare au debut
            if(!in_array($fieldName, $this->fields)){
                $response = [
                    //s'il n'existe pas la valeur boolean recoit false
                    'status' => false,
                    //la valeur avec cle message recoit le champs "nom du champs" n'existe pas
                    'message'=> "Le champ $fieldName n'existe pas !"
                ];
                //retourner le tableau 
                return $response;
            }
        }
// si le champs est vide
        if(empty($fieldValue)){
            $response = [
                'status' => false,
                'message'=> "Le champ $fieldName ne doit pas etre vide !"
            ];
        }
        return $response;
    }








    //la fonction qui va supprimer le compte d'un etudiant de la BD
    public function supprimer($id){

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "compte_etudiants";

        // Creation d'une connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // check de la connection
        if ($conn->connect_error) {
            die("connexion echouée: " . $conn->connect_error);
        }

        // requette de la suppression
        $sql = "DELETE FROM etudiants WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            // si la suppression est effectue avec succes affiche l'alert suivant a l'aide de la variable globale session
            session_start();
            $_SESSION['success_delete'] = "l'étudiant a été supprimé avec succès ";
            header('Location: ./comptes.php');
            exit;
        } else {
            //sinon aficher le message suivant 
            session_start();
            $_SESSION['fail_delete'] = "Une erreur a été survunue ".$conn->error;
            header('Location: ./comptes.php');
            exit;
        }

        $conn->close();
    }






//la fonction editer qui va retourner les donnees a modifie 
    public function editer($id){

        $dns = 'mysql:host=localhost; dbname=compte_etudiants';
        $user = 'root';
        $password = ''; 
        
        $conn = new PDO($dns, $user, $password);

        $sql = "SELECT * FROM etudiants WHERE id=$id"; 
        $res = $conn->query($sql);
        $etudiant =$res->fetch(PDO::FETCH_OBJ);
        return $etudiant;
    }




    public function modifier($formData){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errorValidation = $this->validateFormulaire($formData);
            if(!empty($errorValidation)){
                session_start();
                $_SESSION['errors'] = $errorValidation;
                $id = $formData['id'];
                header("Location: ./modifier_compte.php?id=$id");
                exit;
            }
            $isModified = $this->modifyEtudiant($formData);
            if($isModified){
                session_start();
                $_SESSION['succes_update'] = "l'étudiant a été modifié avec succès ";
                header('Location: ./comptes.php');
                exit;
            }
        }
    }







    private function modifyEtudiant($formData){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "compte_etudiants";

        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "UPDATE etudiants 
                SET 
                    name='".$formData['name']."', 
                    login='".$formData['login']."', 
                    date_naissance='".$formData['date_naissance']."', 
                    email='".$formData['email']."', 
                    adresse='".$formData['adresse']."', 
                    telephone='".$formData['telephone']."' 
                WHERE
                    id=".$formData['id']."
        ";

        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "erreur d'echec de la mis à jour : " . $conn->error;
            return false;
        }
        $conn = null;
    }








    public function trombinoscope(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "compte_etudiants";

        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT * FROM etudiants ";
        $result = $conn->query($sql);

        return $result;
    }
}