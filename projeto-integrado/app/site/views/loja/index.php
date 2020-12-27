<?php
if (!defined('URL')) {
	header("location: /");
	exit();
}
?>

<main role="main">

	<div class="mt-3 text-center">
		<span class="product-sell">Coloque seu produto à venda!</span>
		<a href="
			<?php
			if (isset($_SESSION['usuario_nome'])) {
				echo URL;
				echo "loja/addProduto";
			} else {
				echo URL;
				echo "auth/auth";
			}
			?>">
			<button type="button" class="sell ml-2 mr-2">Clique Aqui!</button>
		</a>
		<img class="image" src="<?= URL ?>assets/img/loja/icon.png" height="80">
	</div>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Tipo</h2>
						<div class="panel-group category-products" id="accordian">
							<div class="panel panel-default">
								<div class="panel-heading mt-2">
									<h4 class="panel-title text-center">
										<a href="<?= URL . 'loja/listarPorTipo/1' ?>">Físico</a>
									</h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title text-center">
										<a href="<?= URL . 'loja/listarPorTipo/2' ?>">Digital</a>
									</h4>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-9 padding-right">
					<div class="features_items">
						<h2 class="title text-center">Produtos</h2>
						<?php
						foreach ($this->dados['produto'] as $umProduto) {
							extract($umProduto);
						?>
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<a href="<?= URL . 'loja/visualizar/' . $id ?>">
												<img src="<?= URL . 'assets/img/loja/' . $imagem ?>">
											</a>
											<h2>R$<?= $preco ?></h2>
											<p><?= $titulo ?></p>
											<a href="<?= URL . 'loja/addProd/' . $id ?>" class="btn btn-default add-to-cart">
												<i class="fa fa-shopping-cart"></i>Adicionar ao Carrinho
											</a>
										</div>
									</div>
								</div>
							</div>
						<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</section>

</main>