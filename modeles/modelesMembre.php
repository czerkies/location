<?php

class modelesMembre extends modelesSuper {

  // ********** Récupérations de ID du membre pour la connexion ********** //
  public function recupMembre($pseudo, $mdp){

    $pdo = $this->connect_central_bdd();

    $connexion = $pdo->query("SELECT * FROM membre WHERE pseudo = '$pseudo' AND mdp = '$mdp'");
    $donnees = $connexion->fetch(PDO::FETCH_ASSOC);

    return $donnees;

  }

  // ********** Insertion d'un nouveau membre ********** //
  public function insertMembre($pseudo, $mdp, $nom, $prenom, $email, $sexe, $ville, $cp, $adresse){

    $select = $this->connect_central_bdd();

    $insertion = $select->prepare("INSERT INTO membre(pseudo, mdp, nom, prenom, email, sexe, ville, cp, adresse) VALUES(:pseudo, :mdp, :nom, :prenom, :email, :sexe, :ville, :cp, :adresse)");

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

    $pdo = $this->connect_central_bdd();

    $mailAdmin = $pdo->query("SELECT email FROM membre WHERE statut = 1");

    return $mailAdmin;

  }

  // *********** Vérification Pseudo ********** //
  public function verifPseudo($pseudo){

    $pdo = $this->connect_central_bdd();

    $pseudo = $pdo->query("SELECT * FROM membre WHERE pseudo = '$pseudo'");

    return $pseudo;

  }

  // *********** Vérification Mail ********** //
  public function verifMail($email){

    $pdo = $this->connect_central_bdd();

    $mail = $pdo->query("SELECT * FROM membre WHERE email = '$email'");

    return $mail;

  }

  // *********** Vérification Pseudo pour MAJ ********** //
  public function verifPseudoMAJ($pseudo, $id_membre){

    $pdo = $this->connect_central_bdd();

    $pseudo = $pdo->query("SELECT * FROM membre WHERE pseudo = '$pseudo' AND id_membre != '$id_membre'");

    return $pseudo;

  }

  // *********** Vérification Mail pour MAJ ********** //
  public function verifMailMAJ($email, $id_membre){

    $pdo = $this->connect_central_bdd();

    $mail = $pdo->query("SELECT * FROM membre WHERE email = '$email' AND id_membre != '$id_membre'");

    return $mail;

  }

  // *********** Mot de passe perdu ********** //
  public function nouveauMdp($mdp, $email){

    $pdo = $this->connect_central_bdd();

    $insertion = $pdo->prepare("UPDATE membre SET mdp = :mdp WHERE email = '$email'");
    $insertion->bindValue(':mdp', $mdp, PDO::PARAM_STR);

    $insertion->execute();

  }

  // ********** Mise à jour profil membre ********* //
  public function updateMembre($pseudo, $nom, $prenom, $email, $sexe, $ville, $cp, $adresse, $id_membre){

    $pdo = $this->connect_central_bdd();

    $insertion = $pdo->prepare("UPDATE membre SET pseudo = :pseudo, email = :email, sexe = :sexe, nom = :nom, prenom = :prenom, ville = :ville, cp = :cp, adresse = :adresse WHERE id_membre = '$id_membre'");

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