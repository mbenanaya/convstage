<?php

class Etudiant
{
    private $email;
    private $datenaiss;
    private $nom;
    private $prenom;
    private $cne;
    private $cin;
    private $diplome;
    private $datedebut;
    private $datefin;

    public function __construct($email, $datenaiss, $nom, $prenom, $cne, $cin, $diplome, $datedebut, $datefin)
    {
        $this->email = $email;
        $this->datenaiss = $datenaiss;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->cne = $cne;
        $this->cin = $cin;
        $this->diplome = $diplome;
        $this->datedebut = $datedebut;
        $this->datefin = $datefin;
    }

    // Getters
    public function getEmail()
    {
        return $this->email;
    }

    public function getdatenaiss()
    {
        return $this->datenaiss;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getCne()
    {
        return $this->cne;
    }

    public function getCin()
    {
        return $this->cin;
    }
    public function getdiplome()
    {
        return $this->diplome;
    }

    public function getDatedebut()
    {
        return $this->datedebut;
    }

    public function getDatefin()
    {
        return $this->datefin;
    }
}