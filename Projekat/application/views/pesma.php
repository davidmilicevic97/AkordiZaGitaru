
<!---->  <section class="page-section about-heading">
    <div class="container">

        <div class="about-heading-content">
            <div class="row ">
                <div class="col-xl-12 col-lg-12 mx-auto ">
                    <div class="bg-faded rounded p-5">
                        <h2 class="section-heading mb-4">
                            <!--<span class="section-heading-upper">Dobar sajt, dobar posao</span>
                            <span class="section-heading-lower">O nama</span>-->
                            <span class="section-heading-upper"><?php echo $pesma->autor ?></span>
                            <span class="section-heading-lower"><?php echo $pesma->naziv ?></span>
                        </h2>

                        <div class ="row">
                            <div class ="col-xl-8 text-justify">
                                <?php
                                echo $pesma->putanjaDoAkorda;
                                ?> 
                            </div>
                            <div class ="col-xl-4">

                                <?php
                                    $ytLinkHeaders = @get_headers($pesma->ytLink);
                                    if ($ytLinkHeaders && $ytLinkHeaders[0] != "HTTP/1.1 404 Not Found") {
                                ?>
                                        <div class ="col-xl-12 ml-0 ">
                                            <center>
                                                <iframe src= "<?php echo $pesma->ytLink; ?>" ></iframe> <!-- $pesma->link da se ubaci-->
                                            </center>
                                        </div>
                                <?php
                                    }
                                ?>
                                <div class ="col-xl-12 mt-5 mx-auto">
                                    <script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/timer.js"></script>
                                    <center>
                                        <table>
                                            <?php
                                            if ($this->session->userdata('korisnik') != null) {
                                                if ($this->session->userdata('korisnik')->tip == 'moderator') {
                                                    echo "<tr>";
                                                    if ($pesma->stanje == 'neodobrena') {
                                                        echo " <td>
                                                            <a class='btn btn-primary' href=" . site_url("$controller/odobriPesmu/") . $pesma->id . ">Odobri</a>
                                                          </td>";
                                                    }
                                                    echo "<td>
                                                            <a class='btn btn-primary' href=" . site_url("$controller/obrisiPesmu/") . $pesma->id . ">Obriši</a>
                                                        </td>
                                                     </tr>";
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="2" align = "center">
                                                    <strong>Metronom</strong> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input class="btn btn-primary" type="button" value="Kreni" id="start" />
                                                </td>
                                                <td>
                                                    <input class="btn btn-primary" type="button" value="Zaustavi" id="stop" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" align = "center">
                                                    Period: 
                                                    <input type="text" value="" id="time" maxlength="4" size="4" />
                                                    ms
                                                </td>    
                                            </tr>
                                        </table>
                                    </center>
                                </div>

                                <div class ="col-xl-12 mt-2 justify-content-center mx-auto">
                                    <center>
                                        Ukupno puta pregledano: &nbsp; <?php echo $pesma->brPregleda ?>
                                    </center>
                                </div>

                            </div>
                        </div>
                        <?php
                        if (isset($controller)) {
                            if ($controller != "Gost") {
                                ?>
                                <form name="commentform" action="<?php echo site_url("$controller/ostaviKomentar"); ?>" method="post">
                                    <input type = "hidden" name = "idPesme" value = "<?php echo $pesma->id; ?>"> 
                                      <div class ="row mt-2">
                                        <div class = "col-xl-5">
                                            <div class="md-form">
                                                <strong>Dodaj komentar:</strong>
                                                <textarea name="komentarTekst" class="md-textarea form-control" rows="3"></textarea>
                                            </div>
                                        </div>        
                                    </div>               
                                    <div class = "row">
                                        <div class = "col-xl-1">
                                            <button type="submit" class="btn btn-primary mt-1 mb-3"/>Pošalji</button></td>
                                        </div>
                                    </div>
                                </form> 
                                <?php
                            }
                        }
                        ?>

                        <?php
                        if (isset($komentari)) {
                            foreach ($komentari as $komentar) {
                                echo ' 
                        <div class ="row">
                            <div class ="col-xl-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <p class="float-left text-info" ><strong>' . $komentar->username . ' ('. $komentar->vreme .')</strong></p>
                                                <div class="clearfix"></div>
                                                <p>' . $komentar->text . '</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>