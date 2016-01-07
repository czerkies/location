<?php

class modelesMembre extends modelesSuper {

  // ********** Récupérations de ID du membre pour la connexion ********** //
  public function recupMembre($pseudo, $mdp){

    $donnees = $this->connect_central_bdd()->query("SELECT * FROM membre WHERE pseudo = '$pseudo' AND mdp = '$mdp'");

    $connexion = $donnees->fetch(PDO::FETCH_ASSOC);

    return $connexion;

  }

  // ********** Insertion d'un nouveau membre ********** //
  public function insertMembre($pseudo, $mdp, $nom, $prenom, $email, $sexe, $ville, $cp, $adresse, $statut){

    $insertion = $this->connect_central_bdd()->prepare("INSERT INTO membre(pseudo, mdp, nom, prenom, email, sexe, ville, cp, adresse, statut) VALUES(:pseudo, :mdp, :nom, :prenom, :email, :sexe, :ville, :cp, :adresse, :statut)");

    $insertion->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
    $insertion->bindValue(':mdp', $mdp, PDO::PARAM_STR);
    $insertion->bindValue(':nom', $nom, PDO::PARAM_STR);
    $insertion->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $insertion->bindValue(':email', $email, PDO::PARAM_STR);
    $insertion->bindValue(':sexe', $sexe, PDO::PARAM_STR);
    $insertion->bindValue(':ville', $ville, PDO::PARAM_STR);
    $insertion->bindValue(':cp', $cp, PDO::PARAM_STR);
    $insertion->bindValue(':adresse', $adresse, PDO::PARAM_STR);
    $insertion->bindValue(':statut', $statut, PDO::PARAM_INT);

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
  public function verifPseudo($pseudo, $id_membre){

    $req = "SELECT id_membre FROM membre WHERE pseudo = '$pseudo'";

    if($id_membre){
      $req .= " AND id_membre != '$id_membre'";
    }

    $donnees = $this->connect_central_bdd()->query($req);

    return $nbPseudo = ($donnees->rowCount() != 0) ? FALSE : TRUE;

  }

  // *********** Vérification Mail ********** //
  public function verifMail($email, $id_membre){

    $req = "SELECT id_membre FROM membre WHERE email = '$email'";

    if($id_membre){
      $req .= " AND id_membre != '$id_membre'";
    }

    $donnees = $this->connect_central_bdd()->query($req);

    return $nbMail = ($donnees->rowCount() != 0) ? FALSE : TRUE;

  }

  // *********** Mot de passe perdu ********** //
  public function nouveauMdp($mdp, $email){

    $insertion = $this->connect_central_bdd()->prepare("UPDATE membre SET mdp = :mdp WHERE email = '$email'");
    $insertion->bindValue(':mdp', $mdp, PDO::PARAM_STR);

    $insertion->execute();

  }

  // ********** Mise à jour profil membre ********* //
  public function updateMembre($pseudo, $mdp, $nom, $prenom, $email, $sexe, $ville, $cp, $adresse, $id_membre){

    if($mdp === NULL){

      $req = "UPDATE membre SET pseudo = :pseudo, email = :email, sexe = :sexe, nom = :nom, prenom = :prenom, ville = :ville, cp = :cp, adresse = :adresse WHERE id_membre = '$id_membre'";

    } else {

      $req = "UPDATE membre SET pseudo = :pseudo, mdp = :mdp, email = :email, sexe = :sexe, nom = :nom, prenom = :prenom, ville = :ville, cp = :cp, adresse = :adresse WHERE id_membre = '$id_membre'";

    }

    $insertion = $this->connect_central_bdd()->prepare($req);

    $insertion->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
    $insertion->bindValue(':nom', $nom, PDO::PARAM_STR);
    $insertion->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $insertion->bindValue(':email', $email, PDO::PARAM_STR);
    $insertion->bindValue(':sexe', $sexe, PDO::PARAM_STR);
    $insertion->bindValue(':ville', $ville, PDO::PARAM_STR);
    $insertion->bindValue(':cp', $cp, PDO::PARAM_STR);
    $insertion->bindValue(':adresse', $adresse, PDO::PARAM_STR);

    if($mdp != NULL){
      $insertion->bindValue(':mdp', $mdp, PDO::PARAM_STR);
    }

    return $insertion->execute();

  }

  // *********** Récupération liste membres Admin ********** //
  public function lesMembresAdmin(){

    $donnees = $this->connect_central_bdd()->query("SELECT * FROM membre");

    $listeMembres = $donnees->fetchAll(PDO::FETCH_ASSOC);

    return $listeMembres;

  }

  // ********** Supprésion d'un membre Admin ********** //
  public function supprimerMembreAdmin($id_membre){

    $donnees = $this->connect_central_bdd()->query("SELECT * FROM membre WHERE statut = 0 AND id_membre = $id_membre");

    $suppMembre = ($donnees->rowCount() != 0) ? TRUE : FALSE;

    // Si aucun membre admin n'est trouvés alors la suppréssion sera effectué.
    if($suppMembre){

      $suppressionMembre = $this->connect_central_bdd()->prepare("DELETE FROM membre WHERE statut = 0 AND id_membre = $id_membre");

      $suppressionMembre->execute();

    }

    return $suppMembre;

  }

  // ********** Accord supprésion si un membre est rattaché à une commande ********* //
  public function verifMembreCommande($id_membre){

    $donnees = modelesSuper::connect_central_bdd()->query("SELECT id_commande FROM commande WHERE id_membre = $id_membre");

    return $membresCommande = $donnees->rowCount();

  }

}
