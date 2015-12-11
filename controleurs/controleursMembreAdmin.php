<?php

class controleursMembre extends controleursSuper {

  // ********* Gestions des Membres Admin ********** //
  public function gestionMembres(){

    session_start();

    $userConnect = (isset($_SESSION['membre'])) ? TRUE : FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;
    $ajouterMembre = FALSE;
    $msg = '';

    $pdo = new modelesMembre();

    $listeMembres = $pdo->lesMembresAdmin();

    // Suppréssion d'un membre
    if(isset($_GET['suppMembre']) && !empty($_GET['suppMembre'])){

      $id_membre = htmlentities($_GET['suppMembre']);

      if($pdo->supprimerMembreAdmin($id_membre)){

        $msg .= 'Le membre a bien été supprimé.';

      } else {

        $msg .= 'Vous ne pouvez pas supprimer ce membre';

      }

      $listeMembres = $pdo->lesMembresAdmin();

    }

    // Ajout membre Administrateur
    if(isset($_GET['ajouter']) && !empty($_GET['ajouter'])){

      $ajouterMembre = TRUE;

      if(isset($_POST) && !empty($_POST)){

        $msg = $this->verifFormMembre($_POST);

        if(empty($msg)){

          foreach ($_POST as $key => $value){
            $_POST[$key] = htmlentities($value, ENT_QUOTES);
          }
          extract($_POST);

          $cont = new modelesMembre();

          $cont->insertMembre($pseudo, $mdp, $nom, $prenom, $email, $sexe, $ville, $cp, $adresse, 1);

          $listeMembres = $pdo->lesMembresAdmin();

        }

      }

    }

    $this->Render('../vues/membre/gestion_membres.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'listeMembres' => $listeMembres, 'ajouterMembre' => $ajouterMembre));

  }

}
