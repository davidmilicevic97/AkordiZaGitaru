<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner text-center rounded">
                    <h2 class="section-heading mb-5">
                        <span class="section-heading-lower">Podešavanja:</span> 
                    </h2>
                    <form name="loginform" action="<?php echo site_url('Gost/primeniPodesavanja') ?>" method="post">
                        <?php
                        if (isset($poruka))
                            echo "<font color='red'>$poruka</font><br>";
                        ?>
                        <table class = "table table-striped mt-5">
                            <tr>
                                <td colspan="2">
                                    Promena korisničkog imena
                                </td>
                            </tr>
                            <tr>
                                <td>Novo korisničko ime</td>
                                <td><input type = "text" name = "user"></td>
                            </tr>
                            <tr>
                                <td>
                                    Prijava za mejling listu
                                </td>
                                <td>
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                </td>
                            </tr>
                            <td colspan="2"><button type="submit" class="btn btn-primary" ">Primeni</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>