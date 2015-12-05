<?php

class modelesMembre extends modelesSuper {

  // ********** Récupérations de ID du membre pour la connexion ********** //
  public function recupMembre($pseudo, $mdp){

    $donnees = $this->connect_central_bdd()->query("SELECT * FROM membre WHERE pseudo = '$pseudo' AND mdp = '$mdp'");

    $connexion = $donnees->fetch(PDO::FETCH_ASSOC);

    return $connexion;

  }

  // ********** Insertion d'un nouveau membre ********** //
  public function insertMembre($pseudo, $mdp, $nom, $prenom, $email, $sexe, $ville, $cp, $adresse){

    $insertion = $this->connect_central_bdd()->prepare("INSERT INTO membre(pseudo, mdp, nom, prenom, email, sexe, ville, cp, adresse) VALUES(:pseudo, :mdp, :nom, :prenom, :email, :sexe, :ville, :cp, :adresse)");

    $insertion->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
    $insertion->bindValue(':mdp', $mdp, PDO::PARAM_STR);
    $insertion->bindValue(':nom', $nom, PDO::PARAM_STR);
    $insertion->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $insertion->bindValue(':email', $email, PDO::PARAM_STR);
    $insertion->bindValue(':sexe', $sexe, PDO::PARAM_STR);
    $insertion->bindValue(':ville', $ville, PDO::PARAM_STR);
    $insertion->bindValue(':cp', $cp, PDO::PARAM_STR);
    $insertion->bindValue(':adresse', $adresse, PDO::PARAM_STR);

    $insertion->execute();

    return $insertion;

  }

  // *********** Récupération Mailadmin ********** //
  public function recupMailAdmin(){

    $emailAdmin = $this->connect_central_bdd()->query("SELECT email FROM membre WHERE statut = 1");

    $email = $emailAdmin->fetch(PDO::FETCH_ASSOC);

    return $email;

  }

  // *********** Vérification Pseudo ********** //
  public function verifPseudo($pseudo){

    $pseudo = $this->connect_central_bdd()->query("SELECT * FROM membre WHERE pseudo = '$pseudo'");

    $nbPseudo = $pseudo->rowCount();

    return $nbPseudo;

  }

  // *********** Vérification Mail ********** //
  public function verifMail($email){

    $mail = $this->connect_central_bdd()->query("SELECT * FROM membre WHERE email = '$email'");

    $nbMail = $mail->rowCount();

    return $nbMail;

  }

  // *********** Vérification Pseudo pour MAJ ********** //
  public function verifPseudoMAJ($pseudo, $id_membre){

    $pseudo = $this->connect_central_bdd()->query("SELECT * FROM membre WHERE pseudo = '$pseudo' AND id_membre != '$id_membre'");

    $nbPseudo = $pseudo->rowCount();

    return $nbPseudo;

  }

  // *********** Vérification Mail pour MAJ ********** //
  public function verifMailMAJ($email, $id_membre){

    $mail = $this->connect_central_bdd()->query("SELECT * FROM membre WHERE email = '$email' AND id_membre != '$id_membre'");

    $nbMailUp = $mail->rowCount();

    return $nbMailUp;

  }

  // *********** Mot de passe perdu ********** //
  public function nouveauMdp($mdp, $email){

    $insertion = $this->connect_central_bdd()->prepare("UPDATE membre SET mdp = :mdp WHERE email = '$email'");
    $insertion->bindValue(':mdp', $mdp, PDO::PARAM_STR);

    $insertion->execute();

  }

  // ********** Mise à jour profil membre ********* //
  public function updateMembre($pseudo, $nom, $prenom, $email, $sexe, $ville, $cp, $adresse, $id_membre){

    $insertion = $this->connect_central_bdd()->prepare("UPDATE membre SET pseudo = :pseudo, email = :email, sexe = :sexe, nom = :nom, prenom = :prenom, ville = :ville, cp = :cp, adresse = :adresse WHERE id_membre = '$id_membre'");

    $insertion->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
    $insertion->bindValue(':nom', $nom, PDO::PARAM_STR);
    $insertion->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $insertion->bindValue(':email', $email, PDO::PARAM_STR);
    $insertion->bindValue(':sexe', $sexe, PDO::PARAM_STR);
    $insertion->bindValue(':ville', $ville, PDO::PARAM_STR);
    $insertion->bindValue(':cp', $cp, PDO::PARAM_STR);
    $insertion->bindValue(':adresse', $adresse, PDO::PARAM_STR);

    $insertion->execute();

  }

}
