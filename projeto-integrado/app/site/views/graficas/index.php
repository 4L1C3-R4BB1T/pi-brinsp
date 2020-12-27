<?php
if (!defined('URL')) {
	header("location: /");
	exit();
}
?>

<main role="main">

	<div class="container mb-5 mt-5">
		<?php
		foreach ($this->dados['graficas'] as $graficas) {
			extract($graficas);
		?>
			<div class="graph">
				<a href="<?= URL . 'assets/img/graficas/' . $id . '/' . $imagem ?>">
					<img class="mr-4" src="<?= URL . 'assets/img/graficas/' . $id . '/' . $imagem ?>">
				</a>
				<div class="m-4">
					<p class="graph-name"><?= $nome ?></p>
					<hr>
					<img class="mr-2" src="https://img.icons8.com/metro/26/000000/phone.png"><?= $fone ?>
					<br />
					<img class="mr-2" src="https://img.icons8.com/ios-glyphs/30/000000/new-post.png"><?= $email ?>
					<p class="mt-3"><?= $endereco ?></p>
				</div>
			</div>
		<?php
		}
		?>
	</div>

</main>