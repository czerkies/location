<?php

class controleursProduit extends controleursSuper {

  public function champs_date($id_select, $id_select_h, $date_bdd){

    $date_bdd_array = date_parse_from_format("j.m.Y.H.i", $date_bdd);

    $select = '<label for="_J">Date</label>
    <select id="_J" name="'.$id_select.'_J">
    <option disabled>Jour</option>';
    for ($i=1;$i<=31;$i++) {
      $select .= '<option value="'.$i.'" ';
      if(isset($_POST[''.$id_select.'_J']) && $_POST[''.$id_select.'_J'] == $i) {$select .= 'selected';}
      elseif (empty($_POST) && $date_bdd != NULL && $date_bdd_array['day'] == $i) {$select .= 'selected';}
      elseif (empty($_POST) && $date_bdd === NULL && date('j') == $i) {$select .= 'selected';}
      $select .= '>'.$i.'</option>';
    }
    $select .= '</select> /
    <select name="'.$id_select.'_M">
    <option disabled>Mois</option>';
    for ($i=1;$i<=12;$i++) {
      $select .= '<option value="'.$i.'" ';
      if(isset($_POST[''.$id_select.'_M']) && $_POST[''.$id_select.'_M'] == $i){$select .= 'selected';}
      elseif (empty($_POST) && $date_bdd != NULL && $date_bdd_array['month'] == $i) {$select .= 'selected';}
      elseif (empty($_POST) && $date_bdd === NULL && date('n') == $i) {$select .= 'selected';}
      $select .= '>'.$i.'</option>';
    }
    $select .= '</select> /
    <select name="'.$id_select.'_A">
    <option disabled>Année</option>';
    for ($i=date('Y');$i <= date('Y')+4;$i++){
      $select .= '<option value="'.$i.'" ';
      if(isset($_POST[''.$id_select.'_A']) && $_POST[''.$id_select.'_A'] == $i){$select .= 'selected';}
      elseif (empty($_POST) && $date_bdd != NULL && $date_bdd_array['year'] == $i) {$select .= 'selected';}
      elseif (empty($_POST) && $date_bdd === NULL && date('Y') == $i) {$select .= 'selected';}
      $select .= '>'.$i.'</option>';
    }
    $select .= '</select>';
    if($id_select_h != NULL){
      $select .= '<label for="_H">Heure</label>
      <select name="'.$id_select_h.'_H">
      <option disabled>Heure</option>';
      for ($i=7;$i<=21;$i++) {
        $select .= '<option value="'.$i.'" ';
        if(isset($_POST[''.$id_select_h.'_H']) && $_POST[''.$id_select_h.'_H'] == $i){$select .= 'selected';}
        elseif (empty($_POST) && $date_bdd != NULL && $date_bdd_array['hour'] == $i) {$select .= 'selected';}
        elseif (empty($_POST) && $date_bdd === NULL && date('H') == $i) {$select .= 'selected';}
        $select .= '>'.$i.'</option>';
      }
      $select .= '>'.$i.'</select> H
      <select name="'.$id_select_h.'_I">
      <option disabled>Minutes</option>';
      for ($i=0;$i<=55;$i+=5) {
        $select .= '<option value="'.$i.'" ';
        if(isset($_POST[''.$id_select_h.'_I']) && $_POST[''.$id_select_h.'_I'] == $i){$select .= 'selected';}
        elseif (empty($_POST) && $date_bdd != NULL && $date_bdd_array['minute'] == $i) {$select .= 'selected';}
        elseif (empty($_POST) && $date_bdd === NULL && date('i') == $i) {$select .= 'selected';}
        $select .= '>'.$i.'</option>';
      }
    $select .= '>'.$i.'</select>';
    }

    return $select;

    // Récupérer la date au format normal en add : _J + _M + _A;
    // S'il y'a un argument heure rentré, récupérer l'heure : _H + _M;

  }

