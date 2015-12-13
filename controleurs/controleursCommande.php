<?php

class controleursCommande extends controleursSuper {

  // ********* Gestions des Avis ********** //
  public function gestionCommandes(){

    session_start();

    $userConnect = (isset($_SESSION['membre'])) ? TRUE : FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;
    $detailsCommandeDisplay = FALSE;
    $detailsCommandeID = FALSE;
    $client = FALSE;
    $msg = '';

    $pdo = new modelesCommande();

    // Affichage d'une commande en détail.
    if(isset($_GET['details_commande']) && !empty($_GET['details_commande'])){

      $idDetailsCommande = htmlentities($_GET['details_commande']);

      $details = new modelesDetails_commande();

      $client = $details->detailsCommande($idDetailsCommande);
      $detailsCommandeID = $details->detailsCommandeGestionAdmin($idDetailsCommande);

      $detailsCommandeDisplay = TRUE;

    }

    $listeCommandes = $pdo->lesCommandesAdmin();

    // Calcule du prix total pour affichage CA.
    $totalCA = 0;

    foreach ($listeCommandes as $value) {
      $totalCA += $value['montant'];
    }

    $this->Render('../vues/commande/gestion_commandes.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'listeCommandes' => $listeCommandes, 'totalCA' => $totalCA, 'client' => $client, 'detailsCommandeID' => $detailsCommandeID, 'detailsCommandeDisplay' => $detailsCommandeDisplay));

  }

}
