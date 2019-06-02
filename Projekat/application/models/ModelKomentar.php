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
    
    public $velicinaStranice = 3;

    public function __construct() {
        parent::__construct();
    }

    public function dodajKomentar($text, $idPesme, $idKorisnika) {
        $this->db->set("text", $text);
        $this->db->set("vreme", mdate("%Y-%m-%d %H:%i:%s"));
        $this->db->set("stanje", "neodobren");
        $this->db->set("idPes", $idPesme);
        $this->db->set("idKor", $idKorisnika);
        $this->db->insert("komentar");
    }

    public function brojNeodobrenihKomentara() {
        $this->db->where("stanje", "neodobren");
        return $this->db->count_all_results("komentar");
    }

    public function dohvatiNeodobreneKomentare($limit, $start) {
        $this->db->from("komentar");
        $this->db->where("stanje", "neodobren");
        $this->db->join("korisnik", "komentar.idKor = korisnik.id", "left");
        $this->db->select("komentar.*, korisnik.username as 'username'");
        $this->db->order_by("komentar.id", "DESC");
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    public function dohvatiKomentareZaPesmu($idPesme) {
        $this->db->where("idPes", $idPesme);
        $this->db->from("komentar");
        $this->db->join("korisnik", "komentar.idKor = korisnik.id", "left");
        $this->db->select("komentar.*, korisnik.username as 'username'");
        $this->db->order_by("komentar.id", "DESC");
        $result = $this->db->get()->result();
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
        $this->db->update("komentar");
    }

    public function odobriKomentar($id) {
        $this->db->set("stanje", "odobren");
        $this->db->where("id", $id);
        $this->db->update("komentar");
    }
    
    public function obrisiKomentar($id) {
        $this->db->where("id", $id);
        $this->db->delete("komentar");
    }
}
