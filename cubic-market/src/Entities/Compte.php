<?php

Class Compte {
    private $pseudo;
    private $email;
    private $mot_passe;
    private $id;

// GETTER

    public function getPseudo()
    {
        return $this->pseudo;
    }

  

    public function getEmail()
    {
        return $this->email;
    }

   
    public function getMotPasse()
    {
        return $this->mot_passe;
    }

    public function getid()
    {
        return $this->id;
    }



    //SETTER

    public function setPseudo($pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }


    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }


    public function setMotPasse($mot_passe): self
    {
        $this->mot_passe = $mot_passe;

        return $this;
    }



}

