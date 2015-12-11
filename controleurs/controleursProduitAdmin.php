<?php

class controleursProduitAdmin extends controleursSuper {

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

  // ********** Ajouter produit Administrateur ********** //
  public function ajouterProduits(){

    session_start();
    $userConnect = FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

    $msg = '';

    $pdo = new modelesSalles();
    $listePromo = new modelesPromotion();

    if($userConnectAdmin){

      $afficher = (isset($_GET['action']) && ($_GET['action']) == 'afficherProduits') ? TRUE : FALSE;
      $ajouter = (isset($_GET['action']) && ($_GET['action']) == 'ajouterProduits') ? TRUE : FALSE;

      $affichageSalles = $pdo->affichageSalles();

      $affichagePromo = $listePromo->affichageCodePromo();

      if($_POST){

        if(empty($_POST['prix'])){
          $msg .= "Veuillez saisir un prix.<br>";
        }

        if(empty($msg)){

          foreach ($_POST as $key => $value){
            $_POST[$key] = htmlentities($value, ENT_QUOTES);
          }

          extract($_POST);

          $date_arrivee = $_POST['date_arrivee_A'].'-'.$_POST['date_arrivee_M'].'-'.$_POST['date_arrivee_J'];
          $date_arrivee .= ' '.$_POST['date_arrivee_H'].':'.$_POST['date_arrivee_I'];

          $date_depart = $_POST['date_depart_A'].'-'.$_POST['date_depart_M'].'-'.$_POST['date_depart_J'];
          $date_depart .= ' '.$_POST['date_depart_H'].':'.$_POST['date_depart_I'];

          $id_promo = (isset($_POST['id_promo']) && $_POST['id_promo'] === 'NULL') ? NULL : $_POST['id_promo'];

          $nouveauxProduit = new modelesProduit();
          $nouveauxProduit->InsertionProduitAdmin($id_salle, $date_arrivee, $date_depart, $prix, $id_promo);

          $msg .= 'Le produit a bien été ajouté.';

        }

      }

    }

    $this->Render('../vues/produit/gestion_produits.php', array('msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'ajouter' => $ajouter, 'afficher' => $afficher, 'affichageSalles' => $affichageSalles, 'affichagePromo' => $affichagePromo));

  }

  // ********** Afficher les produits Administrateur ********** //
  public function afficherProduits(){

    session_start();
    $userConnect = FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

    $msg = '';
    $affichageProduitsAdmin = '';
    $modifSalle = FALSE;
    $idProduitModif = FALSE;
    $afficher = FALSE;
    $ajouter = FALSE;

    $pdo = new modelesSalles();
    $affichageSalles = $pdo->affichageSalles();

    $listePromo = new modelesPromotion();
    $affichagePromo = $listePromo->affichageCodePromo();

    if($userConnectAdmin){

      $afficher = (isset($_GET['action']) && ($_GET['action']) == 'afficherProduits') ? TRUE : FALSE;
      $ajouter = (isset($_GET['action']) && ($_GET['action']) == 'ajouterProduits') ? TRUE : FALSE;

      $pdo = new modelesProduit();

      // ORDER BY pour desc de date_arrivee, date_depart et prix.
      if(isset($_GET['type']) && isset($_GET['order'])){

        if(isset($_GET['type']) && !empty($_GET['type'] && isset($_GET['order']) && !empty($_GET['order'])
          && $_GET['type'] === 'date_arrivee' || $_GET['type'] === 'date_depart' || $_GET['type'] === 'prix'
          && $_GET['order'] === 'asc' || $_GET['order'] === 'desc')) {

          $type = htmlentities($_GET['type']);
          $order = htmlentities($_GET['order']);
          $affichageProduitsAdmin = $pdo->affichageProduitsAdminTypeOrder($_GET['type'], $_GET['order']);

        } else {
            $affichageProduitsAdmin = $pdo->affichageProduitsAdmin();
        }

      }elseif(isset($_GET['supp'])) {
        $id_produit_supp = $_GET['supp'];
        $suppressionProduitAdmin = $pdo->suppressionProduitAdmin($id_produit_supp);
        $affichageProduitsAdmin = $pdo->affichageProduitsAdmin();
      } else {

        // Modification d'un produit Admin
        $affichageProduitsAdmin = $pdo->affichageProduitsAdmin();

        if(isset($_GET['modif'])) {

          $modifSalle = TRUE;
          $id_produit_modif = $_GET['modif'];
          $idProduitModif = $pdo->recupProduitParID($id_produit_modif);

          if(isset($_POST) && !empty($_POST)){

            if($_POST){

              if(empty($_POST['prix'])){
                $msg .= "Veuillez saisir un prix.<br>";
              }

              if(empty($msg)){

                foreach ($_POST as $key => $value){
                  $_POST[$key] = htmlentities($value, ENT_QUOTES);
                }

                extract($_POST);

                $date_arrivee = $_POST['date_arrivee_A'].'-'.$_POST['date_arrivee_M'].'-'.$_POST['date_arrivee_J'];
                $date_arrivee .= ' '.$_POST['date_arrivee_H'].':'.$_POST['date_arrivee_I'];

                $date_depart = $_POST['date_depart_A'].'-'.$_POST['date_depart_M'].'-'.$_POST['date_depart_J'];
                $date_depart .= ' '.$_POST['date_depart_H'].':'.$_POST['date_depart_I'];

                $id_promo = (isset($_POST['id_promo']) && $_POST['id_promo'] === 'NULL') ? NULL : $_POST['id_promo'];

                $modifProduit = new modelesProduit();
                $modifProduit->updateProduitAdmin($id_salle, $date_arrivee, $date_depart, $prix, $id_promo, $id_produit);

                $msg .= 'Le produit a bien été modifié.';

                $affichageProduitsAdmin = $pdo->affichageProduitsAdmin();

              }

            }
            // Appel de la requete d'insertion si $msg est vide.
          }

        }
      }

    }

    $this->Render('../vues/produit/gestion_produits.php', array('msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'ajouter' => $ajouter, 'afficher' => $afficher, 'affichageProduitsAdmin' => $affichageProduitsAdmin, 'modifSalle' => $modifSalle, 'affichageSalles' => $affichageSalles, 'affichagePromo' => $affichagePromo, 'idProduitModif' => $idProduitModif));

  }

}
