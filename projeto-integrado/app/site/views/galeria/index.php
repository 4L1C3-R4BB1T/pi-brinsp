<?php
if (!defined('URL')) {
	header("location: /");
	exit();
}
?>

<main role="main">

	<div class="container text-center mt-4">
		<a href="
			<?php
			if (isset($_SESSION['usuario_nome'])) {
				echo URL . "galeria/addpost";
			} else {
				echo URL . "auth/auth";
			}
			?>">
			<button type='button' class='btn mr-3 sell' title='Envie sua obra!'>ENVIAR OBRA</button>
		</a>
	</div>

	<div class="row filtro mt-3 mb-3">
		<span class="mr-2">Filtrar por: </span>
		<a class="mr-1" href="<?= URL . 'galeria/listarPorTipo/1' ?>">Tradicional</a>
		<a class="mr-1" href="<?= URL . 'galeria/listarPorTipo/2' ?>">Digital</a>
		<a class="mr-1" href="<?= URL . 'galeria/listarPorTipo/3' ?>">Artesanato</a>
		<a href="<?= URL . 'galeria/listarPorTipo/4' ?>">Outros</a>
	</div>

	<div class="cd-full-width mt-2 mb-4 ml-4 mr-4">
		<div class="container-fluid">
			<div class="tm-img-gallery-container">
				<div class="tm-img-gallery">
					<?php
					foreach ($this->dados['imagens'] as $imagens) {
						extract($imagens);
					?>
						<div class="grid-item">
							<figure class="effect-bubba">
								<a href="<?= URL . 'galeria/visualizar/' . $id ?>">
									<img class="tm-img" src="<?= URL . 'assets/img/galeria/' . $imagem ?>" alt="<?= $titulo ?>" title="<?= $titulo ?>">
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

</main>