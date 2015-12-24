<?php

class controleursFonctions extends controleursSuper {

  // ********** Controle du formulaire de la création de membre ********** //
  public function verifFormMembre($value, $id_membre){

    $msg = '';

    $cont = new modelesMembre();

    if(empty($value['pseudo'])){
      $msg .= "Veuillez saisir un Pseudo.<br>";
    } elseif(strlen($value['pseudo']) < 4 || strlen($value['pseudo']) > 15) {
      $msg .= "Veuillez saisir un Pseudo entre 4 et 15 carractères.<br>";
    } elseif(!$cont->verifPseudo($value['pseudo'], $id_membre)){
      $msg .= "Le Pseudo que vous avez saisis est déjà existant.<br>";
    }
    if(!$id_membre){
      if(empty($value['mdp'])){
        $msg .= "Veuillez saisir un mot de passe.<br>";
      } elseif(strlen($value['mdp']) < 5 || strlen($value['mdp']) > 32) {
        $msg .= "Veuillez saisir un mot de passe entre 5 et 32 carractères.<br>";
      } elseif(!preg_match('#^[^A-Z0-9]*([A-Z0-9])#',$value['mdp'])){ // Controler si existe
        $msg .= "Votre mot de passe doit comporter au moins une majuscule ou un chiffre.<br>";
      }
    }
    if(empty($value['nom'])){
      $msg .= "Veuillez saisir un Nom.<br>";
    } elseif(strlen($value['nom']) < 2 || strlen($value['nom']) > 20) {
      $msg .= "Veuillez saisir un Nom entre 2 et 20 carractères.<br>";
    } elseif(is_numeric($value['nom'])){
      $msg .= "Seul les lettres sont autorisées pour votre Nom.<br>";
    }
    if(empty($value['prenom'])){
      $msg .= "Veuillez saisir un Prénom.<br>";
    } elseif(strlen($value['prenom']) < 2 || strlen($value['prenom']) > 20) {
      $msg .= "Veuillez saisir un Prénom entre 2 et 20 carractères.<br>";
    } elseif(is_numeric($value['prenom'])){
      $msg .= "Seul les lettres sont autorisées pour votre Prénom.<br>";
    }
    if(empty($value['email'])){
      $msg .= "Veuillez saisir une adresse Email.<br>";
    } elseif(!filter_var($value['email'], FILTER_VALIDATE_EMAIL)) {
      $msg .= "Votre email est invalide.<br>";
    } elseif(strlen($value['email']) > 30){
      $msg .= "Votre email ne doit pas dépasser 30 carractères.<br>";
    } elseif(!$cont->verifMail($value['email'], $id_membre)){
      $msg .= "L'adresse email que vous avez saisis est déjà existante.<br>";
    }
    if(empty($value['sexe'])){
      $msg .= "Veuillez saisir votre Sexe.<br>";
    }
    if(empty($value['ville'])){
      $msg .= "Veuillez saisir une ville.<br>";
    } elseif(is_numeric($value['ville'])){
      $msg .= "Votre ville ne doit comporter aucun carractères spéciaux.<br>";
    } elseif(strlen($value['ville']) < 2 || strlen($value['ville']) > 30){
      $msg .= "Veuillez saisir une ville entre 2 et 30 carractères.<br>";
    }
    if(empty($value['cp'])){
      $msg .= "Veuillez saisir votre Code Postal.<br>";
    } elseif(strlen($value['cp']) != 5 || !is_numeric($value['cp'])) {
      $msg .= "Votre code postal doit contenir 5 chiffres.<br>";
    }
    if(empty($value['adresse'])){
      $msg .= "Veuillez saisir une Adresse.<br>";
    } elseif(strlen($value['adresse']) < 10 || strlen($value['adresse']) > 30){
      $msg .= "Veuillez saisir une adresse entre 10 et 30 carractères.<br>";
    }

    return $msg;

  }

  // ********** Fonction pour générer un champs de type "date" ********** //
  public function champs_date($id_select, $id_select_h, $date_bdd){

    $date_bdd_array = date_parse_from_format("j.m.Y.H.i", $date_bdd);

    $select = '<label for="_J">Date</label>
    <select id="_J" name="'.$id_select.'_J">
    <option disabled>Jour</option>';
    for ($i=1;$i<=31;$i++) {
      if($i < 10){
        $select .= '<option value="0'.$i.'" ';
      } else {
        $select .= '<option value="'.$i.'" ';
      }
      if(isset($_POST[''.$id_select.'_J']) && $_POST[''.$id_select.'_J'] == $i) {$select .= 'selected';}
      elseif (empty($_POST) && $date_bdd != NULL && $date_bdd_array['day'] == $i) {$select .= 'selected';}
      elseif (empty($_POST) && $date_bdd === NULL && date('j') == $i) {$select .= 'selected';}
      $select .= '>'.$i.'</option>';
    }
    $select .= '</select> /
    <select name="'.$id_select.'_M">
    <option disabled>Mois</option>';
    for ($i=1;$i<=12;$i++) {
      if($i < 10){
        $select .= '<option value="0'.$i.'" ';
      } else {
        $select .= '<option value="'.$i.'" ';
      }
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

  // ********** Fonction pour une page de type "404" ********** //
  public function urlIncorrect(){

    session_start();
    $title = 'Page non trouvée';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $this->Render('../vues/erreur/page_introuvable.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }

}
