<?php

class controleursProduitAdmin extends controleursSuper {

  // ********** Ajouter produit Administrateur ********** //
  public function ajouterProduits(){

    session_start();
    $userConnect = FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

    $msg = '';

    $pdo = new modelesSalles();
    $listePromo = new modelesPromotion();
    $date = new controleursFonctions();

    if($userConnectAdmin){

      $afficher = (isset($_GET['action']) && ($_GET['action']) == 'afficherProduits') ? TRUE : FALSE;
      $ajouter = (isset($_GET['action']) && ($_GET['action']) == 'ajouterProduits') ? TRUE : FALSE;

      $affichageSalles = $pdo->affichageSalles();

      $affichagePromo = $listePromo->affichageCodePromo();


      if($_POST){

        if(empty($_POST['prix'])){
          $msg .= "Veuillez saisir un prix.<br>";
        }

        if(empty($msg)){

          foreach ($_POST as $key => $value){
            $_POST[$key] = htmlentities($value, ENT_QUOTES);
          }

          extract($_POST);

          $date_arrivee = $_POST['date_arrivee_A'].'-'.$_POST['date_arrivee_M'].'-'.$_POST['date_arrivee_J'];
          $date_arrivee .= ' '.$_POST['date_arrivee_H'].':'.$_POST['date_arrivee_I'];

          $date_depart = $_POST['date_depart_A'].'-'.$_POST['date_depart_M'].'-'.$_POST['date_depart_J'];
          $date_depart .= ' '.$_POST['date_depart_H'].':'.$_POST['date_depart_I'];

          $id_promo = (isset($_POST['id_promo']) && $_POST['id_promo'] === 'NULL') ? NULL : $_POST['id_promo'];

          $nouveauxProduit = new modelesProduit();
          $nouveauxProduit->InsertionProduitAdmin($id_salle, $date_arrivee, $date_depart, $prix, $id_promo);

          $msg .= 'Le produit a bien été ajouté.';

        }

      }

    }

    $this->Render('../vues/produit/gestion_produits.php', array('msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'ajouter' => $ajouter, 'afficher' => $afficher, 'affichageSalles' => $affichageSalles, 'affichagePromo' => $affichagePromo, 'date' => $date));

  }

  // ********** Afficher les produits Administrateur ********** //
  public function afficherProduits(){

    session_start();
    $userConnect = FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

    $msg = '';
    $affichageProduitsAdmin = '';
    $modifSalle = FALSE;
    $idProduitModif = FALSE;
    $afficher = FALSE;
    $ajouter = FALSE;

    $date = new controleursFonctions();

    $pdo = new modelesSalles();
    $affichageSalles = $pdo->affichageSalles();

    $listePromo = new modelesPromotion();
    $affichagePromo = $listePromo->affichageCodePromo();

    if($userConnectAdmin){

      $afficher = (isset($_GET['action']) && ($_GET['action']) == 'afficherProduits') ? TRUE : FALSE;
      $ajouter = (isset($_GET['action']) && ($_GET['action']) == 'ajouterProduits') ? TRUE : FALSE;

      $pdo = new modelesProduit();

      // ORDER BY pour desc de date_arrivee, date_depart et prix.
      if(isset($_GET['type']) && isset($_GET['order'])){

        if(isset($_GET['type']) && !empty($_GET['type'] && isset($_GET['order']) && !empty($_GET['order'])
          && $_GET['type'] === 'date_arrivee' || $_GET['type'] === 'date_depart' || $_GET['type'] === 'prix'
          && $_GET['order'] === 'asc' || $_GET['order'] === 'desc')) {

          $type = htmlentities($_GET['type']);
          $order = htmlentities($_GET['order']);
          $affichageProduitsAdmin = $pdo->affichageProduitsAdminTypeOrder($_GET['type'], $_GET['order']);

        } else {

            $affichageProduitsAdmin = $pdo->affichageProduitsAdmin();
        }

      } elseif(isset($_GET['supp'])) {
        $id_produit_supp = $_GET['supp'];
        $suppressionProduitAdmin = $pdo->suppressionProduitAdmin($id_produit_supp);
        $affichageProduitsAdmin = $pdo->affichageProduitsAdmin();
      } else {

        // Modification d'un produit Admin
        $affichageProduitsAdmin = $pdo->affichageProduitsAdmin();

        if(isset($_GET['modif'])) {

          $modifSalle = TRUE;
          $id_produit_modif = $_GET['modif'];
          $idProduitModif = $pdo->recupProduitParID($id_produit_modif);

          if(isset($_POST) && !empty($_POST)){

            if($_POST){

              if(empty($_POST['prix'])){
                $msg .= "Veuillez saisir un prix.<br>";
              }

              if(empty($msg)){

                foreach ($_POST as $key => $value){
                  $_POST[$key] = htmlentities($value, ENT_QUOTES);
                }

                extract($_POST);

                $date_arrivee = $_POST['date_arrivee_A'].'-'.$_POST['date_arrivee_M'].'-'.$_POST['date_arrivee_J'];
                $date_arrivee .= ' '.$_POST['date_arrivee_H'].':'.$_POST['date_arrivee_I'];

                $date_depart = $_POST['date_depart_A'].'-'.$_POST['date_depart_M'].'-'.$_POST['date_depart_J'];
                $date_depart .= ' '.$_POST['date_depart_H'].':'.$_POST['date_depart_I'];

                $id_promo = (isset($_POST['id_promo']) && $_POST['id_promo'] === 'NULL') ? NULL : $_POST['id_promo'];

                $modifProduit = new modelesProduit();
                $modifProduit->updateProduitAdmin($id_salle, $date_arrivee, $date_depart, $prix, $id_promo, $id_produit);

                $msg .= 'Le produit a bien été modifié.';

                $affichageProduitsAdmin = $pdo->affichageProduitsAdmin();

              }

            }
            // Appel de la requete d'insertion si $msg est vide.
          }

        }
      }

    }

    $this->Render('../vues/produit/gestion_produits.php', array('msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'date' => $date, 'ajouter' => $ajouter, 'afficher' => $afficher, 'affichageProduitsAdmin' => $affichageProduitsAdmin, 'modifSalle' => $modifSalle, 'affichageSalles' => $affichageSalles, 'affichagePromo' => $affichagePromo, 'idProduitModif' => $idProduitModif));

  }

}
