
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
                                  echo $pesma->sadrzaj;
                                ?> 
                            </div>
                            <div class ="col-xl-4">

                                <div class ="col-xl-12 ml-0">
                                    <iframe  src= "<?php echo "$src"; ?>" ></iframe> <!-- $pesma->link da se ubaci-->
                                </div>

                                <div class ="col-xl-12 mt-5">
                                    <script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/timer.js"></script>
                                    <input type="button" value="start countdown" id="start" />
                                    <input type="button" value="stop countdown" id="stop" />
                                    <input type="text" value="" id="time" />
                                </div>
                                <div class ="col-xl-12 mt-2">
                                    Ukupno puta pregledano: &nbsp; <!--<?php echo $pesma->brojac ?>">-->
                                </div>
                            </div>
                        </div>
                        <?php
                            if(isset($controller)){
                                if ($controller != "Gost"){
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
                                <form name="commentform" action="'.site_url("$controller/ostaviKomentar").'" method="post">
                                           <button type="submit" class="btn btn-warning mt-1 mb-3""/>Pošalji</button></td>
                                        </form>     
                                </div>
                        </div>'; 
                                }
                            } ?>
                        
                        <?php 
                        if (isset($komentari)){
                            foreach ($komentari as $komentar){
                        echo ' 
                        <div class ="row">
                            <div class ="col-xl-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <p>
                                                    <p class="float-left text-info" ><strong>'.$komentar->ime.'</strong></p>
                                                </p>
                                                <div class="clearfix"></div>
                                                <p>'.$komentar->tekst.'</p>
                                                <p>

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';}} ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>