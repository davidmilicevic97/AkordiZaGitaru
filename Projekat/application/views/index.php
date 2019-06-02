
<section class="page-section clearfix">
    <div class="container">
        <div class="intro">
            <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="<?php echo base_url(); ?>assets/img/girl-with-guitar.jpg" alt="">
            <div class="intro-text left-0 text-center bg-faded p-5 rounded">
                <h2 class="section-heading mb-4">
                    <span class="section-heading-upper">najnovija muzika</span>
                    <span class="section-heading-lower">najkompletniji akordi</span>
                </h2>
                <p class="mb-3">D Bit ekipa se potrudila da muzičkim dušama pruži lagodnost prilikom sviranja, bili to početnici koji tek kreću da sviraju ili iskusni muzičari kojima nije na odmet da nauče neku novu pesmu.
                </p>
                <div class="intro-button mx-auto">
                    <a class="btn btn-primary btn-xl" href="<?php echo site_url("$controller/onama"); ?>">O nama</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner text-center rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-upper">Najpopularnije pesme</span>
                    </h2>
                    <table class ="table table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope = 'col'>#</th>
                                <th scope = 'col'>Autor</th>
                                <th scope = 'col'>Delo</th>
                                <th scope = 'col'>Broj pregleda</th>
                            </tr>
                        </thead>
                        <?php
                            $redniBr = 1;
                            foreach ($modelPesma->dohvatiNajpopularnijePesme(10) as $numera) {
                                echo "<tr>"
                                . "<td scope = 'col'>" . $redniBr++ . "</td>"
                                . "<td scope = 'col'>" . $numera->autor . "</td>"
                                . "<td scope = 'col'><a href =" . site_url("$controller/pesma/") . $numera->id . ">" . $numera->naziv . "</a></td>"
                                . "<td scope = 'col'>". $numera->brPregleda . "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


