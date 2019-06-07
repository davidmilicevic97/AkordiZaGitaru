<?php
/**
 * @author David Milićević 2016/0055
 */

/**
 * ModelAutor model - klasa za pristup tabeli autora
 * 
 * @version 1.0
 */
class ModelAutor extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Dodavanje novog autora u bazu
     * 
     * @param string $naziv naziv autora
     * @return void
     */
    public function dodajAutora($naziv) {
        $this->db->set("naziv", $naziv);
        $this->db->insert("autor");
    }
    
    /**
     * Dohvatanje id-ja autora sa zadatim imenom
     * 
     * @param string $autor naziv autora
     * @return int
     */
    public function dohvatiId($autor) {
        $row = $this->db->where("naziv", $autor)->get("autor")->row();
        if ($row == null) {
            return null;
        }
        return $row->id;
    }
    
    /**
     * Dohvatanje naziva autora sa zadatim id-jem
     * 
     * @param int $id id autora
     * @return string
     */
    public function dohvatiImeAutora($id) {
        $row = $this->db->where("id", $id)->get("autor")->row();
        if ($row == null) {
            return null;
        }
        return $row->naziv;
    }
    
    /**
     * Dohvatanje broja autora ciji naziv ispunjava zadate uslove
     * 
     * @param string $imePocinjeSlovom slovo kojim pocinju nazivi autora
     * @return int
     */
    public function brojAutora($imePocinjeSlovom = NULL) {
        if ($imePocinjeSlovom != NULL && $imePocinjeSlovom != "0") {
            $this->db->like("naziv", strtoupper($imePocinjeSlovom), "after");
            $this->db->or_like("naziv", strtolower($imePocinjeSlovom), "after");
        }
        return $this->db->count_all_results('autor');
    }
    
    /**
     * Dohvatanje autora koji ispunjavaju zadate uslove
     * 
     * @param int $limit broj autora koje treba dohvatiti
     * @param int $start redni broj autora od koga treba dohvatati
     * @param string $imePocinjeSlovom slovo kojim pocinju nazivi autora
     * @return array
     */
    public function dohvatiAutore($limit, $start, $imePocinjeSlovom = NULL) {
        if ($imePocinjeSlovom != NULL && $imePocinjeSlovom != "0") {
            $this->db->like("naziv", strtoupper($imePocinjeSlovom), "after");
            $this->db->or_like("naziv", strtolower($imePocinjeSlovom), "after");
        }
        $this->db->limit($limit, $start);
        return $this->db->get("autor")->result();
    }

}
