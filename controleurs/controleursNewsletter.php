<?php

class controleursNewsletter extends controleursSuper {

  // ********** Envoi de la newsletter ********** //
  public function envoiNews(){

    session_start();
    $title['name'] = 'Envoyer la Newsletter';
    $title['menu'] = 15;
    $userConnect = FALSE;
    $userConnectAdmin = $this->userConnectAdmin();
    $msg = '';

    $mail = new modelesNewsletter();
    $donneesNews = $mail->recupMailMembre();

    $nbAbonne = $donneesNews['nbMail'];

    $mailAdmin = (isset($_SESSION['membre'])) ? $_SESSION['membre']['email'] : NULL;

    if($_POST){

      if(isset($_POST['expediteur']) && !empty($_POST['expediteur'])
      && isset($_POST['sujet']) && !empty($_POST['sujet'])
      && isset($_POST['message']) && !empty($_POST['message'])){

        if(strlen($_POST['message']) < 10 || strlen($_POST['message']) > 5000){
          $msg .= 'Votre message doit contenir entre 10 et 5000 carractères.<br>';
        }

        if(empty($msg)){

          $sujet = $_POST['sujet'];
          $message = $_POST['message'];

          $mail = '';
          foreach ($donneesNews['mailAbonne'] as $value) {
            $mail .= $value['email'].', ';
          }

          mail($mail, $sujet, $message);

          $msg .= 'Votre mail a bien été envoyé.';
          // $confirmation = TRUE;

        }
      } else {
        $msg .= 'Remplissez correctement tout les champs avant d\'envoyer la newsletter.<br>';
      }
    }


    $this->Render('../vues/newsletter/envoi_newsletter.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'mailAdmin' => $mailAdmin, 'nbAbonne' => $nbAbonne));

  }

  // ********** Inscription Membre à la newsletter ********** //
  public function inscriptionMembre(){

    session_start();
    $title['name'] = 'Inscription à la Newsletter';
    $title['menu'] = 19;
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();
    $affichage = FALSE;

    $msg = '';

    if($userConnect){

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
    }

    $this->Render('../vues/newsletter/newsletter.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'affichage' => $affichage));

  }

}
