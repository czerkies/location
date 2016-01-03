<?php

class controleursProduitAdmin extends controleursSuper {

  const ERREURSQL = 'Une erreur est survenue lors du traitement de votre demande.';

  // ********** Controle du formulaire d'un produit *********** //
  public function controleFormulaireProduits($value){

    $msg = '';

    if(empty($value['prix'])){
      $msg .= "Veuillez saisir un prix.<br>";
    } elseif(!is_numeric($value['prix'])) {
      $msg .= "Le prix doit être un chiffre.<br>";
    }

    if(!isset($value['id_salle']) || !is_numeric($value['id_salle'])
    || !isset($value['date_arrivee_J']) || !is_numeric($value['date_arrivee_J'])
    || $value['date_arrivee_J'] < 1 || $value['date_arrivee_J'] > 31
    || !isset($value['date_arrivee_M']) || !is_numeric($value['date_arrivee_M'])
    || $value['date_arrivee_M'] < 1 || $value['date_arrivee_M'] > 12
    || !isset($value['date_arrivee_A']) || !is_numeric($value['date_arrivee_A'])
    || strlen($value['date_arrivee_A']) != 4 || $value['date_arrivee_A'] > date('Y', strtotime('+4 years'))
    || !isset($value['date_arrivee_H']) || !is_numeric($value['date_arrivee_H'])
    || $value['date_arrivee_H'] < 7 || $value['date_arrivee_H'] > 21
    || !isset($value['date_arrivee_I']) || !is_numeric($value['date_arrivee_I'])
    || $value['date_arrivee_I'] < 0 || $value['date_arrivee_I'] > 55
    || !isset($value['date_depart_J']) || !is_numeric($value['date_depart_J'])
    || $value['date_depart_J'] < 1 || $value['date_depart_J'] > 31
    || !isset($value['date_depart_M']) || !is_numeric($value['date_depart_M'])
    || $value['date_depart_M'] < 1 || $value['date_depart_M'] > 12
    || !isset($value['date_depart_A']) || !is_numeric($value['date_depart_A'])
    || strlen($value['date_depart_A']) != 4 || $value['date_depart_A'] > date('Y', strtotime('+4 years'))
    || !isset($value['date_depart_H']) || !is_numeric($value['date_depart_H'])
    || $value['date_depart_H'] < 7 || $value['date_depart_H'] > 21
    || !isset($value['date_depart_I']) || !is_numeric($value['date_depart_I'])
    || $value['date_depart_I'] < 0 || $value['date_depart_I'] > 55
    || !isset($value['id_promo']) || !is_numeric($value['id_promo'])){
      $msg .= self::ERREURSQL;
    }

    return $msg;

  }


