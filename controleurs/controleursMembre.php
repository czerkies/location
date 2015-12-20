<?php

class controleursMembre extends controleursSuper {

  // ********** Controle de la connexion d'un membre ********** //
  public function connexionMembre(){

    session_start();
    $title = 'Title';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $connect = '';

    if(!empty($_POST['connexion']) && isset($_POST['connexion'])){

      $pseudo = $_POST['pseudo'];
      $mdp = $_POST['mdp'];

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
        $connect .= "Session ouverte. Bonjour ". $_SESSION['membre']['prenom'];
        $userConnect = TRUE;
        $userConnectAdmin = (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) ? TRUE : FALSE;

      } else {
        $connect .= "Erreur, vos ID sont éronnés.";
      }

    }

    $this->Render('../vues/membre/connexion.php', array('title' => $title, 'connect' => $connect, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }


  // ********** INSCRIPTION NOUVEAU MEMBRE ********** //
  public function ajoutMembre(){

    session_start();
    $title = 'Title';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg = '';

    if(isset($_POST) && !empty($_POST)){

      $controleFormulaire = new controleursFonctions();
      $msg = $controleFormulaire->verifFormMembre($_POST);

      if(empty($msg)){

        foreach ($_POST as $key => $value){
          $_POST[$key] = htmlentities($value, ENT_QUOTES);
        }
        extract($_POST);

        $cont = new modelesMembre();

        $cont->insertMembre($pseudo, $mdp, $nom, $prenom, $email, $sexe, $ville, $cp, $adresse, 0);

      }

    }

    $this->render('../vues/membre/inscription.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg));

  }

  // ********** Déconnexion ********** //
  public function deconnexionMembre(){

    session_start();
    $title = 'Title';

    if(!empty($_GET) && isset($_GET)){
      if(isset($_GET['deconnexion']) == 'true'){
        session_unset();
      } else {
        echo "METTRE UNE REDI";
      }
    }

    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();


    $this->render('../vues/membre/deconnexion.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }

  // ********** Mot de passe perdu ********** //
  public function mdpperduMembre(){

    session_start();
    $title = 'Title';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg = '';

    if(isset($_POST) && !empty($_POST)){

      if(empty($_POST['email'])){
        $msg .= 'Vous devez saisir une adresse email.';
      } else {
        $cont = new modelesMembre();
        if($cont->verifMail($_POST['email'])){
          $msg .= 'Cet email existe n\'existe pas.';
        } else {

          // L'adresse email existe, donc génération d'un nouvau mdp.
          $chaine = "abcdefghijklmnopqrst123456789";
          $mdp_sch = str_shuffle($chaine);
          $mdp = substr($mdp_sch, 0, 12);

          $nouveauMdp = new modelesMembre();
          $nouveauMdp->nouveauMdp($mdp, $_POST['email']);

          $message = 'Voici votre nouveau mot de passe pour accéder à Lokisalle : ' . $mdp;

          mail($_POST['email'], 'Changement de mot de passe',  $message);

        }
      }
    }

    $this->render('../vues/membre/mdpperdu.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg));

  }

  // ********** Contact Admin ********** //
  public function contactMembre(){

    session_start();
    $title = 'Title';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg = '';

    if(isset($_POST) && !empty($_POST)){

      if(empty($_POST['sujet'])){
        $msg .= "Veuillez saisir un Sujet.<br>";
      }
      if(isset($_POST['email'])){
        if(empty($_POST['email'])){
          $msg .= "Veuillez saisir un Email.<br>";
        }
      }
      if(empty($_POST['message'])){
        $msg .= "Veuillez saisir votre message.<br>";
      }

      if(empty($msg)){

        if($userConnect){
          $emailContact = $_SESSION['membre']['email'];
        } else {
          $emailContact = htmlentities($_POST['email']);
        }

        $sujet = htmlentities($_POST['sujet']);
        $message = htmlentities($_POST['message']);

        $message .= '<br>De la part de '.$emailContact;

        $pdo = new modelesMembre();
        $emailAdmin = $pdo->recupMailAdmin();

        mail($emailAdmin['email'], $sujet, $message);
        // CHECK = Demander à cecile sa requete pour mail pour voir si plus simple.
        // CHECK = Ajouter une condition pour l'envoie du message.
      }
    }

    $this->render('../vues/membre/contact.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg));

  }

  // ********** Mise à jour profil membre ********** //
  public function profilMembre(){

    session_start();
    $title = 'Title';
    $msg = '';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $cont = new modelesMembre();
    $idMembre = ($_SESSION['membre']['id_membre']) ? $_SESSION['membre']['id_membre'] : NULL;

    if(isset($_POST) && !empty($_POST)){

      if(empty($_POST['pseudo'])){
        $msg .= "Veuillez saisir un Pseudo.<br>";
      } else {
        if(!$cont->verifPseudoMAJ($_POST['pseudo'], $idMembre)){
          $msg .= "Le Pseudo que vous avez saisis est déjà existant.<br>";
        }
      }
      if(empty($_POST['nom'])){
        $msg .= "Veuillez saisir un Nom.<br>";
      }
      if(empty($_POST['prenom'])){
        $msg .= "Veuillez saisir un Prénom.<br>";
      }
      if(empty($_POST['email'])){
        $msg .= "Veuillez saisir une adresse Email.<br>";
      } else {
        if(!$cont->verifMailMAJ($_POST['email'], $idMembre)){
          $msg .= "L'adresse email que vous avez saisis est déjà existante.<br>";
        }
      }
      if(empty($_POST['sexe'])){
        $msg .= "Veuillez saisir votre Sexe.<br>";
      }
      if(empty($_POST['ville'])){
        $msg .= "Veuillez saisir une Ville.<br>";
      }
      if(empty($_POST['cp'])){
        $msg .= "Veuillez saisir votre Code Postal.<br>";
      }
      if(empty($_POST['adresse'])){
        $msg .= "Veuillez saisir une Adresse.<br>";
      }

      if(empty($msg)){

        foreach ($_POST as $key => $value){
          $_POST[$key] = htmlentities($value, ENT_QUOTES);
        }

        extract($_POST);

        foreach ($_POST as $key => $value) {
          if($key != 'mdp'){
            $_SESSION['membre'][$key] = $value;
          }
        }

        $cont->updateMembre($pseudo, $nom, $prenom, $email, $sexe, $ville, $cp, $adresse, $idMembre);

      }
    }

    // Récupération des commandes par id_membre
    $commandesIdMembres = new modelesCommande();
    $commandes = $commandesIdMembres->commandesMembres($idMembre);

    $this->render('../vues/membre/profil.php', array('title' => $title, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'commandes' => $commandes));

  }

}
