<?php

class controleursMembreAdmin extends controleursSuper {

  // ********* Gestions des Membres Admin ********** //
  public function gestionMembres(){

    session_start();
    $title['name'] = 'Gestion des membres';
    $title['menu'] = 10;
    $userConnect = FALSE;
    $userConnectAdmin = $this->userConnectAdmin();
    $ajouterMembre = FALSE;
    $dialogue = FALSE;
    $msg = '';

    $membre = new modelesMembre();

    // Suppréssion d'un membre
    if(isset($_GET['suppMembre']) && !empty($_GET['suppMembre']) && is_numeric($_GET['suppMembre'])){

      $id_membre = htmlentities($_GET['suppMembre']);

      if(!$membre->verifMembreCommande($id_membre)){

        if($membre->supprimerMembreAdmin($id_membre)){
          $msg .= 'Le membre a bien été supprimé.';
        } else {
          $msg .= 'Vous ne pouvez pas supprimer ce membre';
        }

      } else {

        $dialogue = TRUE;

        if(isset($_GET['confirm']) && !empty($_GET['confirm']) && $_GET['confirm'] === 'oui'){

          if($membre->supprimerMembreAdmin($id_membre)){
            $msg .= 'Le membre a bien été supprimé.';
          } else {
            $msg .= 'Vous ne pouvez pas supprimer ce membre';
          }

          $dialogue = FALSE;

        }
      }
    }

    // Ajout membre Administrateur
    if(isset($_GET['ajouter']) && !empty($_GET['ajouter']) && $_GET['ajouter'] === 'membre'){

      $ajouterMembre = TRUE;

      if($_POST){

        if(isset($_POST['pseudo']) && isset($_POST['mdp'])
        && isset($_POST['nom']) && isset($_POST['prenom'])
        && isset($_POST['email']) && ((isset($_POST['sexe'])
        && ($_POST['sexe'] === 'm' || $_POST['sexe'] === 'f'))
        && isset($_POST['ville']) && isset($_POST['cp']))
        && isset($_POST['adresse'])){

          $controleFormulaire = new controleursFonctions();
          $msg = $controleFormulaire->verifFormMembre($_POST, NULL);

          if(empty($msg)){

            foreach ($_POST as $key => $value){
              $_POST[$key] = htmlspecialchars($value, ENT_QUOTES);
            }
            extract($_POST);

            $membre->insertMembre($pseudo, $mdp, $nom, $prenom, $email, $sexe, $ville, $cp, $adresse, 1);

          }
        } else {
          $msg .= 'Une erreur est survenue lors de votre demande.<br>';
        }
      }
    }

    $listeMembres = $membre->lesMembresAdmin();


    $this->Render('../vues/membre/gestion_membres.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'listeMembres' => $listeMembres, 'ajouterMembre' => $ajouterMembre, 'dialogue' => $dialogue));

  }

}