  // ********** Affichage des produits sur la page d'accueil ********** //
  public function produitACC(){

    session_start();
    $userConnect = (isset($_SESSION['membre'])) ? TRUE : FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

    $cont = new modelesProduit();
    $lesProduits = $cont->affichageACC();

    $this->Render('../vues/produit/accueil.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'lesProduits' => $lesProduits));

  }

  // ********** Affichage des produits sur la page Réservations ********** //
  public function produitReservation(){

    session_start();

    $userConnect = (isset($_SESSION['membre'])) ? TRUE : FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

    $cont = new modelesProduit();
    $lesProduits = $cont->affichageReservation();

    $this->Render('../vues/produit/reservation.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'lesProduits' => $lesProduits));

  }

  // ********** Page d'affichage réservation détail d'un produit ********** //
  public function reservationDetails(){

    session_start();
    $userConnect = (isset($_SESSION['membre'])) ? TRUE : FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;
    $form = (!$userConnect) ? FALSE : TRUE;

    $msg = '';

    $id_produit = $_GET['id_produit'];

    $modProduit = new modelesProduit();
    $ProduitIDSalle = $modProduit->recupProduitParID($id_produit);

    $id_salle = $ProduitIDSalle['id_salle'];
    $modAvis = new modelesAvis();
    $affichageAvis = $modAvis->recuperationAvisSalle($id_salle);


    // CHECK Afficher TTC *0.196 et Suggestion avec rapport date et ville
    if($userConnect){

      $id_membre = $_SESSION['membre']['id_membre'];

      $nbAvis = $modAvis->verifAvisProduit($id_salle, $id_membre);
      $form = ($nbAvis != 0) ? FALSE : TRUE;

      if($form){

      if(isset($_POST['avis'])){

          if(empty($_POST['commentaire'])){
            $msg .= "Veuillez saisir un commentaire.<br>";
          }
          if(!isset($_POST['note'])){
            $msg .= "Une erreur est survenue.<br>";
          }

          if(empty($msg)){

            foreach ($_POST as $key => $value){
              $_POST[$key] = htmlentities($value, ENT_QUOTES);
            }

            extract($_POST);

            $id_salle = $ProduitIDSalle['id_salle'];

            $modAvis->insertionAvisParID($id_membre, $id_salle, $commentaire, $note);
            $affichageAvis = $modAvis->recuperationAvisSalle($id_salle);
            $form =  FALSE;

          }
        }
      }
    }

    // Traitement des suggestions par produit
    $suggestions = $modProduit->searchSuggestionProduit($id_produit, $ProduitIDSalle['ville'], $ProduitIDSalle['date_arriveeSQL'], $ProduitIDSalle['date_departSQL']);

    $this->Render('../vues/produit/reservation_details.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'affichageAvis' => $affichageAvis, 'ProduitIDSalle' => $ProduitIDSalle, 'form' => $form, 'suggestions' => $suggestions));

  }

  // ********** Recherche de produit *********** //
  public function rechercheProduit(){

    session_start();
    $userConnect = (isset($_SESSION['membre'])) ? TRUE : FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;
    $produits = FALSE;
    $msg = '';

    $categories = new modelesSalles();
    $listeCategories = $categories->categoriesSalle();

    if(isset($_POST) && !empty($_POST)){

      if(
        isset($_POST['recherche_date_A']) && !empty($_POST['recherche_date_A']) &&
        isset($_POST['recherche_date_M']) && !empty($_POST['recherche_date_M']) &&
        isset($_POST['recherche_date_J']) && !empty($_POST['recherche_date_J']) &&
        isset($_POST['categorie']) && !empty($_POST['categorie']) &&
        isset($_POST['keyword'])) {

          foreach ($_POST as $key => $value){
            $_POST[$key] = htmlentities($value, ENT_QUOTES);
          }

          extract($_POST);

          $date_arrivee = $_POST['recherche_date_A'].'-'.$_POST['recherche_date_M'].'-'.$_POST['recherche_date_J'];

          $keyword = (!empty($_POST['keyword'])) ? $_POST['keyword'] : FALSE;
          $categorie = ($_POST['categorie'] === 'all') ? FALSE : $_POST['categorie'];

          $donnees = new modelesProduit();

          $produits = $donnees->requeteRecherche($date_arrivee, $keyword, $categorie);

        }
    }

    $this->Render('../vues/produit/recherche.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'listeCategories' => $listeCategories, 'produits' => $produits));

  }

}
