<?php
if (!defined('URL')) {
	header("location: /");
	exit();
}
?>

<main role="main">

	<div class="container mt-5 p-0">
		<div class="row">
			<?php
			$umPost = $this->dados['post'][0];
			extract($umPost);
			?>
			<div class="col-12 col-md-5 mt-3 container-img">
				<img class="imgpost" src="<?= URL . 'assets/img/galeria/' . $imagem ?>">
			</div>
			<div class="col-12 col-md-5 mt-3">
				<div class="product-information">
					<h2><?= $titulo ?></h2>
					<p class="mt-4"><?= $descricao ?></p>
					<p class="mt-4">Tipo de arte: <?= $tp ?></p>
					<p>Por:
						<a href="<?= URL . 'user/visualizar/' . $usuario ?>"><?= $nome ?></a>
					</p>
				</div>
			</div>

			<div class="col-12 col-md-2 mt-3 mb-5 text-center">
				<div>
					<h4 class="font-italic mb-4">Recentes</h4>
					<ol class="list-unstyled mb-0">
						<?php
						foreach ($this->dados['postRecentes'] as $recente) {
							extract($recente);
						?>
							<li class="mb-4">
								<a href="<?= URL . 'galeria/visualizar/' . $id ?>">
									<img class="imgrec" src="<?= URL . 'assets/img/galeria/' . $imagem ?>">
								</a>
							</li>
						<?php
						}
						?>
					</ol>
				</div>
			</div>
		</div>
	</div>

</main>