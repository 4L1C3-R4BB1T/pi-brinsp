<?php
if (!defined('URL')) {
	header("Location: /");
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

	<div class="container pl-5 pr-5 mb-5">
		<?php
		$umUser = $this->dados['user'][0];
		extract($umUser);
		?>
		<div class="container mt-5 mb-5">
			<div class="row">
				<div class="col-12">
					<?php
					if ((isset($_SESSION['usuario_id'])) && ($_SESSION['usuario_id'] == $id)) {
						echo "<a href='" . URL . "user/upUser/" . $_SESSION['usuario_id'] . "' class='btn btn-outline-primary btn-sm float-right'>Editar</a>";
					}
					?>
				</div>
			</div>
			<div class="row mt-4">
				<input name="id" type="hidden" 
					value="<?php if (isset($valorForm['id'])) { echo $valorForm['id']; } ?>">
				<div class="col-md-3"></div>
				<div class="col-12 col-md-3 text-center">
					<?php
					if (!empty($imagem)) {
						echo "<img style='border-radius: 10px;' src='" . URL . "assets/img/usuario/" . $imagem . "' width='200' height='200'>";
					} else {
						echo "<img style='border-radius: 10px;' src='" . URL . "assets/img/usuario/icone_usuario.png' width='150' height='150'>";
					}
					?>
				</div>
				<div class="col-12 col-md-3 text-center mt-5 pt-3">
					<h1 class="perfil-name"><?= $nome ?></h1>
				</div>
				<div class="col-md-3"></div>
			</div>
			<div class="row mt-5 ml-1">
				<div class="col-12">
					<h4>Sobre mim</h4>
				</div>
			</div>
			<div class="row mt-1 ml-1">
				<div class="col-12 justify-content"><?= $bio ?></div>
			</div>
		</div>

		<?php
		if ((isset($_SESSION['usuario_id'])) && ($_SESSION['usuario_id'] <> $id)) {
		?>
			<div class="container">
				<div class="mt-5 col-12">
					<form method="post">
						<div class="form-row">
							<div class="form-group col-12">
								<h5>Enviar Mensagem</h5>
								<textarea name="mensagem" type="text" class="form-control" placeholder="Comente aqui" rows="5"><?php if (isset($valorForm['mensagem'])) { echo $valorForm['mensagem']; } ?></textarea>
							</div>
						</div>
						<input name="EnviarCom" type="submit" class="btn btn-warning float-right" value="Enviar">
					</form>
				</div>
			</div>
		<?php
		}
		?>

		<div class="container mt-5 pt-4">
			<div class="col-12">
				<h4>Mensagens Recebidas</h4>
				<?php
				if ($this->dados['com'] <> null) {
					foreach ($this->dados['com'] as $comentario) {
						extract($comentario);
				?>
						<hr>
						<div class="mt-4">
							<a href="<?= URL . 'user/visualizar/' . $remetente ?>">
								<img class="user-image" src="<?= URL ?>assets/img/usuario/<?= $imagem ?>">
							</a>
							<a class="user-link" href="<?= URL . 'user/visualizar/' . $remetente ?>">
								<span class="ml-2" name="mensagem"><?= $nome ?>:</span>
							</a>
							<span class="ml-1" name="mensagem"><?= $mensagem ?></span>
							<div class="col-12 pb-2">
								<span class="date-coment float-right"><?= $data_envio ?></span>
							</div>
						</div>
						<hr>
					<?php
					}
				} else {
					?>
					<p class="mt-3">Não há mensagens :´(</p>
				<?php
				}
				?>
			</div>
		</div>
	</div>

</main>