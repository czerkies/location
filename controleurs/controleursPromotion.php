<?php

class controleursPromotion extends controleursSuper {

  // ********** Ajouter code promotion Administrateur ********** //
  public function ajouterPromotion(){

    session_start();
    $userConnect = (isset($_SESSION['membre'])) ? TRUE : FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

    $msg = '';
    $afficher = FALSE;
    $ajouter = FALSE;

    if($userConnectAdmin){

      $afficher = (isset($_GET['action']) && ($_GET['action']) == 'afficherPromotion') ? TRUE : FALSE;
      $ajouter = (isset($_GET['action']) && ($_GET['action']) == 'ajouterPromotion') ? TRUE : FALSE;

      if($_POST){

        $code_promo = $_POST['code_promo'];

        if(empty($_POST['code_promo'])){
          $msg .= "Veuillez saisir un code promo.<br>";
        } elseif(strlen($_POST['code_promo']) > 6){
          $msg .= "Veuillez saisir un code promo à 6 chiffre maximum<br>";
        } else {
          $cont = new modelesPromotion();
          $verifCodePromo = $cont->verifPresencePromo($code_promo);
          if($verifCodePromo != 0){
            $msg .= "Le code promotion que vous avez saisis est déjà existante.<br>";
          }
        }
        if(empty($_POST['reduction'])){
          $msg .= "Veuillez saisir un montant de réduction.<br>";
        }

        if(empty($msg)){

          foreach ($_POST as $key => $value){
            $_POST[$key] = htmlentities($value, ENT_QUOTES);
          }

          extract($_POST);

          $pdo = new modelesPromotion();
          $pdo->ajouterCodePromo($code_promo, $reduction);

          $msg .= 'Votre code promo a bien été ajouté.';
        }
      }
    }

    $this->Render('../vues/promotion/gestion_promos.php', array('msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'ajouter' => $ajouter, 'afficher' => $afficher));

  }
  // ********** Afficher les code promotions Administrateur ********** //
  public function afficherPromotion(){

    session_start();
    $userConnect = (isset($_SESSION['membre'])) ? TRUE : FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

    $msg = '';
    $afficher = FALSE;
    $ajouter = FALSE;
    $donnees = NULL;
    $dialogue = FALSE;

    if($userConnectAdmin){

      $afficher = (isset($_GET['action']) && ($_GET['action']) == 'afficherPromotion') ? TRUE : FALSE;
      $ajouter = (isset($_GET['action']) && ($_GET['action']) == 'ajouterPromotion') ? TRUE : FALSE;

      $bdd = new modelesPromotion();

      if(isset($_GET['supprimer'])){

        $id_promo = htmlentities($_GET['supprimer']);

        $confirmSiProduit = $bdd->VerifPromoProduit($id_promo);

        if($confirmSiProduit === 0){

          $bdd->SuppPromo($id_promo);
          $msg .= "Votre code promo a bien été supprimé.";

        } else {

          $dialogue = TRUE;

          if(isset($_GET['confirm']) && !empty($_GET['confirm']) && $_GET['confirm'] === 'oui'){

            $bdd->SuppPromo($id_promo);
            $msg .= "Votre code promo a bien été supprimé.";
            $dialogue = FALSE;

          }
        }
      }

      $donnees = $bdd->affichageCodePromo();

    }

    $this->Render('../vues/promotion/gestion_promos.php', array('msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'ajouter' => $ajouter, 'afficher' => $afficher, 'donnees' => $donnees, 'dialogue' => $dialogue));

  }

}
