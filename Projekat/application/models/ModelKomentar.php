<?php
/**
 * @author David Milićević 2016/0055
 */

/**
 * ModelKomentar model - klasa za pristup tabeli komentara
 * 
 * @version 1.0
 */
class ModelKomentar extends CI_Model {
    
    /**
     * @var int broj redova koje treba prikazati na delu stranice za prikazivanje komentara
     */
    public $velicinaStranice = 3;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Dodavanje novog komentara u bazu
     * 
     * @param string $text tekst komentara
     * @param int $idPesme id pesme na koju se odnosi komentar
     * @param int $idKorisnika id korisnika koji je napisao komentar
     * @return void
     */
    public function dodajKomentar($text, $idPesme, $idKorisnika) {
        $this->db->set("text", $text);
        $this->db->set("vreme", mdate("%Y-%m-%d %H:%i:%s"));
        $this->db->set("stanje", "neodobren");
        $this->db->set("idPes", $idPesme);
        $this->db->set("idKor", $idKorisnika);
        $this->db->insert("komentar");
    }
    
    /**
     * Dohvatanje broja neodobrenih komentara
     * 
     * @return int
     */
    public function brojNeodobrenihKomentara() {
        $this->db->where("stanje", "neodobren");
        return $this->db->count_all_results("komentar");
    }
    
    /**
     * Dohvatanje neodobrenih komentara
     * 
     * @param int $limit broj komentara koje treba dohvatiti
     * @param int $start redni broj komentara od koga treba dohvatati
     * @return array
     */
    public function dohvatiNeodobreneKomentare($limit, $start) {
        $this->db->from("komentar");
        $this->db->where("stanje", "neodobren");
        $this->db->join("korisnik", "komentar.idKor = korisnik.id", "left");
        $this->db->select("komentar.*, korisnik.username as 'username'");
        $this->db->order_by("komentar.id", "DESC");
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    /**
     * Dohvatanje komentara za zadatu pesmu
     * 
     * @param int $idPesme id pesme
     * @return array
     */
    public function dohvatiKomentareZaPesmu($idPesme) {
        $this->db->where("idPes", $idPesme);
        $this->db->from("komentar");
        $this->db->join("korisnik", "komentar.idKor = korisnik.id", "left");
        $this->db->select("komentar.*, korisnik.username as 'username'");
        $this->db->order_by("komentar.id", "DESC");
        $result = $this->db->get()->result();
        return $result;
    }

    /**
     * Uklanjanje zadatog komentara iz baze
     * 
     * @param int $id id komentara
     * @return void
     */
    public function ukloniKomentar($id) {
        $this->db->where("id", $id);
        $this->db->delete("komentar");
    }

    /**
     * Izmena zadatog komentara
     * 
     * @param int $id id komentara
     * @param string $text novi tekst komentara
     * @return void
     */
    public function promeniKomentar($id, $text) {
        // mozda dodati da se apdejtuje i vreme komentara?
        $this->db->set("text", $text);
        $this->db->where("id", $id);
        $this->db->update("komentar");
    }

    /**
     * Odobravanje zadatog komentara
     * 
     * @param int $id id komentara
     * @return void
     */
    public function odobriKomentar($id) {
        $this->db->set("stanje", "odobren");
        $this->db->where("id", $id);
        $this->db->update("komentar");
    }
    
    /**
     * Brisanje zadatog komentara iz baze
     * 
     * @param int $id id komentara
     * @return void
     */
    public function obrisiKomentar($id) {
        $this->db->where("id", $id);
        $this->db->delete("komentar");
    }
}
