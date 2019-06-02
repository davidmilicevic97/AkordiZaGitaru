
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
                                <table class ="table table-striped table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope = 'col'>#</th>
                                            <th scope = 'col'>Autor</th>
                                            <th scope = 'col'>Delo</th>
                                            <?php
                                            if (isset($odobravanje)) {
                                                echo "<th scope = 'col'></th>";
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <?php
                                    if (isset($numere)) {
                                        $redniBr = $pocetniRedniBr;
                                        foreach ($numere as $numera) {
                                            echo "<tr>"
                                            . "<td scope = 'col'>" . $redniBr++ . "</td>"
                                            . "<td scope = 'col'>" . $numera->autor . "</td>"
                                            . "<td scope = 'col'><a href =" . site_url("$controller/pesma/") . $numera->id . ">" . $numera->naziv . "</a></td>";
                                            if (isset($odobravanje)) {
                                                echo "<td scope = 'col'><a class='btn btn-primary' href=" . site_url("$controller/pesma") . " '>Pregledaj</a></td>";
                                            }
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                </table>
                                
                                <?php echo $links; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>