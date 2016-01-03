<?php

class controleursPanier extends controleursSuper {

  // ********** Page d'affichage réservation d'un produit ********** //
  public function affichagePanier(){

    session_start();
    $title['name'] = 'Votre panier';
    $title['menu'] = 6;
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();
    $userCart = (isset($_SESSION['panier'])) ? TRUE : FALSE;

    $codeProduitOk = FALSE;
    $prixTotal = 0;
    $prixTotalReduit = 0;
    $diffTotalPromo = 0;
    $pourcentageTotalPromo = 0;
    $msg = '';

    $reCodeID = new modelesPromotion();
    $produitPanier = new modelesProduit();

    if(isset($_GET['id_produit']) && !empty($_GET['id_produit']) && is_numeric($_GET['id_produit'])){

      $id_produit = htmlentities($_GET['id_produit'], ENT_QUOTES);

      if($produitPanier->verifExistanceIDProduit($id_produit)){

        $donneesSession = $produitPanier->recupProduitParID($id_produit);

        if(!isset($_SESSION['panier'])) // si le panier n'existe pas
        {

          $_SESSION['panier'] = array();
          $_SESSION['panier']['id_produit'] = array();
          $_SESSION['panier']['titre'] = array();
          $_SESSION['panier']['photo'] = array();
          $_SESSION['panier']['ville'] = array();
          $_SESSION['panier']['capacite'] = array();
          $_SESSION['panier']['date_arrivee'] = array();
          $_SESSION['panier']['date_depart'] = array();
          $_SESSION['panier']['prix'] = array();

          $userCart = TRUE;

        }

        $verifProduit = array_search($id_produit, $_SESSION['panier']['id_produit']);

        if($verifProduit !== FALSE){
          $msg .= 'Désolé, vous ne pouvez pas ajouter ce produit car il est déjà dans votre panier.';
        } else {
            foreach ($donneesSession as $key => $value) {
              $_SESSION['panier'][$key][] = $value;
            }
          $verifProduit = TRUE;
        }
      }
    }

    if(isset($_SESSION['panier']) && isset($_GET['suppId_produit']) && !empty($_GET['suppId_produit'])){

      if($_GET['suppId_produit'] === 'panier'){

        unset($_SESSION['panier']);
        $userCart = FALSE;

      } elseif(is_numeric($_GET['suppId_produit'])) {

        $article_a_supprimer = htmlentities($_GET['suppId_produit']);
        $position_article = array_search($article_a_supprimer, $_SESSION['panier']['id_produit']);
        // retourne un chiffre correspondant à l'indice du tableau ARRAY où se trouve cette valeur (1er argument fourni)
        if($position_article !== FALSE){

          foreach ($_SESSION['panier'] as $key => $value) {
            array_splice($_SESSION['panier'][$key], $position_article, 1);
          }

          $msg .= 'Votre article a été supprimé.';

        }
      }
    }

    // Si un code produit est appliqué
    if(isset($_POST['promo'])){

      if(empty($_POST['code_promo'])){
        $msg .= 'Veuillez saisir une code promo.';
      } else {

        $code_promo = htmlentities($_POST['code_promo'], ENT_QUOTES);
        $codeVerif = $reCodeID->verifPresencePromo($code_promo);

        if(!$codeVerif['nbCodeVerif']){
          $msg .= 'Votre code n\'existe pas.';
        } else {

          $id_promo = $codeVerif['donnees']['id_promo'];

          if($this->verifPromoPanier($id_promo)){
            $msg .= 'Code promotion appliqué sur le panier.<br>';
            $codeProduitOk = TRUE;
          } else {
            $msg .= 'Code promotion non trouvé.<br>';
            $codeProduitOk = FALSE;
          }
        }
      }
    }

    if(isset($_SESSION['panier']) && !empty($_SESSION['panier'])){

      // Calcule du prix total sur le panier.
      $prixTotal = 0;

      foreach ($_SESSION['panier']['prix'] as $key => $value) {
        $prixTotal += $_SESSION['panier']['prix'][$key];
      }

      // Calcule de la TVA
      $prixTotal *= 1.20;

      // Application de la promotion sur le total
      if($codeProduitOk){

        $reductionTotal = $reCodeID->RecupValeurCodePromo($code_promo);

        $prixTotalReduit = $prixTotal - $reductionTotal['reduction'];

        $diffTotalPromo = $prixTotal - $prixTotalReduit;

        $pourcentageTotalPromo = round((100*$diffTotalPromo) / $prixTotalReduit, 2);

      }

    }

    // Paiement du Panier
    if(isset($_POST['payer'])){

      // Vérification que les CGV on été acceptés
      if(empty($_POST['cgv'])){

        $msg .= 'Vous devez accepter les conditions général d\'utilisation.';

      } else {

        if(!empty($_POST['reduction'])){

          $code_promo = htmlentities($_POST['reduction']);

          $codeVerif = $reCodeID->verifPresencePromo($code_promo);

          if(!$codeVerif['nbCodeVerif']){

            $msg .= 'Votre code n\'existe pas.';

          } else {

            $id_promo = $codeVerif['donnees']['id_promo'];

            if($this->verifPromoPanier($id_promo)){
              $msg .= 'Code promotion appliqué sur le panier.<br>';
              $codeProduitOk = TRUE;
            } else {
              $msg .= 'Code promotion non trouvé.<br>';
              $codeProduitOk = FALSE;
            }

          }
        }

        if($codeProduitOk){

          $reductionTotal = $reCodeID->RecupValeurCodePromo($code_promo);

          $prixTotalReduit = $prixTotal - $reductionTotal['reduction'];

          $diffTotalPromo = $prixTotal - $prixTotalReduit;

        }

        $total = ($prixTotalReduit != 0) ? $prixTotalReduit : $prixTotal;

        $commande = new modelesCommande();
        $nouvelleCommande = $commande->insertionCommande($total, $_SESSION['membre']['id_membre']);

        $details_commande = new modelesDetails_commande();
        $numeroCommande = $commande->idCommande($_SESSION['membre']['id_membre']);

        // Mise à jour des produits en "Etat" = 1 et insertion d'une commande en détail
        foreach ($_SESSION['panier']['id_produit'] as $value) {

          $details_commande->insertionDetails_commande($numeroCommande['id_commande'], $value);

          $produitPanier->majEtatProduit($value);

        }

        // Récupération de la commande et coordonnées client
        $client = $details_commande->detailsCommandeClient($numeroCommande['id_commande']);

        // Récupération des infos de la commande
        $infos = $details_commande->detailsCommandeInfos($numeroCommande['id_commande']);

        // Récupération des produits de la commande
        $produits = $details_commande->detailsCommandeProduits($numeroCommande['id_commande']);

        // Formatage du mail avec les données
        $header = 'Content-Type: text/html; charset=\"UTF-8\";' . "\r\n";
        $header .= 'FROM: Lokisalle <contact@lokisalle.romanczerkies.fr>' . "\r\n";

        $sujet = "N° de commande Lokisalle : ".$numeroCommande['id_commande'];

        $message = '<div style="width:90%;margin:25px auto;">Bonjour, merci de votre achat sur Lokisalle. Vous retrouverez ci-dessous le récapitulatif de votre commande.<br>';
        $message .= "Vos coordonnées : ".ucfirst($client['prenom'])." ".strtoupper($client['nom'])."<br>";
        $message .= "Votre adresse de facturation : ".$client['adresse'].", ".$client['cp']." ".$client['ville'].".<br>";
        $message .= "Votre commande a été effectuée le ".$infos['date_commande'].".</p>";
        $message .= '<table border="1">
          <thead>
          <tr><th colspan="8">Récapitulatif</th></tr>
          <tr>
            <th>Produit</th>
            <th>Salle</th>
            <th>Photo</th>
            <th>Ville</th>
            <th>Capacité</th>
            <th>Date Arrivée</th>
            <th>Date Départ</th>
            <th>Montant</th>
          </tr>
          </thead>
          <tbody>';
          foreach ($produits as $value) {
            $message .=
            '<tr>
              <td>'. $value['id_produit'] .'</td>
              <td>'. $value['titre'] .'</td>
              <td><img src="'. $value['photo'] .'" alt="'. $value['photo'] .'"></td>
              <td>'. $value['ville'] .'</td>
              <td>'. $value['capacite'] .'</td>
              <td>'. $value['date_arrivee'] .'</td>
              <td>'. $value['date_depart'] .'</td>
              <td>'. $value['prix'] .' € HT</td>
            </tr>';
          }

        $message .= '
        <tr>
          <td colspan="7">Montant total :</td>
          <td colspan="1">'. $infos['montant'] .' € TTC</td>
        </tr>';
          if($prixTotalReduit != 0){
            $message .= '
            <tr>
              <td colspan="8">Sur un motant total de '.$prixTotal.' €, une réduction de '.$diffTotalPromo.' € a été appliqué grâce au code promo : "'.$code_promo.'".</td>
            </tr>';
          }
        // Mettre les différents montant.

        $message .= '
        </tbody>
        </table>';

        $message .= 'Lokisalle '.date('Y').'.
        </div>';

        //echo $sujet;
        //echo $message;

        // Vider le Panier
        unset($_SESSION['panier']);
        $userCart = FALSE;

        // Mail de confirmation
        mail($_SESSION['membre']['email'], $sujet, $message, $headers);

        $msg .= "La vente est validée.<br>Vous avez reçus votre facture par Email à l'adresse suivante : ".$_SESSION['membre']['email'];

      }
    }

    $this->Render('../vues/produit/panier.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'userCart' => $userCart, 'msg' => $msg, 'prixTotal' => $prixTotal, 'prixTotalReduit' => $prixTotalReduit, 'diffTotalPromo' => $diffTotalPromo, 'pourcentageTotalPromo' => $pourcentageTotalPromo));

  }

  // ********** Controle présence d'un code produit dans le panier ********** //
  public function verifPromoPanier($id_promo){

    $reCodeID = new modelesPromotion();
    $produitAssoc = $reCodeID->verifPromoProduit($id_promo);

    $produit = 0;

    foreach ($produitAssoc['produitsAssoc'] as $key => $value) {
      $produit .= array_search($produitAssoc['produitsAssoc'][$key]['id_produit'], $_SESSION['panier']['id_produit']);
    }

    return $produit;

  }

}
