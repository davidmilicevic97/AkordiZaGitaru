<?php
/**
 * @author David Milićević 2016/0055
 * @author Ratko Amanović 2016/0061
 */

/**
 * Gost controller - klasa za funkcionalnosti gosta
 * 
 * @version 1.0
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
    
    /**
     * Kreiranje index stranice za gost kontrolera
     * 
     * @return void
     */
    public function index() {
        $args = array();
        $args["controller"] = "Gost";
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
        $this->load->view("header.php", $data);
        $this->load->view($glavniDeo, $data);
        $this->load->view("footer.php");
    }
    
    /**
     * Prikazivanje stranice za login
     * 
     * @param string $poruka Poruka koju treba prikazati na stranici (ukoliko je doslo do greske npr) 
     * @return void
     */
    public function login($poruka = null) {
        $podaci = array();
        if ($poruka) {
            $podaci["poruka"] = $poruka;
        }
        $this->prikazi("login.php", $podaci);
    }
    
    /**
     * Prikazivanje stranice za registraciju
     * 
     * @param string $poruka Poruka koju treba prikazati na stranici (ukoliko je doslo do greske npr)
     * @return void
     */
    public function registracija($poruka = null) {
        $podaci = array();
        if ($poruka) {
            $podaci["poruka"] = $poruka;
        }
        $this->prikazi("registracija.php", $podaci);
    }
    
    /**
     * Prikazivanje stranice sa informacijama o autorima sajta
     * 
     * @return void
     */
    public function onama() {
        $this->prikazi("onama.php");
    }

    /**
     * Podesavanje parametara za brojanje stranica
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
     * Prikazivanje stranice sa listom pesama koje su selektovane zadatim parametrima
     * 
     * @param int $idZanr id zanra za koji treba prikazivati pesme
     * @param int $idAutor id autora za kojeg treba prikazivati pesme
     * @param string $pesmaPocinjeSlovom kojim slovom pocinju pesme koje treba prikazivati
     * @return void
     */
    public function muzika($idZanr = 0, $idAutor = 0, $pesmaPocinjeSlovom = 0) {
        $config = array();
        $config["base_url"] = base_url() . "/index.php/Gost/muzika/" . $idZanr . "/" . $idAutor . "/" . $pesmaPocinjeSlovom . "/";
        $config["total_rows"] = $this->ModelPesma->brojPesama($idZanr, $idAutor, $pesmaPocinjeSlovom);
        $config["per_page"] = $this->ModelPesma->velicinaStranice;
        $config["uri_segment"] = 6;
        $this->postaviConfigZaPaginaciju($config);
        $this->pagination->initialize($config);

        $pocetniRedniBr = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;

        $data = array();
        $data["idZanr"] = $idZanr;
        $data["numere"] = $this->ModelPesma->dohvatiPesme($this->ModelPesma->velicinaStranice, $pocetniRedniBr, $idZanr, $idAutor, $pesmaPocinjeSlovom);
        $data["links"] = $this->pagination->create_links();
        $data["controller"] = "gost";
        $data["pocetniRedniBr"] = $pocetniRedniBr + 1;
        $this->prikazi("list.php", $data);
    }
    
    /**
     * Prikazivanje stranice sa listom izvodjaca koji su selektovani zadatim parametrima
     * 
     * @param string $imePocinjeSlovom kojim slovom pocinju imena autora koje treba prikazivati
     * @return void
     */
    public function izvodjaci($imePocinjeSlovom = 0) {
        $config = array();
        $config["base_url"] = base_url() . "/index.php/gost/izvodjaci/" . $imePocinjeSlovom . "/";
        $config["total_rows"] = $this->ModelAutor->brojAutora($imePocinjeSlovom); //broj autora
        $config["per_page"] = $this->ModelPesma->velicinaStranice;
        $config["uri_segment"] = 4;
        $this->postaviConfigZaPaginaciju($config);
        $this->pagination->initialize($config);

        $pocetniRedniBr = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data = array();
        $data["autori"] = $this->ModelAutor->dohvatiAutore($this->ModelPesma->velicinaStranice, $pocetniRedniBr, $imePocinjeSlovom);
        $data["links"] = $this->pagination->create_links();
        $data["controller"] = "gost";
        $data["pocetniRedniBr"] = $pocetniRedniBr + 1;
        $this->prikazi("izvodjaci.php", $data);
    }
    
    /**
     * Prikazivanje stranice za akorde
     * 
     * @param int $id id pesme koju treba prikazati
     * @return void
     */
    public function pesma($id) {
        $args = array();
        $args["pesma"] = $this->ModelPesma->dohvatiPesmu($id, TRUE);
        $args["controller"] = "Gost";
        $args["komentari"] = $this->ModelKomentar->dohvatiKomentareZaPesmu($id);
        $this->prikazi("pesma.php", $args);
    }
    
    /**
     * Logovanje korisnika na sistem 
     * (poziva se iz frontend dela i parametri se prosledjuju post metodom)
     * 
     * @return void
     */
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
    
    /**
     * Registrovanje novog korisnika 
     * (poziva se iz frontend dela i parametri se prosledjuju post metodom)
     * 
     * @return void
     */
    public function registrujse() {
        $this->form_validation->set_rules("username", "Korisničko ime", "required|min_length[8]|max_length[20]");
        $this->form_validation->set_rules("password", "Lozinka", "required|min_length[8]|max_length[20]");
        $this->form_validation->set_rules("confirmPassword", "Potvrda lozinke", "required|min_length[8]|max_length[20]");
        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno!");
        $this->form_validation->set_message("min_length", "Polje {field} mora imati najmanje 8 karaktera!");
        $this->form_validation->set_message("max_length", "Polje {field} ne sme imati više od 20 karaktera!");
        if ($this->form_validation->run()) {
            if ($this->ModelKorisnik->dohvatiKorisnika($this->input->post("username"))) {
                $this->registracija("Korisničko ime već postoji!");
            } elseif ($this->input->post("password") != $this->input->post("confirmPassword")) {
                $this->registracija("Unete lozike se ne poklapaju!");
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
