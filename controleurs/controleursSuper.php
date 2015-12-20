<?php

class controleursSuper {

  public function render($fichierVue, $variable){

    // Définition de la racine du site
    define('RACINE_SITE', '/lokisalle/www/');
    define('RACINE_SERVER', $_SERVER['DOCUMENT_ROOT']);

    extract($variable);

    ob_start();
    include($fichierVue);
    $buffer = ob_get_contents();
    ob_end_clean();

    include '../vues/template.php';

  }

  public function userConnect(){

    return $userConnect = (isset($_SESSION['membre'])) ? TRUE : FALSE;

  }

  public function userConnectAdmin(){

    return $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

  }

}
