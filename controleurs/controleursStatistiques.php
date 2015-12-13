<?php

class controleursStatistiques extends controleursSuper {

  public function affichageStatistiques(){

    session_start();
    $userConnect = FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;
    $cinqNotes = FALSE;

    if(isset($_GET['top']) && !empty($_GET['top']) && $_GET['top'] === 'cinqNotes'){

      $donnees = new modelesStatistiques();
      $cinqNotes = $donnees->dataCinqNotes();

    }

    $this->Render('../vues/statistiques/statistiques.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'cinqNotes' => $cinqNotes));

  }

  public function cinqNote(){

    session_start();
    $userConnect = FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

    $donnees = new modelesStatistiques();
    $cinqNote = $donnees->dataCinqNote();

    $this->Render('../vues/statistiques/statistiques.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'cinqNotes' => $cinqNotes));

  }

  public function cinqVendues(){

    session_start();
    $userConnect = FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

    $this->Render('../vues/statistiques/statistiques.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }

  public function cinqMembresQuantite(){

    session_start();
    $userConnect = FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

    $this->Render('../vues/statistiques/statistiques.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }

  public function cinqMembresPrix(){

    session_start();
    $userConnect = FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

    $this->Render('../vues/statistiques/statistiques.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }

}
