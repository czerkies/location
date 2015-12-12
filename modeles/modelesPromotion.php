<?php

class modelesPromotion extends modelesSuper {

  // ********** Affichage des promotions Administrateur ********** //
  public function affichageCodePromo(){

    $promos = $this->connect_central_bdd()->query("SELECT * FROM promotion");

    $affichagePromosAdmin = $promos->fetchAll(PDO::FETCH_ASSOC);

    return $affichagePromosAdmin;

  }

  // ********** Ajout d'un code promo Administrateur ********** //
  public function ajouterCodePromo($code_promo, $reduction){


    $insertion = $this->connect_central_bdd()->prepare("INSERT INTO promotion(code_promo, reduction) VALUES(:code_promo, :reduction)");

    $insertion->bindValue(':code_promo', $code_promo, PDO::PARAM_STR);
    $insertion->bindValue(':reduction', $reduction, PDO::PARAM_STR);

    $insertion->execute();

  }


  // ********** Suppression code promotion par ID Administrateur ********** //
  public function SuppPromo($id_promo){

    $del = $this->connect_central_bdd()->prepare("DELETE FROM promotion WHERE id_promo = $id_promo");

    $del->execute();

  }

  // ********** Vérification pour éviter doublon de code promo ********** //
  public function verifPresencePromo($code_promo){

    $donnees = $this->connect_central_bdd()->query("SELECT id_promo FROM promotion WHERE code_promo = '$code_promo'");

    $codeVerif = ($donnees->rowCount() === 0) ? TRUE : FALSE;

    return $codeVerif;

  }

  // ********** Vérification code existant pour produit ********** //
  public function VerifPromoProduit($id_promo){

    $donnees = $this->connect_central_bdd()->query("SELECT p.id_produit, p.id_promo, o.id_promo
      FROM produit p, promotion o
      WHERE o.id_promo = p.id_promo
      AND o.id_promo = $id_promo");

    $produitAssoc = ($donnees->rowCount() === 0) ? TRUE : FALSE;

    return $produitAssoc;

  }

  // ********** Récupération valeur de réduction code promo panier ********* //
  public function recupValeurCodePromo($codePromo){

    $codePromo = $this->connect_central_bdd()->query("SELECT reduction FROM promotion WHERE code_promo = '$codePromo'");

    $valeurPromo = $codePromo->fetch(PDO::FETCH_ASSOC);

    return $valeurPromo;

  }

}
