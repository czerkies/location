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
    if(isset($_GET['modif']) && !empty($_GET['modif']) && is_numeric($_GET['modif'])){

      $ajouter = TRUE;
      $id_salle = htmlentities($_GET['modif'], ENT_QUOTES);
      $recupPourModif = $pdo->modifSalleID($id_salle);
      $photo_bdd = $recupPourModif['photo'];

    }

    if($_POST){

      if(isset($_POST['pays']) && isset($_POST['ville'])
      && isset($_POST['adresse']) && isset($_POST['cp'])
      && isset($_POST['titre']) && isset($_POST['description'])
      && isset($_POST['capacite']) && isset($_POST['categorie'])
      && isset($_FILES['photo'])){

        $msg .= $this->controlFormSalle($_POST);

        if(!empty($_FILES['photo']['name'])){

          if($this->verificationPhoto()){

            $nom_photo = 'salle_'.uniqid().'.jpg';
            $photo_bdd = "img/$nom_photo";
            $photo_dossier = RACINE_SERVER_IMG . RACINE_SITE_IMG . "img/$nom_photo";
            copy($_FILES['photo']['tmp_name'], $photo_dossier);
            // Supprimer l'ancienne photo
            $photoSuppModif = $pdo->modifSalleID($id_salle);
            $chemin_photoModif = RACINE_SERVER_IMG . RACINE_SITE_IMG . $photoSuppModif['photo'];


          } else {
            $msg .= "L'extension de la photo n'est pas valide. (Extensions acceptées: png, gif, jpg, jpeg).";
          }
        }
        if(empty($msg)){

          foreach ($_POST as $key => $value){
            $_POST[$key] = htmlentities($value, ENT_QUOTES);
          }
          extract($_POST);

          if($pdo->modificationSalle($id_salle, $pays, $ville, $adresse, $cp, $titre, $description, $photo_bdd, $capacite, $categorie)){

            $msg .= 'La salle a bien été modifié.<br>';
            $ajouter = FALSE;

            if(!empty($photoSuppModif['photo']) && file_exists($chemin_photoModif)){
              unlink($chemin_photoModif);
            }
          }

        }
      } else {
        $msg .= 'Une erreur est survenue lors de votre demande.<br>';
      }
    }

    // Si le lien supp est actif
    if(isset($_GET['supp']) && !empty($_GET['supp']) && is_numeric($_GET['supp'])){

      $id_salle = htmlentities($_GET['supp'], ENT_QUOTES);

      $salleASupprimer = $pdo->modifSalleID($id_salle);
      $chemin_photo = RACINE_SERVER_IMG . RACINE_SITE_IMG . $salleASupprimer['photo'];

      if(!$pdo->VerifSalleProduit($id_salle)){

        if(!$pdo->verifSuppSalle($id_salle)){

          if(!empty($salleASupprimer['photo']) && file_exists($chemin_photo)){
            unlink($chemin_photo);
          }
          $pdo->suppressionSalle($id_salle);
          $gestionSalles = TRUE;
          $msg .= 'La salle a bien été supprimé.<br>';

        } else {

          $dialogue = TRUE;

          if(isset($_GET['confirm']) && !empty($_GET['confirm']) && $_GET['confirm'] === 'oui'){

            if(!empty($salleASupprimer['photo']) && file_exists($chemin_photo)){
              unlink($chemin_photo);
            }

            $pdo->suppressionSalle($id_salle);
            $gestionSalles = TRUE;
            $msg .= 'La salle a bien été supprimé.<br>';
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

  // ********** Ajout d'une salle ********** //
  public function ajouterSalle(){

    session_start();
    $title = 'Ajouter une salle';
    $userConnect = FALSE;
    $userConnectAdmin = $this->userConnectAdmin();
    $recupPourModif = FALSE;
    $salles = FALSE;
    $ajouter = TRUE;

    define('RACINE_SITE_IMG', '/lokisalle/www/');
    define('RACINE_SERVER_IMG', $_SERVER['DOCUMENT_ROOT']);

    $salle = new modelesSalles();
    $listeCategories = $salle->categoriesSalle();

    $msg = '';

    if($_POST){

      if(isset($_POST['pays']) && isset($_POST['ville'])
      && isset($_POST['adresse']) && isset($_POST['cp'])
      && isset($_POST['titre']) && isset($_POST['description'])
      && isset($_POST['capacite']) && isset($_POST['categorie'])
      && isset($_FILES['photo'])){

        $msg .= $this->controlFormSalle($_POST);

        $photo_bdd = '';
        if(isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] === 'modifierSalle'){
          $photo_bdd = isset($_POST['photoBDD']);
        }

        if(!empty($_FILES['photo']['name'])){

          if($this->verificationPhoto()){

            $nom_photo = 'salle_'.uniqid().'.jpg';
            $photo_bdd = "img/$nom_photo";
            $photo_dossier = RACINE_SERVER_IMG . RACINE_SITE_IMG . "img/$nom_photo";
            copy($_FILES['photo']['tmp_name'], $photo_dossier);

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
      } else {
        $msg .= 'Une erreur est survenue lors de votre demande.<br>';
      }
    }

    $this->Render('../vues/salle/gestion_salles.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'ajouter' => $ajouter, 'salles' => $salles, 'recupPourModif' => $recupPourModif, 'listeCategories' => $listeCategories));

  }

  // ********** Controle des formulaires de salles ************ //
  public function controlFormSalle($value){

    $msg = '';

    if(empty($value['pays'])){
      $msg .= "Veuillez saisir un pays.<br>";
    } elseif(strlen($value['pays']) < 2 || strlen($value['pays']) > 20 || is_numeric($value['pays'])) {
      $msg .= "Veuillez saisir un Pays entre 2 et 20 carractères.<br>";
    }
    if(empty($value['ville'])){
      $msg .= "Veuillez saisir une Ville.<br>";
    } elseif(strlen($value['ville']) < 2 || strlen($value['ville']) > 20) {
      $msg .= "Veuillez saisir une Ville entre 2 et 20 carractères.<br>";
    }
    if(empty($value['adresse'])){
      $msg .= "Veuillez saisir une Adresse.<br>";
    } elseif(strlen($value['adresse']) < 4 || strlen($value['adresse']) > 150) {
      $msg .= "Veuillez saisir une Adresse entre 4 et 150 carractères.<br>";
    }
    if(empty($value['cp'])){
      $msg .= "Veuillez saisir un Code Postale.<br>";
    } elseif(strlen($value['cp']) != 5 || !is_numeric($value['cp'])) {
      $msg .= "Votre code postal doit contenir 5 chiffres.<br>";
    }
    if(empty($value['titre'])){
      $msg .= "Veuillez saisir un Titre.<br>";
    } elseif(strlen($value['titre']) < 4 || strlen($value['titre']) > 200) {
      $msg .= "Veuillez saisir une adresse entre 4 et 200 carractères.<br>";
    }
    if(empty($value['description'])){
      $msg .= "Veuillez saisir votre Description.<br>";
    } elseif(strlen($value['description']) < 10 || strlen($value['description']) > 400) {
      $msg .= "Veuillez saisir une Adresse entre 4 et 400 carractères.<br>";
    }
    if(empty($value['capacite'])){
      $msg .= "Veuillez saisir une Capacite.<br>";
    } elseif($value['capacite'] < 1 ||$value['capacite'] > 9999999999999){
      $msg .= "Veuillez saisir une capacité raisonable.<br>";
    }
    if(empty($value['categorie']) || is_numeric($value['categorie'])){
      $msg .= "Veuillez saisir votre Categorie.<br>";
    }

    return $msg;

  }

  // ********** Vérification photo pour insertion et ajout de salle ********** //
  public function verificationPhoto(){
    $extension = strrchr($_FILES['photo']['name'], '.');
    $extension = strtolower(substr($extension, 1));
    $tab_extension_valide = array("jpg", "jpeg");
    $verif_extension = in_array($extension, $tab_extension_valide);
    return $verif_extension;
  }

}
