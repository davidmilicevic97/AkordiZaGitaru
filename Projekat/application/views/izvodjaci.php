<!-- @author Ratko Amanović 2016/0061 -->
<!-- @author David Milićević 2016/0055 -->
<section class="page-section about-heading">
    <div class="container">
        <div class="about-heading-content">
            <div class="row ">
                <div class="col-xl-12 col-lg-12 mx-auto ">
                    <div class="bg-faded rounded p-5">
                        <div class ="row">
                            <div class="col-xl-9 ">
                                <?php
                                    echo "<ul class='list-group' style='clear: both; display: block;content: '';'>";
                                        foreach (array("A", "B", "C", "Č", "Ć", "D", "Dž", "Đ", "E",
                                            "F", "G", "H", "I", "J", "K", "L", "Lj", "M", "N", "Nj", "O",
                                            "P", "R", "S", "Š", "T", "U", "V", "Z", "Ž", "Q", "W", "X", "Y") as $pocetnoSlovo) {
                                            echo "<li class='list-group-item' style='float:left'  ><a href=". site_url("$controller/izvodjaci/"."$pocetnoSlovo") .">$pocetnoSlovo</a></li> ";
                                        }
                                    echo "</ul>";
                                ?>
                                <table class ="table table-striped table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope = 'col'>#</th>
                                            <th scope = 'col'>Autor</th>
                                            <?php
                                            if (isset($odobravanje)) {
                                                echo "<th scope = 'col'></th>";
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <?php
                                    if (isset($autori)) {
                                        $redniBr = $pocetniRedniBr;
                                        foreach ($autori as $autor) {
                                            echo "<tr>"
                                            . "<td scope = 'col'>" . $redniBr++ . "</td>"
                                            . "<td scope = 'col'><a href =" . site_url("$controller/muzika/0/") . $autor->id . ">" . $autor->naziv . "</a></td>";
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