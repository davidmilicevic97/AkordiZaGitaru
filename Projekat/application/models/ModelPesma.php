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

    public $pgSize;
    public $currPg, $totalPgs;

    public function __construct() {
        parent::__construct();

        $this->pgSize = 20;
        $this->currPg = 0;
        $this->totalPgs = 0;
    }

    public function dodajPesmu($naziv, $putanja, $ytLink, $idZanr, $idAutor) {
        $this->db->set("naziv", $naziv);
        $this->db->set("stanje", "neodobrena");
        $this->db->set("putanjaDoAkorda", $putanja);
        $this->db->set("ytLink", $ytLink);
        $this->db->set("brPregleda", 0);
        $this->db->set("idZanr", $idZanr);
        $this->db->set("idAutor", $idAutor);
        $this->db->insert("pesma");
    }

    public function dohvatiPesmu($id, $uvecajBrojac = FALSE) {
        if ($uvecajBrojac) {
            $this->db->set("brPregleda", "brPregleda + 1", FALSE);
            $this->db->where("id", $id);
            $this->db->update("pesma");
        }
        return $this->db->where("id", $id)->get("pesma")->row();
    }

    public function dohvatiPesme($idZanr = NULL, $idAutor = NULL) {
        if ($idZanr != NULL) {
            $this->db->where("idZanr", $idZanr);
        }
        if ($idAutor != NULL) {
            $this->db->where("idAutor", $idAutor);
        }
        $this->db->limit($this->pgSize, max($this->currPg - 1, 0) * $this->pgSize);
        return $this->db->get("pesma")->result();
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
