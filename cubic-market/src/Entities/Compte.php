<?php

namespace src\Entities;

Class Compte {
    private $id;
    private $pseudo;
    private $email;
    private $mot_passe;
    private $role;

    public function __construct($id, $pseudo,$email,$mot_passe,$role)
    {
        $this->id=$id;
        $this->pseudo= $pseudo;
        $this->email=$email;
        $this->mot_passe=$mot_passe;
        $this->role=$role;
    }

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

    public function getId()
    {
        return $this->id;
    }

     public function getRole()
    {
        return $this->role;
    }

    //SETTER

    
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }


    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }


    public function setMotPasse($mot_passe)
    {
        $this->mot_passe = $mot_passe;

        return $this;
    }

   public function login($pseudo, $motpasse, $db) {
        if ($this && password_verify($motpasse, $this->getMotPasse())) {
            return $this->getRole();
        }
        return null;
    }
}

?>