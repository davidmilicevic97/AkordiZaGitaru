
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
                                        echo ' 
                        <div class ="row">
                            <div class ="col-xl-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <p>
                                                    <p class="float-left text-info" ><strong>' . $komentar->ime . '</strong></p>
                                                </p>
                                                <div class="clearfix"></div>
                                                <p>' . $komentar->tekst . '</p>
                                                <p>
                                                   <button type="submit" class="btn btn-warning" name = "odobri">Odobri</button>
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
                                <div class ="row">
                                    <div class ="col-xl-7">
                                        <form action ="<?php echo site_url("$controller/muzika");
                                ?>" method = "post">
                                            <button type="submit" class="btn btn-warning" name = "prva"> <!-- mozes preko post metoda proveriti sta je pritisnuto -->
                                                Prva</button>
                                            <button type="submit" class="btn btn-warning" name = "prethodna"
                                            <?php
                                            if (isset($trenStr)) {
                                                if ($trenStr == 1) {
                                                    echo "disabled";
                                                }
                                            }
                                            ?>
                                                    >
                                                Prethodna</button>
                                            <button type="submit" class="btn btn-warning" name = "sledeca"
                                            <?php
                                            if (isset($trenStr) && isset($ukupnoStr)) {
                                                if ($trenStr == $ukupnoStr) {
                                                    echo "disabled";
                                                }
                                            }
                                            ?>
                                                    >
                                                Sledeća</button>  <!-- vidi da li treba skok na stranicu da se uradi-->                
                                        </form>
                                    </div>
                                    <div class ="col-xl-2 text-right">
                                        <?php
                                        if (isset($trenStr)) {
                                            echo $trenStr;
                                        } else {
                                            echo "?";
                                        }
                                        echo "/";
                                        if (isset($ukupnoStr)) {
                                            echo $ukupnoStr;
                                        } else {
                                            echo "?";
                                        }
                                        ?>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </section>