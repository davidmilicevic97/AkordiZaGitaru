<?php
/**
 * @author Andrija Veljković 2016/0328
 */

/**
 * Admin controller - klasa za funkcionalnosti adminstratora
 * 
 * @version 1.0
 */
class Admin extends CI_Controller {

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
                case "moderator":
                    redirect("Moderator");
                    break;
            }
        }
    }

    public function index() {
        $args = array();
        $args["controller"] = "Admin";
        $args["modelPesma"] = $this->ModelPesma;
        $this->prikazi("index.php", $args);
    }

    public function prikazi($glavniDeo, $data = null) {
        $data['zanrModel'] = $this->ModelZanr;
        $data['autorModel'] = $this->ModelAutor;
        $this->load->view("header_admin.php", $data);
        $this->load->view($glavniDeo, $data);
        $this->load->view("footer.php");
    }

    public function izlogujSe() {
        $this->session->unset_userdata("korisnik");
        $this->session->sess_destroy();
        redirect("Gost");
    }

    public function odobravanjeModeratora() {
        $config = array();
        $config["base_url"] = base_url() . "/index.php/Admin/odobravanjeModeratora";
        $config["total_rows"] = $this->ModelKorisnik->brojKorisnika("korisnik", $this->input->post("searchVal"));
        $config["per_page"] = $this->ModelKorisnik->velicinaStranice;
        $uri_segment = 3;
        $config["uri_segment"] = $uri_segment;
        $this->postaviConfigZaPaginaciju($config);
        $this->pagination->initialize($config);

        $pocetniRedniBr = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;

        $data = array();
        $data["korisnici"] = $this->ModelKorisnik->dohvatiKorisnike(/* $this->ModelKorisnik->velicinaStranice */3, $pocetniRedniBr, "korisnik", $this->input->post("searchVal"));

        $data["links"] = $this->pagination->create_links();
        $data["controller"] = "Admin";
        $data["pocetniRedniBr"] = $pocetniRedniBr;
        $this->prikazi("odobravanje_moderatora.php", $data);
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
    
    public function uklanjanjeModeratora() {
        $config = array();
        $config["base_url"] = base_url() . "/index.php/Admin/uklanjanjeModeratora/";
        $config["total_rows"] = $this->ModelKorisnik->brojKorisnika('moderator', $this->input->post("searchVal"));
        $config["per_page"] = $this->ModelKorisnik->velicinaStranice;
        $uri_segment = 3;
        $config["uri_segment"] = $uri_segment;
        $this->postaviConfigZaPaginaciju($config);
        $this->pagination->initialize($config);

        $pocetniRedniBr = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;

        $data = array();
        $data["korisnici"] = $this->ModelKorisnik->dohvatiKorisnike($this->ModelKorisnik->velicinaStranice, $pocetniRedniBr, 'moderator', $this->input->post("searchVal"));
        $data["links"] = $this->pagination->create_links();
        $data["controller"] = "Admin";
        $data["pocetniRedniBr"] = $pocetniRedniBr;
        $this->prikazi("uklanjanje_moderatora.php", $data);
    }
    
/*
    public function odobravanjeAdmina() {
        $config = array();
        $config["base_url"] = base_url() . "/index.php/Admin/odobravanjeAdmina";
        $config["total_rows"] = $this->ModelKorisnik->brojKorisnika("moderator", $this->input->post("searchVal"));
        $config["per_page"] = $this->ModelKorisnik->velicinaStranice;
        $config["uri_segment"] = 3;
        $this->postaviConfigZaPaginaciju($config);
        $this->pagination->initialize($config);

        $pocetniRedniBr = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data = array();
        $data["korisnici"] = $this->ModelKorisnik->dohvatiKorisnike($this->ModelKorisnik->velicinaStranice, $pocetniRedniBr, "moderator", $this->input->post("searchVal"));

        $data["links"] = $this->pagination->create_links();
        $data["controller"] = "Admin";
        $data["pocetniRedniBr"] = $pocetniRedniBr;
        $this->prikazi("odobravanje_admina.php", $data);
    }
*/
    
    public function uklanjanjeKorisnika() {
        $config = array();
        $config["base_url"] = base_url() . "/index.php/Admin/uklanjanjeModeratora";
        $config["total_rows"] = $this->ModelKorisnik->brojKorisnika("korisnik", $this->input->post("searchVal"));
        $config["per_page"] = $this->ModelKorisnik->velicinaStranice;
        $config["uri_segment"] = 3;
        $this->postaviConfigZaPaginaciju($config);
        $this->pagination->initialize($config);

        $pocetniRedniBr = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data = array();
        $data["korisnici"] = $this->ModelKorisnik->dohvatiKorisnike($this->ModelKorisnik->velicinaStranice, $pocetniRedniBr, "korisnik", $this->input->post("searchVal"));
        $data["links"] = $this->pagination->create_links();
        $data["controller"] = "Admin";
        $data["pocetniRedniBr"] = $pocetniRedniBr;
        $this->prikazi("uklanjanje_korisnika.php", $data);
    }
/*
    public function dodavanjeAdmina($id) {
        $this->ModelKorisnik->promeniTip($id, "admin");
        redirect('Admin/odobravanjeAdmina');
    }
*/
    public function dodavanjeModeratora($id) {
        $this->ModelKorisnik->promeniTip($id, "moderator");
        redirect('Admin/odobravanjeModeratora');
    }

    public function ukloniModeratora($id) {
        $this->ModelKorisnik->promeniTip($id, "korisnik");
        redirect('Admin/uklanjanjeModeratora');
    }

    public function ukloniKorisnika($id) {
        $this->ModelKorisnik->ukloniKorisnika($id);
        redirect('Admin/uklanjanjeKorisnika');
    }



}
