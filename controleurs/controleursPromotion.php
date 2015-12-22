<?php

class controleursPromotion extends controleursSuper {

  // ********** Ajouter code promotion Administrateur ********** //
  public function ajouterPromotion(){

    session_start();
    $title = 'Ajouter une promotion';
    $userConnect = FALSE;
    $userConnectAdmin = $this->userConnectAdmin();
    $msg = '';
    $ajouter = TRUE;
    $donnees = FALSE;

    if($_POST){

      if(isset($_POST['code_promo']) && isset($_POST['reduction'])){

        $code_promo = htmlentities($_POST['code_promo'], ENT_QUOTES);

        if(empty($_POST['code_promo'])){
          $msg .= "Veuillez saisir un code promo.<br>";
        } elseif(strlen($_POST['code_promo']) > 6 || strlen($_POST['code_promo']) < 4){
          $msg .= "Veuillez saisir un code promo entre 4 et 6 carractères.<br>";
        } elseif (!preg_match("/^[a-zA-Z0-9]*$/",$_POST['code_promo'])) {
          $msg .= "Seul les chiffres et lettres sont autorisés.<br>";
        } else {

          $cont = new modelesPromotion();
          $promos = $cont->verifPresencePromo($code_promo);

          if($promos['nbCodeVerif']){

            $msg .= "Le code promotion que vous avez saisis est déjà existante.<br>";

          }
        }

        if(empty($_POST['reduction']) || !is_numeric($_POST['reduction']) || $_POST['reduction'] < 1){
          $msg .= "Veuillez saisir un montant de réduction superieur ou égale à 1.<br>";
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
    }

    $this->Render('../vues/promotion/gestion_promos.php', array('title' => $title, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'ajouter' => $ajouter, 'donnees' => $donnees));

  }
  // ********** Afficher les code promotions Administrateur ********** //
  public function afficherPromotion(){

    session_start();
    $title = 'Gestion des promotions';
    $userConnect = FALSE;
    $userConnectAdmin = $this->userConnectAdmin();
    $ajouter = FALSE;
    $dialogue = FALSE;

    $msg = '';

    $bdd = new modelesPromotion();

    if(isset($_GET['supprimer']) && !empty($_GET['supprimer']) && is_numeric($_GET['supprimer'])){

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

    $this->Render('../vues/promotion/gestion_promos.php', array('title' => $title, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'ajouter' => $ajouter, 'donnees' => $donnees, 'dialogue' => $dialogue));

  }

}
