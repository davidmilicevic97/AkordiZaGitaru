
<!---->  <section class="page-section about-heading">
    <div class="container">

        <div class="about-heading-content">
            <div class="row ">

                <div class="col-xl-12 col-lg-12 mx-auto ">
                    <div class="bg-faded rounded p-5">
                        <h2 class="section-heading mb-4">
                            <span class="section-heading-upper"><?php ?></span> <!--  if is set za tip numere-->
                           <!--  <span class="section-heading-lower">O nama</span>-->
                        </h2>
                        <!--<p>Mi smo trojica studenata Elektrotehničkog fakulteta koji ovaj sajt rade kao projekat iz predmeta Principi Softverskog Inženjerstva na trećoj godini studija.</p>
                        <p class="mb-0">D Bit tim čine : Ratko Amanović, David Milićević i Andrija Veljković. :')</p>-->
                        <div class ="row">
                            <div class="col-xl-9 ">

                                <?php
                                if (isset($komentari)) {
                                    foreach ($komentari as $komentar) {
                                        echo " 
                                            <div class ='row'>
                                                <div class ='col-xl-8'>
                                                    <div class='card'>
                                                        <div class='card-body'>
                                                            <div class='row'>
                                                                <div class='col-md-10'>
                                                                    <p class='float-left text-info' ><strong>" . $komentar->username . " (". $komentar->vreme .")</strong></p>
                                                                    <div class='clearfix'></div>
                                                                    <p>" . $komentar->text . "</p>
                                                                    <p>
                                                                       <a class='btn btn-primary' href=" . site_url("$controller/odobriKomentar/") . $komentar->id . ">Odobri</a>
                                                                       <a class='btn btn-primary' href=" . site_url("$controller/obrisiKomentar/") . $komentar->id . ">Obriši</a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <?php echo $links; ?>
                    </div>
                </div>
            </div>
            </section>