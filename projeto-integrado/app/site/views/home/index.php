<?php
if (!defined('URL')) {
	header("location: /");
	exit();
}
?>

<main role="main">

	<?php
	if (isset($_SESSION['msg'])) {
		echo $_SESSION['msg'];
		unset($_SESSION['msg']);
	}
	?>

	<div id="myCarousel" class="carousel slide mb-5" data-ride="carousel">
		<ol class="carousel-indicators">
			<?php
			$count = count($this->dados['carousel']);
			for ($i = 0; $i < $count; $i++) {
			?>
				<li data-target="#myCarousel" data-slide-to="<?= $i ?>" 
					<?php if ($i == 0) echo "class='active'"; ?>>
				</li>
			<?php
			}
			?>
		</ol>
		<div class="carousel-inner">
			<?php
			$cont = 0;
			foreach ($this->dados['carousel'] as $carousel) {
				extract($carousel);
			?>
				<div class="carousel-item 
				<?php
				if ($cont == 0) echo "active";
				?>">
					<img class="d-block w-100" src="<?= URL . '/assets/img/carousel/' . $id . '/' . $imagem ?>" alt="First slide">
				</div>
			<?php
				$cont++;
			}
			?>
		</div>
	</div>

	<div class="col-11 col-md-12 text-center ml-md-0 ml-2">
		<p class="comunity">
			<img src="<?= URL ?>assets/img/home/art.png" height="110">
			Junte-se a nós!
		</p>
	</div>

	<hr class="mt-5">

	<p class="text-center mt-4 topic-title">Adicionados Recentemente</p>
	<div class="cd-full-width mt-4 ml-2 mr-2">
		<div class="container-fluid">
			<div class="tm-img-gallery-container">
				<div class="tm-img-gallery">
					<?php
					$cont = 0;
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
						$cont++;
					}
					?>
				</div>
			</div>
		</div>
	</div>

	<hr class="mt-5">

	<p class="text-center mt-4 topic-title">Mais Populares</p>
	<div class="cd-full-width mt-4 mb-5 ml-2 mr-2">
		<div class="container-fluid" data-page-no="1" data-page-type="gallery">
			<div class="tm-img-gallery-container">
				<div class="tm-img-gallery">
					<?php
					$cont = 0;
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
						$cont++;
					}
					?>
				</div>
			</div>
		</div>
	</div>

</main>