<?php

class controleursStatistiques extends controleursSuper {

  public function affichageStatistiques(){

    session_start();
    $userConnect = FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;


    $this->Render('../vues/statistiques/statistiques.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }

}
