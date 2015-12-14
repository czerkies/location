<?php

class controleursStatistiques extends controleursSuper {

  public function affichageStatistiques(){

    session_start();
    $userConnect = FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;
    $cinqNotes = FALSE;
    $cinqVendues = FALSE;
    $cinqMembresQuantite = '';

    $donnees = new modelesStatistiques();

    if(isset($_GET['top']) && !empty($_GET['top'])) {

      if($_GET['top'] === 'cinqNotes'){

        $cinqNotes = $donnees->dataCinqNotes();

      }

      if($_GET['top'] === 'cinqVendues'){

        $cinqVendues = $donnees->dataCinqVendues();

      }

      if($_GET['top'] === 'cinqMembresQuantite'){

        $cinqMembresQuantite = $donnees->dataCinqMembresQuantite();

      }

      if($_GET['top'] === 'cinqMembresPrix'){

        $cinqMembresPrix = $donnees->dataCinqMembresPrix();

      }

    }



    $this->Render('../vues/statistiques/statistiques.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'cinqNotes' => $cinqNotes, 'cinqVendues' => $cinqVendues, 'cinqMembresQuantite' => $cinqMembresQuantite, 'cinqMembresPrix' => $cinqMembresPrix));

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
