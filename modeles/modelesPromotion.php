<?php

class modelesPromotion extends modelesSuper {

  // ********** Affichage des promotions Administrateur ********** //
  public function affichageCodePromo(){

    $pdo = $this->connect_central_bdd();
    $promos = $pdo->query("SELECT * FROM promotion");
    return $promos;

  }

  // ********** Ajout d'un code promo Administrateur ********** //
  public function ajouterCodePromo($code_promo, $reduction){

    $select = $this->connect_central_bdd();

    $insertion = $select->prepare("INSERT INTO promotion(code_promo, reduction) VALUES(:code_promo, :reduction)");

    $insertion->bindValue(':code_promo', $code_promo, PDO::PARAM_STR);
    $insertion->bindValue(':reduction', $reduction, PDO::PARAM_STR);

    $insertion->execute();

  }


  // ********** Suppression code promotion par ID Administrateur ********** //
  public function SuppPromo($id_promo){

    $del_sql = $this->connect_central_bdd();
    $del = $del_sql->prepare("DELETE FROM promotion WHERE id_promo = $id_promo");
    $del->execute();

  }

  // ********** Vérification pour éviter doublon de code promo ********** //
  public function verifPresencePromo($code_promo){

    $pdo = $this->connect_central_bdd();
    $codeVerif = $pdo->query("SELECT id_promo FROM promotion WHERE code_promo = '$code_promo'");
    return $codeVerif;

  }

  // ********** Vérification code existant pour produit ********** //
  public function VerifPromoProduit($id_promo){

    $pdo = $this->connect_central_bdd();
    //$produitAssoc = $pdo->query("SELECT id_produit, id_promo FROM produit WHERE id_promo IN(SELECT id_promo FROM promotion WHERE id_promo = $id_promo)");
    $produitAssoc = $pdo->query("SELECT p.id_produit, p.id_promo, o.id_promo FROM produit p, promotion o WHERE o.id_promo = p.id_promo AND o.id_promo = $id_promo");
    // $produitAssoc = $pdo->query("SELECT id_promo FROM promotion WHERE id_promo IN(SELECT id_promo FROM produit WHERE id_promo = $id_promo)");
    return $produitAssoc;

  }

  // ********** Récupération valeur de réduction code promo panier ********* //
  public function RecupValeurCodePromo($codePromo){

    $pdo = $this->connect_central_bdd();
    $codePromo = $pdo->query("SELECT reduction FROM promotion WHERE code_promo = '$codePromo'");
    return $codePromo;

  }

}
