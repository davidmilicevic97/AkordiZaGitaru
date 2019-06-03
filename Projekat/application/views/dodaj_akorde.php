<!-- @author Andrija Veljković 2016/0328 -->
<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner text-center rounded">
                    <h2 class="section-heading mb-5">
                        <span class="section-heading-lower">Forma za dodavanje akorda:</span> 
                    </h2>
                    <form name="dodavanjeAkordaForm" action="<?php echo site_url("$controller/dodajAkorde") ?>" method="post">
                        <table class = "table table-striped mt-5">
                            <tr>
                                <td>Autor/Bend:</td>
                                <td><input type = "text" name = "author"></td>
                            </tr>
                            <tr>
                                <td>Naziv pesme:</td>
                                <td><input type = "text" name = "songName"></td>
                            </tr>
                            <tr>
                                <td>Youtube link:</td>
                                <td><input type = "text" name = "ytLink"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <select name = "zanrId">
                                        <?php
                                        foreach ($zanrModel->dohvatiZanrove() as $zanr) {
                                            echo "<option value='" . $zanr->id . "'>";
                                            echo $zanr->tip;
                                            echo "</option><br/>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea rows="25" cols="70" name = "song" placeholder="Ovde uneti tekst i akorde pesme..."></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><button type="submit" class="btn btn-primary" ">Dodaj akorde</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>