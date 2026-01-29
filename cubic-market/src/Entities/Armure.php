<?php

Class Armure extends Produit { 
    private $protection;
    private $durabilite;

    public function __construct($nom, $desc, $prix, $image, $protection, $durabilite){
        $this->date_creation = $date_creation;
    }

    public function getprotection()
    {
        $this->protection;
    }

    public function getdurabilite()
    {
        $this->durabilite;
    }

}
