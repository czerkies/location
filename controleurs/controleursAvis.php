<?php

class controleursAvis extends controleursSuper {

  // ********* Gestions des Avis Admin ********** //
  public function gestionAvis(){

    session_start();
    $title = 'Gestion des avis';
    $userConnect = FALSE;
    $userConnectAdmin = $this->userConnectAdmin();
    $msg = '';

    $donnees = new modelesAvis();

    if(isset($_GET['supp']) && !empty($_GET['supp']) && is_numeric($_GET['supp'])){

      $id_avis = htmlentities($_GET['supp']);

      $donnees->suppressionAvisAdmin($id_avis);

    }

    $listeAvis = $donnees->lesAvisAdmin();

    $this->Render('../vues/avis/gestion_avis.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'listeAvis' => $listeAvis));

  }

}
