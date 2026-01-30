<?php

namespace src\Entities;

class Arme extends Produit
{
    private $idarme;
    private $degat;
    private $durabilite;

    /*public function __construct($nom, $desc, $prix, $image, $degat, $durabilite){
        parent::__construct($nom, $desc, $prix, $image);
        $this->degat = $degat;
        $this->durabilite = $durabilite;
    }
    */
    public function getDegat()
    {
        $this->degat;
    }

    public function getDurabilite()
    {
        $this->durabilite;
    }
   
    public function setProtection($degat)
    {
        $this->degat = $degat;

        return $this;
    }

    public function setDurabilite($durabilite)
    {
        $this->durabilite = $durabilite;

        return $this;
    }
}
