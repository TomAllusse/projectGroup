<?php

Class Grade extends Produit { 
    private $duree;
    private $date_creation;

    public function __construct($nom, $desc, $prix, $image, $date_creation){
        $this->date_creation = $date_creation;
    }

    public function getduree()
    {
        $this->duree;
    }

    public function getdate_creation()
    {
        $this->date_creation;
    }
}
