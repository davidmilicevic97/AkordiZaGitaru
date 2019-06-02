<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Moderator
 *
 * @author ratko
 */
class Moderator extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model("ModelKorisnik");
        $this->load->model("ModelPesma");
        $this->load->model("ModelKomentar");
        $this->load->model("ModelZanr");
        $this->load->model("ModelAutor");
    }

    public function index() {
        $this->prikazi("index.php");
    }

    public function odobravanjeAkorda() {
        $this->muzika();
    }

    public function odobravanjeKomentara() {
        $this->komentari();
    }
    
    public function brisanjeAkorda(){
        
    }

    public function prikazi($glavniDeo, $data = null) {
        $data['zanrModel'] = $this->ModelZanr;
        $data['autorModel'] = $this->ModelAutor;
        $this->load->view("header_moderator.php", $data);
        $this->load->view($glavniDeo, $data);
        $this->load->view("footer.php");
    }

    public function onama() {
        $this->prikazi("onama.php");
    }

    private function postaviConfigZaPaginaciju(&$config) {
        $config["full_tag_open"] = "<ul class='pagination'>";
        $config["full_tag_close"] = "</ul>";
        $config["first_link"] = "<li class='page-link'>Prva</li>";
        $config["last_link"] = "<li class='page-link'>Poslednja</li>";
        $config["next_link"] = "<li class='page-link'>Sledeća</li>";
        $config["prev_link"] = "<li class='page-link'>Prethodna</li>";
        $config["cur_tag_open"] = "<li class='page-link'><a href='#'><strong>";
        $config["cur_tag_close"] = "</strong></a></li>";
        $config["num_tag_open"] = "<li class='page-link'>";
        $config["num_tag_close"] = "</li>";
    }

    public function muzika() {
        $config = array();
        $config["base_url"] = base_url() . "/index.php/Moderator/muzika/";
        $config["total_rows"] = $this->ModelPesma->brojNeodobrenihPesama();
        $config["per_page"] = $this->ModelPesma->velicinaStranice;
        $uri_segment = 3;
        $config["uri_segment"] = $uri_segment;
        $this->postaviConfigZaPaginaciju($config);
        $this->pagination->initialize($config);

        $pocetniRedniBr = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;

        $data = array();
        $data["numere"] = $this->ModelPesma->dohvatiNeodobrenePesme($this->ModelPesma->velicinaStranice, $pocetniRedniBr);
        $data["links"] = $this->pagination->create_links();
        $data["controller"] = "moderator";
        $data["pocetniRedniBr"] = $pocetniRedniBr;
        $this->prikazi("list.php", $data);
    }

    public function komentari() {
        $config = array();
        $config["base_url"] = base_url() . "/index.php/Moderator/komentari/";
        $config["total_rows"] = $this->ModelKomentar->brojNeodobrenihKomentara();
        $config["per_page"] = $this->ModelKomentar->velicinaStranice;
        $uri_segment = 3;
        $config["uri_segment"] = $uri_segment;
        $this->postaviConfigZaPaginaciju($config);
        $this->pagination->initialize($config);

        $pocetniRedniBr = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;

        $data = array();
        $data["komentari"] = $this->ModelKomentar->dohvatiNeodobreneKomentare($this->ModelPesma->velicinaStranice, $pocetniRedniBr);
        $data["links"] = $this->pagination->create_links();
        $data["controller"] = "moderator";
        $data["pocetniRedniBr"] = $pocetniRedniBr;
        $this->prikazi("comment_list.php", $data);
    }

    public function pesma($id) {
        $args = array();
        $args["pesma"] = $this->ModelPesma->dohvatiPesmu($id, TRUE);
        $args["komentari"] = $this->ModelKomentar->dohvatiKomentareZaPesmu($id);
        $args["controller"] = "moderator";
        $this->prikazi("pesma.php", $args);
    }

    public function odobriKomentar($id) {
        $this->ModelKomentar->odobriKomentar($id);
        redirect("moderator/odobravanjeKomentara");
    }

    public function obrisiKomentar($id) {
        $this->ModelKomentar->obrisiKomentar($id);
        redirect("moderator/odobravanjeKomentara");
    }

    public function odobriPesmu($id) {
        $this->ModelPesma->odobriPesmu($id);
        redirect("moderator/odobravanjeAkorda");
    }

    public function obrisiPesmu($id) {
        $this->ModelPesma->obrisiPesmu($id);
        redirect("moderator/odobravanjeAkorda");
    }

}
