<?php

namespace src\Entities;

Class Produit {
    private $nom;
    private $desc;
    private $prix;
    private $image;

    public function __construct($nom, $desc, $prix, $image) {
        $this->nom = $nom;
        $this->desc = $desc;
        $this->prix = $prix;
        $this->image = $image;
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

    public function setNom($nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function setDesc($desc): self
    {
        $this->desc = $desc;

        return $this;
    }

    public function setPrix($prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }
}

