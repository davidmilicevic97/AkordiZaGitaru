<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner text-center rounded">
                    <h2 class="section-heading mb-5">
                        <span class="section-heading-lower">Forma za dodavanje akorda:</span> 
                    </h2>
                    <form name="izmenaAkordaForm" action="<?php echo site_url("$controller/izmeniAkorde") ?>" method="post">
                        <input type = "hidden" name = "idPesme" value = "<?php echo $idPesme; ?>">
                        <input type = "hidden" name = "putanjaDoAkorda" value = "<?php echo $putanjaDoAkorda; ?>">
                        <table class = "table table-striped mt-5">
                            <tr>
                                <td>Autor/Bend:</td>
                                <td><input type = "text" name = "author" value="<?php echo $autor; ?>"></td>
                            </tr>
                            <tr>
                                <td>Naziv pesme:</td>
                                <td><input type = "text" name = "songName" value="<?php echo $nazivPesme; ?>"></td>
                            </tr>
                            <tr>
                                <td>Youtube link:</td>
                                <td><input type = "text" name = "ytLink" value="<?php echo $ytLink; ?>"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <select name = "zanrId">
                                        <?php 
                                           foreach ($zanrModel->dohvatiZanrove() as $zanr) {
                                               echo "<option value='".$zanr->id."'";
                                               if ($zanr->id == $zanrId) {
                                                   echo " selected = 'selected'";
                                               }
                                               echo ">";
                                               echo $zanr->tip;
                                               echo "</option><br/>";
                                           } 
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea rows="25" cols="70" name = "song"><?php echo file_get_contents($putanjaDoAkorda); ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><button type="submit" class="btn btn-primary" ">Izmeni akorde</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>