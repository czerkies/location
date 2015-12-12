<?php

class controleursPromotion extends controleursSuper {

  // ********** Ajouter code promotion Administrateur ********** //
  public function ajouterPromotion(){

    session_start();
    $userConnect = (isset($_SESSION['membre'])) ? TRUE : FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;
    $msg = '';
    $ajouter = TRUE;
    $donnees = FALSE;

    if(isset($_POST) && !empty($_POST)){

      $code_promo = $_POST['code_promo'];

      if(empty($_POST['code_promo'])){
        $msg .= "Veuillez saisir un code promo.<br>";
      } elseif(strlen($_POST['code_promo']) > 6){
        $msg .= "Veuillez saisir un code promo à 6 chiffre maximum<br>";
      } else {

        $cont = new modelesPromotion();
        $promos = $cont->verifPresencePromo($code_promo);

        if($promos['nbCodeVerif']){

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
        $ajouter = FALSE;
      }
    }

    $this->Render('../vues/promotion/gestion_promos.php', array('msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'ajouter' => $ajouter, 'donnees' => $donnees));

  }
  // ********** Afficher les code promotions Administrateur ********** //
  public function afficherPromotion(){

    session_start();
    $userConnect = (isset($_SESSION['membre'])) ? TRUE : FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;
    $ajouter = FALSE;
    $dialogue = FALSE;

    $msg = '';

    $bdd = new modelesPromotion();

    if(isset($_GET['supprimer']) && !empty($_GET['supprimer'])){

      $id_promo = htmlentities($_GET['supprimer']);
      $VerifPromoProduit = $bdd->VerifPromoProduit($id_promo);

      if($VerifPromoProduit['nbProduitAssoc']){

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

    $this->Render('../vues/promotion/gestion_promos.php', array('msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'ajouter' => $ajouter, 'donnees' => $donnees, 'dialogue' => $dialogue));

  }

}
