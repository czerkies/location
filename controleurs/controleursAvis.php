<?php

class controleursAvis extends controleursSuper {

  // ********* Gestions des Avis ********** //
  public function gestionAvis(){

    session_start();

    $userConnect = (isset($_SESSION['membre'])) ? TRUE : FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;
    $msg = '';

    $pdo = new modelesAvis();

    $listeAvis = $pdo->lesAvis();

    $this->Render('../vues/avis/gestion_avis.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'listeAvis' => $listeAvis));

  }

}
