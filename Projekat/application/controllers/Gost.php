<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Gost
 *
 * @author David
 */
class Gost extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("ModelKorisnik");
        $this->load->model("ModelPesma");
        $this->load->model("ModelKomentar");
        $this->load->model("ModelZanr");
        $this->load->model("ModelAutor");
        
        // redirekcija u zavisnosti od korisnika koji je ulogovan
        $korisnik = $this->session->userdata('korisnik');
        if ($korisnik != NULL) {
            switch ($korisnik->tip) {
                case "korisnik":
                    redirect("Korisnik");
                    break;
                case "moderator":
                    redirect("Moderator");
                    break;
                case "admin":
                    redirect("Admin");
                    break;
                default:
                    redirect("Gost");
                    break;
            }
        }
    }

    public function index() {
        $args = array();
        $args["controller"] = "Gost";
        $args["modelPesma"] = $this->ModelPesma;
        $this->prikazi("index.php", $args);
    }

    public function prikazi($glavniDeo, $data = null) {
        $data['zanrModel'] = $this->ModelZanr;
        $data['autorModel'] = $this->ModelAutor;
        $this->load->view("header.php", $data);
        $this->load->view($glavniDeo, $data);
        $this->load->view("footer.php");
    }

    public function login($poruka = null) {
        $podaci = array();
        if ($poruka) {
            $podaci["poruka"] = $poruka;
        }
        $this->prikazi("login.php", $podaci);
    }

    public function registracija($poruka = null) {
        $podaci = array();
        if ($poruka) {
            $podaci["poruka"] = $poruka;
        }
        $this->prikazi("registracija.php", $podaci);
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

    public function muzika($idZanr = 0, $idAutor = 0) {
        $config = array();
        $config["base_url"] = base_url() . "/index.php/Gost/muzika/" . $idZanr . "/" . $idAutor . "/";
        $config["total_rows"] = $this->ModelPesma->brojPesama($idZanr, $idAutor);
        $config["per_page"] = $this->ModelPesma->velicinaStranice;
        $config["uri_segment"] = 5;
        $this->postaviConfigZaPaginaciju($config);
        $this->pagination->initialize($config);

        $pocetniRedniBr = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $data = array();
        $data["numere"] = $this->ModelPesma->dohvatiPesme($this->ModelPesma->velicinaStranice, $pocetniRedniBr, $idZanr, $idAutor);
        $data["links"] = $this->pagination->create_links();
        $data["controller"] = "gost";
        $data["pocetniRedniBr"] = $pocetniRedniBr + 1;
        $this->prikazi("list.php", $data);
    }

    public function izvodjaci() {
        $config = array();
        $config["base_url"] = base_url() . "/index.php/Gost/izvodjaci/";
        $config["total_rows"] = $this->ModelAutor->brojAutora(); //broj autora
        $config["per_page"] = $this->ModelPesma->velicinaStranice;
        $config["uri_segment"] = 3;
        $this->postaviConfigZaPaginaciju($config);
        $this->pagination->initialize($config);

        $pocetniRedniBr = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data = array();
        $data["autori"] = $this->ModelAutor->dohvatiAutore($this->ModelPesma->velicinaStranice, $pocetniRedniBr);
        $data["links"] = $this->pagination->create_links();
        $data["controller"] = "gost";
        $data["pocetniRedniBr"] = $pocetniRedniBr + 1;
        $this->prikazi("izvodjaci.php", $data);
    }

    public function pesma($id) {
        $args = array();
        $args["pesma"] = $this->ModelPesma->dohvatiPesmu($id, TRUE);
        $args["controller"] = "Gost";
        $args["komentari"] = $this->ModelKomentar->dohvatiKomentareZaPesmu($id);
        $this->prikazi("pesma.php", $args);
    }

    public function ulogujse() {
        $this->form_validation->set_rules("username", "Korisničko ime", "required|min_length[8]|max_length[20]");
        $this->form_validation->set_rules("password", "Lozinka", "required|min_length[8]|max_length[20]");
        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno!");
        $this->form_validation->set_message("min_length", "Polje {field} mora imati najmanje 8 karaktera!");
        $this->form_validation->set_message("max_length", "Polje {field} ne sme imati više od 20 karaktera!");
        if ($this->form_validation->run()) {
            if (!$this->ModelKorisnik->dohvatiKorisnika($this->input->post("username"))) {
                $this->login("Neispravno korisničko ime!");
            } else if (!$this->ModelKorisnik->ispravanPassword($this->input->post("password"))) {
                $this->login("Neispravna lozinka!");
            } else {
                $korisnik = $this->ModelKorisnik->korisnik;
                $this->session->set_userdata('korisnik', $korisnik);
                switch ($korisnik->tip) {
                    case "korisnik":
                        redirect("Korisnik");
                        break;
                    case "moderator":
                        redirect("Moderator");
                        break;
                    case "admin":
                        redirect("Admin");
                        break;
                    default:
                        redirect("Gost");
                        break;
                }
            }
        } else {
            $this->login();
        }
    }

    public function registrujse() {
        $this->form_validation->set_rules("username", "Korisničko ime", "required|min_length[8]|max_length[20]");
        $this->form_validation->set_rules("password", "Lozinka", "required|min_length[8]|max_length[20]");
        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno!");
        $this->form_validation->set_message("min_length", "Polje {field} mora imati najmanje 8 karaktera!");
        $this->form_validation->set_message("max_length", "Polje {field} ne sme imati više od 20 karaktera!");
        if ($this->form_validation->run()) {
            if ($this->ModelKorisnik->dohvatiKorisnika($this->input->post("username"))) {
                $this->registracija("Korisničko ime već postoji!");
            } else {
                $username = $this->input->post("username");
                $password = $this->input->post("password");
                $this->ModelKorisnik->dodajKorisnika($username, $password);
                $this->login("Možete se ulogovati na Vaš nalog!");
            }
        } else {
            $this->registracija();
        }
    }

}
