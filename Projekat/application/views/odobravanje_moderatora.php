
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
                                    <th scope="col" colspan="2">Korisnik</th>
                                 
                                </tr>
                            </thead>
                            <?php
                            if (isset($korisnici)){
                            foreach ($korisnici as $korisnik) {
                            echo "<tr><td scope = 'col'>".$korisnik->ime."</td>"
                                    . "<td scope = 'col'><form name='searchform' action='".site_url("$controller/pretragaModeratora")."/".$korisnik->id."' method='post'>
                                           <button type='submit' class='btn btn-primary float-right'/>Potvrdi</button></form></td>
                                         </tr>";
                            }
                            
                            }
                            ?>
                        </table>
                    </div>
                    <div class ="col-xl-3">
                        <strong>Pretraga korisnika:</strong>
                        <form name="loginform" action="<?php echo site_url('Gost/pretragaKorisnika') ?>" method="post"> <!-- umesto Gost ide admin-->
                            <input type="text" name="searchVal" value="<?php echo set_value('searchVal') ?>"/>
                            <button type = "submit" class = "btn btn-success" >Pretraga</button>
                        </form>
                    </div>
                </div>
                <div class ="row">
                <div class ="col-xl-7">
                    <form action ="<?php  echo site_url("$controller/odobravanjeModeratora");?>" method = "post">
                        <button type="submit" class="btn btn-warning" name = "prva"> <!-- mozes preko post metoda proveriti sta je pritisnuto -->
                            Prva</button>
                        <button type="submit" class="btn btn-warning" name = "prethodna"
                                <?php
                                    if (isset($trenStr)){
                                        if ($trenStr == 1){
                                            echo "disabled";
                                        }
                                    }
                                ?>
                                >
                            Prethodna</button>
                        <button type="submit" class="btn btn-warning" name = "sledeca"
                                <?php
                                    if (isset($trenStr) && isset($ukupnoStr)){
                                        if ($trenStr == $ukupnoStr){
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
                                    if (isset($trenStr)){
                                            echo $trenStr;
                                    }else {echo "?";}
                                            echo "/";
                                    if (isset($ukupnoStr)){
                                            echo $ukupnoStr;
                                    }else {echo "?";}        
                                ?>
                </div>
                    </div> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>