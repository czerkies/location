<?php

class modelesNewsletter extends modelesSuper {

  // *********** Vérification si déjà abonné à la newsletter ********** //
  public function verifNewsletter($id_membre){

    $pdo = $this->connect_central_bdd();
    $verif = $pdo->query("SELECT * FROM newsletter WHERE id_membre = $id_membre");
    return $verif;

  }

  // ********** Insertion d'un nouveau membre ********** //
  public function insertMembre($id_membre){

    $select = $this->connect_central_bdd();
    $insertion = $select->prepare("INSERT INTO newsletter(id_membre) VALUES(:id_membre)");
    $insertion->bindValue(':id_membre', $id_membre, PDO::PARAM_INT);
    $insertion->execute();

  }

  // ********** Récupération nombre abonné ********** //
  //public function nbAbonne(){

    //$pdo = $this->connect_central_bdd();
    //$nbAbonne = $pdo->query("SELECT COUNT(*) FROM newsletter");
    //return $nbAbonne;

  //}

  // ********** Requete pour récupérer adresse mail des membres inscrit ********** //
  public function recupMailMembre(){

    $recupMailNews = $this->connect_central_bdd();
    $mailMembre = $recupMailNews->query("SELECT m.email FROM membre m, newsletter n WHERE m.id_membre = n.id_membre");
    return $mailMembre;

  }

}
