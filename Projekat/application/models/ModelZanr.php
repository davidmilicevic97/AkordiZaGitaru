<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelZanr
 *
 * @author David
 */
class ModelZanr extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function dohvatiId($zanr) {
        $row = $this->db->where("tip", $zanr)->get("zanr")->row();
        if ($row == null)
            return null;
        return $row->id;
    }
    
    public function dohvatiZanrove() {
        return $this->db->get("zanr")->result();
    }
}
