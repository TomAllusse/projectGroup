<?php

namespace src\Entities;

Class Grade extends Produit {
    private $id;
    private $duree;
    private $date_creation;
/*
    public function __construct($nom, $desc, $prix, $image, $duree, $date_creation){
        $this->date_creation = $date_creation;
    }
*/
    public function getDuree()
    {
        return $this->duree;
    }

    public function getDate_creation()
    {
        return $this->date_creation;
    }

    public function setDuree($duree){
        $this->duree = $duree;

        return $this;
    }

    public function setDate_creation($date_creation){
        $this->date_creation = $date_creation;

        return $this;
    }
}

?>