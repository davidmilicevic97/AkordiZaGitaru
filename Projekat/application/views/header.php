

<!DOCTYPE html>
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
                            <a class="nav-link text-uppercase text-expanded" href="<?php echo site_url("Gost/index"); ?>">Početna
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item px-lg-4 dropdown">
                            <a class="nav-link text-uppercase text-expanded dropdown-toggle" data-toggle="dropdown"  href="#">Žanrovi</a> 
                            <ul class="dropdown-menu" role = "menu"  aria-labelledby="dLabel">
                                <li class="dropdown-item"><a href="<?php echo site_url("Gost/muzika/") ?>">Svi zanrovi</a></li>
                                <li class="dropdown-item"><a href="<?php echo site_url("Gost/muzika/") . strval($zanrModel->dohvatiId("Rokenrol")); ?>">Rokenrol</a></li>
                                <li class="dropdown-item"><a href="<?php echo site_url("Gost/muzika/") . strval($zanrModel->dohvatiId("Pank rok")); ?>">Pank rok</a></li>
                                <li class="dropdown-item"><a href="<?php echo site_url("Gost/muzika/") . strval($zanrModel->dohvatiId("Bluz")); ?>">Bluz</a></li>
                                <li class="dropdown-item"><a href="<?php echo site_url("Gost/muzika/") . strval($zanrModel->dohvatiId("Narodna")); ?>">Narodna</a></li>
                                <li class="dropdown-item"><a href="<?php echo site_url("Gost/muzika/") . strval($zanrModel->dohvatiId("Estradna")); ?>">Estradna</a></li>
                            </ul>
                        </li>
                        <li class="nav-item px-lg-4">
                            <a class="nav-link text-uppercase text-expanded" href="<?php echo site_url("Gost/izvodjaci"); ?>">Izvođači</a>
                        </li>
                        <li class="nav-item px-lg-4">
                            <a class="nav-link text-uppercase text-expanded" href="<?php echo site_url("Gost/onama"); ?>">O Nama</a>
                        </li>
                        <li class="nav-item px-lg-4">
                            <a class="nav-link text-uppercase text-expanded" href="<?php echo site_url("Gost/login"); ?>">Uloguj se</a>
                        </li>
                        <li class="nav-item px-lg-4">
                            <a class="nav-link text-uppercase text-expanded" href="<?php echo site_url("Gost/registracija"); ?>">Registracija</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
