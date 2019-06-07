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
    /**
     * Kreiranje index stranice za gost kontrolera
     * 
     * @return void
     */
    public function index() {
        $args = array();
        $args["controller"] = "Admin";
        $args["modelPesma"] = $this->ModelPesma;
        $this->prikazi("index.php", $args);
    }
    
    /**
     * Parametrizovana funkcija za prikazivanje stranice sa zadatim glavnim delom.
     * 
     * @param string $glavniDeo Naziv view-a koji treba prikazati u glavnom delu
     * @param array $data Skup parametara koje treba proslediti zaglavlju i glavnom delu 
     * @return void
     */
    public function prikazi($glavniDeo, $data = null) {
        $data['zanrModel'] = $this->ModelZanr;
        $data['autorModel'] = $this->ModelAutor;
        $this->load->view("header_admin.php", $data);
        $this->load->view($glavniDeo, $data);
        $this->load->view("footer.php");
    }
    /**
     * Funkcija za izlogovanje.
     *  
     * @return void
     */

    public function izlogujSe() {
        $this->session->unset_userdata("korisnik");
        $this->session->sess_destroy();
        redirect("Gost");
    }
    /**
     * Prikazivanje stranice za odobravanje moderatora na kojoj su izlistani potencijalni moderatori.
     * 
     * @return void
     */
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
    /**
     * Stilizacija paginacije.
     * 
     * @param array $config Niz koji treba popuniti parametrima za konfiguraciju brojanja stranica
     * @return void
     */
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
    /**
     * Prikazivanje stranice za uklanjanje moderatora na kojoj su izlistani moderatori
     * koji se mogu ukloniti i postati korisnici.
     * @return void
     */
    
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
    /**
     * Prikazivanje svih korisnika sa tipom "korisnik" čiji nalozi mogu biti izbrisani.
     * 
     * @return void
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
    /**
     * Funkcija koja služi da dodamo moderatora i vratimo se na listu potencijalnih moderatora.
     * @param int $id Id korisnika koji postaje moderator.
     * @return void
     */
    public function dodavanjeModeratora($id) {
        $this->ModelKorisnik->promeniTip($id, "moderator");
        redirect('Admin/odobravanjeModeratora');
    }
    /**
     * Funkcija koja služi da uklonimo moderatora i vratimo se na listu moderatora koje možemo ukloniti.
     * @param int $id Id korisnika koji gubi status moderatora.
     * @return void
     */
    public function ukloniModeratora($id) {
        $this->ModelKorisnik->promeniTip($id, "korisnik");
        redirect('Admin/uklanjanjeModeratora');
    }
    /**
     * Funkcija koja služi da  uklonimo korisnika i ponovo se vratimo na listu potencijalnih moderatora.
     * @param int $id Id korisnika koji se briše u bazi.
     * @return void
     */
    public function ukloniKorisnika($id) {
        $this->ModelKorisnik->ukloniKorisnika($id);
        redirect('Admin/uklanjanjeKorisnika');
    }



}
