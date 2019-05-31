<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Gost extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function odobravanjeModeratora() { //obratiti paznju da ne treba slati ljude koji su vec moderator
        $kor = new stdClass();
        $kor->ime = "andrija";
        $kor->id = 5;

        $this->index("odobravanje_moderatora", ["controller" => "Gost", "korisnici" => array($kor)]);
    }

    public function index($page = "index.php", $args = null) {
        $this->load->view("header_admin.php");
        $this->load->view($page, $args);
        $this->load->view("footer.php");
    }

    public function odobravanjeAkorda() {
        $this->muzika();
    }

    public function odobravanjeKomentara() {
        $kom1 = new stdClass();
        $kom2 = new stdClass();
        $kom3 = new stdClass();
        $kom1->ime = "andrija";
        $kom2->ime = "zića";
        $kom3->ime = "mali";
        $kom1->tekst = "kom1";
        $kom2->tekst = "av av ";
        $kom3->tekst = "kom1";
        $arr = array($kom1, $kom2, $kom3);
        $this->index("comment_list.php", ["controller" => "Gost", "trenStr" => "", "ukupnoStr" => "2", "komentari" => $arr]);
    }

    public function statistika() {
        $this->muzika();
    }

    public function login() {
        $this->index("login.php");
    }

    public function registracija() {
        $this->index("registracija.php");
    }

    public function izlogujSe() {
        
    }

    public function ulogujse() {
        
    }

    public function onama() {
        $this->index("onama.php");
    }

    public function muzika($args = null) { //ovi argumenti predstavljaju sta treba prikazati i redni broj u bazi
        $pesma = new stdClass();
        $pesma->autor = "ja";
        $pesma->delo = "on";
        $pesma->id = 1;
        $arr = array($pesma);
        $this->index("list.php", ["controller" => "Gost", "trenStr" => "2", "ukupnoStr" => "2", "numere" => $arr, "odobravanje" => "true"]);
    }

    public function podesavanjaPrikaz() {
        $this->index("podesavanja.php");
    }

    public function primeniPodesavanja() {
        
    }

    public function dodajAkordePrikaz() {
        $this->index("dodaj_akorde.php");
    }

    public function dodajAkordeUDB() {
        $pesma = new stdClass();
        $pesma->autor = "Autor";
    }

    public function pesma() {
        $obj = new stdClass();
        $obj->autor = "Andrija Veljkovic";
        $obj->naziv = "Lene"; // mora da se sredi parsiranje teksta, ubacivanje <br>, mozda sa split, zavisi kako se u bazi cuva
        $obj->sadrzaj = "

Λένε πως είδαν να γυρίζεις νύχτα<br> 
Την άσφαλτο να σκίζεις<br>
Λένε πως ζεις ευτυχισμένη<br>
και δε θυμάσαι εδώ ποιος μένει<br>
 
Λένε πως βγαίνεις με γνωστούς μας<br>
Λένε πως και στους αυτούς μας<br>
μέσα στο συφερτό του κόσμου<br>
ζεις εσύ, κι ο καημός δικός μου<br>
 
Λίγη καρδιά να ξερα να βάλω<br>
Λίγη καρδιά στο κορμί σου απάνω<br>
Λίγη καρδιά και μια στάλια μνήμη<br>
Λίγη, μήπως στη διαδρομή σου τύχει<br>
και θυμηθείς ποια ήσουν<br>
 
Λένε πως είδαν να χορεύεις νύχτα<br>
με τη φωτιά να παίζεις<br>
σπίρτο στα μάτια όλου του κόσμου<br>
μα δε σε καίει ο πυρετός<br>
 
Λένε πως σ’ είδαν ζαλισμένη<br>
Λένε, με τα άστρα αγκαλιασμένη ζήσε<br>
ο ουρανός σου ανήκει<br>
Ξέρω εγώ, μια ζωή στο νοίκι<br>
 
Λίγη καρδιά να ξερα να βάλω<br>
Λίγη καρδιά στο κορμί σου απάνω<br>
Λίγη καρδιά και μια στάλια μνήμη<br>
Λίγη, μήπως στη διαδρομή σου τύχει<br>
και θυμηθείς ποια ήσουν<br>
 
Άκουσε πως χτυπάει<br>
άκουσε, απ’ τα βάθυ μου έρχεται<br>
και με κυβερνά<br>
 
Άγνωστος, ξέρω είναι<br>
άγνωστος ήχος πια για σένανε<br>
μα είναι η καρδιά<br>";
        $src = "https://www.youtube.com/embed/0MG4703Kexs";
        $controller = "nijeGost"; //gost nema pravo da ostavlja komentar!
        $kom1 = new stdClass();
        $kom2 = new stdClass();
        $kom3 = new stdClass();
        $kom1->ime = "andrija";
        $kom2->ime = "zića";
        $kom3->ime = "mali";
        $kom1->tekst = "kom1";
        $kom2->tekst = "av av ";
        $kom3->tekst = "kom1";
        $this->index("pesma.php", ["pesma" => $obj, "src" => $src, "controller" => $controller, "komentari" => array($kom1, $kom2, $kom3)]);
    }

}
