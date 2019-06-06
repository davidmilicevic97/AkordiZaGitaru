<?php
/**
 * @author Ratko Amanović 2016/0061
 */

/**
 * Gost controller - klasa za funkcionalnosti moderatora
 * 
 * @version 1.0
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
    /**
     * Kreiranje index stranice za moderator kontroler
     * 
     * @return void
     */
    public function index() {
        $args = array();
        $args["controller"] = "Moderator";
        $args["modelPesma"] = $this->ModelPesma;
        $this->prikazi("index.php", $args);
    }

    /**
     * Prikazivanje stranice sa listom akorda koji nisu odobreni
     * 
     * @return void
     */
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
        $data["odobravanje"] = 1;
        $data["numere"] = $this->ModelPesma->dohvatiNeodobrenePesme($this->ModelPesma->velicinaStranice, $pocetniRedniBr);
        $data["links"] = $this->pagination->create_links();
        $data["controller"] = "moderator";
        $data["pocetniRedniBr"] = $pocetniRedniBr + 1;
        $this->prikazi("list.php", $data);
    }
    
    /**
     * Prikazivanje stranice sa listom komentara koji nisu odobreni
     * 
     * @return void
     */
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
        $this->load->view("header_moderator.php", $data);
        $this->load->view($glavniDeo, $data);
        $this->load->view("footer.php");
    }

    /**
     * Odjavljivanje trenutnog korisnika sa sistema
     * 
     * @return void
     */
    public function izlogujSe() {
        $this->session->unset_userdata("korisnik");
        $this->session->sess_destroy();
        redirect("Gost");
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
     * Prikazivanje stranice sa listom izvodjaca koji su selektovani zadatim parametrima
     * 
     * @param string $imePocinjeSlovom kojim slovom pocinju imena autora koje treba prikazivati
     * @return void
     */
    public function izvodjaci($imePocinjeSlovom = 0) {
        $config = array();
        $config["base_url"] = base_url() . "/index.php/moderator/izvodjaci/" . $imePocinjeSlovom . "/";
        $config["total_rows"] = $this->ModelAutor->brojAutora($imePocinjeSlovom); //broj autora
        $config["per_page"] = $this->ModelPesma->velicinaStranice;
        $config["uri_segment"] = 4;
        $this->postaviConfigZaPaginaciju($config);
        $this->pagination->initialize($config);

        $pocetniRedniBr = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data = array();
        $data["autori"] = $this->ModelAutor->dohvatiAutore($this->ModelPesma->velicinaStranice, $pocetniRedniBr, $imePocinjeSlovom);
        $data["links"] = $this->pagination->create_links();
        $data["controller"] = "moderator";
        $data["pocetniRedniBr"] = $pocetniRedniBr + 1;
        $this->prikazi("izvodjaci.php", $data);
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
        $config["base_url"] = base_url() . "/index.php/Moderator/muzika/" . $idZanr . "/" . $idAutor . "/" . $pesmaPocinjeSlovom . "/";
        $config["total_rows"] = $this->ModelPesma->brojPesama($idZanr, $idAutor, $pesmaPocinjeSlovom);
        $config["per_page"] = $this->ModelPesma->velicinaStranice;
        $config["uri_segment"] = 6;
        $this->postaviConfigZaPaginaciju($config);
        $this->pagination->initialize($config);

        $pocetniRedniBr = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;

        $data = array();
        $data["idZanr"] = $idZanr;
        $data["numere"] = $this->ModelPesma->dohvatiPesme($this->ModelPesma->velicinaStranice,
                $pocetniRedniBr, $idZanr, $idAutor, $pesmaPocinjeSlovom);
        $data["links"] = $this->pagination->create_links();
        $data["controller"] = "moderator";
        $data["pocetniRedniBr"] = $pocetniRedniBr + 1;
        $this->prikazi("list.php", $data);
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
        $args["komentari"] = $this->ModelKomentar->dohvatiKomentareZaPesmu($id);
        $args["controller"] = "moderator";
        $this->prikazi("pesma.php", $args);
    }

    /**
     * Odobravanje neodobrenog komentara
     * 
     * @return void
     */
    public function odobriKomentar($id) {
        $this->ModelKomentar->odobriKomentar($id);
        redirect("moderator/odobravanjeKomentara");
    }
    
    /**
     * Brisanje komentara iz baze
     * 
     * @return void
     */
    public function obrisiKomentar($id) {
        $this->ModelKomentar->obrisiKomentar($id);
        redirect("moderator/odobravanjeKomentara");
    }
    
    /**
     * Odobravanje neodobrene pesme u bazi
     * 
     * @return void
     */
    public function odobriPesmu($id) {
        $this->ModelPesma->odobriPesmu($id);
        redirect("moderator/odobravanjeAkorda");
    }

    /**
     * Brisanje pesme iz baze
     * 
     * @return void
     */
    public function obrisiPesmu($id) {
        $this->ModelPesma->obrisiPesmu($id);
        redirect("moderator/odobravanjeAkorda");
    }
    
    /**
     * Prikazivanje stranice za dodavanje novih akorda
     * 
     * @return void
     */
    public function dodajAkordePrikaz() {
        $args = array();
        $args["controller"] = "moderator";
        $this->prikazi("dodaj_akorde.php", $args);
    }

    /**
     * Dohvatanje id-ja autora sa zadatim imenom ili kreiranje novog autora ukoliko ne postoji
     * 
     * @param string $autor naziv autora
     * @return int
     */
    private function dohvatiAutorIdIliDodaj($autor) {
        $id = $this->ModelAutor->dohvatiId($autor);
        if ($id != null) {
            return $id;
        }
        $this->db->set("naziv", $autor)->insert("autor");
        $id = $this->ModelAutor->dohvatiId($autor);
        return $id;
    }
    
    /**
     * Dodavanje novih akorda 
     * (poziva se iz frontend dela i parametri se prosledjuju post metodom)
     * 
     * @return void
     */
    public function dodajAkorde() {
        $korisnikId = $this->session->userdata('korisnik')->id;
        
        $autor = $this->input->post("author");
        $nazivPesme = $this->input->post("songName");
        $ytLink = $this->input->post("ytLink");
        $textPesme = $this->input->post("song");
        $zanrId = $this->input->post("zanrId");
        $autorId = $this->dohvatiAutorIdIliDodaj($autor);  
        
        $folderPath = $this->input->server("DOCUMENT_ROOT")."/akordiFolder";
        $currTime = round(microtime(true) * 1000);
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
        $putanjaDoAkorda = $folderPath."/akordi_".
                $this->session->userdata("korisnik")->username."_".$currTime;
        file_put_contents($putanjaDoAkorda, $textPesme);
                
        $this->ModelPesma->dodajPesmu($nazivPesme, $putanjaDoAkorda, $ytLink, 
                $zanrId, $autorId, $korisnikId);
        redirect("Moderator");
    }

    /**
     * Prikazivanje stranice sa akordima koje je kreirao trenutno ulogovani korisnik
     * 
     * @return void
     */
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

    /**
     * Prikazivanje stranice za izmenu akorda za konkretnu pesmu
     * 
     * @param int $idPesme id pesme koju treba izmeniti
     * @return void
     */
    public function pesmaZaKorisnika($idPesme) {
        $pesma = $this->ModelPesma->dohvatiPesmu($idPesme, FALSE);

        $args = array();
        $args["autor"] = $this->ModelAutor->dohvatiImeAutora($pesma->idAutor);
        $args["idPesme"] = $idPesme;
        $args["nazivPesme"] = $pesma->naziv;
        $args["ytLink"] = $pesma->ytLink;
        $args["zanrId"] = $pesma->idZanr;
        $args["putanjaDoAkorda"] = $pesma->putanjaDoAkorda;
        $args["controller"] = "moderator";
        $this->prikazi("izmeni_akorde.php", $args);
    }

    /**
     * Izmena vec postojecih akorda
     * (poziva se iz frontend dela i parametri se prosledjuju post metodom)
     * 
     * @return void
     */
    public function izmeniAkorde() {
        $idPesme = $this->input->post("idPesme");
        $putanjaDoAkorda = $this->input->post("putanjaDoAkorda");
        $autor = $this->input->post("author");
        $nazivPesme = $this->input->post("songName");
        $ytLink = $this->input->post("ytLink");
        $textPesme = $this->input->post("song");
        $zanrId = $this->input->post("zanrId");
        $autorId = $this->dohvatiAutorIdIliDodaj($autor);

        file_put_contents($putanjaDoAkorda, $textPesme);
        $this->ModelPesma->promeniPesmu($idPesme, $nazivPesme, $putanjaDoAkorda, 
                $ytLink, $zanrId, $autorId);
        redirect("Moderator");
    }

    /**
     * Cuvanje komentara 
     * (poziva se iz frontend dela i parametri se prosledjuju post metodom)
     * 
     * @return void
     */
    public function ostaviKomentar() {
        $text = $this->input->post("komentarTekst");
        $idPes = $this->input->post("idPesme");
        $idKor = $this->session->userdata("korisnik")->id;
        $this->ModelKomentar->dodajKomentar($text, $idPes, $idKor);
        redirect("moderator/pesma/" . $idPes);
    }

}
