
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
                                        $id = 1;
                                        foreach ($numere as $numera) {
                                            echo "<tr>"
                                            . "<td scope = 'col'>" . $id++ . "</td>"
                                            . "<td scope = 'col'>" . $numera->autor . "</td>"
                                            . "<td scope = 'col'><a href =" . site_url("$controller/pesma") . "?id=" . $numera->id . ">" . $numera->delo . "</a></td>";
                                            if (isset($odobravanje)) {
                                                echo "<td scope = 'col'><a class='btn btn-primary' href=" . site_url("$controller/pesma") . " '>Pregledaj</a></td>";
                                            }
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
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