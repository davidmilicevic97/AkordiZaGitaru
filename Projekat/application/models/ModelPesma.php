<?php
/**
 * @author David Milićević 2016/0055
 */

/**
 * ModelPesma model - klasa za pristup tabeli pesma
 * 
 * @version 1.0
 */
class ModelPesma extends CI_Model {

    /**
     * @var int broj redova koje treba prikazati na stranici za prikazivanje pesmi
     */
    public $velicinaStranice = 10;
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Dodavanje nove pesme u bazu
     * 
     * @param string $naziv naziv pesme
     * @param string $putanja putanja do fajla u kojoj su sacuvani akordi za pesmu
     * @param string $ytLink link ka Youtube videu za pesmu
     * @param int $idZanr id zanra kojem pripada pesma
     * @param int $idAutor id autora koji izvodi pesmu
     * @param int $idKor id korisnika koji je dodao pesmu
     * @return void
     */
    public function dodajPesmu($naziv, $putanja, $ytLink, $idZanr, $idAutor, $idKor) {
        $this->db->set("naziv", $naziv);
        $this->db->set("stanje", "neodobrena");
        $this->db->set("putanjaDoAkorda", $putanja);
        $this->db->set("ytLink", $ytLink);
        $this->db->set("brPregleda", 0);
        $this->db->set("idZanr", $idZanr);
        $this->db->set("idAutor", $idAutor);
        $this->db->set("idKor", $idKor);
        $this->db->insert("pesma");
    }

    /**
     * Dohvatanje zadate pesme
     * 
     * @param int $id id pesme
     * @param boolean $uvecajBrojac da li treba uvecati brojac pristupa pesmi
     * @return Pesma
     */
    public function dohvatiPesmu($id, $uvecajBrojac = FALSE) {
        if ($uvecajBrojac) {
            $this->db->set("brPregleda", "brPregleda + 1", FALSE);
            $this->db->where("id", $id);
            $this->db->update("pesma");
        }
        
        $this->db->from("pesma");
        $this->db->where("pesma.id", $id);
        $this->db->join("autor", "autor.id = pesma.idAutor", 'left');
        $this->db->select("pesma.*, autor.naziv as 'autor'");
        return $this->db->get()->row();
    }

    /**
     * Dohvatanje broja pesama koji ispunjavaju zadate uslove
     * 
     * @param int $idZanr id zanra kojem pripadaju pesme
     * @param int $idAutor id autora koji izvodi pesme
     * @param string $pesmaPocinjeSlovom slovo kojim pocinju nazivi pesama
     * @return int
     */
    public function brojPesama($idZanr=NULL, $idAutor=NULL, $pesmaPocinjeSlovom = NULL){
        if ($idZanr != NULL && $idZanr != 0) {
            $this->db->where("idZanr", $idZanr);
        }
        if ($idAutor != NULL && $idAutor != 0) {
            $this->db->where("idAutor", $idAutor);
        }
        if ($pesmaPocinjeSlovom != NULL && $pesmaPocinjeSlovom != "0") {
            $this->db->like("naziv", strtoupper($pesmaPocinjeSlovom), "after");
            $this->db->or_like("naziv", strtolower($pesmaPocinjeSlovom), "after");
        }
        return $this->db->count_all_results("pesma");
    }
    
    /**
     * Dohvatanje broja pesama za zadatog korisnika
     * 
     * @param int $id id korisnika
     * @return int
     */
    public function brojPesamaZaKorisnika($id) {
        $this->db->where("idKor", $id);
        return $this->db->count_all_results("pesma");
    }

    /**
     * Dohvatanje broja neodobrenih pesama
     * 
     * @return int
     */
    public function brojNeodobrenihPesama(){
        $this->db->where("stanje", "neodobrena");
        return $this->db->count_all_results("pesma");
    }
    
