<?php

class controleursFooter extends controleursSuper {

  // ********** Mentions Légales ********** //
  public function mentionsLegales(){

    session_start();
    $title['name'] = 'Mentions Légales';
    $title['menu'] = 16;
    $userConnect = $this->userConnectAdmin();
    $userConnectAdmin = $this->userConnectAdmin();

    $this->Render('../vues/footer/mentions-legales.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }

  // ********** Conditions générales de ventes ********** //
  public function cgv(){

    session_start();
    $title['name'] = 'Conditions générales de ventes';
    $title['menu'] = 17;
    $userConnect = $this->userConnectAdmin();
    $userConnectAdmin = $this->userConnectAdmin();

    $this->Render('../vues/footer/cgv.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }

  // ********** Plan du site ********** //
  public function planDuSite(){

    session_start();
    $title['name'] = 'Conditions générales de ventes';
    $title['menu'] = 18;
    $userConnect = $this->userConnectAdmin();
    $userConnectAdmin = $this->userConnectAdmin();

    $this->Render('../vues/footer/plan-du-site.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }

}
