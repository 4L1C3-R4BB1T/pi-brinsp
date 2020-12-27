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

	<div class="container">
		<div class="table-responsive">
			<div class="content p-5">
				<div class="list-group-item p-5">
					<form method="POST" action="" enctype="multipart/form-data">
						<div class="form-row">
							<div class="form-group col-12">
								<label>
									<span class="text-danger">*</span>Nome
								</label>
								<input name="nome" type="text" class="form-control" placeholder="Digite o título..." 
									value="<?php if (isset($valorForm['nome'])) { echo $valorForm['nome']; } ?>">
							</div>
						</div>
						<div class="form-row mt-2">
							<div class="form-group col-12">
								<label>
									<span class="text-danger">*</span>Descrição
								</label>
								<input name="descricao" type="text" class="form-control" placeholder="Digite a descrição..." 
									value="<?php if (isset($valorForm['descricao'])) { echo $valorForm['descricao']; } ?>">
							</div>
						</div>
						<div class="form-row mt-2">
							<div class="form-group col-12 col-md-6">
								<label>
									<span class="text-danger">*</span>Estado
								</label>
								<input name="uf" type="text" class="form-control" placeholder="Digite a descrição..." 
									value="<?php if (isset($valorForm['uf'])) { echo $valorForm['uf']; } ?>">
							</div>
							<div class="form-group col-12 col-md-6">
								<label>
									<span class="text-danger">*</span>Cidade
								</label>
								<input name="city" type="text" class="form-control" placeholder="Digite a descrição..." 
									value="<?php if (isset($valorForm['city'])) { echo $valorForm['city']; } ?>">
							</div>
						</div>
						<div class="form-row mt-4">
							<div class="form-group col-12 col-md-6">
								<label>Imagem</label>
								<input name="imagem_nova" type="file" onchange="previewImagem();">
							</div>
							<div class="form-group col-12 col-md-6 text-center">
								<?php
								$imagem_antiga = URL . 'assets/img/usuario/preview_img.png';
								?>
								<img src="<?= $imagem_antiga ?>" alt="Imagem Evento" id="preview-user" class="img-thumbnail">
							</div>
						</div>
						<p>
							<span class="text-danger">* </span>Campo obrigatório
						</p>
						<div class="mb-5">
							<input name="CadEvento" type="submit" class="btn btn-warning float-right" value="Salvar">
							<a href="<?= URL ?>eventos" class="btn btn-danger float-right mr-2">Cancelar</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</main>