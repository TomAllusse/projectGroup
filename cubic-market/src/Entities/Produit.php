<?php

namespace src\Entities;

Class Produit {
    private $id;
    private $nom;
    private $desc;
    private $prix;
    private $image;

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this->id;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    public function setDesc($desc)
    {
        $this->desc = $desc;

        return $this;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}

