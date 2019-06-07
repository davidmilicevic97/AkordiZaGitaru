<!DOCTYPE html>
<!-- @author Andrija Veljković 2016/0328 -->
<!-- @author Ratko Amanović 2016/0061 -->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Index</title>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/music_notes_png91_JXD_icon.ico"/>
        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom fonts for this template -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?php echo base_url(); ?>assets/css/business-casual.min.css" rel="stylesheet">
    </head>

    <body>
        <h1 class="site-heading text-center text-white d-none d-lg-block">
            <span class="site-heading-upper text-primary mb-3">D Bit tim · PSI Projekat · ETF Beograd</span>
            <span class="site-heading-lower">Akordi za gitaru</span>
            <span class="site-heading-upper text-primary mt-3"><?php echo $this->session->userdata('korisnik')->username ?> (moderator)</span>
        </h1>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
            <div class="container">
                <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Akordi Za Gitaru</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item active px-lg-4">
                            <a class="nav-link text-uppercase text-expanded" href="<?php echo site_url("Moderator/index"); ?>">Početna
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item px-lg-4 dropdown">
                            <a class="nav-link text-uppercase text-expanded dropdown-toggle" data-toggle="dropdown"  href="#">Žanrovi</a> 
                            <ul class="dropdown-menu" role = "menu"  aria-labelledby="dLabel">
                                <li class="dropdown-item"><a href="<?php echo site_url("Moderator/muzika/") ?>">Svi zanrovi</a></li>
                                <?php
                                foreach ($zanrModel->dohvatiZanrove() as $zanr) {
                                    echo "<li class='dropdown-item'><a href='";
                                    echo site_url("Moderator/muzika/") . $zanr->id;
                                    echo "'>";
                                    echo $zanr->tip;
                                    echo "</a></li>";
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="nav-item px-lg-4">
                            <a class="nav-link text-uppercase text-expanded" href="<?php echo site_url("Moderator/izvodjaci"); ?>">Izvođači</a>
                        </li>
                        <li class="nav-item px-lg-4">
                            <a class="nav-link text-uppercase text-expanded" href="<?php echo site_url("Moderator/dodajAkordePrikaz"); ?>">Dodaj akorde</a>
                        </li>
                        <li class="nav-item px-lg-4">
                            <a class="nav-link text-uppercase text-expanded" href="<?php echo site_url("Moderator/mojiAkordiPrikaz"); ?>">Moji akordi</a>
                        </li>
                        <li class="nav-item px-lg-4 dropdown">
                            <a class="nav-link text-uppercase text-expanded dropdown-toggle" data-toggle="dropdown"  href="#">Opcije moderatora</a> 
                            <ul class="dropdown-menu" role = "menu"  aria-labelledby="dLabel">
                                <li class="dropdown-item"><a href="<?php echo site_url("Moderator/odobravanjeAkorda"); ?>">Odobravanje akorda</a></li>
                                <li class="dropdown-item"><a href="<?php echo site_url("Moderator/odobravanjeKomentara"); ?>">Odobravanje komentara</a></li>
                            </ul>
                        </li>
                        <li class="nav-item px-lg-4">
                            <a class="nav-link text-uppercase text-expanded" href="<?php echo site_url("Moderator/onama"); ?>">O Nama</a>
                        </li>
                        <li class="nav-item px-lg-4">
                            <a class="nav-link text-uppercase text-expanded" href="<?php echo site_url("Moderator/izlogujSe"); ?>">Izloguj se</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
