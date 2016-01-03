<?php

class controleursAvis extends controleursSuper {

  // ********* Gestions des Avis Admin ********** //
  public function gestionAvis(){

    session_start();
    $title['name'] = 'Gestion des avis';
    $title['menu'] = 12;
    $userConnect = FALSE;
    $userConnectAdmin = $this->userConnectAdmin();
    $msg = '';
    $confirmation = '';

    $donnees = new modelesAvis();

    if(isset($_GET['supp']) && !empty($_GET['supp']) && is_numeric($_GET['supp'])){

      $id_avis = htmlentities($_GET['supp']);

      if($donnees->suppressionAvisAdmin($id_avis)){
        $confirmation .= "L'avis a bien été supprimé.";
      }

    }

    $listeAvis = $donnees->lesAvisAdmin();

    $this->Render('../vues/avis/gestion_avis.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'confirmation' => $confirmation, 'msg' => $msg, 'listeAvis' => $listeAvis));

  }

}
