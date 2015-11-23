<?php

class modelesSuper {

  public function connect_central_bdd(){

    include_once '../config/bdd.php';

    $donneesDB = connexionPDO();

    try {
      $pdo = new PDO($donneesDB['DSN'], $donneesDB['user'], $donneesDB['mdp'], $donneesDB['options']);
    } catch(PDOException $e) {
      echo 'Connexion échouée : ' . $e->getMessage();
    }

    return $pdo;

  }

}
