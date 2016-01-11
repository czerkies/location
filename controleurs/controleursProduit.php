<?php

class controleursProduit extends controleursSuper {

  // ********** Affichage des produits sur la page d'accueil ********** //
  public function produitACC(){

    session_start();
    $title['name'] = 'Accueil';
    $title['menu'] = 1;
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $cont = new modelesProduit();
    $lesProduits = $cont->affichageACC();

    $this->Render('../vues/produit/accueil.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'lesProduits' => $lesProduits));

  }

  // ********** Affichage des produits sur la page Réservations ********** //
  public function produitReservation(){

    session_start();
    $title['name'] = 'Tout nos produits';
    $title['menu'] = 2;
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $cont = new modelesProduit();
    $lesProduits = $cont->affichageReservation();

    $this->Render('../vues/produit/reservation.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'lesProduits' => $lesProduits));

  }

  // ********** Page d'affichage réservation détail d'un produit ********** //
  public function reservationDetails(){

    $title['menu'] = 2;

    $modProduit = new modelesProduit();
    $id_produit = htmlentities($_GET['id_produit'], ENT_QUOTES);

    if(isset($_GET['id_produit']) && !empty($_GET['id_produit']) && is_numeric($_GET['id_produit'])
    && $modProduit->verifExistanceIDProduit($id_produit) === TRUE){

      session_start();
      $userConnect = $this->userConnect();
      $userConnectAdmin = $this->userConnectAdmin();
      $form = (!$userConnect) ? FALSE : TRUE;
      $msg = '';
      $confirmation = FALSE;

      $ProduitIDSalle = $modProduit->recupProduitParID($id_produit);

      $title['name'] = $ProduitIDSalle['titre'];

      $id_salle = $ProduitIDSalle['id_salle'];
      $modAvis = new modelesAvis();

      // CHECK Afficher TTC *0.196

      if($userConnect){

        $id_membre = $_SESSION['membre']['id_membre'];

        $nbAvis = $modAvis->verifAvisProduit($id_salle, $id_membre);
        $form = ($nbAvis != 0) ? FALSE : TRUE;

        if($form){

          if(isset($_POST['avis'])){

            if(isset($_POST['commentaire']) && isset($_POST['note'])){

              if(!empty($_POST['note'])
              && $_POST['note'] > 0 && $_POST['note'] < 11 || $_POST['note'] == 0
              && is_numeric($_POST['note'])){

              if(empty($_POST['commentaire'])){
                $msg .= "Veuillez saisir un avis.<br>";
              } elseif(strlen($_POST['commentaire']) < 4 || strlen($_POST['commentaire']) > 450){
                $msg .= "Votre avis doit comporter entre 4 et 450 caractères.<br>";
              }

                if(empty($msg)){

                  foreach ($_POST as $key => $value){
                    $_POST[$key] = htmlentities($value, ENT_QUOTES);
                  }

                  extract($_POST);

                  $id_salle = $ProduitIDSalle['id_salle'];

                  $modAvis->insertionAvisParID($id_membre, $id_salle, $commentaire, $note);
                  $form =  FALSE;
                  $confirmation = TRUE;

                }
              } else {
                $msg .= 'Une erreur est survenue lors de votre demande.<br>';
              }
            } else {
              $msg .= 'Une erreur est survenue lors de votre demande.<br>';
            }
          }
        }
      }

      // Récupération des avis
      $affichageAvis = $modAvis->recuperationAvisSalle($id_salle);

      // Traitement des suggestions par produit
      $suggestions = $modProduit->searchSuggestionProduit($id_produit, $ProduitIDSalle['ville'], $ProduitIDSalle['date_arriveeSQL'], $ProduitIDSalle['date_departSQL']);

    $this->Render('../vues/produit/reservation_details.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'confirmation' => $confirmation, 'affichageAvis' => $affichageAvis, 'ProduitIDSalle' => $ProduitIDSalle, 'form' => $form, 'suggestions' => $suggestions));

    } else {
      header('Location: /lokisalle/www/page-introuvable/');
    }

  }

  // ********** Recherche de produit *********** //
  public function rechercheProduit(){

    session_start();
    $title['name'] = "Recherche d'un produit";
    $title['menu'] = 3;
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();
    $produits = FALSE;
    $msg = '';

    $date = new controleursFonctions();

    $categories = new modelesSalles();
    $listeCategories = $categories->categoriesSalle();

    if($_POST){

      if(isset($_POST['recherche_date_A']) && !empty($_POST['recherche_date_A']) &&
        isset($_POST['recherche_date_M']) && !empty($_POST['recherche_date_M']) &&
        isset($_POST['recherche_date_J']) && !empty($_POST['recherche_date_J']) &&
        isset($_POST['categorie']) && !empty($_POST['categorie']) &&
        isset($_POST['keyword'])){

          foreach ($_POST as $key => $value){
            $_POST[$key] = htmlspecialchars($value, ENT_QUOTES);
          }

          extract($_POST);

          $date_arrivee = $_POST['recherche_date_A'].'-'.$_POST['recherche_date_M'].'-'.$_POST['recherche_date_J'];

          $keyword = (!empty($_POST['keyword'])) ? $_POST['keyword'] : FALSE;
          $categorie = ($_POST['categorie'] === 'all') ? FALSE : $_POST['categorie'];

          $donnees = new modelesProduit();

          $produits = $donnees->requeteRecherche($date_arrivee, $keyword, $categorie);

          $title['name'] .= ' | '.$produits['nbProduits'].' Résultat(s)';

        }
    }

    $this->Render('../vues/produit/recherche.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'listeCategories' => $listeCategories, 'produits' => $produits, 'date' => $date));

  }

}