  // ********** Ajouter produit Administrateur ********** //
  public function ajouterProduits(){

    session_start();
    $title['name'] = 'Ajouter un produit';
    $title['menu'] = 9;
    $title['menu_admin'] = 200;
    $userConnect = FALSE;
    $userConnectAdmin = $this->userConnectAdmin();
    $msg = '';
    $confirmation = '';
    $ajouter = TRUE;
    $affichageProduitsAdmin = FALSE;
    $idProduitModif = FALSE;

    $salles = new modelesSalles();
    $affichageSalles = $salles->affichageSalles();

    $listePromo = new modelesPromotion();
    $affichagePromo = $listePromo->affichageCodePromo();

    $date = new controleursFonctions();

    if($_POST){

      if(isset($_POST['id_salle']) && !empty($_POST['id_salle'])
      && isset($_POST['date_arrivee_J']) && !empty($_POST['date_arrivee_J'])
      && isset($_POST['date_arrivee_M']) && !empty($_POST['date_arrivee_M'])
      && isset($_POST['date_arrivee_A']) && !empty($_POST['date_arrivee_A'])
      && isset($_POST['date_arrivee_H']) && !empty($_POST['date_arrivee_H'])
      && isset($_POST['date_arrivee_I']) && (!empty($_POST['date_arrivee_I']) || $_POST['date_arrivee_I'] === '0')
      && isset($_POST['date_depart_J']) && !empty($_POST['date_depart_J'])
      && isset($_POST['date_depart_M']) && !empty($_POST['date_depart_M'])
      && isset($_POST['date_depart_A']) && !empty($_POST['date_depart_A'])
      && isset($_POST['date_depart_H']) && !empty($_POST['date_depart_H'])
      && isset($_POST['date_depart_I']) && (!empty($_POST['date_depart_I']) || $_POST['date_depart_I'] === '0')
      && isset($_POST['id_promo']) && (!empty($_POST['id_promo']) || $_POST['id_promo'] === '0')
      && isset($_POST['prix'])){

        $msg = $this->controleFormulaireProduits($_POST);

        if(empty($msg)){

          foreach ($_POST as $key => $value){
            $_POST[$key] = htmlentities($value, ENT_QUOTES);
          }

          extract($_POST);

          $date_arrivee = $_POST['date_arrivee_A'].'-'.$_POST['date_arrivee_M'].'-'.$_POST['date_arrivee_J'];
          $date_arrivee .= ' '.$_POST['date_arrivee_H'].':'.$_POST['date_arrivee_I'];

          $date_depart = $_POST['date_depart_A'].'-'.$_POST['date_depart_M'].'-'.$_POST['date_depart_J'];
          $date_depart .= ' '.$_POST['date_depart_H'].':'.$_POST['date_depart_I'];

          $id_promo = (isset($_POST['id_promo']) && $_POST['id_promo'] === '0') ? NULL : $_POST['id_promo'];

          $nouveauxProduit = new modelesProduit();

          // Controle des dates
          if($date_arrivee <= date('Y-m-d g:i')){
            $msg .= 'Vous ne pouvez pas créer un produit inferieur à la date du jour.<br>';
          }
          if($date_depart <= $date_arrivee){
            $msg .= 'Vous ne pouvez pas créer un produit avec une date de départ egale ou inferieur à la date d\'arrivée.<br>';
          }

          if($nouveauxProduit->verifDateBDD($date_arrivee, $date_depart, $id_salle, NULL)){

            if(empty($msg)){

              if($nouveauxProduit->insertionProduitAdmin($id_salle, $date_arrivee, $date_depart, $prix, $id_promo)){

                $confirmation .= 'Le produit a bien été ajouté.';

              } else {

                $msg .= self::ERREURSQL;

              }
            }
          } else {
            $msg .= 'Une salle a déjà été reservé à cette date.<br>Merci de bien vouloir en choisir une autre.<br>';
          }
        }
      } else {

        $msg .= self::ERREURSQL;

      }
    }

    $this->Render('../vues/produit/gestion_produits.php', array('title' => $title, 'msg' => $msg, 'confirmation' => $confirmation, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'ajouter' => $ajouter, 'affichageProduitsAdmin' => $affichageProduitsAdmin, 'affichageSalles' => $affichageSalles, 'affichagePromo' => $affichagePromo, 'date' => $date, 'idProduitModif' => $idProduitModif));

  }

