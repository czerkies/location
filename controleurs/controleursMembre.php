<?php

class controleursMembre extends controleursSuper {

  // ********** Controle de la connexion d'un membre ********** //
  public function connexionMembre(){

    session_start();
    $title['name'] = 'Connexion';
    $title['menu'] = 4;
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg = '';

    if(isset($_POST['connexion'])){

      if(isset($_POST['pseudo']) && isset($_POST['mdp'])){

        if(empty($_POST['pseudo'])){
          $msg .= 'Veuillez saisir un pseudo.<br>';
        }
        if(empty($_POST['mdp'])){
          $msg .= 'Veuillez saisir un mot de passe.<br>';
        }

        if(empty($msg)){

          $pseudo = htmlspecialchars($_POST['pseudo'], ENT_QUOTES);
          $mdp = htmlspecialchars($_POST['mdp'], ENT_QUOTES);

          $connexion = new modelesMembre();
          $data = $connexion->recupMembre($pseudo, $mdp);

          if($data['pseudo'] === $pseudo && $data['mdp'] === $mdp){
            foreach ($data as $key => $value) {
              if($key != 'mdp'){
                $_SESSION['membre'][$key] = $value;
              }
              if(isset($_POST['sauv_session'])){
                setCookie('pseudo', $pseudo, time()+(365*24*3600));
              }
            }

            $userConnect = $this->userConnect();
            $userConnectAdmin = $this->userConnectAdmin();

          } else {
            $msg .= "Erreur, vos ID sont éronnés.<br>";
          }
        }

      } else {
        $msg .= "Une erreur est survenue lors de votre demande.<br>";
      }
    }

    $this->Render('../vues/membre/connexion.php', array('title' => $title, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }

  // ********** INSCRIPTION NOUVEAU MEMBRE ********** //
  public function ajoutMembre(){

    session_start();
    $title['name'] = 'Inscription';
    $title['menu'] = 41;
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg = '';
    $confirmation = FALSE;

    if($_POST){

      if(isset($_POST['pseudo']) && isset($_POST['mdp'])
      && isset($_POST['nom']) && isset($_POST['prenom'])
      && isset($_POST['email']) && ((isset($_POST['sexe'])
      && ($_POST['sexe'] === 'm' || $_POST['sexe'] === 'f'))
      && isset($_POST['ville']) && isset($_POST['cp']))
      && isset($_POST['adresse'])){

        $controleFormulaire = new controleursFonctions();
        $msg = $controleFormulaire->verifFormMembre($_POST, NULL);

        if(empty($msg)){

          foreach ($_POST as $key => $value){
            $_POST[$key] = htmlspecialchars($value, ENT_QUOTES);
          }

          extract($_POST);

          $cont = new modelesMembre();

          if($cont->insertMembre($pseudo, $mdp, $nom, $prenom, $email, $sexe, $ville, $cp, $adresse, 0)){

            $confirmation = TRUE;
            $connexion = new modelesMembre();
            $data = $connexion->recupMembre($pseudo, $mdp);

            if($data['pseudo'] === $pseudo && $data['mdp'] === $mdp){
              foreach ($data as $key => $value) {
                if($key != 'mdp'){
                  $_SESSION['membre'][$key] = $value;
                }
              }

              $userConnect = $this->userConnect();
              $userConnectAdmin = $this->userConnectAdmin();

              $headers = 'Content-Type: text/html; charset=\"UTF-8\";' . "\r\n";
              $headers .= 'FROM: LokiSalle <contact@lokisalle.fr>' . "\r\n";

              $sujet = "Bienvenue chez LokiSalle ".ucfirst($nom)." ".$prenom.".";

              $message = "Bienvenue chez Lokisalle.<br>
              Vous pouvez désormais commander vos salle dans notre catalogue à la page suivante : <a href=\"http://loki-salle.romanczerkies.fr/nos-salles/\">Nos Salles</a>";

              mail($email, $sujet, $message, $headers);

            }
          }
        }
      } else {
        $msg .= 'Une erreur est survenue lors de votre demande.<br>';
      }
    }

    $this->render('../vues/membre/inscription.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'confirmation' => $confirmation));

  }

  // ********** Déconnexion ********** //
  public function deconnexionMembre(){

    session_start();
    $title['name'] = 'Déconnexion';
    $title['menu'] = 4;

    if(isset($_GET['deconnexion']) && !empty($_GET['deconnexion']) && $_GET['deconnexion'] === 'oui'){
      session_unset();
    }

    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();


    $this->render('../vues/membre/deconnexion.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }

  // ********** Mot de passe perdu ********** //
  public function mdpperduMembre(){

    session_start();
    $title['name'] = 'Mot de passe perdu';
    $title['menu'] = 4;
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg = '';
    $confirmation = FALSE;

    if($_POST){

      if(isset($_POST['email'])){

        if(empty($_POST['email'])){
          $msg .= 'Vous devez saisir une adresse email.';
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
          $msg .= "Votre adresse email est invalide.<br>";
        } else {
          $cont = new modelesMembre();
          if($cont->verifMail($_POST['email'], NULL)){
            $msg .= 'Cet email existe n\'existe pas.';
          } else {

            $confirmation = TRUE;

            // L'adresse email existe, donc génération d'un nouvau mdp.
            $chaine = "abcdefghijklmnopqrst123456789";
            $mdp_sch = str_shuffle($chaine);
            $mdp = substr($mdp_sch, 0, 12);

            $headers = 'Content-Type: text/html; charset=\"UTF-8\";' . "\r\n";
            $headers .= 'FROM: LokiSalle - Nouveau mot de passe  <motdepasse@lokisalle.fr>' . "\r\n";

            $nouveauMdp = new modelesMembre();
            $nouveauMdp->nouveauMdp($mdp, $_POST['email']);

            $message = 'Voici votre nouveau mot de passe pour accéder à Lokisalle : ' . $mdp;

            mail($_POST['email'], 'Changement de mot de passe',  $message, $headers);

          }
        }
      } else {
        $msg .= "Une erreur est survenue lors de votre demande.<br>";
      }
    }

    $this->render('../vues/membre/mdpperdu.php', array('title' => $title, 'confirmation' => $confirmation, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg));

  }

  // ********** Contact Admin ********** //
  public function contactMembre(){

    session_start();
    $title['name'] = 'Contacter Lokisalle';
    $title['menu'] = 20;
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg = '';
    $confirmation = FALSE;

    if($_POST){

      if(isset($_POST['sujet']) && isset($_POST['message'])){

        if(empty($_POST['sujet'])){
          $msg .= "Veuillez saisir un Sujet.<br>";
        } elseif(strlen($_POST['sujet']) < 4 || strlen($_POST['sujet']) > 30){
            $msg .= "Votre sujet doit comporter entre 4 et 30 caractères.<br>";
        }

        if(!($userConnect || $userConnectAdmin)){

          if(isset($_POST['email'])){

            if(empty($_POST['email'])){
              $msg .= "Veuillez saisir un email.<br>";
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
              $msg .= "Votre email est invalide.<br>";
            }

          } else {
            $msg .= 'Une erreur est survenue.<br>';
          }
        }

        if(empty($_POST['message'])){
          $msg .= "Veuillez saisir votre message.<br>";
        } elseif(strlen($_POST['message']) < 10 || strlen($_POST['message']) > 4000){
          $msg .= "Votre message doit comporter entre 10 et 4000 caractères.<br>";
        }

        if(empty($msg)){

          if($userConnect){
            $emailContact = $_SESSION['membre']['email'];
            $coordonnees = $_SESSION['membre']['nom'].' '.$_SESSION['membre']['prenom'];
          } else {
            $emailContact = htmlentities($_POST['email']);
            $coordonnees = 'Visiteur';
          }

          $header = 'Content-Type: text/html; charset=\"UTF-8\";' . "\r\n";
          $header .= 'FROM: '.$coordonnees.' <'.$emailContact.'>' . "\r\n";

          $sujet = htmlentities($_POST['sujet']);
          $message = htmlentities($_POST['message']);

          $message .= '<br><br>De la part de '.$emailContact;

          $pdo = new modelesMembre();
          $emailAdmin = $pdo->recupMailAdmin();

          mail($emailAdmin['email'], $sujet, $message, $header);

          $confirmation = TRUE;

        }
      } else {
        $msg .= 'Une erreur est survenue lors de votre demande.<br>';
      }
    }

    $this->render('../vues/membre/contact.php', array('title' => $title, 'confirmation' => $confirmation, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg));

  }

  // ********** Mise à jour profil membre ********** //
  public function profilMembre(){

    session_start();
    $title['name'] = 'Mon profil';
    $title['menu'] = 5;
    $msg = '';
    $confirmation = FALSE;
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();
    $commandes = '';

    $cont = new modelesMembre();
    $idMembre = (isset($_SESSION['membre']['id_membre'])) ? $_SESSION['membre']['id_membre'] : NULL;

    if($_POST){

      if(isset($_POST['pseudo']) && isset($_POST['nom'])
      && isset($_POST['prenom']) && isset($_POST['email'])
      && ((isset($_POST['sexe']) && ($_POST['sexe'] === 'm' || $_POST['sexe'] === 'f'))
      && isset($_POST['ville']) && isset($_POST['cp']))
      && isset($_POST['adresse']) && isset($_POST['mdp'])){

        $controleFormulaire = new controleursFonctions();
        $msg = $controleFormulaire->verifFormMembre($_POST, $idMembre);

        if(empty($msg)){

          foreach ($_POST as $key => $value){
            $_POST[$key] = htmlspecialchars($value, ENT_QUOTES);
          }

          extract($_POST);

          foreach ($_POST as $key => $value) {
            if($key != 'mdp'){
              $_SESSION['membre'][$key] = $value;
            }
          }

          $mdp = (!empty($_POST['mdp'])) ? htmlspecialchars($_POST['mdp']) : NULL;

          if($cont->updateMembre($pseudo, $mdp, $nom, $prenom, $email, $sexe, $ville, $cp, $adresse, $idMembre)){
            $confirmation = TRUE;
          }

        }
      } else {
        $msg .= "Une erreur est survenue lors de votre demande.<br>";
      }
    }
    if($userConnect){

      // Récupération des commandes par id_membre
      $commandesIdMembres = new modelesCommande();
      $commandes = $commandesIdMembres->commandesMembres($idMembre);

    }

    $this->render('../vues/membre/profil.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'confirmation' => $confirmation, 'commandes' => $commandes));

  }

}
