<?php

namespace src\Managers;

    use PDO;

    use src\Entities\Compte;

    use src\Entities\Produit;
    use src\Entities\Arme;
    use src\Entities\Armure;
    use src\Entities\Grade;

Class BoutiqueManager {
    private $db;

    public function __construct(PDO $db){
        $this->db = $db;
    }

    // CREATE
    public function add($oData, $idProduct){
        if($oData instanceof Grade){
            $request = "INSERT INTO grade (id_produit, duree) VALUES (:id, :duree)";
            $param = [
                "id" => $idProduct,
                "duree" => $oData->getDuree()
            ];
        }else if($oData instanceof Arme){
            $request = "INSERT INTO arme (id_produit, degats, durabilite) VALUES (:id, :degat, :durabilite)";
            $param = [
                "id" => $idProduct,
                "degat" => $oData->getDegat(),
                "durabilite" => $oData->getDurabilite()
            ];
        }else if($oData instanceof Armure){
            $request = "INSERT INTO armure (id_produit, protection, durabilite) VALUES (:id, :protection, :durabilite)";
            $param = [
                "id" => $idProduct,
                "protection" => $oData->getProtection(),
                "durabilite" => $oData->getDurabilite()
            ];
        }else if($oData instanceof Produit){
            $request = "INSERT INTO produit (nom, description, prix, image) VALUES (:nom, :desc, :price, :images)";
            $param = [
                "nom" => $oData->getNom(),
                "desc" => $oData->getDesc(),
                "price" => $oData->getPrix(),
                "images" => $oData->getImage()
            ];
        }else if($oData instanceof Compte){
            $request = "INSERT INTO Compte(pseudo, email, pwd_hash) VALUES (:pseudo , :email , :pwd)";
            $param = [
                "pseudo" => $oData->getPseudo(),
                "email"  => $oData->getEmail(),
                "pwd"    => $oData->getMotPasse()
            ];
        } else {
            return "ERREUR AJOUT !";
        }
        $stmt = $this->db->prepare($request);
        $stmt->execute($param);

        return $this->db->lastInsertId();
    }

    // AFFICHER
    public function getAll(){
        $produitAll = [];
        $request = "SELECT * FROM produit ORDER BY id_produit DESC";
        $stmt = $this->db->query($request);
        $dataAll = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($dataAll as $dataOne) {
            $produit = new Produit();
            $produit->setId($dataOne['id_produit']);
            $produit->setNom($dataOne['nom']);
            $produit->setDesc($dataOne['description']);
            $produit->setPrix($dataOne['prix']);
            $produit->setImage($dataOne['image']);
            $produitAll[] = $produit;
        }

        return $produitAll;
    }

    // Recherche élément
    public function getAllSearch($var){
        $produitAll = [];
        $request = "SELECT * FROM produit WHERE nom LIKE :query GROUP BY id_produit";
        $param = [
            'query'=>'%'.$var.'%'
        ];
        $stmt = $this->db->prepare($request);
        $stmt->execute($param);
        $dataAll = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($dataAll as $dataOne) {
            $produit = new Produit();
            $produit->setId($dataOne['id_produit']);
            $produit->setNom($dataOne['nom']);
            $produit->setDesc($dataOne['description']);
            $produit->setPrix($dataOne['prix']);
            $produit->setImage($dataOne['image']);
            $produitAll[] = $produit;
        }

        return $produitAll;
    }

    // AFFICHE UN ELEMENT
    public function getOneCompte($param){
        $request = "SELECT * FROM compte WHERE pseudo = :pseudo";
        $stmt = $this->db->prepare($request);
        $stmt->execute($param);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    // UPDATE
    public function update($oData){
        $request = "UPDATE produit SET image = :imagePath WHERE id_produit = :id";
        $param = [
            "id" => $oData->getId(),
            "imagePath" => $oData->getImage(),
        ];
        $stmt = $this->db->prepare($request);
        $stmt->execute($param);
    }
}


?>