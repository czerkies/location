<?php

class controleursSuper {

  public function render($fichierVue, $variable){

    extract($variable);

    ob_start();
    include($fichierVue);
    $buffer = ob_get_contents();
    ob_end_clean();

    include '../vues/template.php';

  }

}
