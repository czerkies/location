<?php

function connexionPDO(){

  $host = 'localhost'; // DSN
  $dbname = 'lokisalle'; // Nom de la BDD
  $user = 'root'; // User
  $mdp = 'root'; // MDP
  $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8, lc_time_names = \'fr_FR\''
  ]; // Options

  return array('DSN' => 'mysql:host='.$host.';dbname='.$dbname.';', 'user' => $user, 'mdp' => $mdp, 'options' => $options);

}

// $pdo = new PDO($DSN,$user,$mdp, $options);
