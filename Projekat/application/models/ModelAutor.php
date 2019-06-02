<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelAutor
 *
 * @author David
 */
class ModelAutor extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function dodajAutora($naziv) {
        $this->db->set("naziv", $naziv);
        $this->db->insert("autor");
    }
    
    public function dohvatiId($autor) {
        $row = $this->db->where("naziv", $autor)->get("autor")->row();
        if ($row == null) {
            return null;
        }
        return $row->id;
    }

    public function dohvatiImeAutora($id) {
        $row = $this->db->where("id", $id)->get("autor")->row();
        if ($row == null) {
            return null;
        }
        return $row->naziv;
    }
    
    public function brojAutora($imePocinjeSlovom = NULL) {
        if ($imePocinjeSlovom != NULL && $imePocinjeSlovom != "0") {
            $this->db->like("naziv", strtoupper($imePocinjeSlovom), "after");
            $this->db->or_like("naziv", strtolower($imePocinjeSlovom), "after");
        }
        return $this->db->count_all_results('autor');
    }

    public function dohvatiAutore($limit, $start, $imePocinjeSlovom = NULL) {
        if ($imePocinjeSlovom != NULL && $imePocinjeSlovom != "0") {
            $this->db->like("naziv", strtoupper($imePocinjeSlovom), "after");
            $this->db->or_like("naziv", strtolower($imePocinjeSlovom), "after");
        }
        $this->db->limit($limit, $start);
        return $this->db->get("autor")->result();
    }

}
