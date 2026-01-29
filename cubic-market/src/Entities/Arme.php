<?php


class Arme extends Produit
{
    private $degat;
    private $durabilite;

    public function __construct($nom, $desc, $prix, $image, $degat, $durabilite){
        $this->date_creation = $date_creation;
    }

    public function getdurabilite()
    {
        return $this->durabilite;
    }
}
