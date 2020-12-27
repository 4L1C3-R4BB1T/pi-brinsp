<?php
if (!defined('URL')) {
	header("location: /");
	exit();
}
?>

<main role="main">

	<div class="text-center mt-4">
		<span class="event">Vai rolar um evento bacana no seu estado ou na sua cidade? Conta pra gente!</span>
		<a href="
			<?php
			if (isset($_SESSION['usuario_nome'])) {
				echo URL;
				echo "eventos/addEvento";
			} else {
				echo URL;
				echo "auth/auth";
			}
			?>">
			<button type="button" class="sell ml-2">Clique Aqui!</button>
		</a>
	</div>

	<div class="container mb-5 mt-5">
		<?php
		foreach ($this->dados['eventos'] as $eventos) {
			extract($eventos);
		?>
			<div class="graph">
				<img class="mr-4" src="<?= URL . 'assets/img/eventos/' . $imagem ?>">
				<div class="m-4">
					<p class="graph-name"><?= $nome ?></p>
					<hr>
					<p><?= $descricao ?></p>
					<p><?= $city ?> - <?= $uf ?> - Endereço</p>
				</div>
			</div>
		<?php
		}
		?>
	</div>

</main>