<?php

namespace src\Entities;

Class Armure extends Produit { 
    private $idarmure;
    private $protection;
    private $durabilite;

    /*public function __construct($nom, $desc, $prix, $image, $protection, $durabilite){
        parent::__construct($nom, $desc, $prix, $image);
        $this->protection = $protection;
        $this->durabilite = $durabilite;
    }
    */
    public function getProtection()
    {
        $this->protection;
    }

    public function getDurabilite()
    {
        $this->durabilite;
    }

    public function setProtection($protection)
    {
        $this->protection = $protection;

        return $this;
    }

    public function setDurabilite($durabilite)
    {
        $this->durabilite = $durabilite;

        return $this;
    }
}

?>