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
    || !isset($value['date_arrivee_M']) || !is_numeric($value['date_arrivee_M'])
    || !isset($value['date_arrivee_A']) || !is_numeric($value['date_arrivee_A'])
    || !isset($value['date_arrivee_H']) || !is_numeric($value['date_arrivee_H'])
    || !isset($value['date_arrivee_I']) || !is_numeric($value['date_arrivee_I'])
    || !isset($value['date_depart_J']) || !is_numeric($value['date_depart_J'])
    || !isset($value['date_depart_M']) || !is_numeric($value['date_depart_M'])
    || !isset($value['date_depart_A']) || !is_numeric($value['date_depart_A'])
    || !isset($value['date_depart_H']) || !is_numeric($value['date_depart_H'])
    || !isset($value['date_depart_I']) || !is_numeric($value['date_depart_I'])
    || !isset($value['id_promo']) || !is_numeric($value['id_promo'])){
      $msg .= self::ERREURSQL;
    }

    // Vérif des dates

    // Vérif des dates SQL.

    return $msg;

  }


  // ********** Ajouter produit Administrateur ********** //
  public function ajouterProduits(){

    session_start();
    $userConnect = FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;
    $msg = '';
    $ajouter = TRUE;
    $affichageProduitsAdmin = FALSE;
    $idProduitModif = FALSE;

    $salles = new modelesSalles();
    $affichageSalles = $salles->affichageSalles();

    $listePromo = new modelesPromotion();
    $affichagePromo = $listePromo->affichageCodePromo();

    $date = new controleursFonctions();

    if(isset($_POST) && !empty($_POST)){

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
          if($nouveauxProduit->insertionProduitAdmin($id_salle, $date_arrivee, $date_depart, $prix, $id_promo)){

            $msg .= 'Le produit a bien été ajouté.';

          } else {

            $msg .= self::ERREURSQL;

          }
        }
      } else {

        $msg .= self::ERREURSQL;

      }
    }

    $this->Render('../vues/produit/gestion_produits.php', array('msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'ajouter' => $ajouter, 'affichageProduitsAdmin' => $affichageProduitsAdmin, 'affichageSalles' => $affichageSalles, 'affichagePromo' => $affichagePromo, 'date' => $date, 'idProduitModif' => $idProduitModif));

  }

  // ********** Afficher les produits Administrateur ********** //
  public function afficherProduits(){

    session_start();
    $userConnect = FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

    $msg = '';
    $modifSalle = FALSE;
    $idProduitModif = FALSE;
    $ajouter = FALSE;

    $date = new controleursFonctions();
    $salles = new modelesSalles();
    $listePromo = new modelesPromotion();
    $donneesProduits = new modelesProduit();

    // Supprésion d'une salle
    if(isset($_GET['supp']) && !empty($_GET['supp'])){

      $id_produit_supp = htmlentities($_GET['supp']);
      $suppressionProduitAdmin = $donneesProduits->suppressionProduitAdmin($id_produit_supp);

    }

    // Modification d'un produit Admin
    if(isset($_GET['modif']) && !empty($_GET['modif'])) {

      if(isset($_POST) && !empty($_POST)){

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

            $donneesProduits->updateProduitAdmin($id_salle, $date_arrivee, $date_depart, $prix, $id_promo, $id_produit);

            $msg .= 'Le produit a bien été modifié.';

          }
        } else {

          $msg .= self::ERREURSQL;

        }
      }

      $idProduitGet = htmlentities($_GET['modif']);

      // Vérification existance ID produit.
      if($donneesProduits->verifExistanceIDProduit($idProduitGet)){
        $idProduitModif = $donneesProduits->recupProduitParID($idProduitGet);
      } else {
        $msg .= self::ERREURSQL;
      }
    }

    // ORDER BY pour desc de date_arrivee, date_depart et prix.
    if(isset($_GET['type']) && isset($_GET['order'])){

      if(isset($_GET['type']) && !empty($_GET['type'] && isset($_GET['order']) && !empty($_GET['order'])
        && $_GET['type'] === 'date_arrivee' || $_GET['type'] === 'date_depart' || $_GET['type'] === 'prix'
        && $_GET['order'] === 'asc' || $_GET['order'] === 'desc')) {

        $type = htmlentities($_GET['type']);
        $order = htmlentities($_GET['order']);

        $affichageProduitsAdmin = $donneesProduits->affichageProduitsAdminTypeOrder($type, $order);

      }
    } else {

      $affichageProduitsAdmin = $donneesProduits->affichageProduitsAdmin();

    }

    $affichageSalles = $salles->affichageSalles();
    $affichagePromo = $listePromo->affichageCodePromo();

    $this->Render('../vues/produit/gestion_produits.php', array('msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'date' => $date, 'ajouter' => $ajouter, 'affichageProduitsAdmin' => $affichageProduitsAdmin, 'affichageSalles' => $affichageSalles, 'affichagePromo' => $affichagePromo, 'idProduitModif' => $idProduitModif));

  }

}
