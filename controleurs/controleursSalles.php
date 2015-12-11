<?php

// CHECK = Vérifier HTML les extensions.
// Garder la photo lors de la fin de saisie (s'il y'a erreurr).

class controleursSalles extends controleursSuper {

  // ********** Affichage de la salle par ID ********** //
  public function afficherSalles(){

    session_start();

    $userConnect = FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

    $form = (isset($_GET['action']) && $_GET['action'] == 'ajouterSalle') ? TRUE : FALSE;
    $tableau = (isset($_GET['action']) && $_GET['action'] == 'afficherSalles') ? TRUE : FALSE;

    $pdo = new modelesSalles();
    $affichageSalles = $pdo->affichageSalles();

    $this->Render('../vues/salle/gestion_salles.php', array('affichageSalles' => $affichageSalles, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'tableau' => $tableau, 'form' => $form));

  }

  // ********** Vérification photo pour insertion et ajout de salle ********** //
  public function verificationPhoto(){
    $extension = strrchr($_FILES['photo']['name'], '.');
    $extension = strtolower(substr($extension, 1));
    $tab_extension_valide = array("gif", "jpg", "jpeg", "png");
    $verif_extension = in_array($extension, $tab_extension_valide);
    return $verif_extension;
  }

  // ********** Ajout d'une salle ********** //
  public function ajouterSalle(){

    session_start();
    $userConnect = FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

    $form = (isset($_GET['action']) && $_GET['action'] == 'ajouterSalle') ? TRUE : FALSE;
    $tableau = (isset($_GET['action']) && $_GET['action'] == 'afficherSalles') ? TRUE : FALSE;
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
      if(empty($_POST['categorie'])){
        $msg .= "Veuillez saisir votre Categorie.<br>";
      }

      $photo_bdd = '';
      if(isset($_GET['action']) && $_GET['action'] == 'modifierSalle'){
        $photo_bdd = isset($_POST['photoBDD']);
      }

      if(!empty($_FILES['photo']['name'])) // on vérifie si une photo a bien été postée.
      {

        if($this->verificationPhoto()) // on vérifie l'extension de la photo=si c'est TRUE
        {
          define("RACINE_SITE", "/lokisalle/www/");
          define("RACINE_SERVER", $_SERVER['DOCUMENT_ROOT']);

          $nom_photo = 'salle' . $_POST['id_salle'] .'_'. $_FILES['photo']['name'];
          $photo_bdd = "img/$nom_photo";
          $photo_dossier = RACINE_SERVER . RACINE_SITE . "img/$nom_photo"; // chemin pour l'enregistrement dans le dossier qui va servir dans la fonction copy()
          copy($_FILES['photo']['tmp_name'], $photo_dossier); // copy() permet de copier un fichier depuis un endroit (1er argument) vers un autre endroit (2ème argument)
          // debug($_FILES);
        } else {
          $msg .=  "L'extension de la photo n'est pas valide. (Extensions acceptées: png, gif, jpg, jpeg).";
        }
      }

      if(empty($msg)){

        foreach ($_POST as $key => $value){
          $_POST[$key] = htmlentities($value, ENT_QUOTES);
        }
        extract($_POST);

        $cont = new modelesSalles();

        $insertion = $cont->ajouterSalle($pays, $ville, $adresse, $cp, $titre, $description, $photo_bdd, $capacite, $categorie);

      }
    }


    $this->Render('../vues/salle/gestion_salles.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'tableau' => $tableau, 'form' => $form, 'msg' => $msg));

  }

  // ********** Modification salle *********** //
  public function modifierSalle(){

    session_start();
    $userConnect = FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

    $photo_bdd = '';
    $msg = '';

    $id_salle = $_GET['id_salle'];

    if(isset($_GET['action']) && $_GET['action'] == 'ajouterSalle' || $_GET['action'] == 'modifierSalle'){
      $form = TRUE;
      $pdo_recup = new modelesSalles();
      $recupPourModif = $pdo_recup->modifSalleID($id_salle);
      $photo_bdd = $recupPourModif['photo'];
    } else {
      $form = FALSE;
    }

    $tableau = (isset($_GET['action']) && $_GET['action'] == 'afficherSalles') ? TRUE : FALSE;

    if($_POST){

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
      if(empty($_POST['categorie'])){
        $msg .= "Veuillez saisir votre Categorie.<br>";
      }

      if(!empty($_FILES['photo']['name'])) // on vérifie si une photo a bien été postée.
      {

        if($this->verificationPhoto()) // on vérifie l'extension de la photo=si c'est TRUE
        {
          define("RACINE_SITE", "/lokisalle/www/");
          define("RACINE_SERVER", $_SERVER['DOCUMENT_ROOT']);

          $nom_photo = 'salle' . $_POST['id_salle'] .'_'. $_FILES['photo']['name'];
          $photo_bdd = "img/$nom_photo";
          $photo_dossier = RACINE_SERVER . RACINE_SITE . "img/$nom_photo"; // chemin pour l'enregistrement dans le dossier qui va servir dans la fonction copy()
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

        $cont = new modelesSalles();
        $insertion = $cont->modificationSalle($id_salle, $pays, $ville, $adresse, $cp, $titre, $description, $photo_bdd, $capacite, $categorie);
      }
    }

    $pdo = new modelesSalles();
    $recupPourModif = $pdo->modifSalleID($id_salle);

    $this->Render('../vues/salle/gestion_salles.php', array('recupPourModif' => $recupPourModif, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'tableau' => $tableau, 'form' => $form, 'msg' => $msg));

  }

  public function supprimerSalle(){

    session_start();

    $userConnect = FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;


    $form = (isset($_GET['action']) && $_GET['action'] == 'ajouterSalle' || $_GET['action'] == 'modifierSalle') ? TRUE : FALSE;
    $tableau = (isset($_GET['action']) && $_GET['action'] == 'afficherSalles') ? TRUE : FALSE;

    if(isset($_GET['id_salle']) && !empty($_GET['id_salle'])){

      $id_salle = $_GET['id_salle'];

      $pdo = new modelesSalles();
      $recupPourModif = $pdo->modifSalleID($id_salle);
    }

    $msg = '';
    $id_salle = $_GET['id_salle'];

    define("RACINE_SITE", "/lokisalle/www/");
    define("RACINE_SERVER", $_SERVER['DOCUMENT_ROOT']);

    $supp = new modelesSalles();
    $salleASupprimer = $supp->modifSalleID($id_salle);
    $chemin_photo = RACINE_SERVER . RACINE_SITE . $salleASupprimer['photo']; // nous avons besoin du chemin depuis la racine serveur pour supprimer la photo du serveur.

    if(!empty($salleASupprimer['photo']) && file_exists($chemin_photo)){
      unlink($chemin_photo);
    }

    $supp->suppressionSalle($id_salle);
    $gestionSalles = TRUE;
    $msg .= '<div class="success"><p>Suppression effectuée.</p></div>';

    $this->Render('../vues/salle/gestion_salles.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'tableau' => $tableau, 'form' => $form, 'msg' => $msg));

  }

}
