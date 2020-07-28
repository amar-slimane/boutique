<?php

class bddconnect {

    protected $_bdd;
    public function __construct()
    {
        try {
            $this->_bdd = new PDO('mysql:host=localhost;dbname=boutique;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
 