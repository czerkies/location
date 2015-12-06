<?php

class controleursCommande extends controleursSuper {

  // ********* Gestions des Avis ********** //
  public function gestionCommandes(){

    session_start();

    $userConnect = (isset($_SESSION['membre'])) ? TRUE : FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;
    $msg = '';

    $pdo = new modelesCommande();

    $listeCommandes = $pdo->lesCommandesAdmin();

    // Calcule du prix total pour affichage CA.
    $totalCA = 0;

    foreach ($listeCommandes as $value) {
      $totalCA += $value['montant'];
    }

    $this->Render('../vues/commande/gestion_commandes.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'listeCommandes' => $listeCommandes, 'totalCA' => $totalCA));

  }

}
