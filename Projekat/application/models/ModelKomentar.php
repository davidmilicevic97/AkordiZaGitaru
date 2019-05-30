<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelKomentar
 *
 * @author David
 */
class ModelKomentar extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function dodajKomentar($text, $idPesme, $idKorisnika) {
        $this->db->set("text", $text);
        $this->db->set("vreme", mdate());
        $this->db->set("idPes", $idPesme);
        $this->db->set("idKor", $idKorisnika);
        $this->db->insert("komentar");
    }
    
    public function dohvatiKomentareZaPesmu($idPesme) {
        $this->db->where("id", $idPesme);
        $result = $this->db->get("komentar")->result();
        return $result;
    }
    
    public function ukloniKomentar($id) {
        $this->db->where("id", $id);
        $this->db->delete("komentar");
    }
    
    public function promeniKomentar($id, $text) {
        // mozda dodati da se apdejtuje i vreme komentara?
        $this->db->set("text", $text);
        $this->db->where("id", $id);
        $this->db->update("korisnik");
    }
}
