<?php
if (!defined('URL')) {
	header("location: /");
	exit();
}
?>

<main role="main">

	<?php
	if ($this->dados <> null) {
	?>

		<div class="cd-full-width mt-5 mb-3 ml-4 mr-4">
			<div class="container-fluid">
				<div class="tm-img-gallery-container">
					<div class="tm-img-gallery">
						<?php
						foreach ($this->dados as $pesquisa) {
							extract($pesquisa);
						?>
							<div class="grid-item">
								<figure class="effect-bubba">
									<a href="
										<?php
										if (isset($preco)) {
											echo URL . 'loja/visualizar/' . $id;
										} else {
											echo URL . 'galeria/visualizar/' . $id;
										}
										?>">
										<img src="
											<?php
											if (isset($preco)) {
												echo URL . 'assets/img/loja/' . $imagem;
											} else {
												echo URL . 'assets/img/galeria/' . $imagem;
											}
											?>" alt="<?= $titulo ?>" class="img-fluid tm-img" title="<?= $titulo ?>">
									</a>
								</figure>
							</div>
						<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>

	<?php
	} else {
		echo "<div class='container text-center mt-5 mb-4' style='height: 64vh'><h4>Nenhum resultado encontrado!</h4></div>";
	}
	?>

</main>