<?php
/**
 * @author David Milićević 2016/0055
 */

/**
 * ModelZanr model - klasa za pristup tabeli zanr
 * 
 * @version 1.0
 */
class ModelZanr extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Dohvatanje id-ja zanra sa zadatim nazivom
     * 
     * @param string $zanr naziv zanra
     * @return int
     */
    public function dohvatiId($zanr) {
        $row = $this->db->where("tip", $zanr)->get("zanr")->row();
        if ($row == null)
            return null;
        return $row->id;
    }
    
    /**
     * Dohvatanje svih zanrova iz baze
     * 
     * @return array
     */
    public function dohvatiZanrove() {
        return $this->db->get("zanr")->result();
    }
}