    /**
     * Dohvatanje pesama koji ispunjavaju zadate uslove
     * 
     * @param int $limit broj pesama koje treba dohvatiti
     * @param int $start redni broj pesme od koje treba dohvatati
     * @param int $idZanr id zanra kojem pripadaju pesme
     * @param int $idAutor id autora koji izvodi pesme
     * @param string $pesmaPocinjeSlovom slovo kojim pocinju nazivi pesama
     * @return array
     */
    public function dohvatiPesme($limit, $start, $idZanr = NULL, $idAutor = NULL, $pesmaPocinjeSlovom = NULL) {
        if ($idZanr != NULL && $idZanr != 0) {
            $this->db->where("idZanr", $idZanr);
        }
        if ($idAutor != NULL && $idAutor != 0) {
            $this->db->where("idAutor", $idAutor);
        }
        $this->db->from("pesma");
        if ($pesmaPocinjeSlovom != NULL && $pesmaPocinjeSlovom != "0") {
            $this->db->where("(pesma.naziv LIKE '" . strtoupper($pesmaPocinjeSlovom) . "%' OR " .
                    "pesma.naziv LIKE '" . strtolower($pesmaPocinjeSlovom) . "%')");
        }
        $this->db->join("autor", "autor.id = pesma.idAutor", 'left');
        $this->db->select("pesma.*, autor.naziv as 'autor'");
        $this->db->order_by("pesma.id", "DESC");
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }
    
    /**
     * Dohvatanje pesama koji je dodao zadati korisnik
     * 
     * @param int $limit broj pesama koje treba dohvatiti
     * @param int $start redni broj pesme od koje treba dohvatati
     * @param int $id id korisnika
     * @return array
     */
    public function dohvatiPesmeZaKorisnika($limit, $start, $id) {
        $this->db->where("idKor", $id);
        $this->db->from("pesma");
        $this->db->join("autor", "autor.id = pesma.idAutor", 'left');
        $this->db->select("pesma.*, autor.naziv as 'autor'");
        $this->db->order_by("pesma.id", "DESC");
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    /**
     * Dohvatanje neodobrenih pesama
     * 
     * @param int $limit broj pesama koje treba dohvatiti
     * @param int $start redni broj pesme od koje treba dohvatati
     * @return array
     */
    public function dohvatiNeodobrenePesme($limit, $start){
        $this->db->from("pesma");
        $this->db->where("stanje", "neodobrena");
        $this->db->join("autor", "autor.id = pesma.idAutor", 'left');
        $this->db->select("pesma.*, autor.naziv as 'autor'");
        $this->db->order_by("pesma.id", "DESC");
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }
    
    /**
     * Dohvatanje zadatog broja najpopularnijih pesama
     * 
     * @param int $number broj pesama koje treba dohvatiti
     * @return array
     */
    public function dohvatiNajpopularnijePesme($number) {
        $this->db->from("pesma");
        $this->db->join("autor", "autor.id = pesma.idAutor", 'left');
        $this->db->select("pesma.*, autor.naziv as 'autor'");
        $this->db->order_by("pesma.brPregleda", "DESC");
        $this->db->limit($number, 0);
        return $this->db->get()->result();
    }
    
    /**
     * Odobravanje zadate pesme
     * 
     * @param int $id id pesme
     * @return void
     */
    public function odobriPesmu($id) {
        $this->db->set("stanje", "odobrena");
        $this->db->where("id", $id);
        $this->db->update("pesma");
    }
    
    /**
     * Izmena zadate pesme
     * 
     * @param int $id id pesme
     * @param string $naziv naziv pesme
     * @param string $putanja putanja do fajla u kojoj su sacuvani akordi za pesmu
     * @param string $ytLink link ka Youtube videu za pesmu
     * @param int $idZanr id zanra kojem pripada pesma
     * @param int $idAutor id autora koji izvodi pesmu
     * @return void
     */
    public function promeniPesmu($id, $naziv, $putanja, $ytLink, $idZanr, $idAutor) {
        $this->db->set("naziv", $naziv);
        $this->db->set("putanjaDoAkorda", $putanja);
        $this->db->set("ytLink", $ytLink);
        $this->db->set("idZanr", $idZanr);
        $this->db->set("idAutor", $idAutor);
        $this->db->where("id", $id);
        $this->db->update("pesma");
    }
    
    /**
     * Brisanje zadate pesme iz baze
     * 
     * @param int $id id pesme
     * @return void
     */
    public function obrisiPesmu($id) {
        $putanjaDoAkorda = $this->dohvatiPesmu($id)->putanjaDoAkorda;
        unlink($putanjaDoAkorda);
        $this->db->where("id", $id);
        $this->db->delete("pesma");
    }

}
