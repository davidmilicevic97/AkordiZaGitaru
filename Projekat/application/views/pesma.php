
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
                                <!--<p>Mi smo trojica studenata Elektrotehničkog fakulteta koji ovaj sajt rade kao projekat iz predmeta Principi Softverskog Inženjerstva na trećoj godini studija.</p>
                                <p class="mb-0">D Bit tim čine : Ratko Amanović, David Milićević i Andrija Veljković. :')</p>-->
                                <?php
                                echo $pesma->putanjaDoAkorda;
                                ?> 
                            </div>
                            <div class ="col-xl-4">


                                <div class ="col-xl-12 ml-0 ">
                                    <center>
                                        <iframe  src= "<?php echo "$src"; ?>" ></iframe> <!-- $pesma->link da se ubaci-->
                                    </center>
                                </div>

                                <div class ="col-xl-12 mt-5 mx-auto">
                                    <script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/timer.js"></script>
                                    <center>
                                        <table>
                                            <tr>
                                                <td colspan="2" align = "center">
                                                    <strong>Metronom</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="button" value="Kreni" id="start" />
                                                </td>
                                                <td>
                                                    <input type="button" value="Zaustavi" id="stop" />
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
                                echo '
                         <div class ="row mt-2">
                                <div class = "col-xl-5">
                                    <div class="md-form">
                                        <strong>Dodaj komentar:</strong>
                                        <textarea id="form10" class="md-textarea form-control" rows="3"></textarea>
                                    </div>
                                </div>        
                        </div>               
                        <div class = "row">
                                <div class = "col-xl-1">
                                <form name="commentform" action="' . site_url("$controller/ostaviKomentar") . '" method="post">
                                           <button type="submit" class="btn btn-warning mt-1 mb-3""/>Pošalji</button></td>
                                        </form>     
                                </div>
                        </div>';
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
                                                <p>
                                                    <p class="float-left text-info" ><strong>' . $komentar->username . '</strong></p>
                                                </p>
                                                <div class="clearfix"></div>
                                                <p>' . $komentar->text . '</p>
                                                <p>

                                                </p>
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