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
		<form method="POST" action="" enctype="multipart/form-data">
			<div class="container mt-5 mb-5">
				<?php
				if (isset($this->dados['form'])) {
					$valorForm = $this->dados['form'];
				}

				if (isset($this->dados['form'][0])) {
					$valorForm = $this->dados['form'][0];
				}
				?>
				<input name="id" type="hidden" 
					value="<?php if (isset($valorForm['id'])) { echo $valorForm['id']; } ?>">
				<div class="row mt-5">
					<div class="col-md-2"></div>
					<div class="col-12 col-md-8">
						<input name="imagem_antiga" type="hidden" 
							value="<?php if (isset($valorForm['imagem_antiga'])) { echo $valorForm['imagem_antiga'];
									} elseif (isset($valorForm['imagem'])) { echo $valorForm['imagem']; } ?>">
						<input name="imagem_nova" type="file" onchange="previewImagem();">
					</div>
					<div class="col-md-2"></div>
				</div>
				<div class="row mt-4">
					<div class="col-md-3"></div>
					<div class="col-12 col-md-3 text-center">
						<?php
						if (isset($valorForm['imagem']) and !empty($valorForm['imagem'])) {
							$imagem_antiga = URL . 'assets/img/usuario/' . $valorForm['imagem'];
						} elseif (isset($valorForm['imagem_antiga']) and !empty($valorForm['imagem_antiga'])) {
							$imagem_antiga = URL . 'assets/img/usuario/' . $valorForm['imagem_antiga'];
						} else {
							$imagem_antiga = URL . 'assets/img/usuario/icone_usuario.png';
						}
						?>
						<img src="<?php echo $imagem_antiga ?>" alt="Imagem do Usuário" id="preview-user" class="img-thumbnail" style="width: 200px; height: 200px;">
					</div>
					<div class="col-12 col-md-3 mt-5 pt-3">
						<label for="nome">Nome:</label>
						<input name="nome" id="nome" type="text" class="form-control" placeholder="Digite o nome completo" 
							value="<?php if (isset($valorForm['nome'])) { echo $valorForm['nome']; } ?>">
					</div>
					<div class="col-md-3"></div>
				</div>
				<div class="row mt-5">
					<div class="col-12">
						<h4>Sobre mim</h4>
					</div>
				</div>
				<div class="row mt-1">
					<div class="col-12">
						<textarea name="bio" type="text" class="form-control" placeholder="Digite sobre você" rows="5"><?php if (isset($valorForm['bio'])) { echo $valorForm['bio']; } ?></textarea>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-12">
						<input name="editUsuario" type="submit" class="btn btn-warning float-right" value="Salvar">
						<a href="<?= URL ?>user/visualizar/<?= $_SESSION['usuario_id'] ?>" class="btn btn-danger float-right mr-2">Cancelar</a>
					</div>
				</div>
			</div>
		</form>
	</div>

</main>