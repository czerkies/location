<?php

class controleursStatistiques extends controleursSuper {

  public function affichageStatistiques(){

    session_start();
    $title['name'] = 'Statistiques';
    $title['menu'] = 14;
    $userConnect = FALSE;
    $userConnectAdmin = $this->userConnectAdmin();
    $cinqNotes = '';
    $cinqVendues = '';
    $cinqMembresQuantite = '';
    $cinqMembresPrix = '';

    $donnees = new modelesStatistiques();

    if(isset($_GET['top']) && !empty($_GET['top'])) {

      if($_GET['top'] === 'cinqNotes'){

        $cinqNotes = $donnees->dataCinqNotes();
        $title['name'] .= ' | 5 Salles les mieux notés';

      }

      if($_GET['top'] === 'cinqVendues'){

        $cinqVendues = $donnees->dataCinqVendues();
        $title['name'] .= ' | 5 Salles les plus vendues';

      }

      if($_GET['top'] === 'cinqMembresQuantite'){

        $cinqMembresQuantite = $donnees->dataCinqMembresQuantite();
        $title['name'] .= ' | 5 Membres qui achète le plus';

      }

      if($_GET['top'] === 'cinqMembresPrix'){

        $cinqMembresPrix = $donnees->dataCinqMembresPrix();
        $title['name'] .= ' | 5 Membres dépensant le plus';

      }

    }

    $this->Render('../vues/statistiques/statistiques.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'cinqNotes' => $cinqNotes, 'cinqVendues' => $cinqVendues, 'cinqMembresQuantite' => $cinqMembresQuantite, 'cinqMembresPrix' => $cinqMembresPrix));

  }

}