  // ********** Afficher les produits Administrateur ********** //
  public function afficherProduits(){

    session_start();
    $title['name'] = 'Afficher les produits';
    $title['menu'] = 9;
    $title['menu_admin'] = 201;
    $userConnect = FALSE;
    $userConnectAdmin = $this->userConnectAdmin();

    $msg = '';
    $confirmation = '';
    $modifSalle = FALSE;
    $idProduitModif = FALSE;
    $ajouter = FALSE;

    $date = new controleursFonctions();
    $salles = new modelesSalles();
    $listePromo = new modelesPromotion();
    $donneesProduits = new modelesProduit();

    // Supprésion d'une salle
    if(isset($_GET['supp']) && !empty($_GET['supp']) && is_numeric($_GET['supp'])){

      $id_produit_supp = htmlentities($_GET['supp']);

      if(!$donneesProduits->produitEtatUn($id_produit_supp)){

        $suppressionProduitAdmin = $donneesProduits->suppressionProduitAdmin($id_produit_supp);
        $confirmation .= 'Le produit a bien été supprimé.';

      } else {

        $msg .= 'Vous ne pouvez pas supprimer ce produit car il a été réservé par un client.';

      }

    }

    // Modification d'un produit Admin
    if(isset($_GET['modif']) && !empty($_GET['modif']) && is_numeric($_GET['modif'])) {

      $title['name'] .= ' | Modification';

      $idProduitGet = htmlentities($_GET['modif']);

      if(!$donneesProduits->produitEtatUn($idProduitGet)){

        if($_POST){

          if(isset($_POST['id_salle']) && !empty($_POST['id_salle'])
          && isset($_POST['date_arrivee_J']) && !empty($_POST['date_arrivee_J'])
          && isset($_POST['date_arrivee_M']) && !empty($_POST['date_arrivee_M'])
          && isset($_POST['date_arrivee_A']) && !empty($_POST['date_arrivee_A'])
          && isset($_POST['date_arrivee_H']) && !empty($_POST['date_arrivee_H'])
          && isset($_POST['date_arrivee_I']) && (!empty($_POST['date_arrivee_I']) || $_POST['date_arrivee_I'] === '0')
          && isset($_POST['date_depart_J']) && !empty($_POST['date_depart_J'])
          && isset($_POST['date_depart_M']) && !empty($_POST['date_depart_M'])
          && isset($_POST['date_depart_A']) && !empty($_POST['date_depart_A'])
          && isset($_POST['date_depart_H']) && !empty($_POST['date_depart_H'])
          && isset($_POST['date_depart_I']) && (!empty($_POST['date_depart_I']) || $_POST['date_depart_I'] === '0')
          && isset($_POST['id_promo']) && (!empty($_POST['id_promo']) || $_POST['id_promo'] === '0')
          && isset($_POST['id_produit']) && !empty($_POST['id_produit']) && is_numeric($_POST['id_produit'])
          && isset($_POST['prix'])){

            $msg = $this->controleFormulaireProduits($_POST);

            if(empty($msg)){

              foreach ($_POST as $key => $value){
                $_POST[$key] = htmlentities($value, ENT_QUOTES);
              }

              extract($_POST);

              $date_arrivee = $_POST['date_arrivee_A'].'-'.$_POST['date_arrivee_M'].'-'.$_POST['date_arrivee_J'];
              $date_arrivee .= ' '.$_POST['date_arrivee_H'].':'.$_POST['date_arrivee_I'];

              $date_depart = $_POST['date_depart_A'].'-'.$_POST['date_depart_M'].'-'.$_POST['date_depart_J'];
              $date_depart .= ' '.$_POST['date_depart_H'].':'.$_POST['date_depart_I'];

              $id_promo = (isset($_POST['id_promo']) && $_POST['id_promo'] === '0') ? NULL : $_POST['id_promo'];

              // Controle des dates
              if($date_arrivee <= date('Y-m-d g:i')){
                $msg .= 'Vous ne pouvez pas créer un produit inferieur à la date du jour.';
              }
              if($date_depart <= $date_arrivee){
                $msg .= 'Vous ne pouvez pas créer un produit avec une date de départ egale ou inferieur à la date d\'arrivée.';
              }

              if($donneesProduits->verifDateBDD($date_arrivee, $date_depart, $id_salle, $id_produit)){

                if(empty($msg)){

                  if($donneesProduits->updateProduitAdmin($id_salle, $date_arrivee, $date_depart, $prix, $id_promo, $id_produit)){

                    $confirmation .= 'Le produit a bien été modifié.';

                  } else {

                    $msg .= self::ERREURSQL;

                  }
                }
              } else {
                $msg .= 'Une salle a déjà été reservé à cette date.<br>Merci de bien vouloir en choisir une autre.<br>';
              }
            }
          } else {

            $msg .= self::ERREURSQL;

          }
        }
      } else {
        $msg .= 'Ce produit ne peut être modifié car il été réservé par un client.<br>';
      }

      // Vérification existance ID produit.
      if($donneesProduits->verifExistanceIDProduit($idProduitGet)){
        $idProduitModif = $donneesProduits->recupProduitParID($idProduitGet);
      } else {
        $msg .= self::ERREURSQL;
      }

    }

    // ORDER BY pour desc de date_arrivee, date_depart et prix.
    if(isset($_GET['type']) && !empty($_GET['type'])
      && isset($_GET['order']) && !empty($_GET['order'])
      && ($_GET['type'] === 'date_arrivee' || $_GET['type'] === 'date_depart' || $_GET['type'] === 'prix')
      && ($_GET['order'] === 'asc' || $_GET['order'] === 'desc')) {

      $type = htmlentities($_GET['type']);
      $order = htmlentities($_GET['order']);

      $affichageProduitsAdmin = $donneesProduits->affichageProduitsAdminTypeOrder($type, $order);

    } else {

      $affichageProduitsAdmin = $donneesProduits->affichageProduitsAdmin();

    }

    $affichageSalles = $salles->affichageSalles();
    $affichagePromo = $listePromo->affichageCodePromo();

    $this->Render('../vues/produit/gestion_produits.php', array('title' => $title, 'msg' => $msg, 'confirmation' => $confirmation, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'date' => $date, 'ajouter' => $ajouter, 'affichageProduitsAdmin' => $affichageProduitsAdmin, 'affichageSalles' => $affichageSalles, 'affichagePromo' => $affichagePromo, 'idProduitModif' => $idProduitModif));

  }

}
