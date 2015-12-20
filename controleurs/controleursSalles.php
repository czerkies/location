<?php

class controleursSalles extends controleursSuper {

  // ********** Gestion des salles Admin ********** //
  public function gestionSalles(){

    session_start();
    $title = 'Gestion des salles';
    $userConnect = FALSE;
    $userConnectAdmin = $this->userConnectAdmin();
    $msg = '';
    $recupPourModif = FALSE;
    $ajouter = FALSE;
    $dialogue = FALSE;

    define('RACINE_SITE_IMG', '/lokisalle/www/');
    define('RACINE_SERVER_IMG', $_SERVER['DOCUMENT_ROOT']);

    $pdo = new modelesSalles();

    // Si le lien modifier est actif
    if(isset($_GET['modif']) && !empty($_GET['modif'])){

      $ajouter = TRUE;
      $id_salle = htmlentities($_GET['modif']);
      $recupPourModif = $pdo->modifSalleID($id_salle);
      $photo_bdd = $recupPourModif['photo'];

    }

    if(isset($_POST) && !empty($_POST)){

      if(empty($_POST['pays'])){
        $msg .= "Veuillez saisir un pays.<br>";
      }
      if(empty($_POST['ville'])){
        $msg .= "Veuillez saisir une Ville.<br>";
      }
      if(empty($_POST['adresse'])){
        $msg .= "Veuillez saisir une Adresse.<br>";
      }
      if(empty($_POST['cp'])){
        $msg .= "Veuillez saisir un Code Postale.<br>";
      }
      if(empty($_POST['titre'])){
        $msg .= "Veuillez saisir un Titre.<br>";
      }
      if(empty($_POST['description'])){
        $msg .= "Veuillez saisir votre Description.<br>";
      }
      if(empty($_POST['capacite'])){
        $msg .= "Veuillez saisir une Capacite.<br>";
      }
      if(empty($_POST['categorie']) || $_POST['categorie'] === 'null'){
        $msg .= "Veuillez saisir votre Categorie.<br>";
      }

      if(!empty($_FILES['photo']['name'])){

        if($this->verificationPhoto()){

          $nom_photo = 'salle' . $_POST['id_salle'] .'_'. $_FILES['photo']['name'];
          $photo_bdd = "img/$nom_photo";
          $photo_dossier = RACINE_SERVER_IMG . RACINE_SITE_IMG . "img/$nom_photo"; // chemin pour l'enregistrement dans le dossier qui va servir dans la fonction copy()
          copy($_FILES['photo']['tmp_name'], $photo_dossier); // copy() permet de copier un fichier depuis un endroit (1er argument) vers un autre endroit (2ème argument)
          // debug($_FILES);
        } else {
          $msg .= "L'extension de la photo n'est pas valide.";
        }
      }
      if(empty($msg)){

        foreach ($_POST as $key => $value){
          $_POST[$key] = htmlentities($value, ENT_QUOTES);
        }
        extract($_POST);

        $pdo->modificationSalle($id_salle, $pays, $ville, $adresse, $cp, $titre, $description, $photo_bdd, $capacite, $categorie);

        $msg .= 'La salle a bien été modifié.';

      }
    }

    // Si le lien supp est actif
    if(isset($_GET['supp']) && !empty($_GET['supp'])){

      $id_salle = htmlentities($_GET['supp']);

      $salleASupprimer = $pdo->modifSalleID($id_salle);
      $chemin_photo = RACINE_SERVER_IMG . RACINE_SITE_IMG . $salleASupprimer['photo'];

      if(!$pdo->VerifSalleProduit($id_salle)){

        if(!$pdo->verifSuppSalle($id_salle)){

          if(!empty($salleASupprimer['photo']) && file_exists($chemin_photo)){
            unlink($chemin_photo);
          }
          $pdo->suppressionSalle($id_salle);
          $gestionSalles = TRUE;
          $msg .= '<div class="success"><p>Suppression effectuée.</p></div>';

        } else {

          $dialogue = TRUE;

          if(isset($_GET['confirm']) && !empty($_GET['confirm']) && $_GET['confirm'] === 'oui'){

            if(!empty($salleASupprimer['photo']) && file_exists($chemin_photo)){
              unlink($chemin_photo);
            }
            $pdo->suppressionSalle($id_salle);
            $gestionSalles = TRUE;
            $msg .= '<div class="success"><p>Suppression effectuée.</p></div>';
            $dialogue = FALSE;

          }
        }
      } else {

        $msg .= 'Vous ne pouvez pas supprimer cette salle car elle a été reservé par des clients.<br>';

      }
    }

    $salles = $pdo->affichageSalles();
    $listeCategories = $pdo->categoriesSalle();


    $this->Render('../vues/salle/gestion_salles.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'ajouter' => $ajouter, 'recupPourModif' => $recupPourModif, 'salles' => $salles, 'listeCategories' => $listeCategories, 'dialogue' => $dialogue));

  }

  // ********** Vérification photo pour insertion et ajout de salle ********** //
  public function verificationPhoto(){
    $extension = strrchr($_FILES['photo']['name'], '.');
    $extension = strtolower(substr($extension, 1));
    $tab_extension_valide = array("jpg", "jpeg");
    $verif_extension = in_array($extension, $tab_extension_valide);
    return $verif_extension;
  }

  // ********** Ajout d'une salle ********** //
  public function ajouterSalle(){

    session_start();
    $title = 'Ajouter une salle';
    $userConnect = FALSE;
    $userConnectAdmin = $this->userConnectAdmin();
    $salles = FALSE;
    $ajouter = TRUE;

    define('RACINE_SITE_IMG', '/lokisalle/www/');
    define('RACINE_SERVER_IMG', $_SERVER['DOCUMENT_ROOT']);

    $salle = new modelesSalles();
    $listeCategories = $salle->categoriesSalle();

    //define('RACINE_SITE', '/lokisalle/www/');
    //define('RACINE_SERVER', $_SERVER['DOCUMENT_ROOT']);

    $msg = '';

    if(isset($_POST) && !empty($_POST)){

      if(empty($_POST['pays'])){
        $msg .= "Veuillez saisir un pays.<br>";
      }
      if(empty($_POST['ville'])){
        $msg .= "Veuillez saisir une Ville.<br>";
      }
      if(empty($_POST['adresse'])){
        $msg .= "Veuillez saisir une Adresse.<br>";
      }
      if(empty($_POST['cp'])){
        $msg .= "Veuillez saisir un Code Postale.<br>";
      }
      if(empty($_POST['titre'])){
        $msg .= "Veuillez saisir un Titre.<br>";
      }
      if(empty($_POST['description'])){
        $msg .= "Veuillez saisir votre Description.<br>";
      }
      if(empty($_POST['capacite'])){
        $msg .= "Veuillez saisir une Capacite.<br>";
      }
      if(empty($_POST['categorie']) || $_POST['categorie'] === 'null'){
        $msg .= "Veuillez saisir votre Categorie.<br>";
      }

      $photo_bdd = '';
      if(isset($_GET['action']) && $_GET['action'] == 'modifierSalle'){
        $photo_bdd = isset($_POST['photoBDD']);
      }

      if(!empty($_FILES['photo']['name'])) // on vérifie si une photo a bien été postée.
      {

        if($this->verificationPhoto()){

          $nom_photo = 'salle' . $_POST['id_salle'] .'_'. $_FILES['photo']['name'];
          $photo_bdd = "img/$nom_photo";
          $photo_dossier = RACINE_SERVER_IMG . RACINE_SITE_IMG . "img/$nom_photo"; // chemin pour l'enregistrement dans le dossier qui va servir dans la fonction copy()
          copy($_FILES['photo']['tmp_name'], $photo_dossier); // copy() permet de copier un fichier depuis un endroit (1er argument) vers un autre endroit (2ème argument)
          // debug($_FILES);
        } else {
          $msg .= "L'extension de la photo n'est pas valide. (Extensions acceptées: png, gif, jpg, jpeg).";
        }
      }

      if(empty($msg)){

        foreach ($_POST as $key => $value){
          $_POST[$key] = htmlentities($value, ENT_QUOTES);
        }
        extract($_POST);

        $salle->ajouterSalle($pays, $ville, $adresse, $cp, $titre, $description, $photo_bdd, $capacite, $categorie);

        $msg .= 'La salle a bien été ajouté.';
        $ajouter = FALSE;

      }
    }

    $this->Render('../vues/salle/gestion_salles.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'ajouter' => $ajouter, 'salles' => $salles, 'listeCategories' => $listeCategories));

  }

}
