<?php

namespace App\Users\Entity;

class User
{
    /**
     * User id.
     *
     * @var int
     */
    protected $id;
    /**
     * nom.
     *
     * @var string
     */
    protected $nom;
    /**
     * Prenom.
     *
     * @var string
     */
    protected $prenom;

    /*
    * Setter di
    * @param Int $id
    */
    public function setId($id)
    {
        $this->id = $id;
    }

    /*
    * Setter nom
    * @param string $nom
    */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }
    /*
    * Setter prenom
    * @param string $prenom
    */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getPrenom()
    {
        return $this->prenom;
    }
    public function getNom()
    {
        return $this->nom;
    }

    public function toArray()
    {
        $array = array();
        $array['id'] = $this->id;
        $array['nom'] = $this->nom;
        $array['prenom'] = $this->prenom;

        return $array;
    }
}
