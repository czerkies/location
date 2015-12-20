<?php

class controleursNewsletter extends controleursSuper {

  // ********** Envoi de la newsletter ********** //
  public function envoiNews(){

    session_start();
    $title = 'Title';
    $userConnect = FALSE;
    $userConnectAdmin = $this->userConnectAdmin();
    $msg = '';

    $mail = new modelesNewsletter();
    $donneesNews = $mail->recupMailMembre();

    $nbAbonne = $donneesNews['nbMail'];

    $mailAdmin = $_SESSION['membre']['email'];

    if(isset($_POST) && !empty($_POST)){

      $sujet = $_POST['sujet'];
      $message = $_POST['message'];

      $mail = '';
      foreach ($donneesNews['mailAbonne'] as $value) {
        $mail .= $value['email'].', ';
      }
      mail($mail, $sujet, $message);
      $msg .= 'Votre mail a bien été envoyé.';
    }


    $this->Render('../vues/newsletter/envoi_newsletter.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'mailAdmin' => $mailAdmin, 'nbAbonne' => $nbAbonne));

  }

  // ********** Inscription Membre à la newsletter ********** //
  public function inscriptionMembre(){

    session_start();
    $title = 'Title';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();
    $affichage = FALSE;


    $msg = '';

    $id_membre = $_SESSION['membre']['id_membre'];

    $cont = new modelesNewsletter();

    if($cont->verifNewsletter($id_membre)){

      $affichage = TRUE;

      if(isset($_GET['inscription']) && !empty($_GET['inscription']) && $_GET['inscription'] === 'ok'){

        $pdo = new modelesNewsletter();
        $insertion = $pdo->insertMembre($id_membre);
        $affichage = FALSE;

      }

    } else {
      $affichage = FALSE;
    }

    $this->Render('../vues/newsletter/newsletter.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'affichage' => $affichage));

  }

}
