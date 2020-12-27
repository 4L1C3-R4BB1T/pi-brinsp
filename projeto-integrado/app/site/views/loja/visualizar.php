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
			$umProduto = $this->dados['produto'][0];
			extract($umProduto);
			?>
			<div class="col-12 col-md-5 mt-3 container-img">
				<img class="imgproduto" src="<?= URL . 'assets/img/loja/' . $imagem ?>">
			</div>

			<div class="col-12 col-md-5 mt-3">
				<div class="product-information">
					<h2><?= $titulo ?></h2>
					<p class="mt-4"><?= $descricao ?></p>
					<span>
						<span>R$<?= $preco ?>,00</span>
						<a href="<?= URL . 'loja/addProd/' . $id ?>" class="btn btn-default add-to-cart mt-1 ml-2">
							<i class="fa fa-shopping-cart"></i>Adicionar ao Carrinho
						</a>
					</span>
					<p>Por:
						<a href="<?= URL . 'user/visualizar/' . $usuario ?>"><?= $nome ?></a>
					</p>
				</div>
			</div>

			<div class="col-12 col-md-2 mt-3 mb-5 text-center">
				<div>
					<h4 class="font-italic mb-4">Recentes</h4>
					<ol class="list-unstyled">
						<?php
						foreach ($this->dados['prodRecentes'] as $recente) {
							extract($recente);
						?>
							<li class="mb-4">
								<a href="<?= URL . 'loja/visualizar/' . $id ?>">
									<img class="imgrec" src="<?= URL . 'assets/img/loja/' . $imagem ?>">
									<p><?= $titulo ?></p>
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