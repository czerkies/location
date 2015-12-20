<?php

class controleursAvis extends controleursSuper {

  // ********* Gestions des Avis ********** //
  public function gestionAvis(){

    session_start();
    $title = 'Gestion des avis';
    $userConnect = (isset($_SESSION['membre'])) ? TRUE : FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;
    $msg = '';

    $pdo = new modelesAvis();

    if(isset($_GET['supp']) && !empty($_GET['supp'])){

      $id_avis = htmlentities($_GET['supp']);

      $pdo->suppressionAvisAdmin($id_avis);

    }

    $listeAvis = $pdo->lesAvisAdmin();

    $this->Render('../vues/avis/gestion_avis.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'listeAvis' => $listeAvis));

  }

}
