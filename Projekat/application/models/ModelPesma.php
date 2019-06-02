<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelPesma
 *
 * @author David
 */
class ModelPesma extends CI_Model {

    public $velicinaStranice = 3;
    
    public function __construct() {
        parent::__construct();
    }

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
    
    public function brojPesamaZaKorisnika($id) {
        $this->db->where("idKor", $id);
        return $this->db->count_all_results("pesma");
    }

    public function brojNeodobrenihPesama(){
        $this->db->where("stanje", "neodobrena");
        return $this->db->count_all_results("pesma");
    }
    
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
    
    public function dohvatiPesmeZaKorisnika($limit, $start, $id) {
        $this->db->where("idKor", $id);
        $this->db->from("pesma");
        $this->db->join("autor", "autor.id = pesma.idAutor", 'left');
        $this->db->select("pesma.*, autor.naziv as 'autor'");
        $this->db->order_by("pesma.id", "DESC");
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    public function dohvatiNeodobrenePesme($limit, $start){
        $this->db->from("pesma");
        $this->db->where("stanje", "neodobrena");
        $this->db->join("autor", "autor.id = pesma.idAutor", 'left');
        $this->db->select("pesma.*, autor.naziv as 'autor'");
        $this->db->order_by("pesma.id", "DESC");
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    public function dohvatiNajpopularnijePesme($number) {
        $this->db->from("pesma");
        $this->db->join("autor", "autor.id = pesma.idAutor", 'left');
        $this->db->select("pesma.*, autor.naziv as 'autor'");
        $this->db->order_by("pesma.brPregleda", "DESC");
        $this->db->limit($number, 0);
        return $this->db->get()->result();
    }
    
    public function odobriPesmu($id) {
        $this->db->set("stanje", "odobrena");
        $this->db->where("id", $id);
        $this->db->update("pesma");
    }

    public function promeniPesmu($id, $naziv, $putanja, $ytLink, $idZanr, $idAutor) {
        $this->db->set("naziv", $naziv);
        $this->db->set("putanjaDoAkorda", $putanja);
        $this->db->set("ytLink", $ytLink);
        $this->db->set("idZanr", $idZanr);
        $this->db->set("idAutor", $idAutor);
        $this->db->where("id", $id);
        $this->db->update("pesma");
    }

    public function obrisiPesmu($id) {
        $this->db->where("id", $id);
        $this->db->delete("pesma");
    }

}
