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
									<span class="text-danger">*</span>Título
								</label>
								<input name="titulo" type="text" class="form-control" placeholder="Digite o título..." 
									value="<?php if (isset($valorForm['titulo'])) { echo $valorForm['titulo']; } ?>">
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
							<div class="form-group col-12">
								<label>
									<span class="text-danger">*</span>Tipo de Arte
								</label>
								<select name="tipo_arte" id="tipo_arte" class="form-control">
									<option>Selecione</option>
									<option value=1>Tradicional</option>
									<option value=2>Digital</option>
									<option value=3>Artesanato</option>
									<option value=4>Outros</option>
								</select>
							</div>
						</div>
						<div class="form-row mt-4">
							<div class="form-group col-12 col-md-6">
								<label>
									<span class="text-danger">*</span>Imagem
								</label>
								<input name="imagem_nova" type="file" onchange="previewImagem();">
							</div>
							<div class="form-group col-12 col-md-6 text-center">
								<?php
								$imagem_antiga = URL . 'assets/img/usuario/preview_img.png';
								?>
								<img src="<?= $imagem_antiga ?>" alt="Imagem Post" id="preview-user" class="img-thumbnail">
							</div>
						</div>
						<p>
							<span class="text-danger">* </span>Campo obrigatório
						</p>
						<div class="mb-5">
							<input name="CadPost" type="submit" class="btn btn-warning float-right" value="Salvar">
							<a href="<?= URL ?>galeria" class="btn btn-danger float-right mr-2">Cancelar</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</main>