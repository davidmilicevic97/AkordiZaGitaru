<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelKorisnik
 *
 * @author David
 */
class ModelKorisnik extends CI_Model {

    public $korisnik;

    public function __construct() {
        parent::__construct();
        $this->korisnik = NULL;
    }

    public function dodajKorisnika($username, $password) {
        $this->db->set("username", $username);
        $this->db->set("password", $password);
        $this->db->set("tip", "korisnik");
        $this->db->insert("korisnik");
    }

    public function dohvatiKorisnika($username) {
        $result = $this->db->where("username", $username)->get("korisnik");
        $korisnik = $result->row();
        if ($korisnik != NULL) {
            $this->korisnik = $korisnik;
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function ispravanPassword($password) {
        if ($this->korisnik->password == $password) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function dohvatiKorisnike($tip = NULL) {
        if ($tip != NULL) {
            $this->db->where("tip", $tip);
        }
        return $this->db->get("korisnik")->result();
    }

    public function promeniTip($id, $tip) {
        $this->db->set("tip", $tip);
        $this->db->where("id", $id);
        $this->db->update("korisnik");
    }
    
    public function ukloniKorisnika($id) {
        $this->db->where("id", $id);
        $this->db->delete("korisnik");
    }
}
