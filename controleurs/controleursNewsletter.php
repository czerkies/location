<?php

class controleursNewsletter extends controleursSuper {

  // ********** Envoi de la newsletter ********** //
  public function envoiNews(){

    session_start();
    $userConnect = (isset($_SESSION['membre'])) ? TRUE : FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

    $msg = '';

    $userConnectAdmin = ($_SESSION && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

    if($userConnectAdmin){

      $mail = new modelesNewsletter();
      $donneesNews = $mail->recupMailMembre();

      $nbAbonne = $donneesNews['nbMail'];

      $mailAdmin = $_SESSION['membre']['email'];

      if($_POST){

        $sujet = $_POST['sujet'];
        $message = $_POST['message'];

        $mail = '';
        foreach ($donneesNews['mailAbonne'] as $value) {
          $mail .= $value['email'].', ';
        }
        mail($mail, $sujet, $message);
        $msg .= 'Votre mail a bien été envoyé.';
      }
    }


    $this->Render('../vues/newsletter/envoi_newsletter.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'mailAdmin' => $mailAdmin, 'nbAbonne' => $nbAbonne));

  }

  // ********** Inscription Membre à la newsletter ********** //
  public function inscriptionMembre(){

    session_start();
    $userConnect = (isset($_SESSION['membre'])) ? TRUE : FALSE;
    $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;
    $affichage = FALSE;


    $msg = '';

    if($userConnect){

      $id_membre = $_SESSION['membre']['id_membre'];

      $cont = new modelesNewsletter();
      $verifNews = $cont->verifNewsletter($id_membre);

      if($verifNews == 0){

        $affichage = TRUE;

        if(isset($_GET['inscription']) && $_GET['inscription'] == 'ok'){

          $pdo = new modelesNewsletter();
          $insertion = $pdo->insertMembre($id_membre);
          $affichage = FALSE;

        }

      } else {
        $affichage = FALSE;
      }
    }

    $this->Render('../vues/newsletter/newsletter.php', array('userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'affichage' => $affichage));

  }

}
