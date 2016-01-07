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
    $confirmation = '';

    $mail = new modelesNewsletter();
    $donneesNews = $mail->recupMailMembre();

    $nbAbonne = $donneesNews['nbMail'];

    $mailAdmin = (isset($_SESSION['membre'])) ? $_SESSION['membre']['email'] : NULL;

    if($_POST){

      if(isset($_POST['expediteur']) && !empty($_POST['expediteur'])
      && isset($_POST['sujet']) && !empty($_POST['sujet'])
      && isset($_POST['message']) && !empty($_POST['message'])){

        if(!filter_var($_POST['expediteur'], FILTER_VALIDATE_EMAIL)){
          $msg .= "Votre adresse email est invalide.<br>";
        }
        if(strlen($_POST['message']) < 10 || strlen($_POST['message']) > 5000){
          $msg .= "Votre message doit contenir entre 10 et 5000 carractères.<br>";
        }

        if(empty($msg)){

          $sujet = $_POST['sujet'];
          $message = $_POST['message'];
          $expediteur = $_POST['expediteur'];

          $headers = 'Content-Type: text/html; charset=\"UTF-8\";' . "\r\n";
          $headers .= 'FROM: '.$expediteur.' <'.$expediteur.'>' . "\r\n";

          $mail = '';
          foreach ($donneesNews['mailAbonne'] as $value) {
            $mail .= $value['email'].', ';
          }

          mail($mail, $sujet, $message, $headers);

          $confirmation .= 'Votre mail a bien été envoyé.';

        }
      } else {
        $msg .= 'Remplissez correctement tout les champs avant d\'envoyer la newsletter.<br>';
      }
    }


    $this->Render('../vues/newsletter/envoi_newsletter.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'confirmation' => $confirmation, 'mailAdmin' => $mailAdmin, 'nbAbonne' => $nbAbonne));

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
      $news = new modelesNewsletter();

      if(!$news->verifNewsletter($id_membre)){

        $affichage = TRUE;

        if(isset($_GET['inscription']) && !empty($_GET['inscription']) && $_GET['inscription'] === 'ok'){

          if($news->insertMembre($id_membre)){
            $affichage = FALSE;
          }

        }

      } else {
        $affichage = FALSE;
      }
    }

    if(isset($_GET['inscription']) && !empty($_GET['inscription']) && $_GET['inscription'] === 'del'){

      if($news->suppNews($id_membre)){
        $affichage = TRUE;
      }

    }


    $this->Render('../vues/newsletter/newsletter.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'affichage' => $affichage));

  }

}
