<?php
if (!defined('URL')) {
    header("location: /");
    exit();
}
?>

<main role="main">

    <div class="container marketing">
        <hr class="featurette-divider">
        <h2 class="display-4 text-center">Quem Somos</h2>
        <hr class="featurette-divider">
        <?php
        $cont = 0;
        $anima = array('anima_left', 'anima_bottom', 'anima_right');
        foreach ($this->dados['quemsomos'] as $quemsomos) {
            extract($quemsomos);
            $ordem[0] = ($cont % 2 == 0) ? "order-md-2" : "";
            $ordem[1] = ($cont % 2 == 0) ? "order-md-1" : "";
        ?>
            <div class="row featurette">
                <div class="col-md-7 <?= $ordem[0] ?> <?= $anima[0] ?>">
                    <h2 class="featurette-heading"><?= $titulo ?></h2>
                    <p class="lead"><?= $descricao ?></p>
                </div>
                <div class="col-md-5 <?= $ordem[1] ?> <?= $anima[0] ?>">
                    <img class="featurette-image img-fluid mx-auto rounded" src="<?= URL . 'assets/img/quemsomos/' . $id . '/' . $imagem ?>" alt="<?= $titulo ?>" title="<?= $titulo ?>">
                </div>
            </div>
            <hr class="featurette-divider">
        <?php
            $cont++;
        } ?>
    </div>

</main>