
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
                        <div class ="row">
                            <div class="col-xl-9 ">
                                <table class ="table table-striped table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" colspan="2">Korisnik</th>

                                        </tr>
                                    </thead>
                                    <?php
                                    if (isset($korisnici)) {
                                        foreach ($korisnici as $korisnik) {
                                            echo "<tr><td scope = 'col'>" . $korisnik->username . "</td>"
                                            . "<td scope = 'col'><form name='searchform' action='" . site_url("Admin/ukloniKorisnika") . "/" . $korisnik->id . "' method='post'>
                                           <button type='submit' class='btn btn-primary float-right'/>Potvrdi</button></form></td>
                                         </tr>";
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                            <div class ="col-xl-3 mx-auto">
                                <strong>Pretraga korisnika:</strong>
                                <form name="loginform" action="<?php echo site_url('Admin/uklanjanjeKorisnika') ?>" method="post"> <!-- umesto Gost ide admin-->
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="text" name="searchVal" value="<?php echo set_value('searchVal') ?>"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                <button type = "submit" class = "btn btn-primary" >Pretraga</button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                         <?php echo $links;?>
                    </div> 
                </div>
            </div>
            
        </div>
    </div>
</div>
</section>