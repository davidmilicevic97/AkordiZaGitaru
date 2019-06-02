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
        
        // redirekcija u zavisnosti od korisnika koji je ulogovan
        $korisnik = $this->session->userdata('korisnik');
        if ($korisnik == NULL) {
            redirect("Gost");
        }
        else {
            switch ($korisnik->tip) {
                case "korisnik":
                    redirect("Korisnik");
                    break;
                case "admin":
                    redirect("Admin");
                    break;
            }
        }
    }

    public function index() {
        $args = array();
        $args["controller"] = "Moderator";
        $args["modelPesma"] = $this->ModelPesma;
        $this->prikazi("index.php", $args);
    }

    public function odobravanjeAkorda() {
        $config = array();
        $config["base_url"] = base_url() . "/index.php/Moderator/odobravanjeAkorda/";
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
        $data["pocetniRedniBr"] = $pocetniRedniBr + 1;
        $this->prikazi("list.php", $data);
    }

    public function odobravanjeKomentara() {
        $config = array();
        $config["base_url"] = base_url() . "/index.php/Moderator/odobravanjeKomentara/";
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
        $data["pocetniRedniBr"] = $pocetniRedniBr + 1;
        $this->prikazi("comment_list.php", $data);
    }

    public function prikazi($glavniDeo, $data = null) {
        $data['zanrModel'] = $this->ModelZanr;
        $data['autorModel'] = $this->ModelAutor;
        $this->load->view("header_moderator.php", $data);
        $this->load->view($glavniDeo, $data);
        $this->load->view("footer.php");
    }

    public function izlogujSe() {
        $this->session->unset_userdata("korisnik");
        $this->session->sess_destroy();
        redirect("Gost");
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

    public function izvodjaci() {
        $config = array();
        $config["base_url"] = base_url() . "/index.php/moderator/izvodjaci/";
        $config["total_rows"] = $this->ModelAutor->brojAutora(); //broj autora
        $config["per_page"] = $this->ModelPesma->velicinaStranice;
        $config["uri_segment"] = 3;
        $this->postaviConfigZaPaginaciju($config);
        $this->pagination->initialize($config);

        $pocetniRedniBr = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data = array();
        $data["autori"] = $this->ModelAutor->dohvatiAutore($this->ModelPesma->velicinaStranice, $pocetniRedniBr);
        $data["links"] = $this->pagination->create_links();
        $data["controller"] = "moderator";
        $data["pocetniRedniBr"] = $pocetniRedniBr + 1;
        $this->prikazi("izvodjaci.php", $data);
    }

    public function muzika($idZanr = 0, $idAutor = 0) {
        $config = array();
        $config["base_url"] = base_url() . "/index.php/moderator/muzika/" . $idZanr . "/" . $idAutor . "/";
        $config["total_rows"] = $this->ModelPesma->brojPesama($idZanr, $idAutor);
        $config["per_page"] = $this->ModelPesma->velicinaStranice;
        $config["uri_segment"] = 5;
        $this->postaviConfigZaPaginaciju($config);
        $this->pagination->initialize($config);

        $pocetniRedniBr = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $data = array();
        $data["numere"] = $this->ModelPesma->dohvatiPesme($this->ModelPesma->velicinaStranice, $pocetniRedniBr, $idZanr, $idAutor);
        $data["links"] = $this->pagination->create_links();
        $data["controller"] = "moderator";
        $data["pocetniRedniBr"] = $pocetniRedniBr + 1;
        $this->prikazi("list.php", $data);
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

    public function dodajAkordePrikaz() {
        $args = array();
        $args["controller"] = "moderator";
        $this->prikazi("dodaj_akorde.php", $args);
    }

    private function dohvatiAutorIdIliDodaj($autor) {
        $id = $this->ModelAutor->dohvatiId($autor);
        if ($id != null) {
            return $id;
        }
        $this->db->set("naziv", $autor)->insert("autor");
        $id = $this->ModelAutor->dohvatiId($autor);
        return $id;
    }

    public function dodajAkorde() {
        $korisnikId = $this->session->userdata('korisnik')->id;

        $autor = $this->input->post("author");
        $nazivPesme = $this->input->post("songName");
        $ytLink = $this->input->post("ytLink");
        $textPesme = $this->input->post("song");
        $zanrId = $this->input->post("zanrId");
        $autorId = $this->dohvatiAutorIdIliDodaj($autor);

        $this->ModelPesma->dodajPesmu($nazivPesme, $textPesme, $ytLink, $zanrId, $autorId, $korisnikId);
        redirect("Moderator");
    }

    public function mojiAkordiPrikaz() {
        $korisnikId = $this->session->userdata('korisnik')->id;

        $config = array();
        $config["base_url"] = base_url() . "/index.php/moderator/mojiAkordiPrikaz/";
        $config["total_rows"] = $this->ModelPesma->brojPesamaZaKorisnika($korisnikId);
        $config["per_page"] = $this->ModelPesma->velicinaStranice;
        $config["uri_segment"] = 3;
        $this->postaviConfigZaPaginaciju($config);
        $this->pagination->initialize($config);

        $pocetniRedniBr = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data = array();
        $data["numere"] = $this->ModelPesma->
                dohvatiPesmeZaKorisnika($this->ModelPesma->velicinaStranice, $pocetniRedniBr, $korisnikId);
        $data["links"] = $this->pagination->create_links();
        $data["controller"] = "moderator";
        $data["pocetniRedniBr"] = $pocetniRedniBr + 1;
        $this->prikazi("listZaKorisnika.php", $data);
    }

    public function pesmaZaKorisnika($idPesme) {
        $pesma = $this->ModelPesma->dohvatiPesmu($idPesme, FALSE);

        $args = array();
        $args["autor"] = $this->ModelAutor->dohvatiImeAutora($pesma->idAutor);
        $args["idPesme"] = $idPesme;
        $args["nazivPesme"] = $pesma->naziv;
        $args["ytLink"] = $pesma->ytLink;
        $args["zanrId"] = $pesma->idZanr;
        $args["textPesme"] = $pesma->putanjaDoAkorda;
        $args["controller"] = "moderator";
        $this->prikazi("izmeni_akorde.php", $args);
    }

    public function izmeniAkorde() {
        $idPesme = $this->input->post("idPesme");
        $autor = $this->input->post("author");
        $nazivPesme = $this->input->post("songName");
        $ytLink = $this->input->post("ytLink");
        $textPesme = $this->input->post("song");
        $zanrId = $this->input->post("zanrId");
        $autorId = $this->dohvatiAutorIdIliDodaj($autor);

        $this->ModelPesma->promeniPesmu($idPesme, $nazivPesme, $textPesme, $ytLink, $zanrId, $autorId);
        redirect("Moderator");
    }

    public function ostaviKomentar() {
        $text = $this->input->post("komentarTekst");
        $idPes = $this->input->post("idPesme");
        $idKor = $this->session->userdata("korisnik")->id;
        $this->ModelKomentar->dodajKomentar($text, $idPes, $idKor);
        redirect("moderator/pesma/" . $idPes);
    }

}
