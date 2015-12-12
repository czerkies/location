<?php

class controleursProduit extends controleursSuper {

  // ********** Affichage des produits sur la page d'accueil ********** //
  public function produitACC(){

    session_start();
    $userConnect = (isset($_SESSION['membre'])) ? TRUE : FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

    $cont = new modelesProduit();
    $lesProduits = $cont->affichageACC();

    $this->Render('../vues/produit/accueil.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'lesProduits' => $lesProduits));

  }

  // ********** Affichage des produits sur la page Réservations ********** //
  public function produitReservation(){

    session_start();

    $userConnect = (isset($_SESSION['membre'])) ? TRUE : FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

    $cont = new modelesProduit();
    $lesProduits = $cont->affichageReservation();

    $this->Render('../vues/produit/reservation.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'lesProduits' => $lesProduits));

  }

  // ********** Page d'affichage réservation détail d'un produit ********** //
  public function reservationDetails(){

    session_start();
    $userConnect = (isset($_SESSION['membre'])) ? TRUE : FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;
    $form = (!$userConnect) ? FALSE : TRUE;

    $msg = '';

    $id_produit = htmlentities($_GET['id_produit']);

    $modProduit = new modelesProduit();
    $ProduitIDSalle = $modProduit->recupProduitParID($id_produit);

    $id_salle = $ProduitIDSalle['id_salle'];
    $modAvis = new modelesAvis();
    $affichageAvis = $modAvis->recuperationAvisSalle($id_salle);


    // CHECK Afficher TTC *0.196 et Suggestion avec rapport date et ville
    if($userConnect){

      $id_membre = $_SESSION['membre']['id_membre'];

      $nbAvis = $modAvis->verifAvisProduit($id_salle, $id_membre);
      $form = ($nbAvis != 0) ? FALSE : TRUE;

      if($form){

      if(isset($_POST['avis'])){

          if(empty($_POST['commentaire'])){
            $msg .= "Veuillez saisir un commentaire.<br>";
          }
          if(!isset($_POST['note'])){
            $msg .= "Une erreur est survenue.<br>";
          }

          if(empty($msg)){

            foreach ($_POST as $key => $value){
              $_POST[$key] = htmlentities($value, ENT_QUOTES);
            }

            extract($_POST);

            $id_salle = $ProduitIDSalle['id_salle'];

            $modAvis->insertionAvisParID($id_membre, $id_salle, $commentaire, $note);
            $affichageAvis = $modAvis->recuperationAvisSalle($id_salle);
            $form =  FALSE;

          }
        }
      }
    }

    // Traitement des suggestions par produit
    $suggestions = $modProduit->searchSuggestionProduit($id_produit, $ProduitIDSalle['ville'], $ProduitIDSalle['date_arriveeSQL'], $ProduitIDSalle['date_departSQL']);

    $this->Render('../vues/produit/reservation_details.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'affichageAvis' => $affichageAvis, 'ProduitIDSalle' => $ProduitIDSalle, 'form' => $form, 'suggestions' => $suggestions));

  }

  // ********** Recherche de produit *********** //
  public function rechercheProduit(){

    session_start();
    $userConnect = (isset($_SESSION['membre'])) ? TRUE : FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;
    $produits = FALSE;
    $msg = '';

    $date = new controleursFonctions();

    $categories = new modelesSalles();
    $listeCategories = $categories->categoriesSalle();

    if(isset($_POST) && !empty($_POST)){

      if(
        isset($_POST['recherche_date_A']) && !empty($_POST['recherche_date_A']) &&
        isset($_POST['recherche_date_M']) && !empty($_POST['recherche_date_M']) &&
        isset($_POST['recherche_date_J']) && !empty($_POST['recherche_date_J']) &&
        isset($_POST['categorie']) && !empty($_POST['categorie']) &&
        isset($_POST['keyword'])) {

          foreach ($_POST as $key => $value){
            $_POST[$key] = htmlentities($value, ENT_QUOTES);
          }

          extract($_POST);

          $date_arrivee = $_POST['recherche_date_A'].'-'.$_POST['recherche_date_M'].'-'.$_POST['recherche_date_J'];

          $keyword = (!empty($_POST['keyword'])) ? $_POST['keyword'] : FALSE;
          $categorie = ($_POST['categorie'] === 'all') ? FALSE : $_POST['categorie'];

          $donnees = new modelesProduit();

          $produits = $donnees->requeteRecherche($date_arrivee, $keyword, $categorie);

        }
    }

    $this->Render('../vues/produit/recherche.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'listeCategories' => $listeCategories, 'produits' => $produits, 'date' => $date));

  }

}
