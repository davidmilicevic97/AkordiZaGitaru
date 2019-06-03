<!-- @author Andrija Veljković 2016/0328 -->
<!-- @author David Milićević 2016/0055 -->
<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner text-center rounded">
                    <h2 class="section-heading mb-5">
                        <span class="section-heading-lower">Forma za registraciju:</span> 
                    </h2>
                    <form name="loginform" action="<?php echo site_url('Gost/registrujse') ?>" method="post">
                        <?php
                        if (isset($poruka))
                            echo "<font color='red'>$poruka</font><br>";
                        ?>
                        <table class = "table table-striped mt-5">
                            <tr>
                                <td>Korisničko ime:</td>
                                <td><input type = "text" name = "username" value="<?php echo set_value('username') ?>"></td>
                                <td><?php echo form_error("username", "<font color='red'>", "</font>"); ?></td>                           
                            </tr>
                            <tr>
                                <td>Lozinka:</td>
                                <td><input type = "password" name = "password"></td>
                                <td><?php echo form_error("password", "<font color='red'>", "</font>"); ?></td>
                            </tr>
                            <tr>
                                <td>Potvrda lozinke:</td>
                                <td><input type = "password" name = "confirmPassword"></td>
                                <td><?php echo form_error("confirmPassword", "<font color='red'>", "</font>"); ?></td>
                            </tr>
                            <tr>
                                <td colspan="3"><button type="submit" class="btn btn-primary" ">Registruj se</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>