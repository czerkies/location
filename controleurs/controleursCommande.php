<?php

class controleursCommande extends controleursSuper {

  // ********* Gestions des Commandes Admin ********** //
  public function gestionCommandes(){

    session_start();
    $title = 'Gestion des commandes';
    $userConnect = FALSE;
    $userConnectAdmin = $this->userConnectAdmin();
    $detailsCommandeDisplay = FALSE;
    $detailsCommandeID = FALSE;
    $client = '';
    $infos = '';
    $msg = '';

    $donneesCommandes = new modelesCommande();

    // Affichage d'une commande en détail.
    if(isset($_GET['details_commande']) && !empty($_GET['details_commande']) && is_numeric($_GET['details_commande'])){

      $idDetailsCommande = htmlentities($_GET['details_commande']);

      $details = new modelesDetails_commande();

      $client = $details->detailsCommandeClient($idDetailsCommande);
      $infos = $details->detailsCommandeInfos($idDetailsCommande);
      $detailsCommandeID = $details->detailsCommandeGestionAdmin($idDetailsCommande);

      $detailsCommandeDisplay = TRUE;

    }

    $listeCommandes = $donneesCommandes->lesCommandesAdmin();

    // Calcule du prix total pour affichage CA.
    $totalCA = 0;

    foreach ($listeCommandes as $value) {
      $totalCA += $value['montant'];
    }

    $this->Render('../vues/commande/gestion_commandes.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'listeCommandes' => $listeCommandes, 'totalCA' => $totalCA, 'client' => $client, 'infos' => $infos, 'detailsCommandeID' => $detailsCommandeID, 'detailsCommandeDisplay' => $detailsCommandeDisplay));

  }

}
