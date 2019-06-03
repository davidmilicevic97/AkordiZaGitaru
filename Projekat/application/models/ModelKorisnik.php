<?php
/**
 * @author David Milićević 2016/0055
 */

/**
 * ModelKorisnik model - klasa za pristup tabeli korisnika
 * 
 * @version 1.0
 */
class ModelKorisnik extends CI_Model {
    
    /**
     * @var Korisnik Poslednji korisnik ucitan iz baze
     */
    public $korisnik;
    /**
     * @var int broj redova koje treba prikazati na stranici za prikazivanje korisnika
     */
    public $velicinaStranice = 3;

    public function __construct() {
        parent::__construct();
        $this->korisnik = NULL;
    }
    
    /**
     * Dodavanje novog korisnika u bazu
     * 
     * @param string $username korisnicko ime
     * @param string $password lozinka
     * @return void
     */
    public function dodajKorisnika($username, $password) {
        $this->db->set("username", $username);
        $this->db->set("password", $password);
        $this->db->set("tip", "korisnik");
        $this->db->insert("korisnik");
    }

    /**
     * Dohvatanje korisnika sa zadatim korisnickim imenom u promenljivu $korisnik klase
     * (vraca TRUE ukoliko postoji korisnik u bazi, FALSE u suprotnom)
     * 
     * @param string $username korisnicko ime
     * @return boolean
     */
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
    
    /**
     * Proverava da li je zadata lozinka ispravna za poslednjeg dohvacenog korisnika
     * 
     * @param string $password lozinka
     * @return boolean
     */
    public function ispravanPassword($password) {
        if ($this->korisnik != NULL && $this->korisnik->password == $password) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Dohvatanje korisnika koji ispunjavaju zadate uslove
     * 
     * @param int $limit broj korisnika koje treba dohvatiti
     * @param int $start redni broj korisnika od koga treba dohvatati
     * @param string $tip tip korisnika koje treba dohvatati
     * @param string $like string koji korisnicko ime treba da sadrzi
     * @return array
     */
    public function dohvatiKorisnike($limit, $start, $tip = NULL, $like = NULL) {
        if ($tip != NULL) {
            $this->db->where("tip", $tip);
        }
        if ($like != NULL) {
            $this->db->like("username", $like);
        }
        $this->db->limit($limit, $start);
        return $this->db->get("korisnik")->result();
    }
    
    /**
     * Dohvatanje broja korisnika koji ispunjavaju zadate uslove
     * 
     * @param string $tip tip korisnika koje treba brojati
     * @param string $like string koji korisnicko ime treba da sadrzi
     * @return int
     */
    public function brojKorisnika($tip = NULL, $like = NULL) {
        if ($tip != NULL) {
            $this->db->where("tip", $tip);
        }
        if ($like != NULL) {
            $this->db->like("username", $like);
        }
        return $this->db->count_all_results("korisnik");
    }
    
    /**
     * Izmena tipa zadatog korisnika
     * 
     * @param int $id id korisnika
     * @param string $tip novi tip korisnika
     * @return void
     */
    public function promeniTip($id, $tip) {
        $this->db->set("tip", $tip);
        $this->db->where("id", $id);
        $this->db->update("korisnik");
    }
    
    /**
     * Brisanje zadatog korisnika iz baze
     * 
     * @param type $id id korisnika
     * @return void
     */
    public function ukloniKorisnika($id) {
        $this->db->where("id", $id);
        $this->db->delete("korisnik");
    }

}
