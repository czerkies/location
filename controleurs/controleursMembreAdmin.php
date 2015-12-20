<?php

class controleursMembreAdmin extends controleursSuper {

  // ********* Gestions des Membres Admin ********** //
  public function gestionMembres(){

    session_start();
    $title = 'Title';
    $userConnect = FALSE;
    $userConnectAdmin = $this->userConnectAdmin();
    $ajouterMembre = FALSE;
    $msg = '';

    $membre = new modelesMembre();

    // Suppréssion d'un membre
    if(isset($_GET['suppMembre']) && !empty($_GET['suppMembre'])){

      $id_membre = htmlentities($_GET['suppMembre']);

      if($membre->supprimerMembreAdmin($id_membre)){

        $msg .= 'Le membre a bien été supprimé.';

      } else {

        $msg .= 'Vous ne pouvez pas supprimer ce membre';

      }

    }

    // Ajout membre Administrateur
    if(isset($_GET['ajouter']) && !empty($_GET['ajouter'])){

      $ajouterMembre = TRUE;

      if(isset($_POST) && !empty($_POST)){

        $controleFormulaire = new controleursFonctions();
        $msg = $controleFormulaire->verifFormMembre($_POST);

        if(empty($msg)){

          foreach ($_POST as $key => $value){
            $_POST[$key] = htmlentities($value, ENT_QUOTES);
          }
          extract($_POST);

          $cont->insertMembre($pseudo, $mdp, $nom, $prenom, $email, $sexe, $ville, $cp, $adresse, 1);

        }

      }

    }

    $listeMembres = $membre->lesMembresAdmin();


    $this->Render('../vues/membre/gestion_membres.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'listeMembres' => $listeMembres, 'ajouterMembre' => $ajouterMembre));

  }

}
