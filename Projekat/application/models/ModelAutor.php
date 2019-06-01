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

    public function dohvatiId($autor) {
        return $this->db->where("naziv", $autor)->get("autor")->row();
    }

    public function brojAutora() {
        return $this->db->count_all('autor');
    }

    public function dohvatiAutore($limit, $start) {
        $this->db->limit($limit, $start);
        return $this->db->get("autor")->result();
    }

}
