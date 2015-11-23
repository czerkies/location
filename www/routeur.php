<?php

function autoloader($class){

  if(strpos($class, 'controleurs') !== FALSE){
    if(file_exists('../controleurs/'.$class.'.php')){
      include_once '../controleurs/'.$class.'.php';
    }
  }

  if(strpos($class, 'modeles') !== FALSE){
    if(file_exists('../modeles/'.$class.'.php')){
      include_once '../modeles/'.$class.'.php';
    }
  }

}

spl_autoload_register('autoloader');


$controleur = $_GET['controleurs'];
$action = $_GET['action'];


if(file_exists('../controleurs/controleurs'.ucfirst($controleur).'.php')){
  include('../controleurs/controleurs'.ucfirst($controleur).'.php');
    if(method_exists('controleurs'.ucfirst($controleur), $action)){
      $classe = 'controleurs'.ucfirst($controleur);
      $instance = new $classe();
      $instance->$action();
    }
}
